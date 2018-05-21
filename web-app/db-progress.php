<?php $page_name="db_progress"; include_once "includes/header.php" ?>

    <div class="container">
        <h4 class="text-center" >Progression Data</h4>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Site Structure
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                        <td>Dynamic menu for public and private users with a log in protecting the private area.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                        <td>User activity refreshes the session timer.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                        <td>Dynamic menu for public and private users with a log in protecting the private area.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>Public search page is main landing page.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>All pages created and navigatable.</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Manage Data
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                        <td>All tables have management interface implemented.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>In line editing for all non primary key fields.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>Public form allows for file upload.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>Filtered search boxes for grammatical changes and bibliography references.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>Table statistics on main menu need to be added.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>Need to add dynamic updating of data on tables when added or modified.</td>
                    </tr>
                    <td><span class="glyphicon glyphicon-option-horizontal"></span></td>
                    <td>Front end validation for forms, currently only back end.</td>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Search
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                        <td>Basic searching for all three tables.</td>
                    </tr>
                    <tr>
                      <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                      <td>Drop down suggestion lists based on input.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>Need to add filters for more advanced search capability.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>Need to add ability to search for all records.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>Need a page to allow management of uploaded file submissions.</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                        <td>More advanced display of searched records and associated data in future.</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <h4 class="text-center" >Legend</h4>
        <table class="table table-bordered legend-table">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td><span class="glyphicon glyphicon-ok text-center"></span></td>
                            <td>Done</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-remove"></span></td>
                            <td>Not Done</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-exclamation-sign"></td>
                            <td>Note for future consideration</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-option-horizontal"></span></td>
                            <td>In progress</td>
                        </tr>

                        </tbody>
                    </table>


    </div>

<?php include_once "includes/footer.php" ?>
