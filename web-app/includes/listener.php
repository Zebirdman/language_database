<?php
  /**
  * this is the landing page for all ajax requests sent by the browser, each request is already
  * assigned a parameter called 'option' which can be used to execute the relevant case. Each request
  * has its own PHP controller instance managing the result
  */
  $prefix = "";
  include "../../config.php";
  $log = Factory::createLog();
  $control = Factory::createController();

  //**  -----------------------------------  Process requests here -------------------------------------- **//

  if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST") {

    if($_SERVER["REQUEST_METHOD"] == "GET") {
      $option = $_GET['option'];
      $log->output($_GET);
    } else {
      $option = $_POST['option'];
      $control->refreshLogin();
      $log->output($_POST);
    }


    // switchyard for handling the different types of requests from javascript controller
    switch($option) {

      case "get-current-references":
        $control->retrieveReferences($_POST);
        break;

      case "attach-reference":
        $control->attachReference($_POST);
        break;

      case "remove-reference":
        $control->removeReference($_POST);
        break;

      case "get-table":
        $control->getTableRows(0, 20, $_POST['table']);
        break;

      case "public-submit":
      $log->output("PUBLIC FORM FILTER RECIEVED");
        $control->submitPublicForm($_POST, $_FILES);
        break;

      case "retrieve-filtered-search":
        $control->getFilteredSearchResults($_POST);
        break;

      case "retrieve-filtered-search-refs-page":
        $control->getFilteredSearchResultsRefsPage($_POST);
        break;

      case "retrieve-public-search":
        $control->getPublicSearchResults($_POST);
        break;

      case "retrieve-public-search-table":
        $control->getPublicSearchTable($_POST);
        break;

      case "retrieve-public-column-filter":
        $control->getPublicColumnFilter($_POST);
        break;

      case "delete":
        $control->deleteRecord($_POST);
        break;

      case "retrieve-search":
        $control->getTableRows(($_POST['key'] - 1), 20, $_POST['table']);
        break;

      case "assign-refs":
        $control->getAssignRefsPage($_POST);
        break;

      case "retrieve-gram-change-for-refs-assigning":
        $control->getAssignRefsGramChange($_POST);
        break;

      case "suggest":
        $control->getSuggestions($_POST['text'], $_POST['table']);
        break;

      case "filtered-suggest":
        $control->getFilteredSuggestions($_POST['text'], $_POST['table'], $_POST['column']);
        break;

      case "filtered-suggest-references":
        $control->getFilteredSuggestionsReferences($_POST['text'], $_POST['table'], $_POST['column'], $_POST['gramID']);
        break;

      case "management-menu":
        $control->getManagementMenu();
        break;

      case "languages-page":
        $control->getLanguagesPage();
        $control->refreshLogin();
        break;

      case "bibliography-page":
        $control->getBibliographyPage();
        $control->refreshLogin();
        break;

      case "gram-change-page":
        $control->getGramChangePage();
        $control->refreshLogin();
        break;

      case "next":
        $_GET['start'] += 20;
        $control->getTableRows($_GET['start'], 20, $_GET['table']);
        $control->refreshLogin();
        break;

      case "previous":
        $_GET['start'] -= 20;
        $control->getTableRows($_GET['start'], 20, $_GET['table']);
        $control->refreshLogin();
        break;

      case "logout":
        $control->logout();
        break;

      case "login":
        $control->login($_POST);
        break;

      case "update":
        $control->updateTableCell($_GET['pk_name'], $_GET['pk'], $_GET['table'], $_GET['column'], $_GET['value']);
        $control->refreshLogin();
        break;

      case "add":
        $control->getAddRecordForm($_GET['table']);
        $control->refreshLogin();
        break;

      case "add-record":
        $control->addNewRecord($_POST);
        break;

    }
  }
?>
