<?php $page_name="search"; include_once "includes/header.php" ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
          <h4>Search Database</h4>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-2">
        </div>

        <div class="col-lg-4">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button" id="filtered-search-go">Go</button>
            </span>
            <div  id="public-search-filtered">
              <input type="text" class="form-control" placeholder="Search for..." name="" >
              <div class="dropdown-content-custom special-margin" id="public-search-content-filtered">
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <select class="form-control custom-select" id="public-search-table-filter">
            <option default value="none">Select Table</option>
            <option value="languages">Languages by Name</option>
            <option value="changes_grammatical">Changes Grammatical by Language</option>
            <option value="bibliography">References by Title</option>
          </select>
        </div>

        <div id="column-filter-container">
        </div>

        <div class="col-lg-2">
        </div>
      </div>
      <br>
      <!-- this is where dynamic content is inserted -->
      <div id="public-search-results">
      </div>
    </div>

<?php include_once "includes/footer.php" ?>
