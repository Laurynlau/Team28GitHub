<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Login Page | harun </title>
</head>

<body>
<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION["token"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["login_submitted"])) {
        // LOGIN HANDLER
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'db_connect.php';

    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['loggedin'] = true;

            $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'home.php';
            $redirect_url = filter_var($redirect_url, FILTER_SANITIZE_URL);

            header('Location: ' . $redirect_url);
            exit;
        }
    }

    $login_err = 'Invalid email or password.';

    $stmt->close();
}
    } elseif (isset($_POST["register_submitted"])) {
        // REGISTER HANDLER
        if (!empty($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
            require_once 'db_connect.php';

            // Making usernames unique. Not currently functional.
            // $firstCheck = $conn->prepare("SELECT * FROM users WHERE username = ?");
            // if ($firstCheck) {
            //     $firstCheck->bind_param("s", $username);
            //     $firstResult = $firstCheck->get_result();
            //     if ($firstResult) {
            //         if ($firstResult->num_rows > 0) {
            //             echo "An account with that username already exists.";
            //         }
            //     } else {
            //         if (mysqli_connect_errno()) {
            //             echo "Error executing statement: " . $stmt->error;
            //         }
            //     }
            // } else {
            //     echo "Error preparing statement: " . $conn->error;
            // }
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        
            if ($stmt) {
                $stmt->bind_param("sss", $username, $email, $password);
        
                $success = $stmt->execute();
                
                if ($success) {
                    if (isset($_SESSION['redirect_url'])) {
                        header('Location: ' . $_SESSION['redirect_url']);
                    } else {
                        header('Location: home.php');
                    }
                    exit;
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
        
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        
            $conn->close();        
        }
    }
}
?>

    <img src="LOGO.png" alt="Your Logo" class="logo">

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="process_signup.php" method="post">
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="text" name="username" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="process_login.php" method="post">
                <h1>Sign In</h1>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="loginScript.js"></script>
</body>

</html>
