<?php
	require 'config.php';

	$grand_total = 0;
	$allfoods = '';
	$foods = [];

	$sql = "SELECT CONCAT(foodname, '(',qty,')') AS qty, totalprice FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['totalprice'];
	  $foods[] = $row['qty'];
	}
	$allfoods = implode(', ', $foods);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <script type="text/javascript" src="validate.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
<header>
    <a href="home.php" class="logo"><i class="fas fa-utensils"></i>EasyEat</a>
    <div class="icons">
		<a href="cart.php" class="fas fa-shopping-cart"></a>
    </div>
</header>
<section>

</section>

<section class="order" id="order">

    <h3 class="heading"> Complete Your Order </h3>

    <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="sub-heading"><b>Product(s) : </b><?= $allfoods; ?></h6>
          <h6 class="sub-heading"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
    </div>

    <form action="confirm.php" name="validateForm" method="post" id="placeOrder" onsubmit="return validateF()">

        <input type="hidden" name="products" value="<?= $allfoods; ?>">
        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">

        <div class="inputBox">
            <div class="input">
                <span>your name</span>
                <input type="text" class="form-control" placeholder="enter your name" name="name" id="name">
            </div>
            <div class="input">
                <span>your email</span>
                <input type="text" class="form-control" placeholder="enter your email" name="email" id="email">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>your phonenumber</span>
                <input type="text" class="form-control" placeholder="enter your number" name="phone" id="phone">
            </div>
            <div class="input">
                    <span>Select Payment Mode</span>
                    <select name="pmode" class="form-control">
                        <option value="" selected disabled>-Select Payment Mode-</option>
                        <option value="cod">Cash On Delivery</option>
                        <option value="netbanking">Net Banking</option>
                        <option value="cards">Debit/Credit Card</option>
                    </select>
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Enter delivery address...</span>
                <textarea name="address" class="form-control" placeholder="enter your address" id="message" cols="30" rows="5"></textarea>
            </div>
            
        </div>

        <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">

    </form>

</section>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>

</html>