<?php
  /**
  * Class: FilterControl
  * Stores and allows access to all the filter / validation rules used in the program
  *
  */

  class FilterControl {

    //** -----------------------------------------   Member rules --------------------------------------- **//

    private static $changeGramFilters = array(
      "langID" => "trim",
      "change" => "trim|sanitize_string",
      "changeType" => "trim|sanitize_string",
      "domain" => "trim|sanitize_string",
      "when" => "trim|sanitize_string",
      "certainty" => "trim|sanitize_string",
      "evidenceType" => "trim|sanitize_string",
      "notes" => "trim|sanitize_string",
    );

    private static $changeGramValidation = array(
      "langID" => "max_45",
      "change" => "max_300",
      "changeType" => "max_180",
      "domain" => "max_120",
      "when" => "max_100",
      "certainty" => "max_45",
      "evidenceType" => "max_180",
      "notes" => "max_300",
    );

    private static $publicFormFilters = array(
      "first-name" => "trim|sanitize_string",
      "last-name" => "trim|sanitize_string",
      "organisation" => "trim|sanitize_string",
      "email-1" => "trim|sanitize_string",
      "email-2" => "trim|sanitize_string",
      "submissionType" => "trim|sanitize_string",
      "notes" => "trim|sanitize_string",
      "optionSelected" => "trim|sanitize_string",
    );

    private static $publicFormValidation = array(
      "first-name" => "required|max_60",
      "last-name" => "required|max_60",
      "organisation" => "required|max_120",
      "email-1" => "required|max_100",
      "email-2" => "max_100",
      "submissionType" => "required|max_30",
      "notes" => "required|max_200",
      "optionSelected" => "required|max_50",
    );

    private static $biblioFilters = array(
      "type" => "trim|sanitize_string",
      "title" => "trim|sanitize_string",
      "author" => "trim|sanitize_string",
      "journal" => "trim|sanitize_string",
      "year" => "trim|sanitize_string",
      "month" => "trim|sanitize_string",
      "pages" => "trim|sanitize_string",
      "volume" => "trim|sanitize_string",
      "arxiv" => "trim|sanitize_string",
      "doi" => "trim|sanitize_string",
      "gsid" => "trim|sanitize_string",
      "issue" => "trim|sanitize_string",
      "numpages" => "trim|sanitize_string",
      "publisher" => "trim|sanitize_string",
      "url" => "trim|sanitize_string",
    );

    private static $biblioValidation = array(
      "type" => "max_45",
      "title" => "max_120",
      "author" => "max_100",
      "journal" => "max_100",
      "year" => "max_10",
      "month" => "max_15",
      "pages" => "max_11",
      "volume" => "max_11",
      "arxiv" => "max_11",
      "doi" => "max_60",
      "gsid" => "max_11",
      "issue" => "max_11",
      "numpages" => "max_11",
      "publisher" => "max_80",
      "url" => "max_255",
    );

    //** ----------------------------------------- Getter functions ------------------------------------- **//


    /*
    * returns the bibliography filter options
    */
    public static function biblioFilters() {
      return FilterControl::$biblioFilters;
    }

    /*
    * returns the bibliography validation options
    */
    public static function biblioValidators() {
      return FilterControl::$biblioValidation;
    }

    /*
    * returns the public form filter options
    */
    public static function publicFormFilters() {
      return FilterControl::$publicFormFilters;
    }

    /*
    * returns the public form validation options
    */
    public static function publicFormValidators() {
      return FilterControl::$publicFormValidation;
    }

    /*
    * returns the changes_grammatical filter options
    */
    public static function changeGramFilters() {
      return FilterControl::$changeGramFilters;
    }

    /*
    * returns the changes_grammatical validation options
    */
    public static function changeGramValidators() {
      return FilterControl::$changeGramValidation;
    }
  }
?>
