<?php 
session_start();
require_once("db_con.php");

// Echo all session variables (for debugging purposes)
// echo '<pre>'; 
// print_r($_SESSION);
// echo '</pre>';

if (!isset($_SESSION['admin_id'])) {
    die("Admin not logged in. Please log in first.");
}

$admin_id = $_SESSION['admin_id'];

// Fetch surveys created by the admin
$sql = "SELECT id, survey_title, description FROM surveys WHERE admin_Id = $admin_id ORDER BY created_at DESC";
$result = $conn->query($sql);

// Handle delete request
if (isset($_GET['delete'])) {
    $survey_id = intval($_GET['delete']);
    
    // Delete survey and associated questions/options
    $conn->query("DELETE FROM questions WHERE survey_id = $survey_id");
    $conn->query("DELETE FROM question_options WHERE question_id IN (SELECT id FROM questions WHERE survey_id = $survey_id)");
    $conn->query("DELETE FROM surveys WHERE id = $survey_id");
    $conn->query("DELETE FROM responses WHERE survey_id = $survey_id"); // Delete responses if needed
    
    // Redirect to the same page to refresh the list
    header("Location: adminmainpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="pagestyle.css">
    <style>
        .survey-post {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .survey-post h3 {
            margin: 0;
        }
        .delete-button, .results-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .delete-button:hover, .results-button:hover {
            background-color: #c0392b;
        }
        .results-button {
            background-color: #3498db;
            margin-left: 10px;
        }
        .results-button:hover {
            background-color: #2980b9;
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
    </style>
</head>
<body>
    <header>
        <h1>Welcome Admin</h1>
        <a href="adminlogout.php" class="logout-button">Logout</a> <!-- Logout Button -->
    </header>

    <div class="container">
        <aside>
            <div class="button-container">
                <a href="create_survey.php" class="box-button">Create a Survey</a>
            </div>
            <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
            </ul>
        </aside>

        <main>
            <h2>Previous Surveys</h2>

            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="survey-post">
                        <h3><?php echo htmlspecialchars($row['survey_title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="adminmainpage.php?delete=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this survey?');">Delete</a>
                        <a href="view_results.php?survey_id=<?php echo $row['id']; ?>" class="results-button">View Results</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No surveys found.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
