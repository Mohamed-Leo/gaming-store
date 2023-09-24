

<!-- Start top nav -->
<div class="top-nav">
    <!-- Start left -->
    <div class="left">
        <div class="wish">
            wishlist
            <i class="fa-solid fa-heart"></i>
        </div>

        <div class="help" id="help_div">
            <p>need help ?</p>
            <i class="fa-solid fa-chevron-down arrow"></i>

            <div class="list">
                <ul>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        0000-00-00
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        6865-58-32
                    </li>
                    <li>
                        <i class="fa-brands fa-whatsapp"></i>
                        9854-265-35
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End left -->

    <!-- Start right -->
    <div class="right">
        call 24/7 . 654-8435-984
        <form action="logout.php" method="post">
            <button type="submit" name="logout" value="log-out">log-out</button>
        </form>
    </div>
    <!-- End right -->

    <!-- logout  -->

    <!-- logout  -->
</div>
<!-- End top nav -->




<!-- Start nav -->
<nav>
    <!-- Start logo -->
    <div class="logo">
        <img src="https://capricathemes.com/wordpress/WCM04/WCM040086/wp-content/themes/gamehoak/images/codezeel/logo.png" alt="logo">
    </div>
    <!-- End logo -->

    <!-- Start links -->
    <div id="links_div" class="links">
        <i class="fa-solid fa-xmark close_icon"></i>

        <ul>
            <li><a href="index.php" target="_blank">home</a></li>
            <li><a href="index.php#store">store</a></li>
            <li><a href="aboutus.php" target="_blank">about</a></li>
            <li><a href="contactus.php" target="_blank">contact</a></li>
            <li><a href="feedback.php" target="_blank">feedback</a></li>
        </ul>

        <div class="search_box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="search">
        </div>
    </div>
    <!-- End links -->

    <!-- Start right -->
    <div class="right-side">

        <div class="search">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" placeholder="Search" class="search_input">
        </div>

        <div class="login">
            <a id="login_link" href="contactus.php" target="_blank">
                <i class="fa-solid fa-user"></i>
                <?php 
                    if(empty($_SESSION['name'])){
                        echo 'login';
                        echo "<script>document.getElementById(\"login_link\").href=\"contactus.php\";</script>";
                    } 
                    else {
                        echo $_SESSION['name'];
                        echo "<script>document.getElementById(\"login_link\").href=\"profile.php\";</script>";
                    }
                ?>
            </a>
        </div>

        <div class="cart">
            <i class="fa-solid fa-basket-shopping"></i>
            <span class="pro-number">0</span>
            <span class="total">0.00</span>
        </div>

        <i class="fa-solid fa-bars menu_icon"></i>
    </div>
    <!-- End right -->
</nav>
<!-- End nav -->