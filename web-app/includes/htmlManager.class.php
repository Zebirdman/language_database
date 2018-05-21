<?php
  /**
  * statis php class for holding all html elements that will dynamically requested from the site.
  * the javascript controller makes the request, the php listener creates a controller in response
  * to the request and the controller retrieves all html elements from here.
  *
  */
  class htmlManager {

    /**
    * holds the html for a datalist set of items
    */
    public static function getDatalist($id, $col) {?>
      <a class="list-suggest" id="<?php echo $id?>" name="list"><?php echo $col?></a>
      <?php
    }

    /**
    * holds the html for the main management menu
    */
    public static function getManagementMenu($data) {?>
      <div class="center">
        <h4>Grammatical Changes Database Tables</h4>
        <br>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn center">
              <button type="button" class="btn btn-primary mybtn mybtn-large main-menu-buttons" id="lang_button">Languages</button>
            </span>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn center">
              <button type="button" class="btn btn-primary mybtn mybtn-large main-menu-buttons" id="gramChange_button">Grammatical Changes</button>
            </span>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn center">
              <button type="button" class="btn btn-primary mybtn mybtn-large main-menu-buttons" id="biblio_button">Bibliography</button>
            </span>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-2 bordered">
          <h5>Language Table Stats</h5>
          <p>Total Records: <?php echo $data['numLang']?></p>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="col-lg-2 bordered">
          <h5>Grammatical Changes Table Stats</h5>
          <p>Total Records: <?php echo $data['numGram']?></p>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="col-lg-2 bordered">
          <h5>Bibliography Table Stats</h5>
          <p>Total Records: <?php echo $data['numBiblio']?></p>
        </div>
        <div class="col-lg-1">
        </div>
      </div>
      <br>
      <?php
    }

    /**
    * holds the html for a language table record
    */
    public static function getLanguageTable($row) {?>
      <tr>
        <td name="pk"><?php echo $row['code'];?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="language"><?php echo $row['language']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="retired"><?php echo $row['retired']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="north_limit"><?php echo $row['north_limit']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="south_limit"><?php echo $row['south_limit']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="west_limit"><?php echo $row['west_limit']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="east_limit"><?php echo $row['east_limit']?></td>
        <td contenteditable='true' id="<?php echo $row['code'];?>" name="description"><?php echo $row['description']?></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['code'];?>" name="delete">Delete Record</button></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getGrammaticalTable($row) {?>
      <tr>
        <td name="pk"><?php echo $row['id'];?></td>
        <td contenteditable='true' name="language" id="<?php echo $row['id'];?>"><?php echo $row['language']?></td>
        <td contenteditable='true' name="changeTitle" id="<?php echo $row['id'];?>"><?php echo $row['changeTitle']?></td>
        <td contenteditable='true' name="changeType" id="<?php echo $row['id'];?>"><?php echo $row['changeType']?></td>
        <td contenteditable='true' name="domain" id="<?php echo $row['id'];?>"><?php echo $row['domain']?></td>
        <td contenteditable='true' name="whenChanged" id="<?php echo $row['id'];?>"><?php echo $row['whenChanged']?></td>
        <td contenteditable='true' name="certainty" id="<?php echo $row['id'];?>"><?php echo $row['certainty']?></td>
        <td contenteditable='true' name="evidenceType" id="<?php echo $row['id'];?>"><?php echo $row['evidenceType']?></td>
        <td contenteditable='true' name="changeNotes" id="<?php echo $row['id'];?>"><?php echo $row['changeNotes']?></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['id'];?>" name="add-reference">Add References</button></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['id'];?>" name="delete">Delete Record</button></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getBibliographyTable($row) {?>
      <tr>
        <td name="pk"><?php echo $row['id'];?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="type"><?php echo $row['type']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="title"><?php echo $row['title']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="author"><?php echo $row['author']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="journal"><?php echo $row['journal']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="year"><?php echo $row['year']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="month"><?php echo $row['month']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="pages"><?php echo $row['pages']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="volume"><?php echo $row['volume']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="arxiv"><?php echo $row['arxiv']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="doi"><?php echo $row['doi']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="gsid"><?php echo $row['gsid']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="issue"><?php echo $row['issue']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="numpages"><?php echo $row['numpages']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="publisher"><?php echo $row['publisher']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="url"><?php echo $row['url']?></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['id'];?>" name="delete">Delete Record</button></td>
      </tr><?php
    }

    /**
    * holds the html for a language table record
    */
    public static function getPublicLanguageTable($row) {?>
      <tr>
        <td  id="<?php echo $row['code'];?>" name="language"><?php echo $row['language']?></td>
        <td  id="<?php echo $row['code'];?>" name="retired"><?php echo $row['retired']?></td>
        <td  id="<?php echo $row['code'];?>" name="north_limit"><?php echo $row['north_limit']?></td>
        <td  id="<?php echo $row['code'];?>" name="south_limit"><?php echo $row['south_limit']?></td>
        <td  id="<?php echo $row['code'];?>" name="west_limit"><?php echo $row['west_limit']?></td>
        <td  id="<?php echo $row['code'];?>" name="east_limit"><?php echo $row['east_limit']?></td>
        <td  id="<?php echo $row['code'];?>" name="description"><?php echo $row['description']?></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getPublicGrammaticalTable($row) {?>
      <tr id="<?php echo $row['id'];?>">
        <td name="language" id="<?php echo $row['id'];?>"><?php echo $row['language']?></td>
        <td name="changeTitle" id="<?php echo $row['id'];?>"><?php echo $row['changeTitle']?></td>
        <td name="changeType" id="<?php echo $row['id'];?>"><?php echo $row['changeType']?></td>
        <td name="domain" id="<?php echo $row['id'];?>"><?php echo $row['domain']?></td>
        <td name="whenChanged" id="<?php echo $row['id'];?>"><?php echo $row['whenChanged']?></td>
        <td name="certainty" id="<?php echo $row['id'];?>"><?php echo $row['certainty']?></td>
        <td name="evidenceType" id="<?php echo $row['id'];?>"><?php echo $row['evidenceType']?></td>
        <td name="changeNotes" id="<?php echo $row['id'];?>"><?php echo $row['changeNotes']?></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getPublicBibliographyTable($row) {?>
      <tr>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="type"><?php echo $row['type']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="title"><?php echo $row['title']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="author"><?php echo $row['author']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="journal"><?php echo $row['journal']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="year"><?php echo $row['year']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="month"><?php echo $row['month']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="pages"><?php echo $row['pages']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="volume"><?php echo $row['volume']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="arxiv"><?php echo $row['arxiv']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="doi"><?php echo $row['doi']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="gsid"><?php echo $row['gsid']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="issue"><?php echo $row['issue']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="numpages"><?php echo $row['numpages']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="publisher"><?php echo $row['publisher']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="url"><?php echo $row['url']?></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getBibliographyAddRefsTable($row) {?>
      <tr>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="type"><?php echo $row['type']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="title"><?php echo $row['title']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="author"><?php echo $row['author']?></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['id'];?>" name="assign">Add</button></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical changes table record
    */
    public static function getBibliographyRemoveRefsTable($row) {?>
      <tr>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="type"><?php echo $row['type']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="title"><?php echo $row['title']?></td>
        <td contenteditable='true' id="<?php echo $row['id'];?>" name="author"><?php echo $row['author']?></td>
        <td><button type="button" class="btn btn-default table-row-btns" id="<?php echo $row['id'];?>" name="remove">Remove</button></td>
      </tr><?php
    }

    /**
    * holds the html for a grammatical change add record form
    */
    public static function getGrammaticalForm() {?>
    <div id="hidden" hidden="true">
      <form class="form-inline" id="form" name="changes_grammatical" method="post" action="<?php echo LISTENER?>">
        <div class="form-group dropdown-custom" id="lang-search">
          <input type="text" class="form-control" placeholder="Language" name="languages">
          <div class="dropdown-content-custom" id="lang-search-content">
          </div>
        </div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Change" name="changeTitle"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Change Type" name="changeType"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Domain" name="domain"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="When" name="whenChanged"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Certainity" name="certainty"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Evidence Type" name="evidenceType"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Notes" name="changeNotes"></div>
        <button type="submit" class="btn btn-default" id="form-button">Submit Changes</button>
      </form>
      <br>
      <div class="spaced-tab">
        <div id="result-div">
          <p id="form-result"></p>
        </div>
      </div>
    </div><?php
    }

    /**
    * holds the html for a bibliography add record form
    */
    public static function getBibliographyForm() {?>
    <div id="hidden" hidden="true">
      <form class="form-inline" method="post" name="bibliography" action="<?php echo LISTENER?>" id="form">
        <div class="form-group"><input type="text" class="form-control" placeholder="Type" name="type"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Title" name="title"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Author" name="author"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Journal" name="journal"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Year" name="year"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Month" name="month"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Pages" name="pages"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Volume" name="volume"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Arxiv" name="arxiv"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Doi" name="doi"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="GSID" name="gsid"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Issue" name="issue"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Numpages" name="numpages"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Publisher" name="publisher"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="URL" name="url"></div>
        <button type="submit" class="btn btn-default" id="form-button">Submit Changes</button>
      </form>
      <br>
      <div class="spaced-tab">
        <div id="result-div">
          <p id="form-result"></p>
        </div>
      </div>
    </div><?php
    }

    /**
    * holds the html for a language record form
    */
    public static function getLanguageForm() {?>
    <div hidden>
      <form class="form-inline hidden-form">
        <div class="form-group"><input type="text" class="form-control" placeholder="Language"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Change"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Change Type"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Domain"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="When"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Certainity"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Evidence Type"></div>
        <div class="form-group"><input type="text" class="form-control" placeholder="Notes"></div>
        <button type="submit" class="btn btn-default">Submit Changes</button>
      </form>
      <br>
      <div class="spaced-tab">
        <div id="result-div">
          <p id="form-result"></p>
        </div>
      </div>
    </div><?php
    }

    /**
    * holds the html for the languages page
    */
    public static function getLanguagesPage() {?>
      <h4>Languages Table Options</h4>
      <div class="row">
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="main_button">Tables Menu</button>
            </span>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button" id="search-go">Go</button>
            </span>
            <div id="lang-search">
              <input type="text" class="form-control" placeholder="Search for..." name="languages">
              <div class="dropdown-content-custom special-margin" id="lang-search-content">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="back_button" >Back</button>
            </span>
          </div>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="next_button">Next</button>
            </span>
          </div>
        </div>
      </div>
      <br>
      <table class="table table-striped">
        <thead name="languages code" id="table_name">
          <tr>
            <th>Code</th>
            <th>Language</th>
            <th>Retired</th>
            <th>North Limit</th>
            <th>South Limit</th>
            <th>West Limit</th>
            <th>East Limit</th>
            <th>Description</th>
          </tr>
        </thead>
        <tfoot>
          <tr>

          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
        <?php
    }


    /**
    * holds the html for the languages page
    */
    public static function getBibliographyPage() {?>
      <h4>Bibliography Table Options</h4>
      <div class="row">
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="main_button">Tables Menu</button>
            </span>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="anr_button">Add New Record</button>
            </span>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button" id="filtered-search-go">Go</button>
            </span>
            <div  id="biblio-search-filtered">
              <input type="text" class="form-control" placeholder="Search for..." name="bibliography">
              <div class="dropdown-content-custom special-margin" id="biblio-search-content-filtered">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <select class="form-control custom-select" id="suggest-filter-biblio">
            <option value="type" default>Type</option>
            <option value="title">Title</option>
            <option value="author">Author</option>
          </select>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="back_button" >Back</button>
            </span>
          </div>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="next_button">Next</button>
            </span>
          </div>
        </div>
      </div>
      <br>
      <?php
      htmlManager::getBibliographyForm();
      htmlManager::getLanguageForm();
      ?>
      <table class="table table-striped">
        <thead name="bibliography id" id="table_name">
        <tr>
          <th>Id</th>
          <th>Type</th>
          <th>Title</th>
          <th>Author</th>
          <th>Journal</th>
          <th>Year</th>
          <th>Month</th>
          <th>Pages</th>
          <th>Volume</th>
          <th>Arxiv</th>
          <th>Doi</th>
          <th>GSID</th>
          <th>Issue</th>
          <th>Numpages</th>
          <th>Publisher</th>
          <th>URL</th>
        </tr>
        </thead>
        <tfoot>
          <tr>

          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
        <?php
    }

    public static function getPublicSearchLanguageFilter() {?>
      <div class="col-lg-2" name="languages">
          <select class="form-control custom-select " id="active" >
            <option value="language" selected>Language</option>
          </select>
        </div>
      <?php
    }

    public static function getPublicSearchGramFilter() {?>
      <div class="col-lg-2" name="changes_grammatical">
          <select class="form-control custom-select " id="active" >
            <option value="changeTitle" selected>Change</option>
            <option value="changeType">Change Type</option>
            <option value="language">Language</option>
          </select>
        </div>
      <?php
    }

    public static function getPublicSearchBiblioFilter() {?>
      <div class="col-lg-2" name="bibliography">
          <select class="form-control custom-select " id="active" >
            <option value="type" selected>Type</option>
            <option value="title">Title</option>
            <option value="author">Author</option>
          </select>
        </div>
      <?php
    }

    public static function searchPageLanguageResults() {?>
      <table class="table table-striped">
        <thead id="table_name">
          <tr>
            <th>Language</th>
            <th>Retired</th>
            <th>North Limit</th>
            <th>South Limit</th>
            <th>West Limit</th>
            <th>East Limit</th>
            <th>Description</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
      <?php
    }

    public static function searchPageGramResults() {?>
      <table class="table table-striped">
        <thead id="table_name">
          <tr>
            <th>Language</th>
            <th>Change</th>
            <th>Change Type</th>
            <th>Domain</th>
            <th>When</th>
            <th>Certainty</th>
            <th>Evidence Type</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
      <?php
    }

    public static function searchPageBiblioResults() {?>
      <table class="table table-striped">
        <thead id="table_name">
        <tr>
          <th>Type</th>
          <th>Title</th>
          <th>Author</th>
          <th>Journal</th>
          <th>Year</th>
          <th>Month</th>
          <th>Pages</th>
          <th>Volume</th>
          <th>Arxiv</th>
          <th>Doi</th>
          <th>GSID</th>
          <th>Issue</th>
          <th>Numpages</th>
          <th>Publisher</th>
          <th>URL</th>
        </tr>
        </thead>
        <tfoot>
          <tr>
          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
      <?php
    }

    /**
    * holds the html for the languages page
    */
    public static function getGramChangePage() {?>
      <h4>Changes Grammatical Table Options</h4>
      <div class="row">
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="main_button">Tables Menu</button>
            </span>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="anr_button">Add New Record</button>
            </span>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button" id="filtered-search-go">Go</button>
            </span>
            <div  id="gram-search-filtered">
              <input type="text" class="form-control" placeholder="Search for..." name="changes_grammatical" >
              <div class="dropdown-content-custom special-margin" id="gram-search-content-filtered">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <select class="form-control custom-select" id="suggest-filter-gram">
            <option value="changeTitle" default>Change</option>
            <option value="changeType">Change Type</option>
            <option value="language">Language</option>
          </select>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="back_button" >Back</button>
            </span>
          </div>
        </div>
        <div class="col-lg-1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="next_button">Next</button>
            </span>
          </div>
        </div>
      </div>
      <br>
      <?php
      htmlManager::getGrammaticalForm();
      ?>
      <table class="table table-striped">
        <thead name="changes_grammatical id" id="table_name">
          <tr>
            <th>Id</th>
            <th>Language</th>
            <th>Change</th>
            <th>Change Type</th>
            <th>Domain</th>
            <th>When</th>
            <th>Certainty</th>
            <th>Evidence Type</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tfoot>
          <tr>

          </tr>
        </tfoot>
        <tbody id="table_data">
        </tbody>
      </table>
        <?php
    }

    /**
    * holds the html for the languages page
    */
    public static function getAssignRefsPage($row) {?>
      <h4>Assign References To a Grammatical Change</h4>
      <div class="row">

        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="main_button">Tables Menu</button>
            </span>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary mybtn" id="back_button">Go Back</button>
            </span>
          </div>
        </div>

        <div class="col-lg-4">

          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button" id="filtered-search-go">Go</button>
            </span>
            <div  id="biblio-search-filtered">
              <input type="text" class="form-control" placeholder="Search for..." name="bibliography">
              <div class="dropdown-content-custom special-margin" id="biblio-search-content">
              </div>
            </div>
          </div>

        </div>
        <div class="col-lg-2">
          <select class="form-control custom-select" id="suggest-filter-biblio">
            <option value="title" default>Title</option>
            <option value="author">Author</option>
            <option value="type">Type</option>
          </select>
        </div>
      </div>
      <br>
      <div class="row" id="selected-gram-change">
      </div>
      <br>
      <div class="row">
        <table class="table table-striped">
          <thead name="changes_grammatical id" id="table_name">
            <tr>
              <th>Language</th>
              <th>Change</th>
              <th>Change Type</th>
              <th>Domain</th>
              <th>When</th>
              <th>Certainty</th>
              <th>Evidence Type</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody id="table_data">
            <tr id="<?php echo $row['id'];?>">
              <td name="language" id="<?php echo $row['id'];?>"><?php echo $row['language']?></td>
              <td name="changeTitle" id="<?php echo $row['id'];?>"><?php echo $row['changeTitle']?></td>
              <td name="changeType" id="<?php echo $row['id'];?>"><?php echo $row['changeType']?></td>
              <td name="domain" id="<?php echo $row['id'];?>"><?php echo $row['domain']?></td>
              <td name="whenChanged" id="<?php echo $row['id'];?>"><?php echo $row['whenChanged']?></td>
              <td name="certainty" id="<?php echo $row['id'];?>"><?php echo $row['certainty']?></td>
              <td name="evidenceType" id="<?php echo $row['id'];?>"><?php echo $row['evidenceType']?></td>
              <td name="changeNotes" id="<?php echo $row['id'];?>"><?php echo $row['changeNotes']?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <br>

      <div class="row">

        <div class="col-lg-6" id="current-refs">
          <table class="table table-striped">
            <thead name="bibliography id" id="table_name1">
            <tr>
              <p>Currently Assigned References</p>
            </tr>
            <tr>
              <th>Type</th>
              <th>Title</th>
              <th>Author</th>
              <th>Option</th>
            </tr>
            </thead>
            <tfoot>
              <tr>
              </tr>
            </tfoot>
            <tbody id="table_data1">
            </tbody>
          </table>
        </div>
        <div class="col-lg-6" id="searched-refs">
          <table class="table table-striped">
            <thead name="bibliography id" id="table_name2">
              <tr>
                <p>Available References</p>
              </tr>
            <tr>
              <th>Type</th>
              <th>Title</th>
              <th>Author</th>
              <th>Option</th>
            </tr>
            </thead>
            <tfoot>
              <tr>
              </tr>
            </tfoot>
            <tbody id="table_data2">
            </tbody>
          </table>
        </div>
      </div>
        <?php
    }
  }
?>
