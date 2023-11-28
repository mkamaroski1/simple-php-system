<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/compiled/tailwind.css"> <!-- Substitua pelo caminho real do seu arquivo Tailwind CSS compilado -->
    <title>Login</title>
</head>

<body class="bg-blue-100">
    <div class="container">
        <div class="box form-box">

            <?php
            include("php/config.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if (is_array($row) && !empty($row)) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                } else {
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Go Back</button>";

                }
                if (isset($_SESSION['valid'])) {
                    header("Location: home.php");
                }
            } else {
            ?>
                <header class="text-2xl font-semibold pb-4 border-b-2 border-gray-300 mb-4">Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="h-10 w-full text-lg px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="h-10 w-full text-lg px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn bg-indigo-700 border-0 border-radius-5 text-white text-lg cursor-pointer transition-all duration-300 mt-4 px-4 hover:opacity-82 w-full" name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have an account? <a href="register.php">Sign Up Now</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>
