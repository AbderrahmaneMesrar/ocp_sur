<?php 
session_start();
require_once("db_con.php");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in first.");
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveys</title>
    <link rel="stylesheet" href="pagestyle.css"> 
    <style>
        /* Add styling for survey posts and small boxes */
        .survey-post, .survey-small-box {
            background-color: #e6f2e6;
            color: black;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .survey-small-box {
            margin: 10px 0; /* Smaller margin for completed surveys */
            padding: 15px; /* Smaller padding for completed surveys */
        }

        .survey-post h3, .survey-small-box h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .survey-post p, .survey-small-box p {
            margin: 5px 0;
            font-size: 0.9em;
        }

        .survey-post a.box-button {
            padding: 8px 12px;
            background-color: #00897b;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545; /* Red color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .logout-button:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        header {
            display: flex;
            align-items: center;
            background-color: rgb(255, 255, 255); 
            color: black;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        header .logo {
            width: 100px; /* Adjust the size of the logo as needed */
            height: auto;
            margin-right: 20px; /* Space between the logo and the text */
        }

        header h1 {
            flex: 1; /* Allows the h1 to take up remaining space */
            margin: 0;
        }

        header .logout-button {
            margin-left: 20px; /* Space between the header text and the logout button */
        }
    </style>
</head>
<body>

<header>
    <img src="ocplogo.jpg" alt="OCPL Logo" class="logo">
    <h1>Welcome User</h1>
    <a href="userlogout.php" class="logout-button">Logout</a> <!-- Logout Button -->
</header>

<div class="container">
    <aside>
        <h2>Completed Surveys</h2>
        <?php
        // Fetch completed surveys for the user
        $completed_query = "SELECT DISTINCT s.id, s.survey_title, s.description
                            FROM surveys s
                            JOIN responses r ON s.id = r.survey_id
                            WHERE r.user_id = $user_id";
        $completed_result = $conn->query($completed_query);

        if ($completed_result->num_rows > 0) {
            while ($completed_survey = $completed_result->fetch_assoc()) {
                $description = $completed_survey['description'];
                $description_words = explode(' ', $description);

                // Limit description to 20 words
                if (count($description_words) > 20) {
                    $description = implode(' ', array_slice($description_words, 0, 20)) . '...';
                }

                echo '<div class="survey-small-box">';
                echo '<h3>' . $completed_survey['survey_title'] . '</h3>';
                echo '<p>' . $description . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No completed surveys.</p>';
        }
        ?>
    </aside>

    <main>
        <h2>Surveys to Answer</h2>
        <?php
        // Fetch all surveys that the user has not completed
        $unanswered_query = "SELECT s.id, s.survey_title, s.description, u.lastName AS admin_last_name
                             FROM surveys s
                             JOIN users u ON s.admin_Id = u.Id
                             LEFT JOIN responses r ON s.id = r.survey_id AND r.user_id = $user_id
                             WHERE r.survey_id IS NULL
                             ORDER BY s.created_at DESC";
        $unanswered_result = $conn->query($unanswered_query);

        if ($unanswered_result->num_rows > 0) {
            while ($survey = $unanswered_result->fetch_assoc()) {
                echo '<div class="survey-post">';
                echo '<div>';
                echo '<h3>' . $survey['survey_title'] . '</h3>';
                echo '<p>' . $survey['description'] . '</p>';
                echo '<p>Admin: ' . $survey['admin_last_name'] . '</p>'; // Display admin's last name
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
