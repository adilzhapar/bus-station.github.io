<?php
    session_start();
    if ($_SESSION['logged'] == false) {
        header("location: login.php");
    }

    $dbhost = "localhost";
    $dbname = "webMKM";
    $dbuser = "adil";
    $dbpass = "jukilo999";
    $dbport = 3306;

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
    $user = $_SESSION['username'];

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Station</title>
    <link rel="stylesheet" href="assets/styles/purchase.css">
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
                <a href="logout.php"><img src="assets/imgs/logout.png" alt="log-out" width="90%"></a>
            </div>
        </div>

        <div class="content">
            <?php 
                $id = $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT * FROM tickets WHERE ticket_id=$id");

                while($row = $query->fetch_assoc()){
                    echo '<div class="purchase_obj">';
                    echo '<h4>From: ' . $row['cityA'] . '</h4>';
                    echo '<h4>To: ' . $row['cityB'] . '</h4>';
                    echo '<h4>When: ' . $row['departure'] . '</h4>';
                    echo '<h4>Come back: ' . $row['arrival'] . '</h4>';
                    echo '<h4>Cost: ' . $row['cost'] . '</h4>';
                    $cost = $row['cost'];
                    echo '</div>';
                }
                $query2 = mysqli_query($conn, "SELECT COUNT('*') from orders");
                $next_id = mysqli_fetch_array($query2)[0];
                $query3 = mysqli_query($conn, "SELECT COUNT('*') from orders where username=$user");
                $orderNums = mysqli_fetch_array($query3)[0];
                
            ?>

            <form action="" method="POST">
                <input type="checkbox" value="is Two Way" name="isTwoWay">
                <label for="isTwoWay">Is Two Way?</label>
                <input type="checkbox" value="Night road" name="nightRoad">
                <label for="nightRoad">Go at night?</label>
                <select name="busType" id="">
                    <option value="cargo">Cargo</option>
                    <option value="jeep">Jeep</option>
                    <option value="bus">Bus</option>
                </select>
                <input type="checkbox" placeholder="is VIP" name="vip">
                <label for="vip">Is VIP?</label>
                <select name="discount" id="">
                    <option value="none">None</option>
                    <option value="one_parent">One Parent</option>
                    <option value="retiree">Retiree</option>
                    <option value="veteran">Veteran</option>
                </select>
                <input type="text" placeholder="amount" name="amount">
                
                <input type="submit" name="buy" value="Buy">
            </form>

            <?php
                if(isset($_POST['buy'])){
                    $total = 0;
                    $busType = $_POST['busType'];
                    if(isset($_POST['isTwoWay'])){
                        $total = $cost * 2;
                        unset($_POST['isTwoWay']);
                        $isTwoWay = 'TRUE';
                    }else{
                        $isTwoWay = 'FALSE';
                    }
                    if(isset($_POST['nightRoad'])){
                        $total *= 0.8;
                    }
                    
                    
                    if(isset($_POST['vip'])){
                        $total += $cost;
                        unset($_POST['vip']);
                        $vip = 'TRUE';
                    }else{
                        $vip = 'FALSE';
                    }

                    $discount = 0;
                    if($_POST['discount'] == 'one_parent'){
                        $total *= 0.9;
                        $discount = 10;
                    }else if($_POST['discount'] == 'retiree'){
                        $total *= 0.8;
                        $discount = 20;
                    }else if($_POST['discount'] == 'veteran'){
                        $total *= 0.7;
                        $discount = 30;
                    }
                    $total *= intval($_POST['amount']);
                    $amnt = intval($_POST['amount']);
                    if(($orderNums + $amnt) % 5 == 0){
                        $total *= 0.9;
                    }
                    
                    $sql = "INSERT INTO orders VALUES ($next_id, '$user', $id, $isTwoWay, '$busType', $vip, $discount, $amnt, $total, TRUE)";

                    // $query3 = mysqli_query($conn, $sql);
                    if(mysqli_query($conn, $sql)){  

                        echo "Record inserted successfully";  
                       
                       }else{  
                       
                       echo "Could not insert record: ". mysqli_error($conn);  
                       
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