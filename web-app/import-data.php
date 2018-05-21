<?php
  $prefix = "includes/";
  include "../config.php";
?>
<?php $page_name="import_data"; include_once "includes/header.php" ?>
    <div class="container">
      <form  enctype="multipart/form-data" method="post" name="public-form" action="<?php echo LISTENER?>" id="public-form">
        <h4>Data Submission Form</h4>
        <div class="form-group">
          <label for="first-name">First Name</label>
          <input type="text" class="form-control" id="first-name" placeholder="Enter first name" name="first-name">
        </div>
        <div class="form-group">
          <label for="last-last">Last Name</label>
          <input type="text" class="form-control" id="last-name" placeholder="Enter last name" name="last-name">
        </div>
        <div class="form-group">
          <label for="organisation">Organisation</label>
          <input type="text" class="form-control" id="organisation" placeholder="Enter organisation" name="organisation">
        </div>
      <div class="form-group">
        <label for="email1">Email address 1</label>
        <input type="email1" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email" name="email-1">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="email2">Email address 2</label>
        <input type="email" class="form-control" id="email2" aria-describedby="emailHelp" placeholder="Enter email" name="email-2">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="submit-type">Submission Type</label>
        <select class="form-control" id="submit-type" name="submission-type">
          <option>Please select option</option default>
          <option>Grammatical Change Data</option>
          <option>Language Data</option>
          <option>References Data</option>
          <option>Mixed Data</option>
        </select>
      </div>
      <div class="form-group">
        <label for="submit-notes">Submission Notes</label>
        <textarea class="form-control" id="submit-notes" rows="5" name="notes"></textarea>
      </div>
      <div class="form-group">
        <label for="file">File input</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="6000000">
        <input type="file" class="form-control-file" id="file" aria-describedby="fileHelp" name="file">
        <small id="fileHelp" class="form-text text-muted">Accepted formats are *.txt .pdf .doc</small>
      </div>
      <fieldset class="form-group">
        <legend>Submission Options</legend>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="option-selected" id="option-1" value="option1" checked>
            Confirm on recieval and email me about important future updates
          </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="option-selected" id="option-2" value="option2">
            Confirm on recieval
          </label>
        </div>
        <div class="form-check disabled">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="option-selected" id="option-3" value="option3">
            Please do not email me
          </label>
        </div>
      </fieldset>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <div class="spaced-tab">
      <div id="result-div">
        <p id="form-result"></p>
      </div>
    </div>
    </div>
<?php include_once "includes/footer.php" ?>
