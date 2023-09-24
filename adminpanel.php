

<?php 
    session_start();
    include("database.php"); 
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-page</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="swiper-bundle.css">

    <!-- main css file -->
    <link rel="stylesheet" href="static/css/home/home.css">
    <link rel="stylesheet" href="static/css/navbar/navbar.css">
    <link rel="stylesheet" href="static/css/footer/footer.css">
    <link rel="stylesheet" href="static/css/adminpage/admin.css">
</head>

<body>
    <!-- loading -->
    <?php include("loading.php"); ?>

    <!-- Start nav -->
    <?php include("navbar.php"); ?>
    <!-- End nav -->



    <!-- Start main -->
    <main>

        <h1>Admin Panel</h1>

        <div class="container">

            <!-- Start add_product delete form -->
            <form method="post" enctype="multipart/form-data">
                <h3>Add and delete Product</h3>

                <!-- Start add product to database php -->
                <?php 
                    if(isset($_POST['add'])){

                        $proname = htmlspecialchars($_POST["proname"]);
                        $prodescription = htmlspecialchars($_POST["prodescription"]);
                        $price = htmlspecialchars($_POST["price"]);

                        // image upload
                        $image = $_FILES['image']['name'];
                        $imagetmp = $_FILES['image']['tmp_name'];
                        $path = 'static/images/' . $image;
                        move_uploaded_file($imagetmp, $path);


                        // query to send data 
                        $prosql = "INSERT INTO `products` (`title`, `description`, `price` , `img`) 
                        VALUES ('$proname', '$prodescription', '$price' , '$path')";
                        

                        // query to select data 
                        $proselectsql = "SELECT * FROM `products`
                        WHERE `title` = '$proname'";
                        $selectpro = mysqli_query($dbconnect, $proselectsql);

                        $proerr = '';

                        if(mysqli_num_rows($selectpro) == 1) {
                            $proerr = 'This product is already exist';
                        }
                        else{
                            $proresult = mysqli_query($dbconnect, $prosql);
                            header("location: adminpanel.php");
                        }
                    }

                    if(isset($_POST['delete'])){

                        $proname = htmlspecialchars($_POST["proname"]);

                        // query to select data 
                        $proselectsql = "SELECT * FROM `products`
                            WHERE `title` = '$proname'";
                        $selectpro = mysqli_query($dbconnect, $proselectsql);

                        // query to delete data 
                        $prosql = "DELETE FROM `products` WHERE `title` = '$proname'";
                        
                        $delerr = "";

                        if(mysqli_num_rows($selectpro) == 1) {
                            $delete = mysqli_query($dbconnect, $prosql);
                            header("location: adminpanel.php");
                        }
                        else{
                            $delerr = 'this product is not exist';
                        }
                    }
                ?>
                <!-- End add product to database php -->

                    <?php if(empty($proerr)){} else{echo $proerr;} ?>
                    <?php if(empty($delerr)){} else{echo $delerr;}?>
                    <?php if(empty($updaterr)){} else{echo $updaterr;}?>

                <div class="form-box">
                    <input type="text" name="proname" placeholder="product name" required
                    value="<?php if(empty($proname)){} else{echo $proname;} ?>">
                </div>

                <div class="form-box">
                    <textarea name="prodescription" placeholder="description" 
                    value="<?php if(empty($prodescription)){} else{echo $prodescription;} ?>" 
                    required></textarea>
                </div>

                <div class="form-box">
                    <input type="text" name="price" placeholder="product price" required
                    value="<?php if(empty($price)){} else{echo $price;} ?>">
                </div>

                <!-- upload -->
                <label class="custum-file-upload" for="file">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
                        </div>
                        <input type="file" id="file" name="image" accept=".png, .jpg">
                        <span>click to upload</span>
                </label>

                <div class="buttons">
                    <button type="submit" id="btn_1" name="add">
                        Add
                    </button>

                    <button type="submit" id="btn_2" name="delete">
                        Delete
                    </button>
                </div>
            </form>
            <!-- End add_product delete form -->

            <!-- Start view products -->
            <div class="view">
                <h3>View Products</h3>
                
                <div class="products-box">
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/209000/header.jpg?t=1681234740" alt="game-image">
                    </div>
                    
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/311210/header.jpg?t=1646763462" alt="game-image">
                    </div>
                    
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1817070/header.jpg?t=1673999865" alt="game-image">
                    </div>

                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/699130/header.jpg?t=1680096435" alt="game-image">
                    </div>

                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1172470/header.jpg?t=1690583643" alt="game-image">
                    </div>

                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/374320/header.jpg?t=1682651227" alt="game-image">
                    </div>

                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1498570/header.jpg?t=1691479379" alt="game-image">
                    </div>
                    
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1449690/header.jpg?t=1688062400" alt="game-image">
                    </div>
                    
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1967630/header_alt_assets_2.jpg?t=1691486233" alt="game-image">
                    </div>
                    
                    <div class="box">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/306130/header.jpg?t=1689258769" alt="game-image">
                    </div>
                </div>
                
                <a href="home.php?#store" target="_blank">
                    <button class="btn">
                        view products
                    </button>
                </a>
            </div>
            <!-- End view products -->
            
            <!-- Start view feedback -->
            <div class="feed">
                <!-- Start slider -->
                <div class="swiper-container-3 swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="box-feed">
                                <img src="https://lh3.googleusercontent.com/fife/AKsag4Nrb6LAdJggvrAXNNErUiNn-kOsxsbyEsUS_gKL4NYEQTceQxdgDwkqrIXvjjSsBwY-QHNn8iVc719oWsQGej1YQwdURk5aMLcyXHo5c_UNFF7PxLXW6-HZRudUS2xpdrBM0-32Y29oxcboVCQgV6RJsxtT7EiiG3v7cA5fIsLi6I77xKMy0-TBIs7ZXwyD8qctsayFGRZPkUuGLRqMd6FfF3Qw8hxWJ2p9_35h5pQNq6Vf-wZycrEXvVUhGMvb0JluvF9rkCtbpiNUQpNsFMiJnp4roVZz9LN5KIXa1FfPy8KfmAY6oxuL1D0IkOtfe6qNxusOFWUPVg5eCSSlKNjNlv8QOlO1t6oovnVf7XWRZjQEEl04Om23NUSXuMo3zzbjqr9UA9MPrmEVmGaxQOAF0_NR1NHlp-SW4063N5gJmwn-25aWJ-Dt4xb1Sza32vYKoDSIVsULJSpBPd_3zg24-L4t_PcqAlpfKqZJNaTHUgsrFBezGNz38UMC4-rIpanWI92J4nKLzYhVZYcOsRX3dv9KA3pTqAUuLnjmL2IZl8_bvqdm7PcPgYY4TT2KFqucEQy9hMl6NkKWjpiX7usLVyIB1k-cN0o3d6YWsaSeQK0X5LM2zEmdyzkYWlVXII6rYgq9CNBwcBS7rGYRDneypHhCJZzkA1GZqf8V8cN4f1Nkuaa-Qht_rtcKF--08-GVPjDRfKO5h4qIJDImNCSL732JQP2xoy2R6wZUhx8Gu2XFjWrqnnXXWw5hE3_ygdfG_l0QZT5oAOCnODzaaTafereMILgnVWlVtNqCnONXiFPrkfxLQ_FPLZzQNYDMg13iKJ5B5BsGi1sa1aFFkTZMmEp0c44OxcCY35mKKjF7HwGetoAVnAyewzhpfk_nPnXatQPTaqLNiS126rrt7HLxUuXwRzpFKftktvm1DmOJhnjBGknXPNMB8LWnTYP-Jc1AOxOb7gcGE-YXmLbxhJ7sRHVtkZnMba3wcnhvmDD_yy_4s8nIX4FyQH7PQ1jsDmX8rVAVb_frObU_Bl9JNdjt5LtDAIMXGUvLBPHbn0m2_cQ6kwBY54NcmM9w14BgONi_Q9JLlr6Od8EcMd0WPP4HD1dfilnAZ89RYeO0Ioj2xcjcDMs9_geuOxel3pD1g0UlZrUna_8nsszD8PrpqDddm3J3Ie9fAQ_j9opxZRxixItDEIp6S47Rko9BvEExpGfnFrKdTosIlqxTNBoE9q2XNdWRZGy7GG1kuANFbMWu2qWAkWnwmMcjOyyog6aMBrkPTRh-eHqIDzXiHNM_phYaHNZSR5j3mOW0Xm-T40dT_uqvGMA6boeCgm5GusX5vA4rIaXGKOS9d3Dn87hr9-hVnW8tyIaHZferFB7w3WpI0BitsJ4IpY1EjLjx9Uodk2Madze0spdEYjVzC9p16ev1iurSEtPQuS6DCUE4-dnpntPW-VUe8DCbhh9vjHrvmN8bfFy1G3QRdqo4njrVPiSHNbGuI4aHfLzY3VRNkb7Tefm7KqAYIvBQ0hq1V2LpV2sNEVrhoGH22nN92NT3gfVflLeX4O6ebxOjSO8kidiUuxa09OO-htU7AEJX_nt0R58HKVDPXuooAEQ4ig=w1366-h611" alt="user">
                                <h3>mohamed mahmoud <span>(full stack developer)</span></h3>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit. Voluptate, temporibus porro nobis numquam optio
                                    labore esse aspernatur aliquid perspiciatis, explicabo
                                    quos doloribus aut laborum nulla at animi modi a officiis?
                                </p>
                            </div>
                        </div>
                        
                        <div class="swiper-slide">
                            <div class="box-feed">
                                <img src="https://png.pngtree.com/png-clipart/20210425/original/pngtree-cute-girl-in-orange-hijab-for-chat-icon-simple-vector-png-image_6252671.jpg" alt="user">
                                <h3>nada atef <span>(banker)</span></h3>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                    elit. Voluptate, temporibus porro nobis numquam optio
                                    labore esse aspernatur aliquid perspiciatis, explicabo
                                    quos doloribus aut laborum nulla at animi modi a officiis?
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End slider -->
                </div>
            <!-- End view feedback -->

            <a href="showfeedback.php" target="_blank">
                <button>Show Feedback</button>
            </a>

            <a href="showusers.php" target="_blank">
                <button>Show Users</button>
            </a>
            </div>
        
            <!-- Start update form -->
            <form method="post" enctype="multipart/form-data">
                <h3>Update Product</h3>

                <?php 
                
                    if(isset($_POST['update'])) {

                        $oldproname = htmlspecialchars($_POST['oldproname']);
                        $newproname = htmlspecialchars($_POST['newproname']);
                        $newprodescription = htmlspecialchars($_POST['newprodescription']);
                        $newprice = htmlspecialchars($_POST['newprice']);

                        // image update----
                        $newimg = $_FILES['image']['name'];
                        // print_r($newimg['error']);
                        $newimg_tmp = $_FILES['image']['tmp_name'];
                        $upimgpath = 'static/images/' . $newimg;
                        move_uploaded_file($newimg_tmp, $upimgpath);

                        $updatesql = "UPDATE `products` SET 
                            `title` = '$newproname', 
                            `description` = '$newprodescription', 
                            `price` = '$newprice',
                            `img` =  '$upimgpath'
                        WHERE 
                            `title` = '$oldproname'";

                        $selectsql = "SELECT * FROM `products` 
                        WHERE `title` = '$oldproname'";
                        $selectpro = mysqli_query($dbconnect, $selectsql);

                        $updaterr = '';

                        if(mysqli_num_rows($selectpro) == 1){
                            $updatepro = mysqli_query($dbconnect, $updatesql);
                        }
                        else{
                            $updaterr = 'this product is not exist';
                        }
                    }
                ?>

                <?php if(empty($updaterr)){} else{echo $updaterr;} ?>
        
                <div class="form-box">
                    <input type="text" name="oldproname" placeholder="product name" required
                    value="<?php if(empty($oldproname)){} else{echo $oldproname;} ?>">
                </div>
        
                <div class="form-box">
                    <input type="text" name="newproname" placeholder="new product name"
                    value="<?php if(empty($newproname)){} else{echo $newproname;} ?>">
                </div>

                <div class="form-box">
                    <textarea name="newprodescription" placeholder="new description" 
                    value="<?php if(empty($newprodescription)){} else{echo $newprodescription;} ?>" 
                    ></textarea>
                </div>

                <div class="form-box">
                    <input type="text" name="newprice" placeholder="new product price"
                    value="<?php if(empty($newprice)){} else{echo $newprice;} ?>">
                </div>
        
        
                <h4>upload</h4>
                <!-- <label class="custum-file-upload" for="file">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
                        </div>
                        <input type="file" id="file" name="image" accept=".png, .jpg">
                        <span>click to upload</span>
                </label> -->


                <div class="con-update">
                    <label class="label" for="arquivo">Choose a file:</label>
                    <input type="file" id="file" name="image" accept="image/*">			
	            </div>

                <div class="buttons">
                    <button type="submit" id="btn_3" name="update">
                        update 
                    </button>
                </div>
            </form>
            <!-- End update form -->

        </div>

    </main>
    <!-- End main -->

    <!-- jquery file -->
    <script src="static/js/jquery-3.6.4.min.js"></script>
    <!-- swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- main js files -->
    <script src="static/js/home.js"></script>

    <script>
        $(document).ready(() => {
            $(".loading").fadeOut(1500);
        });
    </script>
</body>

</html>

<?php ob_end_flush(); ?>