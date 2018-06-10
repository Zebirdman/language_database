// --------------------------- Sub page locations --------------------------------

var listener = "includes/listener.php";
var pageData = "#database_container";
var tableData = "#table_data";
var next_button = "next_button";
var back_button = "back_button";
var main_menu = "main_button";
var addRecord_button = "anr_button";

// global variable used to keep track of current value of a selected table row, used for comparison
// to see if database update is needed
var activeTableRowValue = "";

/**
* uses a call to function when doc loads as this function ensures that the correct listeners are loaded
* each time the main menu is loaded not just when the document first loads.
*/
$(document).ready(function() {

  var publicForm = $("#public-form");
  var publicTableFilter = $("#public-search-table-filter");
  var publicSearchInput = $("#public-search-filtered").children();
  getManageMain();

  $("#login").click(function() {

    var username = $("#user-name").val();
    var password = $("#password").val();
    console.log("login clicked details are: " + username + " " + password);
    var input = {option: 'login', username: username, password: password};
    console.log(listener);
    $.ajax({
      type: 'POST',
      url: listener,
      data: input

    }).done(function(response) {
      console.log(response);
      window.location.href = response;
    });
  });
  /**
  * ajax handler for the submission of the public form
  */
  publicForm.submit(function(event) {

    var resultDiv = $("#result-div");
    var result = $("#form-result");
    var form = $("#form");
    resultDiv.css('display','none');
    resultDiv.removeClass("alert alert-success");
    resultDiv.removeClass("alert alert-danger");

    event.preventDefault();
    var formData = new FormData(this);
    formData.append("option","public-submit");

    $.ajax({
      url: listener,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false
    }).done(function(response) {

      //result.css("color","Green");
      result.text(response);
      form.children().children().val('');

      resultDiv.css('display','block');
      resultDiv.addClass("alert alert-success");

    }).fail(function(response) {

      result.text(response.responseText);
      resultDiv.css('display','block');
      resultDiv.addClass("alert alert-danger");

    });
  });

  /**
  * handles the filter rules for a search on the public page, assigns the table name to the html
  * search element so the go button can use the name attribute
  */
  publicTableFilter.on('change', function() {

    var value = publicTableFilter.val();
    publicSearchInput.attr('name', value);
  });
  attachSuggestList($("#public-search-filtered").children(), $("#public-search-content-filtered"));
  attachPublicFilteredSearchListener(publicSearchInput);
});


/**
* attachs listener and functions to the public search go button, first retrieves the table outline
* then triggers another request to get the actual records
*/
function attachPublicFilteredSearchListener(input) {

  $("#filtered-search-go").click(function() {
    var name = input.attr('name');
    var id = input.attr('id');
    if(input.attr('id') != '') {

      var value = input.val();
      var postData1 = {option: 'retrieve-public-search', key: id, name: value, table: name};
      var postData2 = {option: 'retrieve-public-search-table', key: id, name: value, table: name};

      $.ajax({
        type: 'POST',
        url: listener,
        data: postData1

      }).done(function(response) {
        $("#column-filter-container").html(response);
      }).done(function() {
        $.ajax({
          type: 'POST',
          url: listener,
          data: postData2

        }).done(function(response) {
          $("#table_data").html(response);
        });
      });
    }
  });
}

/** -------------------------------- Listener assignment and management ---------------------------------- **/
/**
* retieves the main menu for the manage database section of the site, loads the menu and assigns all
* new listeners to the appropriate elements
*/
function getManageMain() {

  $.get(listener, {
    option: 'management-menu'
  }).done(function(response) {
    $(pageData).html(response);

  }).done(function() {
    // retrieves language table options page
    $("#lang_button").click(function() {

      $.get(listener,{option:'languages-page'}, function(data){
        $(pageData).html(data);
      }).done(function() {
        getTable('languages');
      });
    });
    // retrieves changes grammatical table options page
    $("#gramChange_button").click(function() {
      $.get(listener,{option:'gram-change-page'}, function(data){
        $(pageData).html(data);
        document.getElementById(addRecord_button).addEventListener("click", showForm);
      }).done(function() {
        getTable('changes_grammatical');
      });
    });
    // retrieves bibliography table options page
    $("#biblio_button").click(function() {
      $.get(listener,{option:'bibliography-page'}, function(data){
        $(pageData).html(data);
        document.getElementById(addRecord_button).addEventListener("click", showForm);
      }).done(function() {
        getTable('bibliography');
      });
    });
  });
}

