<?php

    // Include config
    require_once "config__connection.php";

    // Include queries
    require_once "config__query.php";

?>

<?php include("template__head.php"); ?>

<body>
    <div class="grid-container"> 

        <!--   Title    -->
        <div class="grid-x">
            <div class="cell small-12"><h1 class="h1 text-center">Schedule</h1></div>
        </div>
        <div class="grid-x">
            <div class="cell large-8 large-offset-0 medium-10 medium-offset-1">
                <table class="schedule-table" id="scheduleTable">
                    <thead>
                        <tr>
                            <th colspan="6">Schedule</th>
                        </tr>
                        <!-- Column headings -->

                        <!-- 

                            These are hardcoded, which isn't ideal.
                            This was done because the actual columns are misaligned
                            with the type of HTML inputs we're using - a datepicker and
                            two timepickers, rather than 2 "datetime" inputs.

                            That said, if you want to use a query to output the 
                            table columns, it could look something like this:
                            SELECT COLUMN_NAME
                                FROM INFORMATION_SCHEMA.COLUMNS
                                WHERE table_name = 'bakery_shifts'
                                LIMIT 100 OFFSET 1

                            Note that MySQL doesn't have ROWNUM, and that 'FETCH'
                            is actually just a CURSOR. So what we end up doing, assuming
                            we don't want to output a column with the primary key, is
                            using OFFSET, which, in MySQL, is part of the LIMIT statement.

                         -->
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Location</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Checks to see if the query succeeds

                        // The $link variable comes from config__connection.php
                        // and is the connection string
                        // $sqlTimeTable is from config__query.php
                        // and is the query string
                        if($result = mysqli_query($link, $sqlTimeTable)){
                            // Checks to see if the query returns any results
                            if(mysqli_num_rows($result) > 0){
                                // Loops for each row in the database table,
                                // outputting the column data, wrapped in
                                // html tags for the html table.
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['day'] . "</td>";
                                    echo "<td>" . $row['start'] . "</td>";
                                    echo "<td>" . $row['end'] . "</td>";
                                    echo "<td>" . $row['address'] . "</td>";
                                    echo "<td>" . $row['employee_type'] . "</td>";
                                    echo "</tr>";
                                }
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "<td colspan='5'>No records found</td>";
                            }
                        } else{
                            echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
                        }
             
                        ?>
                    </tbody>
                </table>
            </div>

        <div class="cell large-3 large-offset-1 medium-10 medium-offset-1">
        <!-- 
            
            The PHP code that will run when we hit the submit button
            inside our form.

            Forms have a lot of implicit and opinionated default behaviour - 
            they're by far the most 'finicky' aspect of HTML, both
            in terms of the DOM API and styling.

            It's a great topic to do some further research on: 
            https://developer.mozilla.org/en-US/docs/Learn/HTML/Forms

         -->
            <?php 
                // Define variables and initialize with empty values
                $employee = $location = $day = $start_time = $end_time = "";
                 
                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    // $_POST["employee"] is the value of
                    // the input element that has the 
                    // attribute name="employee"
                    $input_employee = trim($_POST["employee"]);
                    $employee = $input_employee;

                    // $_POST["location"] is the value of
                    // the input element that has the 
                    // attribute name="location"
                    // and so on...
                    $input_location = trim($_POST["location"]);
                    $location = $input_location;
                    
                    $input_day = trim($_POST["day"]);
                    $day = $input_day;

                    $input_start_time = trim($_POST["start_time"]);
                    $start_time = $input_start_time;

                    $input_end_time = trim($_POST["end_time"]);
                    $end_time = $input_end_time;
                    
                    // Prepare an insert statement
                    // The question marks will be replaced
                    // by the bind variables
                    // 
                    // Note that we don't need to pass a primary_key
                    // if the key is set to autoincrement in our table
                    $sql = "INSERT INTO bakery_shifts (employee_id, location_id, start_time, end_time) VALUES (?, ?, ?, ?)";
                     
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        // "ssss" stands for the four strings
                        // These are PHP data types, so we don't need
                        // to worry about date datatypes
                        // 
                        // You can see a table of the four data types
                        // accepted by mysqli_stmt_bind_param here:
                        // http://php.net/manual/en/mysqli-stmt.bind-param.php
                        mysqli_stmt_bind_param($stmt, "ssss", $param_employee, $param_location, $param_start_time, $param_end_time);
                        
                        // Set parameters - 
                        // Note how we align the values from the 
                        // 3 html inputs - 2 time and one date -
                        // with the 2 database fields we need to populate
                        // 
                        // Date formatting and conversion is pretty brutal in PHP,
                        // so it ended up being less work simply formatting
                        // our input data as a string that's recognizable to MySQL.
                        // The default HTML date and time inputs have similar formatting -
                        // YYYY-MM-DD and a 24 hour clock. All we have to do here
                        // is add a space between, and milliseconds to the time.
                        // 
                        // This is lucky, but it still took a good deal of var_dump()
                        // to get right.
                        $param_employee = $employee;
                        $param_location = $location;
                        $param_start_time = $day . ' ' .  $start_time . ':00';
                        $param_end_time = $day . ' ' . $end_time . ':00';
                        
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            // Records created successfully. 
                            // Refreshing the page.
                            // This could also be set to a "success" page
                            header("location: index.php");
                            exit();
                        } else{
                            echo "Something went wrong. Please try again later.";
                        }
                    }
                     
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            ?>
            <!-- 
                The submission form.
             -->
            <form class="schedule-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <fieldset>
                    <legend>Add a shift</legend>
                
                    <div class="grid-x grid-padding-x">

                        <div class="medium-12 cell">
                            <label>Employee
                                <select name="employee" id="employeeDatalist" required>
                                    <!-- 
                                        A database request so we can have
                                        one select option for each employee.

                                        Note that we need to set the option value to 
                                        the employee_id, as that's what goes into the shifts table.
                                     -->
                                    <option value="" selected disabled hidden></option>
                                    <?php 
                                    if($result = mysqli_query($link, $sqlEmployees)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<option value='" . $row['employee_id'] . "'>" . $row['name'] . "</option>";
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "<option value='No records were found'>";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>

                        <div class="medium-12 cell">
                            <label>Location
                                <select name="location" id="locationDatalist" required>
                                    <!-- Same idea here. -->
                                    <option value="" selected disabled hidden></option>
                                    <?php 
                                    if($result = mysqli_query($link, $sqlLocations)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<option value='" . $row['location_id'] . "'>" . $row['address'] . "</option>";
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "<option value='No records were found'>";
                                        }
                                    } else{
                                        echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>

                    <!-- 
                    
                        Let's talk about validation for a moment.
                        We can see that on the page, we have client-side validation.

                        Now open up the dev tools.
                        Can you figure out how to 'hack' it?

                        Client-side validation is a good user experience (although not
                        easy to add custom styles to).
                        Support for the Native HTML validation API is pretty great:
                        https://caniuse.com/#feat=form-validation

                        It means that people can have their mistakes caught without 
                        adding expensive scripting to the page, or having to wait for
                        the server to come back and tell them they screwed up.

                        But it doesn't actually prevent anyone from sending data you don't
                        like to your server.

                        It is good to have constraints in your database, but remember that
                        those are rules, not just for the user, but for how the data can be used.

                        You also need to *handle* any data that violates the constraints
                        in a way that gives the user relevant feedback.

                        That's why server-side validation is the go-to type of validation.

                     -->

                    <div class="grid-x grid-padding-x">
                        <div class="medium-12 cell">
                                <label>Date
                                  <input name="day" type="date" required>
                                </label>
                        </div>
                        <div class="medium-12 cell">
                                <label>Start time
                                  <input name="start_time" type="time" min="9:00" max="18:00" required>
                                </label>
                        </div>

                        <div class="medium-12 cell">
                                <label>End time
                                  <input name="end_time" type="time" min="9:00" max="18:00" required>
                                </label>
                        </div>

                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="cell medium-12"><button class="button primary">Add shift</button></div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    </div>
    <?php
        // Close connection
        mysqli_close($link);
    ?>
<!-- 

    Down in the footer, I include two javascript operations
    1. Setting the date inputs' min and max values to 
        today and 1 year from today, respectively
    2. My friend Tristen's library for table sorting
        because nepotism :)
 -->
<?php include("template__foot.php"); ?>
