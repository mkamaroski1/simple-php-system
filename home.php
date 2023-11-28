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
    <title>Home</title>
</head>

<body class="bg-blue-100">
    <div class="nav bg-white flex justify-between items-center h-16">
        <div class="logo text-2xl font-bold">
            <p><a href="home.php" class="text-black no-underline">Logo</a></p>
        </div>

        <div class="right-links">
            <?php
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }

            echo "<a href='edit.php?Id=$res_id' class='px-2'>Change Profile</a>";
            ?>

            <a href="php/logout.php" class="px-2">
                <button class="btn bg-indigo-700 border-0 border-radius-5 text-white text-lg cursor-pointer transition-all duration-300 hover:opacity-82">Log Out</button>
            </a>
        </div>
    </div>
    <main class="flex items-center justify-center mt-16">
        <div class="main-box top flex justify-between">
            <div class="box m-4">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box m-4">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
        </div>
        <div class="bottom mt-20">
            <div class="box">
                <p>And you are <b><?php echo $res_Age ?> years old</b>.</p>
            </div>
        </div>
    </main>
</body>

</html>
