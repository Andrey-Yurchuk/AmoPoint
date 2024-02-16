<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: stats.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = 'admin';
    $password = '12345';

    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['loggedin'] = true;
        header('Location: stats.php');
        exit;
    } else {
        $error = 'Неправильное имя пользователя или пароль';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
    <title>Авторизация</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container label {
            margin-bottom: 5px;
        }

        .login-container input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .login-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }

        #password {
            margin-left: 72px;
        }

        .wrap-button {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<h1>Авторизация</h1>

<div class="login-container">

<?php if (isset($error)) { ?>
    <p><?php echo $error; ?></p>
<?php } ?>

<form method="POST" action="">
    <div>
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="wrap-button">
        <button type="submit">Войти</button>
    </div>
</form>

</div>

</body>
</html>
