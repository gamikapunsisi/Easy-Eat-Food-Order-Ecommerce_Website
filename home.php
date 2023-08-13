<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Eat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <header>
        <a href="#" class="logo"><i class="fas fa-utensils"></i>EasyEat</a>

        <nav class="navbar">
            <a class="active" href="#home">home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
        </nav>

        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
            <i class="fas fa-search" id="search-icon"></i>
            <a href="#" class="fas fa-heart"></a>
            <a href="cart.php" class="fas fa-shopping-cart"></a>
            <a herf="#" class="fa fa-user"></a>
        </div>
    </header>
    <section class="home" id="home">

        <div class="swiper-container home-slider">
            <div class="swiper-wrapper wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>special dishes for your</span>
                        <h3>Hungry Time</h3>
                        <p>Open your browser. Order now quickly. Tastes our dishes.</p>
                        <a href="#menu" class="btn">order now</a>
                    </div>
                    <div class="image">
                        <img src="images/home1.png" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <section class="about" id="about">

        <h3 class="sub-heading"> About Us </h3>
        <h1 class="heading"> WHY CHOOSE US? </h1>

        <div class="row">

            <div class="image">
                <img src="images/home2.png" alt="">
            </div>

            <div class="content">
                <h3>best food in the country</h3>
                <p>The main objective of the Online Food Ordering System is to manage the details of Item Category,Food,Delivery Address,Order,Shopping Cart. It manages all the information about Item Category, Customer, Shopping Cart, Item Category</p>
                <p>Conatct Me : 0710948815(Gamika)</p>



            </div>
    </section>
    <section class="menu" id="menu">

        <h3 class="sub-heading"> our menu </h3>
        <h1 class="heading"> Select your preference </h1>

        <section>
            <div id="message"></div>
        </section>

        <div class="box-container">
            <?php
            include 'config.php';
            $stmt = $conn->prepare("SELECT * FROM foods");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) :

            ?>
                <div class="box" id="output">
                    <div class="image">
                        <img src="images/<?php echo $row["foodimage"]; ?>" class="img-responsive" />
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>

                        <h3 name="foodname"><?= $row['foodname'] ?></h3>
                        <p><?php echo $row["fooddis"]; ?></p>

                        <form action="" class="form-submit">

                            <input type="hidden" class="fId" value="<?php echo $row["foodId"]; ?>" />
                            <input type="hidden" class="fname" value="<?php echo $row["foodname"]; ?>" />
                            <input type="hidden" class="fprice" value="<?php echo $row["foodprice"]; ?>" />
                            <input type="hidden" class="fimage" value="<?php echo $row["foodimage"]; ?>" />
                            <input type="hidden" class="fcode" value="<?php echo $row["foodcode"]; ?>" />
                            <input type="hidden" class="fdis" value="<?php echo $row["fooddis"]; ?>" />

                            <button class="btn btn-success btn-block addItemBtn">
                                <i class="">&nbsp;&nbsp;Add to cart</i>
                            </button>
                        </form>
                        <span class="price" name="foodprice">Rs.<?= number_format($row['foodprice'], 2) ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        </div>
    </section>
    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>locations</h3>
                <a href="#">Kurunegala</a>
                <a href="#">Colombo</a>
                <a href="#">Kandy</a>
                <a href="#">Galle</a>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#">home</a>
                <a href="#">about</a>
                <a href="#">menu</a>
                <a href="#">order</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#">+94717835063</a>
                <a href="#">nibmkurunegala@gmail.com</a>
                <a href="#">Kurunegala, Sri Lanka</a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#">facebook</a>
                <a href="#">twitter</a>
                <a href="#">instagram</a>
                <a href="#">linkedin</a>
            </div>

        </div>

    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".addItemBtn").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var fId = $form.find(".fId").val();
                var fname = $form.find(".fname").val();
                var fprice = $form.find(".fprice").val();
                var fdis = $form.find(".fdis").val();
                var fimage = $form.find(".fimage").val();
                var fcode = $form.find(".fcode").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {
                        fId: fId,
                        fname: fname,
                        fprice: fprice,
                        fdis: fdis,
                        fimage: fimage,
                        fcode: fcode
                    },
                    success: function(response) {
                        $("#message").html(response);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#search").keyup(function() {
                $ajax({
                    url: 'search.php',
                    method: 'post',
                    data: {
                        name: $("#search").val()
                    },
                    success: function(data) {
                        $('#output').html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>