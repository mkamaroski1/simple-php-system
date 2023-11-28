<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/compiled/tailwind.css"> <!-- Substitua pelo caminho real do seu arquivo Tailwind CSS compilado -->
    <title>Change Profile</title>
</head>

<body class="bg-blue-100">
    <div class="nav bg-white flex justify-between items-center h-16">
        <div class="logo text-2xl font-bold">
            <p><a href="home.php" class="text-black no-underline">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#" class="px-2">Change Profile</a>
            <a href="php/logout.php" class="px-2">
                <button class="btn bg-indigo-700 border-0 border-radius-5 text-white text-lg cursor-pointer transition-all duration-300 hover:opacity-82">Log Out</button>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id ") or die("error occurred");

                if ($edit_query) {
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
                }
            } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id ");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                }
            ?>
                <header class="text-2xl font-semibold pb-4 border-b-2 border-gray-300 mb-4">Change Profile</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" class="h-10 w-full text-lg px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" class="h-10 w-full text-lg px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" class="h-10 w-full text-lg px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn bg-indigo-700 border-0 border-radius-5 text-white text-lg cursor-pointer transition-all duration-300 mt-4 px-4 hover:opacity-82" name="submit" value="Update" required>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>
