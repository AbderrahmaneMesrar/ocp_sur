<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN REGISTRATION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="ocplogo.jpg" alt="OCP Surveys Logo" class="logo">
        <h1 class="welcome">WELCOME TO OCP ADMIN SURVEYS</h1>
    </header>

    <div class="container" id="signUpAdmin" style="display:none;">
        <h1 class="form-title">Admin Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fNameAdmin" id="fNameAdmin" placeholder="First Name" required>
                <label for="fNameAdmin">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lNameAdmin" id="lNameAdmin" placeholder="Last Name" required>
                <label for="lNameAdmin">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="emailAdmin" id="emailAdmin" placeholder="Email" required>
                <label for="emailAdmin">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Password" required>
                <label for="passwordAdmin">Password</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user-shield"></i>
                <input type="text" name="AdminCode" id="AdminCode" placeholder="Admin Code" required>
                <label for="AdminCode">Create Admin Code</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUpAdmin">
        </form>
        <div class="links">
            <p>Already an admin?</p>
            <button id="signInAdminButton">Sign In</button>
        </div>
    </div>

    <div class="container" id="signInAdmin">
        <h1 class="form-title">Admin Sign In</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="emailAdmin" id="emailAdmin" placeholder="Email" required>
                <label for="emailAdmin">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Password" required>
                <label for="passwordAdmin">Password</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user-shield"></i>
                <input type="text" name="adminCode" id="adminCode" placeholder="Admin Code" required>
                <label for="adminCode">Admin Code</label>
            </div>
            <p class="recover">
                <a href="#">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signInAdmin">
        </form>
        <div class="links">
            <p>Register as admin?</p>
            <button id="signUpAdminButton">Register</button>
        </div>
    </div>

    <script>
        document.getElementById("signInAdminButton").addEventListener("click", function() {
            document.getElementById("signUpAdmin").style.display = "none";
            document.getElementById("signInAdmin").style.display = "block";
        });

        document.getElementById("signUpAdminButton").addEventListener("click", function() {
            document.getElementById("signInAdmin").style.display = "none";
            document.getElementById("signUpAdmin").style.display = "block";
        });
    </script>
</body>
</html>
