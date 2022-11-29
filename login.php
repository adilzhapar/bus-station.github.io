<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Station</title>
    <link rel="stylesheet" href="assets/styles/login.css">
    <link rel="icon" href="./assets/imgs/bus.png" type="image/icon type">

</head>

<body>
    <div class="main">
        <div class="header">
            <a class="header-link" href="index.html"><img src="./assets/imgs/bus.png" alt="bus-logo" width="80%"></a>
            <a class="header-link" href="citybus.html">
                <h2 class="txt">Citybus</h2>
            </a>
            <a class="header-link" href="transport_cards.html">
                <h2 class="txt">Transport cards</h2>
            </a>
            <a class="header-link" href="intercity.html">
                <h2 class="chosen-link txt">Intercity</h2>
            </a>
            <a class="header-link" href="tickets.html">
                <h2 class="txt">Tickets</h2>
            </a>
            <a class="header-link" href="companies.html">
                <h2 class="txt">Companies</h2>
            </a>
            <div class="header-btns">
                <a href="https://t.me/zhaparka" target="_blank"><img src="./assets/imgs/phone.png" alt="phone" width="90%"></a>
                <a href="login.php"><img src="./assets/imgs/info.png" alt="info" width="90%"></a>
            </div>
        </div>

        <div class="content">
            <div class="">
                <a class="link" href="register.php">Register</a> 
                <span class="link">|</span>
                <a class="link chosen" href="login.php">Login</a>
            </div>

            <form action="" method="POST" class="login-form">

                <fieldset>

                    <div class="">
                        <h4 class="inp-tag">Username:</h4> 
                        <input class="inp" type="text" name="user"><br />
                    </div>
                    <div class="">
                        <h4 class="inp-tag">Password:</h4> 
                        <input class="inp" type="password" name="pass"><br />
                    </div>
                    <input class="inp-btn" type="submit" value="Login" name="submit" />

                </fieldset>

            </form>
            <?php
            if (isset($_POST["submit"])) {
                if (!empty($_POST['user']) && !empty($_POST['pass'])) {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $dbhost = "localhost";
                    $dbname = "webMKM";
                    $dbuser = "adil";
                    $dbpass = "jukilo999";
                    $dbport = 3306;
                    // Создаем соединение
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);


                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND pass='$pass'");
                    $numrows = mysqli_num_rows($query);
                    if ($numrows == 0) {
                        echo "failure!";
                    } else {
                        echo "Welcome!";
                        session_start();
                        $_SESSION['logged'] = true;
                        $_SESSION['username'] = $user;
                        
                        header("location: profile.php");
                    }
                } else {
                    echo "
                    <script>
                        alert('All fields are required!');
                    </script>";
                }
            }
            ?>
        </div>

        <div class="footer">
            <div class="footer-info">
                <h4 class="txt">Bus Station project</h4>
                <h4 class="txt">Zhapar Adil</h4>
                <h4 class="txt">Web Development</h4>
                <h4 class="txt">Bakhramov Serik</h4>
                <h4 class="txt">2022</h4>
            </div>
        </div>
    </div>


</body>

</html>