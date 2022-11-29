<?php
session_start();
if ($_SESSION['logged'] == false) {
    header("location: login.php");
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Station</title>
    <link rel="stylesheet" href="assets/styles/profile.css">
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
function canDelete($departure){
    if(date("Y", $departure) == date("Y") && date("m", $departure) == date("m")
    && date("d", $departure) == date("d")){
        return false;
    }else{
        return true;
    }
    echo date("Y", $departure);
    echo date("m", $departure);
    echo date("d", $departure);
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
                <a href="profile.php"><img src="./assets/imgs/info.png" alt="info" width="90%"></a>
                <a href="logout.php"><img src="assets/imgs/logout.png" alt="log-out" width="90%"></a>
            </div>
        </div>

        <div class="content">
            <?php
            session_start();
            if ($_SESSION['logged'] == true) {
                $dbhost = "localhost";
                $dbname = "webMKM";
                $dbuser = "adil";
                $dbpass = "jukilo999";
                $dbport = 3306;
                $user = $_SESSION['username'];
                // Создаем соединение
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);


                $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");

                while ($row = $query->fetch_assoc()) {
                    echo '<div class="user-info">';
                    echo '<h4>Username: ' . $row['username'] . '</h4>';
                    echo '<h4>Full Name: ' . $row['firstName'] . ' ' . $row['lastName'] . '</h4>';
                    echo '<h4>Birthday: ' . $row['birthday'] . '</h4>';
                    echo '<h4>Number of orders: ' . $row['numberOfOrders'] . '</h4>';
                    
                    if (!is_null($row['creditCard'])) {
                        echo '<h4>Card: ' . $row['creditCard'] . '</h4>';
                        echo '</div>';
                    } else { ?>

                        <form action="" method="POST" class="card-form">

                            <fieldset>
                                <div class="inp-pair">
                                    <h4 class="inp-tag">Card number: </h4><input class="inp" type="text" name="card">
                                </div>
                                <input class="inp-btn" type="submit" value="Add card" name="submit" />
                            </fieldset>
                        </form>
                        </div>
                    
                    <?php     
                        if(isset($_POST['submit'])){
                            if(!empty($_POST['card'])){
                                $card = $_POST['card'];
                                if(isValid($card)){
                                    $query2 = mysqli_query($conn, "UPDATE users SET creditCard='$card' WHERE username='$user'");
                                    echo '<script>parent.window.location.reload(true);</script>';
                                }else{
                                    echo "<h4>Invalid credentials</h4>";

                                }
                            }else{
                                echo '<h4 style="margin-left:50px">You have to fill all fields!</h4>';
                            }
                        }
                    }
                }

                $query3 = mysqli_query($conn, "SELECT * FROM orders, tickets WHERE username='$user' AND orders.ticket_id = tickets.ticket_id");
                ?>
                <h1 class="h-head">History</h1>
                <table class="order-table">
                    <tr class="tb-row">
                        <th>ID</th>
                        <th>Ticket ID</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Departure</th>
                        <th>Is two way</th>
                        <th>Arrival</th>
                        <th>Type of Bus</th>
                        <th>VIP ticket</th>
                        <th>Discount</th>
                        <th>Amount</th>
                        <th>Total price</th>
                        <th>Is Active</th>
                    </tr>
                <?php
                while ($row = $query3->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['ticket_id'] . "</td>";
                    echo "<td>" . $row['cityA'] . "</td>";
                    echo "<td>" . $row['cityB'] . "</td>";
                    echo "<td>" . $row['departure'] . "</td>";
                    if($row['isTwoWay'] == TRUE){
                        echo "<td>Yes</td>";
                        echo "<td>" . $row['arrival'] . "</td>";
                    }else{
                        echo "<td>No</td>";
                        echo "<td>-</td>";
                    }
                    echo "<td>" . $row['busType'] . "</td>";
                    echo $row['vip'] == TRUE ? "<td>Yes</td>" : "<td>No</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['finalPrice'] . "</td>";
                    echo $row['isActive'] == TRUE ? "<td>Active</td>" : "<td>Not active</td>";
                    ?>
                    <td>
                        <form action="" method="POST">
                            <input class="inp-btn" type="submit" value="Cancel" name="cancel" />
                        </form>
                    </td>
                    <?php
                    echo "</tr>";
                    if(isset($_POST['cancel'])){
                        $dt = $row['departure'];
                        $id = $row['order_id'];
                        if(canDelete($dt)){
                            $query4 = mysqli_query($conn, "DELETE FROM orders where order_id=$id");
                            echo '<script>parent.window.location.reload(true);</script>';
                        }else{
                            echo "You can not delete on day of departure";
                        }
                    }
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