<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Station</title>
    <link rel="stylesheet" href="assets/styles/tickets.css">
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
            <a class="header-link" href="intercity.php">
                <h2 class="txt">Intercity</h2>
            </a>
            <a class="header-link" href="tickets.php">
                <h2 class="chosen-link txt">Tickets</h2>
            </a>
            <a class="header-link" href="companies.html">
                <h2 class="txt">Companies</h2>
            </a>
            <div class="header-btns">
                <a href="https://t.me/zhaparka" target="_blank"><img src="./assets/imgs/phone.png" alt="phone" width="90%"></a>
                <a href="profile.php"><img src="./assets/imgs/info.png" alt="info" width="90%"></a>
            </div>
        </div>

        <div class="content DivWithScroll">
            <?php
            $dbhost = "localhost";
            $dbname = "webMKM";
            $dbuser = "adil";
            $dbpass = "jukilo999";
            $dbport = 3306;
            // Создаем соединение
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);

            $query = mysqli_query($conn, "SELECT * FROM tickets");
            while ($row = $query->fetch_assoc()) {
                echo '<div class="content-object">';
                echo '<p>' . $row['ticket_id'] . '</p>';
                echo '<p>' . $row['cityA'] . '-' . $row['cityB'] . '</p>';
                echo '<p>' . $row['departure'] . ':' . $row['arrival'] . '</p>';
                echo '<p>' . $row['cost'] . '</p>';
                echo '<form method="POST" action="">';
                echo '<input type="submit" value="Buy" name="buy' . $row['ticket_id'] . '" />';
                echo '</form>';
                if (isset($_POST['buy' . $row['ticket_id']])) {
                    session_start();
                    $_SESSION['id'] = $row['ticket_id'];                    
                    header("location:purchase.php ");
                }

                echo '</div>';
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