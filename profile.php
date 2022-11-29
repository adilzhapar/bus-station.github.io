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
            <?php
                session_start();
                if($_SESSION['logged'] == true){
                    echo "Logged";

                }else{
                    echo "not logged";
                }

            ?>
            <a href="logout.php">Logout</a>
            
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