/**
* Retrieves a set of table rows for a given table name, assigns all relevant listeners to the
* table elements once loaded.
*
* @param name - the name of the table to be loaded
*/
function getTable(name) {
  var tableDiv = $("#table_data");
  var input = {option:'get-table', table: name};

  $.ajax({
    type: 'POST',
    url: listener,
    data: input

  }).done(function(response) {
    $(tableData).html(response);
  }).done(function() {
    makeEditable();
    makeUpdateable();
    attachAddRecordListener();
    attachFilteredSuggestList($("#lang-search-filtered").children(), $("#lang-search-content-filtered"), $("#suggest-filter"));
    attachFilteredSuggestList($("#gram-search-filtered").children(), $("#gram-search-content-filtered"), $("#suggest-filter-gram"));
    attachFilteredSuggestList($("#biblio-search-filtered").children(), $("#biblio-search-content-filtered"), $("#suggest-filter-biblio"));
    attachSuggestList($("#lang-search").children(), $("#lang-search-content"));
    attachAddRefListeners();
    attachSearchListener(name);
    attachFilteredSearchListener($("#suggest-filter-gram"), $("#gram-search-filtered").children(), name);
    attachFilteredSearchListener($("#suggest-filter-biblio"), $("#biblio-search-filtered").children(), name);
    attachDeleteListeners(name);
    $("#next_button").click(function() {
      getNext(name);
    });
    $("#back_button").click(function() {
      getPrevious(name);
    });
    $("#main_button").click(function() {
      getManageMain();
    });
  });
}

/**
* attaches a listener to a search bar that has a filter, sends request and then assigns listeners
* to the appropriate html elements once loaded
*/
function attachFilteredSearchListener(filter, input, name) {

  $("#filtered-search-go").click(function() {
    var id = input.attr('id');
    if(input.attr('id') != '') {
      var column = filter.val();

      var value = input.val();
      var postData = {option: 'retrieve-filtered-search', key: id, name: value, table: name, column: column};
      $.ajax({
        type: 'POST',
        url: listener,
        data: postData
      }).done(function(response){
        $(tableData).html(response);
      }).done(function() {
        makeEditable();
        makeUpdateable();
        attachDeleteListeners(name);
        attachAddRefListeners();
      });
    }
  });
}

/**
* attaches a listener to a search field that does not contain a filter, such as the one used in the
* language table section
*/
function attachSearchListener(name) {
  var input = $("#lang-search").children();

  $("#search-go").click(function() {
    var id = input.attr('id');

    if(input.attr('id') != '') {
      var value = input.val();
      var postData = {option: 'retrieve-search', key: id, name: value, table: name};
      $.ajax({
        type: 'POST',
        url: listener,
        data: postData
      }).done(function(response){
        $(tableData).html(response);
      }).done(function() {
        makeEditable();
        makeUpdateable();
        attachDeleteListeners(name);
      });
    }
  });
}



// --------------------------------------- assign references handlers ------------------------------------- //

