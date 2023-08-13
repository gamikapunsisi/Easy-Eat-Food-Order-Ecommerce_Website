<?php

session_start();
require 'config.php';

if(isset($_POST['fId']))
{
    $fId = $_POST['fId'];
    $fname = $_POST['fname'];
    $fprice = $_POST['fprice'];
    $fimage = $_POST['fimage'];
    $fdis = $_POST['fdis'];
    $fcode = $_POST['fcode'];
    $fqty = 1;

    $stmt = $conn->prepare("SELECT foodcode FROM cart WHERE foodcode=?");
    $stmt->bind_param("s",$fcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['foodcode'] ?? '';

    if(!$code)
    {
        $query = $conn->prepare("INSERT INTO cart (foodname,foodprice,foodimage,qty,totalprice,foodcode) VALUES (?,?,?,?,?,?)");
        $query->bind_param("sssiss",$fname,$fprice,$fimage,$fqty,$fprice,$fcode);
        $query->execute();


        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item added to your cart!</strong>
            </div>';
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item already added to your cart!</strong>
            </div>';
    }
}

if (isset($_GET['remove'])) {
    $cartid = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE cartid=?');
    $stmt->bind_param('i',$cartid);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
  }


if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM cart');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Item removed from the cart!';
    header('location:cart.php');
  }


if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $cartid = $_POST['cartid'];
    $foodprice = $_POST['foodprice'];

    $totalprice = $qty * $foodprice;

    $stmt = $conn->prepare('UPDATE cart SET qty=?, totalprice=? WHERE cartid=?');
    $stmt->bind_param('isi',$qty,$totalprice,$cartid);
    $stmt->execute();
  }



  if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
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
  }
?>
