<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header>
    <a href="home.php" class="logo"><i class="fas fa-utensils"></i>EatEasy</a>
</header>
<section>

</section>
<section>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div style="display:<?php if (isset($_SESSION['showAlert'])) {echo $_SESSION['showAlert'];} else{echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['message'])) {echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong>
            </div>

            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>    
                        <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Product in your cart!</h4>

                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>
                                <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>Clear Cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'config.php';
                            $stmt = $conn->prepare("SELECT * FROM cart");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['cartid'] ?></td>
                            <input type="hidden" class="cartid" value="<?= $row['cartid'] ?>">
                            <td><img src="<?= $row['foodimage'] ?>" width="50"> </td>
                            <td><?= $row['foodname'] ?></td>
                            <td><i class=""></i><?= number_format($row['foodprice'],2); ?></td>
                            
                            <input type="hidden" class="foodprice" value="<?= $row['foodprice'] ?>">
                            
                            <td><input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;"></td>
                            <td><i class=""></i><?= number_format($row['totalprice'],2); ?></td>
                            <td>
                                <a href="action.php?remove=<?= $row['cartid'] ?>" class="text-danger lead" onclick="return confirm('Areyou sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $grand_total +=$row['totalprice']; ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">
                                <a href="home.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>Continue Shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>
                            <td><b><i class=""><?= number_format($grand_total,2); ?></i></b></td>
                            <td>
                                <a href="checkout.php" class="btn btn-info <?= ($grand_total>1)?"":"disabled"; ?>"><i class="far fa-credit-card"></i>Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>

    </div>
    
</div>

<script type="text/javascript">

$(document).ready(function() {

  $(".itemQty").on('change', function() {
    var $el = $(this).closest('tr');

    var cartid = $el.find(".cartid").val();
    var foodprice = $el.find(".foodprice").val();
    var qty = $el.find(".itemQty").val();
    location.reload(true);
    $.ajax({
      url: 'action.php',
      method: 'post',
      cache: false,
      data: {
        qty: qty,
        cartid: cartid,
        foodprice: foodprice
      },
      success: function(response) {
        console.log(response);
      }
    });
  });
});
</script>

</body>
</html>