/**
* Attaches a click listener to all page elements with a given name add-reference, used in the changes
* grammatical section to allow for a individual record to be selected for assigning of references
*/
function attachAddRefListeners() {
  $("button[name=add-reference]").on('click', function() {
    var record = $(this).attr('id');
    var input1 = {option:'assign-refs',id: record};
    var input2 = {option:'retrieve-gram-change-for-refs-assigning',key: record, table:'changes_grammatical'};
    $.ajax({
      type: 'POST',
      url: listener,
      data: input1
    }).done(function(response) {
      $(pageData).html(response);
      attachFilteredSuggestListReferences($("#biblio-search-filtered").children(), $("#biblio-search-content"), $("#suggest-filter-biblio"));
      getAvailableReferencesForGram($("#suggest-filter-biblio"), $("#biblio-search-filtered").children(), 'bibliography');
      attachBackButtonListener();
      retrieveCurrentGramReferences(record);
      $("#main_button").click(function() {
        getManageMain();
      });
    });
  });
}

/**
* retrieves the bibliography references that have been entered into the filtered search bar in the assign
* references section. Retrieves the html element that contains the record info and a button to add it to the
* current active grammatical change record
*
* @param filter - the filter that the search bar has as an jquery object
* @param input - the search bar itself as jquery object
* @param name - the name of the table
*/
function getAvailableReferencesForGram(filter, input, name) {
  $("#filtered-search-go").click(function() {
    var id = input.attr('id');
    var gramID = $("#table_data").children().attr('id');
    if(input.attr('id') != '') {
      var column = filter.val();
      var value = input.val();
      var postData = {option: 'retrieve-filtered-search-refs-page', gramID: gramID, key: id, name: value, table: name, column: column};
      $.ajax({
        type: 'POST',
        url: listener,
        data: postData
      }).done(function(response){
        $("#table_data2").html(response);
        attachAddReferenceListener();
      });
    }
  });
}

/**
* retrieves the references associated with the active grammtical change selected in the assign references
* section.
*
* @param id - the id of the active grammatical change
*/
function retrieveCurrentGramReferences(id) {
  var postData = {gramID: id, option: 'get-current-references'};
  $.ajax({
    type: 'POST',
    url: listener,
    data: postData
  }).done(function(response){
    $("#table_data1").html(response);
    attachRemoveReferenceListener();
  });
}

/**
* attachs the event listener to the assign button and processes the request and response
*/
function attachAddReferenceListener() {
  $("button[name=assign]").on('click', function(){
    var button = $(this);
    var gramID = $("#table_data").children().attr('id');
    var refID = button.attr('id');
    var postData = {gramID: gramID, refID: refID, option: 'attach-reference'};
    $.ajax({
      type: 'POST',
      url: listener,
      data: postData
    }).done(function(response){
      retrieveCurrentGramReferences(gramID);
      button.addClass('btn-success');
      button.html('Assigned');
    });
  });
}

/**
* attachs listener to the remove reference button and processes the request
*/
function attachRemoveReferenceListener() {
  $("button[name=remove]").on('click', function(){
    var button = $(this);
    var gramID = $("#table_data").children().attr('id');
    var refID =  button.attr('id');
    var postData = {gramID: gramID, refID: refID, option: 'remove-reference'};
    $.ajax({
      type: 'POST',
      url: listener,
      data: postData
    }).done(function(response){
      button.addClass('btn-danger');
      button.html('Removed');
      setTimeout(function() {
        retrieveCurrentGramReferences(gramID);
      },1000);
    });
  });
}

/**
* returns the references currently assigned to a grammatical change
*/
function attachBackButtonListener() {
  $("#back_button").click(function() {
    $.get(listener,{option:'gram-change-page'}, function(data){
      $(pageData).html(data);
      document.getElementById(addRecord_button).addEventListener("click", showForm);
    }).done(function() {
      getTable('changes_grammatical');
    });
  });
}

// -------------------------------- Suggestion list handlers --------------------------------------------- //

