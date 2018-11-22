<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bakery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/css/foundation.min.css">
    <style>body {padding: 3rem 0}</style>
</head>
<body>
    <div class="grid-x">
        <div class="cell large-6 large-offset-3 medium-10 medium-offset-1">

            <?php
            require_once "config.php";

            require_once "query.php";

            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table><thead><tr>";
                    $finfo = $result->fetch_fields();

                    foreach ($finfo as $val) {
                        echo "<th>" . $val->name . "</th>";
                    }
                    echo "</tr></thead><tbody>";

                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        foreach ($row as $row) {
                            echo "<td>" . $row . "</td>";
                        }
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                    mysqli_free_result($result);
                } else {
                    echo "<p class='lead'><em>No records were found.</em></p>";
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            
            mysqli_close($link);
            ?>
            
            <div class="callout"><a href="create.php" class="button primary">Create shift</a></div>
        </div>
    </div>
</body>
</html>