<?php 
    session_start();
    // print_r($_SERVER["REQUEST_URI"]);
    $url_id = $_GET['id'];
    
    include("database.php");

    // query to select products from database
    $query = "SELECT * FROM `products` WHERE `id` = '$url_id'";
    $result = mysqli_query($dbconnect, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signle-product</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- main css files -->
    <link rel="stylesheet" href="static/css/home/home.css">
    <link rel="stylesheet" href="static/css/navbar/navbar.css">
    <link rel="stylesheet" href="static/css/footer/footer.css">
    <link rel="stylesheet" href="static/css/single_product/singleproduct.css">
</head>

<body>

    <!-- Start nav -->
    <?php include("navbar.php"); ?>
    <!-- End nav -->



    <?php 
    
    foreach($result as $row){
    ?>

        <div class="main">
            <div class="box img-size">
                <img src="<?php echo $row['img'] ?>" alt="game-image">
            </div>

            <div class="box text">
                <h1><?php echo $row['title'] ?></h1>

                <p><?php echo $row['description'] ?></p>

                <p><?php echo $row['price'] ?></p>

                <div class="os-system">
                    <i class="fa-brands fa-windows"></i>
                    <i class="fa-brands fa-apple"></i>
                </div>

                <button class="button">
                    <span class="button_lg">
                        <span class="button_sl"></span>
                        <span class="button_text">Download Now</span>
                    </span>
                </button>
            </div>
        </div>

    <?php } ?>


    <!-- Start footer -->
    <?php include("footer.php"); ?>
    <!-- End footer -->

    <!-- loading -->
    <?php include("loading.php"); ?>

    <!-- jquery file -->
    <script src="static/js/jquery-3.6.4.min.js"></script>
    <!-- main js file -->
    <script src="static/js/home.js"></script>
    <script>
        // laoding------------------------------
        $(document).ready(() => {
            $(".loading").fadeOut(1500);
        });
    </script>
</body>

</html>