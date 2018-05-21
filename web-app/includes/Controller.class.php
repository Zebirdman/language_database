<?php
  /**
  * a php controller that allows for easy encapsulation of control methods that other files use, basically
  * all logic should be handled here as much as possible with cooperation from other classes.
  *
  * TODO: remove sql from class into a seperate sql manager class.
  * TODO: remove duplicate logic and condense functions better
  */

  class Controller {

    private $database; // the database object used for serving sql queries
    private $log; // the php logger used for debuggin and error messaging
    private $validator; // the php validation object used for sanitization and field checking

    /**
    * contructor with dependancy injection for the database connection, validator and log classes that
    * are needed.
    */
    public function __construct($database, $log, $validator) {
      $this->database = $database;
      $this->log = $log;
      $this->validator = $validator;
    }

    /**
    * retrieves the management menu section in response to a js ajax call
    */
    public function getManagementMenu() {
      $data = array(
        'numGram' => 0,
        'numLang' => 0,
        'numBiblio' => 0,
      );
      $database = Factory::createConnection();

      $row = $database->getterQuery("SELECT COUNT(id) AS numGram FROM changes_grammatical WHERE active = 'true'");
      $temp1 = $row->fetch();
      $data['numGram'] = $temp1['numGram'];

      $row = $database->getterQuery("SELECT COUNT(id) AS numLang FROM languages WHERE active = 'true'");
      $temp2 = $row->fetch();
      $data['numLang'] = $temp2['numLang'];

      $row = $database->getterQuery("SELECT COUNT(id) AS numBiblio FROM bibliography WHERE active = 'true'");
      $temp3 = $row->fetch();
      $data['numBiblio'] = $temp3['numBiblio'];

      htmlManager::getManagementMenu($data);
    }

    /**
    * creates a language page using the html manager and fills it with the first 20 rows
    */
    public function getLanguagesPage() {
      htmlManager::getLanguagesPage();
    }

    /**
    * creates a bibliography page using the html manager and fills it with the first 20 rows
    */
    public function getBibliographyPage() {
      htmlManager::getBibliographyPage();
    }

    /**
    * creates a bibliography page using the html manager and fills it with the first 20 rows
    */
    public function getGramChangePage() {
      htmlManager::getGramChangePage();
    }

    /**
    * handles the submission of the public form, processes the input data both file and text
    *
    * @param data - the array containing the text information
    * @param file - the files array
    */
    public function submitPublicForm($data, $file) {
      $val = Factory::createValidator();
      $database = Factory::createConnection();

      $sql = "INSERT INTO submissions(fName,lName,organisation,email1,email2,submissionType,notes,filePath,";
      $sql = $sql."optionSelected,currentStatus) VALUES (:fName,:lName,:org,:em1,:em2,:subT,:notes,:fPath,:opt,";
      $sql = $sql.":status)";

      $val->filterRules(FilterControl::publicFormFilters());
      $val->validationRules(FilterControl::publicFormValidators());

      $destination = "../uploads/".$_FILES['file']['name'];
      $this->log->output($_FILES['file']);
      $values = array(
        ':fName' => $data['first-name'],
        ':lName' => $data['last-name'],
        ':org' => $data['organisation'],
        ':em1' => $data['email-1'],
        ':em2' => $data['email-2'],
        ':subT' => $data['submission-type'],
        ':notes' => $data['notes'],
        ':fPath' => "/uploads/".$_FILES['file']['name'],
        ':opt' => $data['option-selected'],
        ':status' => 'submitted',
      );
      $this->log->output($destination);
      $file = $_FILES['file']['tmp_name'];
      move_uploaded_file($file, $destination);

      if($val->run($data)) {

        $database->setterQuery($values, $sql);
        http_response_code(200);
        echo "Thanks for your submission!";
      } else {

        http_response_code(400);
        echo $val->message();
      }
    }

    /**
    * Adds a new record to the database switches based off name of table
    *
    * @param data - the POST array containing the data to add
    */
    public function addNewRecord($data) {

      $val = Factory::createValidator();
      $database = Factory::createConnection();
      $table = $data['form'];
      $this->log->output("Processing data");
      switch($table) {

        case "changes_grammatical":
          $sql = "INSERT INTO changes_grammatical(lang_id, changeTitle, changeType,domain,whenChanged,certainty,evidenceType,changeNotes)";
          $sql = $sql." VALUES (:lang_id,:change,:type,:domain,:whenChanged,:certainty,:evidenceType,:changeNotes)";
          $this->log->output($sql);
          $this->log->output($data);
          $val->filterRules(FilterControl::changeGramFilters());
          $val->validationRules(FilterControl::changeGramValidators());

          $values = array(
            ':lang_id' => (int)$data['langID'],
            ':change' => $data['changeTitle'],
            ':type' => $data['changeType'],
            ':domain' => $data['domain'],
            ':whenChanged' => $data['when'],
            ':certainty' => $data['certainty'],
            ':evidenceType' => $data['evidenceType'],
            ':changeNotes' => $data['changeNotes'],
          );
          break;

        case "bibliography":
          $sql = "INSERT INTO bibliography(type,title,author,journal,year,month,pages,volume,arxiv,doi,gsid,issue,numpages,publisher,url)";
          $sql = $sql." VALUES(:type,:title,:author,:journal,:year,:month,:pages,:volume,:arxiv,:doi,:gsid,:issue,:numpages,:publisher,:url)";
          $val->filterRules(FilterControl::biblioFilters());
          $val->validationRules(FilterControl::biblioValidators());

          $values = array(
            ':type' => $data['type'],
            ':title' => $data['title'],
            ':author' => $data['author'],
            ':journal' => $data['journal'],
            ':year' => (int)$data['year'],
            ':month' => $data['month'],
            ':pages' => (int)$data['pages'],
            ':volume' => (int)$data['volume'],
            ':arxiv' => (int)$data['arxiv'],
            ':doi' => $data['doi'],
            ':gsid' => (int)$data['gsid'],
            ':issue' => (int)$data['issue'],
            ':numpages' => (int)$data['numpages'],
            ':publisher' => $data['publisher'],
            ':url' => $data['url'],
          );
          break;
      }
      if($val->run($data)) {

        $database->setterQuery($values, $sql);
        http_response_code(200);
        echo "Record Succesfully Created";

      } else {

        http_response_code(400);
        echo $val->message();
      }
    }

    /**
    * Checks whether or not a person is logged in and the session timer hasnt expired, renews the timer if
    * the session is still valid
    */
    public function checkLogin() {

      if(!isset($_SESSION)) {
        session_start();
      }
      $time = time();

      if(!$_SESSION['logged_in']) {
        $this->log->output("login doesnt exist");
        header("location: login.php");
      } else {
        if($_SESSION["start"] - $time <= 0) {
          $this->log->output("session expired");
          $this->logout();
        } else {
          $_SESSION["start"] = time() + 600;
          $this->log->output("session renewed");
        }
      }
    }

    /**
    * refreshes the login timer, used in cunjunction with requests to refresh based upon user
    * interaction.
    */
    public function refreshLogin() {
      $_SESSION["start"] = time() + 600;
      $this->log->output("session is refreshed");
    }

    /**
    * Logs someone in and creates a session TODO: manage sessions better, create session manager class
    *
    * @param data - the POST array data containing log in information
    */
    public function login($data) {

      if($data['username'] == USERNAME && $data['password'] == PASSWORD) {
        session_start();
        $_SESSION["start"] = time() + 600;
        $_SESSION["logged_in"] = true;
        $_SESSION['last-sql'] = '';
        $_SESSION['last-table'] = '';
        $_SESSION['last-start'] = 0;
        $_SESSION['last-finish'] = 0;
        echo "manage.php";
      }
    }

    /**
    * logs someone out and destroys the session variables
    */
    public function logout() {
      if(!isset($_SESSION)) {
        session_start();
      }
      unset($_SESSION["logged_in"]);
      unset($_SESSION["start"]);
      session_destroy();
      header("location: ../login.php");
    }
    public function getPublicColumnFilter($data) {
      $table = $data['table'];
      if($table == 'languages') {
        htmlManager::getPublicSearchLanguageFilter();
      } else if($table == 'changes_grammatical') {
        htmlManager::getPublicSearchGramFilter();
      } else if($table == 'bibliography') {
        htmlManager::getPublicSearchBiblioFilter();
      }
    }

    /**
    * retrieves a suggestion list based on a sql LIKE search of a given table
    *
    * @param value - the value to search for
    * @param table - the database table to search in
    */
    public function getSuggestions($value, $table) {
      $col;
      if($table == "bibliography") {
        $col = "title";
      } else if($table == "changes_grammatical") {
        $col = "changeTitle";
      } else if($table == 'languages') {
        $col = "language";
      }
      $database = Factory::createConnection();
      $value = $value.'%';
      if($table == 'changes_grammatical') {
        $sql = "SELECT lang_id, language FROM  changes_grammatical C, languages L";
        $sql = $sql." WHERE L.language LIKE '$value' AND C.active = 'true' AND L.active = 'true'";
        $sql = $sql." AND C.lang_id = L.id GROUP BY language, lang_id ORDER BY language LIMIT 0, 10";
      } else {
        $sql = "SELECT * FROM $table WHERE $col LIKE '$value' AND active = 'true' ORDER BY $col LIMIT 0, 10";
      }
      $this->log->output($sql);
      $data = $database->getterQuery($sql);
      $rowsReturned = 0;
      while($row = $data->fetch()) {
        if($table == 'languages') {
          htmlManager::getDatalist($row['id'], $row['language']);
        } else if($table == "bibliography"){
          htmlManager::getDatalist($row['id'], $row['title']);
        } else if($table == "changes_grammatical") {
          htmlManager::getDatalist($row['lang_id'], $row['language']);
        }
        $rowsReturned++;
      }
      if($rowsReturned == 0) {
        echo "no results";
      }
    }

    /**
    * retrieves a suggest list based on a given column filter
    *
    * @param value - the value to be searched for
    * @param table - the database table to search
    * @param col - the column to search for the value in
    */
    public function getFilteredSuggestions($value, $table, $col) {

      $database = Factory::createConnection();
      $value = $value.'%';

      if($table == 'bibliography') {
        $pk = 'id';

      } else if($table == 'languages') {
        $pk = 'id';

      } else if($table == 'changes_grammatical') {
        $pk = 'id';
        if($col == 'language') {
          $pk = 'lang_id';
        }
      }
      $this->log->output("MARKER FOR COLUMN SENT, SUGGESTIONS");
      $this->log->output($col);

      if($table == 'changes_grammatical') {
        if($col == 'changeType') {

          $sql = "SELECT C.id, changeType FROM  changes_grammatical C, languages L";
          $sql = $sql." WHERE changeType LIKE '$value' AND C.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND changeType != ' ' GROUP BY changeType, C.id ORDER BY changeType LIMIT 0, 10";

        } else if($col == 'language') {

          $sql = "SELECT lang_id, language FROM  changes_grammatical C, languages L";
          $sql = $sql." WHERE L.language LIKE '$value' AND C.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND C.lang_id = L.id GROUP BY language, lang_id ORDER BY language LIMIT 0, 10";

        } else if($col == 'changeTitle') {

          $sql = "SELECT C.id, changeTitle FROM  changes_grammatical C, languages L";
          $sql = $sql." WHERE changeTitle LIKE '$value' AND C.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND changeTitle != ' ' GROUP BY changeTitle, C.id ORDER BY changeType LIMIT 0, 10";
        }
      } else if($table == 'bibliography') {

        if($col == 'type') {

          $sql = "SELECT id, type FROM  bibliography";
          $sql = $sql." WHERE type LIKE '$value' AND active = 'true' ";
          $sql = $sql." AND type != ' ' GROUP BY type, id ORDER BY type LIMIT 0, 10";

        } else if($col == 'title') {

          $sql = "SELECT id, title FROM  bibliography";
          $sql = $sql." WHERE title LIKE '$value' AND active = 'true' ";
          $sql = $sql." AND title != ' ' GROUP BY title, id ORDER BY title LIMIT 0, 10";

        } else if($col == 'author') {

          $sql = "SELECT id, author FROM  bibliography";
          $sql = $sql." WHERE author LIKE '$value' AND active = 'true' ";
          $sql = $sql." AND author != ' ' GROUP BY author, id ORDER BY author LIMIT 0, 10";
        }
      } else if($table == 'languages') {
        $col = 'language';
        $sql = "SELECT * FROM languages WHERE language LIKE '$value' AND active = 'true' ORDER BY $col LIMIT 0, 10";
      }

      $this->log->output($sql);
      $rowsReturned = 0;
      $data = $database->getterQuery($sql);

      while($row = $data->fetch()) {
        $rowsReturned++;
        htmlManager::getDatalist($row[$pk], $row[$col]);
      }
      if($rowsReturned == 0) {
        echo "no results";
      }
    }

    /**
    * TODO: aggregate this with the above and clean up this mess!
    */
    public function getFilteredSuggestionsReferences($value, $table, $col, $gramID) {
      $database = Factory::createConnection();
      $value = $value.'%';

      if($col == 'type') {
        $col = 'type';
        $sql = "SELECT B.id, B.type FROM  bibliography B";
        $sql = $sql." WHERE B.type LIKE '$value' AND B.active = 'true'  AND type != ' ' ";
        $sql = $sql." AND NOT EXISTS (SELECT * FROM change_references C WHERE B.id = C.referenceID AND B.type LIKE '$value' AND C.changeID = $gramID)";

      } else if($col == 'title') {
        $col = 'title';
        $sql = "SELECT B.id, B.title FROM  bibliography B";
        $sql = $sql." WHERE B.title LIKE '$value' AND B.active = 'true'  AND title != ' ' ";
        $sql = $sql." AND NOT EXISTS (SELECT * FROM change_references C WHERE B.id = C.referenceID AND B.title LIKE '$value' AND C.changeID = $gramID)";

      } else if($col == 'author') {
        $col = 'author';
        $sql = "SELECT B.id, B.author FROM  bibliography B";
        $sql = $sql." WHERE B.author LIKE '$value' AND B.active = 'true'  AND author != ' ' ";
        $sql = $sql." AND NOT EXISTS (SELECT * FROM change_references C WHERE B.id = C.referenceID AND B.author LIKE '$value' AND C.changeID = $gramID)";
      }
      $this->log->output($sql);
      $rowsReturned = 0;
      $data = $database->getterQuery($sql);
      while($row = $data->fetch()) {
        $rowsReturned++;
        htmlManager::getDatalist($row['id'], $row[$col]);
      }
      if($rowsReturned == 0) {
        echo "no results";
      }
    }

    /**
    * retrieves and prints out a set of rows from a given table.
    *
    * @param start - the starting point for the row numbers
    * @param finish - the finishing point for the row numbers
    * @param table - the name of the table to be queried
    */
    public function getTableRows($start, $finish, $table) {

      $database = Factory::createConnection();

      if($table == 'languages' || $table == 'bibliography') {
        $sql = "SELECT * FROM  $table WHERE active = 'true' AND id > $start LIMIT $finish";
      } else {
        $sql = "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
        $sql = $sql. " FROM $table G, languages L WHERE G.lang_id = L.id  AND G.active = 'true' AND L.active = 'true' AND G.id > $start LIMIT $finish";
      }
      $data = $database->getterQuery($sql);
      $this->log->output($table);

      while($row = $data->fetch()) {
        if($table == 'languages') {
          htmlManager::getLanguageTable($row);
        } elseif($table === "changes_grammatical") {
          htmlManager::getGrammaticalTable($row);
        } elseif($table === "bibliography") {
          htmlManager::getBibliographyTable($row);
        }
      }?>
      <tr hidden>
        <td id="row_start" hidden><?php echo $start;?></td>
        <td id="row_finish" hidden><?php echo $finish;?></td>
      </tr>
      <?php
    }

    /**
    * retrieves and prints out a set of rows from a given table.
    * @param start - the starting point for the row numbers
    * @param finish - the finishing point for the row numbers
    * @param table - the name of the table to be queried
    */
    public function getFilteredSearchResults($data) {
      $key = $data['key'];
      $table = $data['table'];
      $col = $data['column'];
      $start = 0;
      $finish = 20;

      $database = Factory::createConnection();
      if($table == 'changes_grammatical') {
        if($col == 'language') {

          $sql = "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
          $sql = $sql." FROM changes_grammatical G, languages L WHERE G.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND G.lang_id = L.id AND G.lang_id = $key LIMIT $finish";

        } else if($col == 'changeTitle') {

          $name = $data['name'];
          $sql= "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
          $sql = $sql." FROM changes_grammatical G, languages L WHERE G.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND G.lang_id = L.id AND G.changeTitle = '$name' LIMIT $finish";

        } else if($col == "changeType") {
          $name = $data['name'];
          $sql= "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
          $sql = $sql." FROM changes_grammatical G, languages L WHERE G.active = 'true' AND L.active = 'true'";
          $sql = $sql." AND G.lang_id = L.id AND G.changeType = '$name' LIMIT $finish";
        }

      } else if($table == 'languages') {

        $sql = "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
        $sql = $sql. " FROM $table G, languages L WHERE G.lang_id = L.id  AND G.active = 'true' AND L.active = 'true' AND G.id > $start LIMIT $finish";

      } else if($table == 'bibliography') {

        $name = $data['name'];
        $sql = "SELECT * FROM bibliography WHERE $col = '$name' AND active = 'true' ORDER BY $col LIMIT $finish";

      }

      $data = $database->getterQuery($sql);
      $this->log->output($table);

      while($row = $data->fetch()) {
        if($table == 'languages') {
          htmlManager::getLanguageTable($row);
        } elseif($table === "changes_grammatical") {
          htmlManager::getGrammaticalTable($row);
        } elseif($table === "bibliography") {
          htmlManager::getBibliographyTable($row);
        }
      }?>
      <tr hidden>
        <td id="row_start" hidden><?php echo $start;?></td>
        <td id="row_finish" hidden><?php echo $finish;?></td>
      </tr>
      <?php
    }

    // ** ------------------------- handlers for assign references page -------------------------------------

    /**
    * gets filtered search results that are used on the assign references part of the management interface
    *
    * @param data - the POST array data to be processed
    */
    public function getFilteredSearchResultsRefsPage($data) {
      $key = $data['key'];
      $gramID = $data['gramID'];
      $table = $data['table'];
      $col = $data['column'];
      $name = $data['name'];
      $database = Factory::createConnection();
      $sql = "SELECT B.id, B.type, B.title, B.author FROM bibliography B WHERE $col = '$name' ";
      $sql = $sql." AND B.active = 'true' ";
      $data = $database->getterQuery($sql);
      $this->log->output($table);
      $this->log->output($sql);

      while($row = $data->fetch()) {
        htmlManager::getBibliographyAddRefsTable($row);
      }?>
      <tr hidden>
        <td id="row_start" hidden></td>
        <td id="row_finish" hidden></td>
      </tr>
      <?php
    }

    /**
    * attaches a bibliography record to a grammatical change by creating a record in the change references
    * table.
    *
    * @param data - the POST array containing the data to submit
    */
    public function attachReference($data) {
      $gramID = $data['gramID'];
      $refID = $data['refID'];
      $database = Factory::createConnection();
      $sql = "INSERT INTO change_references (referenceID, changeID) VALUES (:refID, :gramID)";
      $values = array(
        ':refID' => $refID,
        ':gramID' => $gramID,
      );
      $data = $database->setterQuery($values, $sql);
    }

    /**
    * removes a bibliography reference from a grammatical change by deleting a record
    *
    * @param data - the POST array containing the data to match for record deletion
    */
    public function removeReference($data) {
      $gramID = $data['gramID'];
      $refID = $data['refID'];
      $database = Factory::createConnection();
      $sql = "DELETE FROM change_references WHERE changeID = $gramID AND referenceID = $refID";
      $data = $database->getterQuery($sql);
    }

    /**
    * Retrieves references that are assigned to a given grammatical change as a set of html elements
    *
    * @param data - the POST array with relevant data
    */
    public function retrieveReferences($data) {
      $id = $data['gramID'];
      $database = Factory::createConnection();
      $sql = "SELECT B.id, B.type, B.title, B.author FROM bibliography B, change_references C WHERE ";
      $sql = $sql."B.id = C.referenceID AND C.changeID = $id";

      $data = $database->getterQuery($sql);

      while($row = $data->fetch()) {
        htmlManager::getBibliographyRemoveRefsTable($row);
      }?>
      <tr hidden>
        <td id="row_start" hidden></td>
        <td id="row_finish" hidden></td>
      </tr>
      <?php
    }

    /**
    * used to retireve a grammatical change result for assign references part of the site
    *
    * @param data - the POST array data
    */
    public function getAssignRefsPage($data) {
      $key = $data['id'];
      $sql = "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
      $sql = $sql." FROM changes_grammatical G, languages L WHERE G.active = 'true' AND L.active = 'true'";
      $sql = $sql." AND G.lang_id = L.id AND G.id = $key";
      $database = Factory::createConnection();
      $data = $database->getterQuery($sql);
      $this->log->output($sql);
      $row = $data->fetch();
      htmlManager::getAssignRefsPage($row);
    }

    /**
    * retrieves tables for the public search area
    *
    * @param data - the POST array data
    */
    public function getPublicSearchTable($data) {
      $key = $data['key'];
      $table = $data['table'];

      if($table == 'languages') {
        $col = 'language';
        $sql = "SELECT * FROM languages WHERE id = $key AND active = 'true' LIMIT 20";
      } else if($table == 'changes_grammatical') {
        $col = 'lang_id';
        $sql = "SELECT G.id, lang_id, language, changeTitle, changeType, domain, whenChanged, certainty, evidenceType, changeNotes";
        $sql = $sql." FROM changes_grammatical G, languages L WHERE G.active = 'true' AND L.active = 'true'";
        $sql = $sql." AND G.lang_id = L.id AND G.lang_id = $key LIMIT 20";
      } else if($table == 'bibliography') {
        $col = 'title';
        $sql = "SELECT * FROM bibliography WHERE id = $key AND active = 'true' LIMIT 20";
      }
      $database = Factory::createConnection();
      $data = $database->getterQuery($sql);
      $this->log->output($table);

      while($row = $data->fetch()) {
        if($table == 'languages') {
          htmlManager::getPublicLanguageTable($row);
        } elseif($table === "changes_grammatical") {
          htmlManager::getPublicGrammaticalTable($row);
        } elseif($table === "bibliography") {
          htmlManager::getPublicBibliographyTable($row);
        }
      }?>
      <tr hidden>
        <td id="row_start" hidden></td>
        <td id="row_finish" hidden></td>
      </tr>
      <?php
    }

    /**
    * returns the results from a public search page query
    */
    public function getPublicSearchResults($data) {
       $key = $data['key'];
       $table = $data['table'];
       if($table == 'languages') {
         htmlManager::searchPageLanguageResults();
       } else if($table == 'changes_grammatical') {
         htmlManager::searchPageGramResults();
       } else if($table == 'bibliography') {
         htmlManager::searchPageBiblioResults();
       }
     }

    /**
    * retrieves and prints out a set of rows from a given table.
    *
    * @param start - the starting point for the row numbers
    * @param finish - the finishing point for the row numbers
    * @param table - the name of the table to be queried
    */
    public function updateTableCell($pk_name, $pk, $table, $column, $value) {

      $database = Factory::createConnection();
      $sql = "SET SQL_SAFE_UPDATES=0; UPDATE $table SET $column = '$value' WHERE $pk_name = '$pk'";
      $this->log->output($sql);
      $database->runQuery($sql);
    }

    /**
    * deletes a row by making the active field read false
    *
    * @param data - the POST array containing the relevant info
    */
    public function deleteRecord($data) {

      $database = Factory::createConnection();
      $table = $data['table'];
      $keyVal = $data['id'];
      if($table == 'languages') {
        $col = 'code';
      } else {
        $col = 'id';
      }
      $sql = "SET SQL_SAFE_UPDATES=0; UPDATE $table SET active = 'false' WHERE $col = '$keyVal'";
      $this->log->output($sql);
      $database->runQuery($sql);
    }
  }
 ?>
