<?php 
session_start();
require_once("db_con.php");

if (!isset($_SESSION['admin_id'])) {
    die("Admin not logged in. Please log in first.");
}

$admin_id = $_SESSION['admin_id'];

if (!isset($_GET['user_id']) || !isset($_GET['survey_id'])) {
    die("User ID or Survey ID not specified.");
}

$user_id = intval($_GET['user_id']);
$survey_id = intval($_GET['survey_id']);

// Fetch answers for the specific user and survey
$sql = "SELECT question_id, response FROM responses WHERE user_id = $user_id AND survey_id = $survey_id";
$answers = $conn->query($sql);

// Fetch survey questions
$questions_sql = "SELECT id, question_text FROM questions WHERE survey_id = $survey_id";
$questions = $conn->query($questions_sql);

$questions_array = [];
while ($q = $questions->fetch_assoc()) {
    $questions_array[$q['id']] = $q['question_text'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Answers</title>
    <link rel="stylesheet" href="pagestyle.css">
    <style>
        .answers-list {
            list-style-type: none;
            padding: 0;
        }
        .answers-list li {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Answers</h1>
    </header>

    <div class="container">
        <main>
            <h2>Answers for User ID: <?php echo $user_id; ?>, Survey ID: <?php echo $survey_id; ?></h2>

            <?php if ($answers->num_rows > 0): ?>
                <ul class="answers-list">
                    <?php while($row = $answers->fetch_assoc()): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($questions_array[$row['question_id']]); ?></strong>
                            <p><?php echo htmlspecialchars($row['response']); ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No answers found for this user.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
