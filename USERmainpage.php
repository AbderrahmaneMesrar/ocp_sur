<?php 
session_start();
require_once("db_con.php");

echo("<pre>"); 
print_r($_SESSION);
echo("</pre>");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveys</title>
    <link rel="stylesheet" href="pagestyle.css"> 
    
    
    <!-- Link to existing CSS -->
    <style>
    /* Simplified CSS */
    .survey-post {
        background-color: #e6f2e6;
        color: black;
        border: 1px solid #ccc; /* Light border color */
        border-radius: 8px;    /* Rounded corners */
        padding: 20px;
        margin: 20px 0;
        display: flex;
        justify-content: space-between; /* Align title and button */
        align-items: center; /* Vertically center the content */
    }

    .survey-post h3 {
        margin: 0;
        font-size: 1.2em; /* Standard font size for the title */
    }

    .survey-post p {
        margin: 5px 0;
        font-size: 0.9em; /* Slightly smaller font size for description */
    }

    .survey-post a.box-button {
        padding: 8px 12px;
        background-color: #00897b; /* Button color */
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    </style>
</head>
<body>

<header>
    <h1>Welcome User</h1>
</header>

<div class="container">
    <aside>
        <!-- Remove or comment out the survey creation button -->
        <!--
        <div class="button-container">
            <a href="create_survey.php" class="box-button">Create a Survey</a>
        </div>
        -->
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </aside>

    <main>
        <h2>Surveys to Answer</h2>

        <?php
        
       
       
        // Fetch all surveys
        $sql = "SELECT id, survey_title, description FROM surveys ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($survey = $result->fetch_assoc()) {
                echo '<div class="survey-post">';
                echo '<div>';
                echo '<h3>' . $survey['survey_title'] . '</h3>';
                echo '<p>' . $survey['description'] . '</p>';
                echo '</div>';
                echo '<a href="take_survey.php?survey_id=' . $survey['id'] . '" class="box-button">Take Survey</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No surveys available at the moment.</p>';
        }

        $conn->close();
        ?>
    </main>
</div>

</body>
</html>
