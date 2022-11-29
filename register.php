<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Station</title>
    <link rel="stylesheet" href="assets/styles/register.css">
    <link rel="icon" href="./assets/imgs/bus.png" type="image/icon type">

</head>
<?php
function isValid($number)
{
    global $type;

    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
    );

    if (preg_match($cardtype['visa'], $number)) {
        $type = "visa";
        return true;
    } else if (preg_match($cardtype['mastercard'], $number)) {
        $type = "mastercard";
        return true;
    } else {
        return false;
    }
}
?>

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
            <a class="header-link" href="intercity.php">
                <h2 class="chosen-link txt">Intercity</h2>
            </a>
            <a class="header-link" href="tickets.php">
                <h2 class="txt">Tickets</h2>
            </a>
            <a class="header-link" href="companies.html">
                <h2 class="txt">Companies</h2>
            </a>
            <div class="header-btns">
                <a href="https://t.me/zhaparka" target="_blank"><img src="./assets/imgs/phone.png" alt="phone" width="90%"></a>
                <a href="profile.php"><img src="./assets/imgs/info.png" alt="info" width="90%"></a>
            </div>
        </div>

        <div class="content">
            <div class="links">
                <a class="link chosen" href="register.php">Register</a> 
                <span class="link">|</span>
                <a class="link" href="login.php">Login</a>
            </div>
            <form action="" method="POST" class="reg-form">

                <fieldset>

                    <div class="inp-pair"><h4 class="inp-tag">Username:</h4> <input class="inp" type="text" name="user"></div>
                    <div class="inp-pair"><h4 class="inp-tag">Password:</h4> <input class="inp" type="password" name="pass"></div>
                    <div class="inp-pair"><h4 class="inp-tag">Birthday:</h4> <input class="inp" type="text" placeholder="yyyy-mm-dd" value="" name="birthday"></div>
                    <div class="inp-pair"><h4 class="inp-tag">First Name:</h4> <input class="inp" type="text" name="first_name"></div>
                    <div class="inp-pair"><h4 class="inp-tag">Last Name:</h4> <input class="inp" type="text" name="last_name"></div>

                    <div class="inp-pair"><h4 class="inp-tag">Card number: </h4><input class="inp" type="text" name="card"></div>

                    <input class="inp-btn" type="submit" value="Register" name="submit" />

                </fieldset>

            </form>
            <?php
            if (isset($_POST["submit"])) {
                if (
                    !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['birthday'])
                    && !empty($_POST['first_name']) && !empty($_POST['last_name'])
                ) {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $birthday = $_POST['birthday'];
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $card = $_POST['card'];
                    $dbhost = "localhost";
                    $dbname = "webMKM";
                    $dbuser = "adil";
                    $dbpass = "jukilo999";
                    $dbport = 3306;
                    // Создаем соединение
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);


                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
                    $numrows = mysqli_num_rows($query);
                    if ($numrows == 0) {
                        if(!isset($_POST['card'])){
                            $sql = "INSERT INTO users VALUES('$user','$pass', '$birthday', '$first_name', '$last_name', NULL, 0)";
                        }else{
                            if(isValid($card)){
                                $sql = "INSERT INTO users VALUES('$user','$pass', '$birthday', '$first_name', '$last_name', '$card', 0)";
                            }else{
                                echo '<h4>Wrong credentials for card</h4>';
                            }
                        }

                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            session_start();
                            $_SESSION['logged'] = true;
                            $_SESSION['username'] = $user;

                            header("location: profile.php");
                        } else {
                            echo "<h4>Failure!</h4>";
                        }
                    } else {
                        echo "<h4>That username already exists! Please try again with another.</h4>";
                    }
                } else {
                    echo "<h4>All fields are required!</h4>";
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