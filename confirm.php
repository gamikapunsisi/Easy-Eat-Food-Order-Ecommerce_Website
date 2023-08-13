<?php

session_start();
require 'config.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];

    $data = '';

    $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
    $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
    $stmt->execute();
    $stmt2 = $conn->prepare('DELETE FROM cart');
    $stmt2->execute();
    $data .= '<div class="text-center">
                              <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                              <h2 class="text-success">Your Order Placed Successfully!</h2>
                              <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
                              <h4>Your Name : ' . $name . '</h4>
                              <h4>Your E-mail : ' . $email . '</h4>
                              <h4>Your Phone : ' . $phone . '</h4>
                              <h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
                              <h4>Payment Mode : ' . $pmode . '</h4>
                        </div>';
    echo $data;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <a href="home.php" class="logo"><i class="fas fa-utensils"></i>EasyEat</a>
    </header>
    <section>

    </section>
    <section>
        <div class="text-center">

    </div>
    </section>
</body>
</html>