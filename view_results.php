<?php 
session_start();
require_once("db_con.php");

if (!isset($_SESSION['admin_id'])) {
    die("Admin not logged in. Please log in first.");
}

$admin_id = $_SESSION['admin_id'];

if (!isset($_GET['survey_id'])) {
    die("Survey ID not specified.");
}

$survey_id = intval($_GET['survey_id']);

// Fetch respondents for the survey
$sql = "SELECT DISTINCT user_id FROM responses WHERE survey_id = $survey_id";
$respondents = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Results</title>
    <link rel="stylesheet" href="styleresults.css">
    
</head>
<body>
    <header>
        <h1>Survey Results</h1>
    </header>

    <div class="container">
        <main>
            <h2>Respondents for Survey ID: <?php echo $survey_id; ?></h2>

            <?php if ($respondents->num_rows > 0): ?>
                <ul class="results-list">
                    <?php while($row = $respondents->fetch_assoc()): ?>
                        <?php
                        // Fetch respondent's name 
                        $user_id = intval($row['user_id']);
                        $user_result = $conn->query("SELECT firstName, lastName FROM users WHERE Id = $user_id");
                        $user = $user_result->fetch_assoc();
                        ?>
                        <li>
                            <strong><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></strong>
                            <a href="view_answers.php?user_id=<?php echo $user_id; ?>&survey_id=<?php echo $survey_id; ?>" class="view-answers-button">View Answers</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No respondents found.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
