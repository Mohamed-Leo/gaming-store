<?php

// $username_session = $_SESSION['name'];

if(empty($_SESSION['name'])) {}
    else $username_session = $_SESSION['name'];

include("database.php");

// for products
$prosql = "SELECT * FROM `products`";
$proresult = mysqli_query($dbconnect, $prosql);

// for feedback
$feedsql = "SELECT * FROM `feedback`";
$feedresult = mysqli_query($dbconnect, $feedsql);

if(empty($username_session)) {}
    else{
        $selectuser = "SELECT `img` FROM `customers` WHERE `username` = '$username_session'";
        $runquery = mysqli_query($dbconnect,$selectuser);
        $fetchquery = mysqli_fetch_assoc($runquery);
    }
?>



<main>
    <!-- Start section-1 -->
    <section class="section-1">
        <!-- Start container -->
        <div class="container">
            <!-- Start cards -->
            <div href="#" class="socialContainer">
                <i class="fa-solid fa-truck socialSvg"></i>
                <div class="text">
                    Free Delivery<br>
                    <span>Free Shipping On All Orde</span>
                </div>
            </div>

            <div href="#" class="socialContainer">
                <i class="fa-solid fa-sack-dollar socialSvg"></i>
                <div class="text">
                    Money Return<br>
                    <span>Back Guarantee in 7 days</span>
                </div>
            </div>

            <div href="#" class="socialContainer">
                <i class="fa-solid fa-tag socialSvg"></i>
                <div class="text">
                    Member Discount<br>
                    <span>On every order over $130.00</span>
                </div>
            </div>

            <div href="#" class="socialContainer">
                <i class="fa-solid fa-hand-holding-dollar socialSvg"></i>
                <div class="text">
                    Return Policy<br>
                    <span>Support 24 hours a day</span>
                </div>
            </div>
            <!-- Start cards -->
        </div>
        <!-- End container -->
    </section>
    <!-- End section-1 -->

    <!-- Start section-2 -->
    <section class="section-2">
        <!-- Start container -->
        <div class="container">
            <div class="box">
                <a href="https://store.steampowered.com/app/582160/Assassins_Creed_Origins/" target="_blank">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/582160/header.jpg?t=1682005718" alt="game-photo">
                </a>
            </div>

            <div class="box">
                <a href="https://store.steampowered.com/app/311210/Call_of_Duty_Black_Ops_III/" target="_blank">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/311210/header.jpg?t=1646763462" alt="game-photo">
                </a>
            </div>

        </div>
        <!-- End container -->
    </section>
    <!-- End section-2 -->

    <!-- Start section-3 -->
    <section class="section-3">
        <!-- Start head -->
        <div class="head">
            <h2>Featured Games</h2>
        </div>
        <!-- End head -->

        <!-- Start container -->
        <div class="container">
            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1282100/Remnant_II/">
                    <video autoplay muted controls>
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256960118/movie480_vp9.webm?t=1690308562" type="video/mp4">
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256960118/movie480_vp9.webm?t=1690308562" type="video/ogg">
                    </video>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1172470/Apex_Legends/">
                    <video autoplay muted controls>
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256947248/movie480_vp9.webm?t=1684341130" type="video/mp4">
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256947248/movie480_vp9.webm?t=1684341130" type="video/ogg">
                    </video>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/292030/The_Witcher_3_Wild_Hunt/">
                    <video autoplay muted controls>
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256927226/movie480_vp9.webm?t=1674829926" type="video/mp4">
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256927226/movie480_vp9.webm?t=1674829926" type="video/ogg">
                    </video>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1238820/Battlefield_3/">
                    <video autoplay muted controls>
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256787639/movie480_vp9.webm?t=1591887373" type="video/mp4">
                        <source src="https://cdn.akamai.steamstatic.com/steam/apps/256787639/movie480_vp9.webm?t=1591887373" type="video/ogg">
                    </video>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/2195250/EA_SPORTS_FC_24/">
                    <video autoplay muted controls>
                        <source src="https://cdn.cloudflare.steamstatic.com/steam/apps/256957849/movie480_vp9.webm?t=1691021264" type="video/mp4">
                        <source src="https://cdn.cloudflare.steamstatic.com/steam/apps/256957849/movie480_vp9.webm?t=1691021264" type="video/ogg">
                    </video>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1203220/NARAKA_BLADEPOINT/">
                    <video autoplay muted controls>
                        <source src="https://cdn.cloudflare.steamstatic.com/steam/apps/256957930/movie480_vp9.webm?t=1689283190" type="video/mp4">
                        <source src="https://cdn.cloudflare.steamstatic.com/steam/apps/256957930/movie480_vp9.webm?t=1689283190" type="video/ogg">
                    </video>
                </a>
            </div>
        </div>
        <!-- End container -->
    </section>
    <!-- End section-3 -->

    <!-- Start section-4 -->
    <section class="section-4">
        <!-- Start container -->
        <div class="container">

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1272080/PAYDAY_3/">
                    <div class="card">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1272080/header_alt_assets_0.jpg?t=1691159104" alt="game-photo">
                        <p>
                            PAYDAY 3 is the much anticipated sequel to one of the most
                            popular co-op shooters ever. Since its release,
                            PAYDAY-players have been reveling in the thrill of a
                            perfectly planned and executed heist. That’s what makes
                            PAYDAY a high-octane, co-op FPS experience without equal.
                        </p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1938090/Call_of_Duty/">
                    <div class="card">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg?t=1691007781" alt="game-photo">
                        <p>
                            Welcome to Call of Duty® HQ, the home of Call of Duty®:
                            Modern Warfare® II and Warzone™.
                        </p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/730/CounterStrike_Global_Offensive/">
                    <div class="card">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/730/header.jpg?t=1683566799" alt="game-photo">
                        <p>
                            Counter-Strike: Global Offensive (CS: GO) expands upon
                            the team-based action gameplay that it
                            pioneered when it was launched 19 years ago.
                            CS: GO features new maps, characters, weapons,
                            and game modes, and delivers updated versions of
                            the classic CS content (de_dust2, etc.).
                        </p>
                    </div>
                </a>
            </div>

            <div class="box">
                <a target="_blank" href="https://store.steampowered.com/app/1282100/Remnant_II/">
                    <div class="card">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1282100/header.jpg?t=1690498964" alt="game-photo">
                        <p>
                            Remnant II pits survivors of humanity against new deadly
                            creatures and god-like bosses across terrifying worlds.
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- End container -->
    </section>
    <!-- End section-4 -->

    <!-- Start section-5 -->
    <section class="section-5">
        <!-- Start head -->
        <div class="head">
            <h2 id="store">Store</h2>
        </div>
        <!-- End head -->

        <!-- Start container -->
        <div class="container">

            <!-- Start product php  -->
            <?php

            foreach ($proresult as $prodata) {
            ?>

                <div class="box">
                    <div class="card">
                        <img src="<?php echo $prodata['img'] ?>" alt="game-photo">
                        <p>
                            <?php echo $prodata['title'] ?>
                        </p>

                        <div class="os-system">
                            <i class="fa-brands fa-windows"></i>
                            <i class="fa-brands fa-apple"></i>
                        </div>

                        <p>
                            <?php echo $prodata['price'] ?>
                        </p>

                        <a href="singleproduct.php?id=<?php echo $prodata['id'] ?>" target="_blank">
                            <button>
                                Show More
                                <div id="clip">
                                    <div id="leftTop" class="corner"></div>
                                    <div id="rightBottom" class="corner"></div>
                                    <div id="rightTop" class="corner"></div>
                                    <div id="leftBottom" class="corner"></div>
                                </div>
                                <span id="rightArrow" class="arrow"></span>
                                <span id="leftArrow" class="arrow"></span>
                            </button>
                        </a>
                    </div>
                </div>

            <?php } ?>
            <!-- End product php  -->
        </div>
        <!-- End container -->
    </section>
    <!-- End section-5 -->

    <!-- Start section-6 -->
    <section class="section-6">
        <div class="custom-shape-divider-bottom-1691353763">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>

        <img src="https://www.pngitem.com/pimgs/m/137-1371827_games-png-image-video-games-characters-png-transparent.png" alt="games-charcters">

        <div class="custom-shape-divider-top-1691353924">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    <!-- End section-6 -->

    <!-- Start section-7  -->
    <section class="section-7">
        <div class="swiper-container-2 swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Start Slides -->
                <div class="swiper-slide">
                    <div class="box-feed">
                        <img src="https://lh3.googleusercontent.com/u/0/drive-viewer/AITFw-yoItfIR3fo0t0i5N29QIjRe6iyDCYABBmpol9EkgvbnlOneC3xJRK45gwLUsB9WjAkbxt6pk8GXiwpuDOfhCdJ1_u4=w1366-h611" alt="user">
                        <h3>mohamed mahmoud <span>(full stack developer)</span></h3>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing
                            elit. Voluptate, temporibus porro nobis numquam optio
                            labore esse aspernatur aliquid perspiciatis, explicabo
                            quos doloribus aut laborum nulla at animi modi a officiis?
                        </p>
                    </div>
                </div>

                <!-- start feedback from database  -->
                <?php 
                foreach($feedresult as $feeddata){
                ?>

                    <div class="swiper-slide">
                        <div class="box-feed">
                            <img src="<?php if(empty($fetchquery['img'])) echo 'static/images/user.png';
                                            else echo $fetchquery['img'];
                                        ?>" 
                                    alt="user">
                            <h3><?php echo $feeddata["username"] ?><span>(gamer)</span></h3>
                            <p>
                                <?php echo $feeddata["comment"] ?>
                            </p>
                        </div>
                    </div>

                <?php } ?>
                <!-- End feedback from database  -->
                <!-- End Slides -->
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End section-7  -->
</main>