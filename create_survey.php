<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <link rel="stylesheet" href="stylecreate.css">
    <script>
        function addQuestion() {
            var questionsDiv = document.getElementById('questions');
            var questionCount = document.querySelectorAll('.question').length + 1;

            var newQuestion = document.createElement('div');
            newQuestion.className = 'question';
            newQuestion.innerHTML = `
                <label for="question${questionCount}">Question ${questionCount}:</label>
                <input type="text" name="questions[${questionCount}][text]" id="question${questionCount}" required>
                <br>
                <label for="question${questionCount}_type">Question Type:</label>
                <select name="questions[${questionCount}][type]" id="question${questionCount}_type" onchange="toggleOptions(${questionCount})" required>
                    <option value="text">Text</option>
                    <option value="radio">Radio</option>
                    <option value="multiple">Multiple Choice</option>
                </select>
                <br>
                <div id="options${questionCount}" style="display: none;">
                    <label>Options:</label>
                    <div id="options_container${questionCount}">
                        <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1">
                    </div>
                    <button type="button" onclick="addOption(${questionCount})">Add Another Option</button>
                </div>
                <br><br>
            `;
            questionsDiv.appendChild(newQuestion);
        }

        function toggleOptions(questionNumber) {
            var questionType = document.getElementById(`question${questionNumber}_type`).value;
            var optionsDiv = document.getElementById(`options${questionNumber}`);

            if (questionType === "radio" || questionType === "multiple") {
                optionsDiv.style.display = "block";
            } else {
                optionsDiv.style.display = "none";
            }
        }

        function addOption(questionNumber) {
            var optionsContainer = document.getElementById(`options_container${questionNumber}`);
            var optionCount = optionsContainer.querySelectorAll('input').length + 1;

            var newOption = document.createElement('div');
            newOption.innerHTML = `<input type="text" name="questions[${questionNumber}][options][]" placeholder="Option ${optionCount}">`;
            optionsContainer.appendChild(newOption);
        }
    </script>
</head>
<body>
    <h1>Create a Survey</h1>
    <form action="save_survey.php" method="POST">
        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>"> 
        
        <label for="survey_title">Survey Title:</label>
        <input type="text" name="survey_title" id="survey_title" required>
        <br><br>

        <label for="survey_description">Survey Description:</label>
        <textarea name="survey_description" id="survey_description" rows="4" cols="50" required></textarea>
        <br><br>

        <div id="questions">
            <div class="question">
                <label for="question1">Question 1:</label>
                <input type="text" name="questions[1][text]" id="question1" required>
                <br>
                <label for="question1_type">Question Type:</label>
                <select name="questions[1][type]" id="question1_type" onchange="toggleOptions(1)" required>
                    <option value="text">Text</option>
                    <option value="radio">Radio</option>
                    <option value="multiple">Multiple Choice</option>
                </select>
                <br>
                <div id="options1" style="display: none;">
                    <label>Options:</label>
                    <div id="options_container1">
                        <input type="text" name="questions[1][options][]" placeholder="Option 1">
                    </div>
                    <button type="button" onclick="addOption(1)">Add Another Option</button>
                </div>
                <br><br>
            </div>
        </div>

        <button type="button" onclick="addQuestion()">Add Another Question</button>
        <br><br>

        <input type="submit" value="Create Survey">
    </form>
</body>
</html>