/**
* retrieves records dynamically and shows as a drop down list for user to select
* from
*/
function attachSuggestList(search, list) {
  search.on('input', function() {
    search.attr('id', '');
    if(search.val() != '') {
      var hasResults = false; // flag if there are results
      var input = "&text=" + search.val() + "&option=suggest&table=";
      input = input + search.attr('name');
      $.ajax({
        type: 'POST',
        url: listener,
        data: input
      }).done(function(response) {
        if(response == "no results") {

          list.css("display", "none");
          search.attr('id', '');
        } else {
          list.css("display", "block");
          list.html(response);
          hasResults = true;
        }
      }).done(function() {
        if(hasResults) {
          $(".list-suggest").on('click', function() {
            var selected = $(this);
            search.val(selected.html());
            search.attr('id', selected.attr('id'));
            list.css("display", "none");
          });
        }
      });
    } else {
      list.css("display", "none");
    }
  });
}

/**
* retrieves records dynamically and shows as a drop down list for user to select from.
*
* @param search - the search bar as jquery object
* @param list - the drop down list where the result go as jquery object
* @param filter - the search bar filter as jquery object
*/
function attachFilteredSuggestList(search, list, filter) {
  search.on('input', function() {
    search.attr('id', '');
    if(search.val() != '') {
      var hasResults = false; // flag if there are results
      var column = filter.val();
      var input = "&text=" + search.val() + "&option=filtered-suggest&table=";
      input = input + search.attr('name');
      input = input + "&column=" + column;
      $.ajax({
        type: 'POST',
        url: listener,
        data: input
      }).done(function(response) {
        if(response == "no results") {
          list.css("display", "none");
          search.attr('id', '');
        } else {
          list.css("display", "block");
          list.html(response);
          hasResults = true;
        }
      }).done(function() {
        if(hasResults) {
          $(".list-suggest").on('click', function() {
            var selected = $(this);
            search.val(selected.html());
            search.attr('id', selected.attr('id'));
            list.css("display", "none");
          });
        }
      });
    } else {
      list.css("display", "none");
    }
  });
}

/**
* TODO: this is a temporary fix to stop records showing in attach references area that have already been
* assigned, this needs to be aggregated with the above function
* retrieves records dynamically and shows as a drop down list for user to select
* from
*/
function attachFilteredSuggestListReferences(search, list, filter) {

  search.on('input', function() {
    search.attr('id', '');
    var gramID = $("#table_data").children().attr('id');

    if(search.val() != '') {
      var hasResults = false; // flag if there are results
      var column = filter.val();
      var input = {text: search.val(), option: 'filtered-suggest-references', table: search.attr('name'), column: column, gramID: gramID};
      $.ajax({
        type: 'POST',
        url: listener,
        data: input
      }).done(function(response) {
        if(response == "no results") {
          list.css("display", "none");
          search.attr('id', '');

        } else {
          list.css("display", "block");
          list.html(response);
          hasResults = true;
        }
      }).done(function() {
        if(hasResults) {
          $(".list-suggest").on('click', function() {
            var selected = $(this);
            search.val(selected.html());
            search.attr('id', selected.attr('id'));
            list.css("display", "none");
          });
        }
      });
    } else {
      list.css("display", "none");
    }
  });
}

// ---------------------------------------- assign references handlers ------------------------------------ //

/**
* Attaches a click listener for deleting records, actually just makes the delete option active and
* signals a warning to the user, two stage process, function below this one handles second part.
*
* @param tab - the name of the current table being managed
*/
function attachDeleteListeners(tab) {
  $("button[name=delete]").on('click', function() {
    var selected = $(this);
    selected.html('Confirm Delete');
    selected.attr('name','confirm-delete');
    selected.removeClass('btn-warning');
    selected.addClass('btn-danger');
    attachConfirmListeners(tab);
  });
}

/**
* Attaches a click listener for confirming the deleting of records
*
* @param tab - the current table name
*/
function attachConfirmListeners(tab) {
  $("button[name=confirm-delete]").on('click', function() {
    var selected = $(this);
    var record = selected.attr('id');
    var input = {option:'delete',id: record, table:tab};
    $.ajax({
      type: 'POST',
      url: listener,
      data: input
    }).done(function(response) {
      //$(pageData).html(response);
      selected.removeClass('btn-danger');
      selected.addClass('btn-success');
      selected.html('Deleted');
    }).done(function() {
      $("#main_button").click(function() {
        getManageMain();
      });
    });
  });
}

