<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intercity</title>
    <link rel="stylesheet" href="assets/styles/intercity.css">
    <link rel="icon" href="./assets/imgs/bus.png" type="image/icon type">

</head>

<?php
    session_start();
    $dbhost = "localhost";
    $dbname = "webMKM";
    $dbuser = "adil";
    $dbpass = "jukilo999";
    $dbport = 3306;

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
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
            <form action="" method="POST">
                <div class="content-object">
                    <h3 class="content-txt">From:</h3>
                    <select name="cityA" id="cities">
                        <?php
                            $query = mysqli_query($conn, "SELECT DISTINCT cityA from tickets");
                            while($row = $query->fetch_assoc()){
                                echo '<option value="' . $row['cityA'] . '">'. $row['cityA'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="content-object">
                    <h3 class="content-txt">To:</h3>
                    <select name="cityB" id="cities">
                    <?php
                            $query = mysqli_query($conn, "SELECT DISTINCT cityB from tickets");
                            while($row = $query->fetch_assoc()){
                                echo '<option value="' . $row['cityB'] . '">'. $row['cityB'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="content-object">
                    <h3 class="content-txt">When?</h3>
                    <input type="date" id="date" name="date">
                </div>

            
                <input class="content-btn" type="submit" value="search" name="search">
            </form>

            <?php
                if(isset($_POST['search'])){
                    $cityA = $_POST['cityA'];
                    $cityB = $_POST['cityB'];
                    $departure = $_POST['date'];
                    
                    $query3 = mysqli_query($conn, "SELECT * FROM tickets WHERE cityA = '$cityA' AND cityB = '$cityB' AND departure='$departure'");
                    
                    while($row = $query3->fetch_assoc()){
                        echo '<div class="ticket-object">';
                        echo '<p>' . $row['ticket_id'] . '</p>';
                        echo '<p>' . $row['cityA'] . '-' . $row['cityB'] . '</p>';
                        echo '<p>' . $row['departure'] . ':' . $row['arrival'] . '</p>';
                        echo '<p>' . $row['cost'] . '</p>';
                        // echo '<form method="POST" action="">';
                        // echo '<input class="buy-btn" type="submit" value="Buy" name="buy' . $row['ticket_id'] . '" />';
                        // echo '</form>';
                        // echo '</div>';
                        // if(isset($_POST['buy' . $row['ticket_id']])){
                        //     $_SESSION['id'] = $row['ticket_id'];
                        //     header("location:purchase.php ");
                        // }
                    }

                }
            ?>
            

        </div>

        <div class="footer">
            <div class="footer-info">
                <h4 class="txt">Bus Station project</h4>
                <h4 class="txt">Web Development</h4>
                <h4 class="txt">Zhapar Adil</h4>
                <h4 class="txt">Bakhramov Serik</h4>
                <h4 class="txt">2022</h4>
            </div>
        </div>
    </div>

</body>

</html>