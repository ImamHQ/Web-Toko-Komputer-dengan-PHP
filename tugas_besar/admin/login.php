<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        /* html,
        body {
            background-image: url('../img/lap.jpg');
            height: 100%;
            background-size: cover;
        } */

        .main {
            height: 100vh;
        }

        .login-box {
            width: 500px;
            height: 300px;
            box-sizing: border-box;
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center ">
        <div class="login-box p-5 shadow">
            <form action="" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button class="btn btn-primary form-control mt-3" type="submit" name="loginbtn">Login</button>
            </form>

        </div>
        <div class="mt-3">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('Location:../admin');
                    } else {
            ?>
                        <div class="alert alert-danger" role="alert">
                            Password yang dimasukkan Salah
                        </div>
                    <?php

                    }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Akun tidak tersedia
                    </div>
            <?php


                }
            }
            ?>
        </div>
    </div>

</body>

</html>