/**
* makes a hidden form visible in response to a add record button push
*/
function showForm() {
  var resultDiv = $("#result-div");
  resultDiv.css('display', 'none');
  resultDiv.removeClass("alert alert-success");
  resultDiv.removeClass("alert alert-danger");
  $("#hidden").slideDown("slow","linear");
}

/**
* handles a form submission for a new grammatical change
*/
function attachAddRecordListener () {

  var result = $("#form-result");
  var resultDiv = $("#result-div");
  var form = $("#form");
  var hidden = $("#hidden");

  form.submit(function(event) {

    resultDiv.removeClass("alert alert-success");
    resultDiv.removeClass("alert alert-danger");
    event.preventDefault();
    result.text('');
    var formInfo = "&option=add-record&form=";
    var formData = form.serialize();
    var name = form.attr('name');
    formInfo = formInfo.concat(name);
    formData = formData.concat(formInfo);
    if(name == 'changes_grammatical') {
      var langID = $("#lang-search").children().attr('id');
      formData = formData.concat("&langID="+langID);
    }
    $.ajax({
        type: 'POST',
        url: listener,
        data: formData
    }).done(function(response) {
      if(name == 'changes_grammatical') {
        $("#lang-search").children().attr('id','');
      }
      //result.css("color","Green");
      result.text(response);
      resultDiv.css('display', 'block');
      form.children().children().val('');
      hidden.attr('hidden',true);
      resultDiv.addClass("alert alert-success");
      setTimeout(function() {
        hidden.slideUp("slow","linear");
      },2000);

    }).fail(function(data) {
      resultDiv.css('display', 'block');
      resultDiv.addClass("alert alert-danger");
      if (data.responseText !== '') {
          result.text(data.responseText);
      } else {
          result.text('Oops! An error occured and your message could not be sent.');
      }
    });
  });
}

/**
* Used to trigger database updates once a table row has finished being edited, attachs a listener to
* all <td> html elements.
*/
function makeUpdateable() {
  $('td').blur(function() {
    $(this).css('color', '#333');
    $(this).css('background-color', '#f9f9f9');
    $(this).css('cursor', 'cell');
    if($(this).html() !== activeTableRowValue) {
      var data = {
        pk_name: $("#table_name").attr('name').split(" ")[1],
        pk: $(this).attr('id'),
        table: $("#table_name").attr('name').split(" ")[0],
        column: $(this).attr('name'),
        value: $(this).html(),
        option: "update"
      };
      $.get(listener, data);
    }
  });
}

/**
* Makes the table rows change color and changes the color to signal to user they can be edited
*/
function makeEditable() {
  $('td').focus(function() {
    if($(this).attr('name') !== "pk") {
      $(this).css('color', '#31708f');
      $(this).css('background-color', '#d9edf7');
      $(this).css('cursor', 'text');
      activeTableRowValue = $(this).html();
    }
  });
}

/**
* handles the retrieval of the next series of table records
*/
function getNext(tab) {

  var start = $("#row_start").html();
  var finish = $("#row_finish").html();
  var data = {
    table:tab,
    start:start,
    finish:finish,
    option:"next"
  };
  $.get(listener, data).done(function(response) {
    $(tableData).html(response);
  }).done(function() {
    makeEditable();
    makeUpdateable();
    attachDeleteListeners(tab);
    attachAddRefListeners();
  });
}

/**
* handles the retrieval of the previous series of table records
*/
function getPrevious(tab) {

  var start = $("#row_start").html();
  var finish = $("#row_finish").html();

  var data = {
    table:tab,
    start:start,
    finish:finish,
    option:"previous"
  };
  $.get(listener, data).done(function(response) {
    $(tableData).html(response);
  }).done(function() {
    makeEditable();
    makeUpdateable();
    attachDeleteListeners(tab);
    attachAddRefListeners();
  });;
}
