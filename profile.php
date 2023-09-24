<!-- database -->
<?php

    session_start();
    include("database.php");

    $username_session = $_SESSION['name'];


    $selectquery = "SELECT * FROM `customers` WHERE `username` = '$username_session'";
    $resultuser = mysqli_query($dbconnect, $selectquery);
    $data = mysqli_fetch_assoc($resultuser);

    ob_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- main css file -->
    <link rel="stylesheet" href="static/css/home/home.css">
    <link rel="stylesheet" href="static/css/navbar/navbar.css">
    <link rel="stylesheet" href="static/css/footer/footer.css">
    <link rel="stylesheet" href="static/css/profilepage/profile.css">
</head>

<body>

    <!-- loading -->
    <?php include("loading.php"); ?>

    <!-- Start nav -->
    <?php include("navbar.php"); ?>
    <!-- End nav -->

    <!-- Start main -->
    <main>
        <h1 class="head">profile</h1>

        <div class="profile-con">

            <!-- Start profile -->
            <div class="profile">
                <!-- Start pro-data -->
                <div class="pro-data">

                        <!-- Start pro-img -->
                        <div class="pro-img">
                            <img src="<?php if(empty($data['img'])) {echo 'static/images/user.png';}
                                        else echo $data['img'];
                                    ?>" 
                            alt="profile-photo">
                        </div>
                        <!-- End pro-img -->

                        <form class="change_img" method="post" enctype="multipart/form-data">
                            <div class="align">
                                <label for="file-img">change photo</label>
                                <input id="file-img" type="file" name='profileimage' accept="image/*"/>
                                <button type="submit" name='change'>
                                    change
                                </button>
                            </div>
                        </form>

                        <?php 
                            if(isset($_POST['change'])) {
                                $profile_image = $_FILES['profileimage'];
                                $path = 'static/images/' . $profile_image['name'];

                                $updatequery = "UPDATE `customers` SET 
                                `img` = '$path' WHERE `username` = '$username_session'";
                                $doquery = mysqli_query($dbconnect, $updatequery);

                                move_uploaded_file($profile_image['tmp_name'] , $path);
                                header('Location: profile.php');
                            }
                        ?>

                        <!-- Start pro-text -->
                        <div class="pro-text">
                            <p class="user"><?php echo $data['username']; ?></p>
                            <p><?php echo $data['email']; ?></p>
                            <p><?php echo $data['age']; ?></p>
                            <p><?php echo $data['gender']; ?></p>
                            <p><?php echo $data['country']; ?></p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem
                                deserunt, ratione odio architecto nulla illum beatae
                                veniam illo voluptatibus odit aspernatur. Nemo eligendi
                                expedita odit tempora neque, minima officiis voluptas.
                            </p>
                        </div>
                        <!-- End pro-text -->

                    
                </div>
                <!-- End pro-data -->
            </div>
            <!-- End profile -->

            <!-- update profile -->
            <div class="update-profile">

                <form method="post" enctype="multipart/form-data">
                    <h3>update profile</h3>

                    <?php

                        if (isset($_POST['update'])) {

                            $username = htmlspecialchars(trim($_POST['username']));
                            $email = htmlspecialchars(trim($_POST['email']));
                            $age = htmlspecialchars(trim($_POST['age']));
                            $gender = htmlspecialchars(trim($_POST['gender']));
                            $country = htmlspecialchars(trim($_POST['country']));

                            // username and email from database // foreach
                            $namee = $data['username'];
                            $emailfor = $data['email'];

                            // update query
                            $updatequery = "UPDATE `customers` SET 
                                    `username` = '$username', 
                                    `email` = '$email', 
                                    `age` = '$age',
                                    `gender` =  '$gender',
                                    `country` =  '$country'
                                WHERE 
                                    `username` = '$username_session'";

                            // select query
                            $selectusersql = "SELECT * FROM `customers` 
                                WHERE `username` = '$username' AND `username` != '$namee'";
                            $selectuser = mysqli_query($dbconnect, $selectusersql);

                            // select query
                            $selectemailsql = "SELECT * FROM `customers` 
                                WHERE `email` = '$email' AND `email` != '$emailfor'";
                            $selectmail = mysqli_query($dbconnect, $selectemailsql);

                            $usererr = $mailerr = $updated = "";

                            if(mysqli_num_rows($selectuser) == 1) {
                                $usererr = "This Name Is Already Taken";
                            }
                            elseif(mysqli_num_rows($selectmail) == 1){
                                $mailerr = "This Email Is Already Taken";
                            }
                            else {
                                $updateuser = mysqli_query($dbconnect, $updatequery);
                                $_SESSION["name"]=$username;
                                $updated = "profile has been updated";
                                header("location: profile.php");
                            }
                        }

                    ?>

                    <?php if(empty($usererr)){} else{echo $usererr;}?>
                    <?php if(empty($mailerr)){} else{echo $mailerr;}?>

                    <div class="form-box">
                        <input type="text" name="username" placeholder="Username" 
                        value="<?php if(empty($username)){echo $data['username'];} 
                        else{echo $username;} ?>" required>
                    </div>

                    <div class="form-box">
                        <input type="email" name="email" placeholder="Email" 
                        value="<?php if(empty($email)){echo $data['email'];} 
                        else{echo $email;} ?>" required>
                    </div>

                    <div class="form-box">
                        <input type="number" name="age" placeholder="Age" 
                        value="<?php if(empty($age)){echo $data['age'];} 
                            else{echo $age;} ?>" required>
                    </div>

                    <div class="form-box">
                        <input type="text" name="gender" placeholder="Gender" 
                        value="<?php if(empty($gender)){echo $data['gender'];} 
                            else{echo $gender;} ?>" required>
                    </div>

                    <div class="form-box">
                        <input type="text" name="country" placeholder="Country" 
                        value="<?php if(empty($country)){echo $data['country'];} 
                            else{echo $country;} ?>" required>
                    </div>

                    <div class="buttons">
                        <button type="submit" id="btn_3" name="update">
                            update
                        </button>
                    </div>
                </form>
            </div>
            <!-- End profile -->
            
            <!-- close of foreach to get userdata -->
            
        </div>
    </main>
    <!-- End main -->


    <!-- Start footer -->
    <?php // include("footer.php"); 
    ?>
    <!-- End footer -->



    <!-- jquery file -->
    <script src="static/js/jquery-3.6.4.min.js"></script>
    <!-- main js files -->
    <script src="static/js/home.js"></script>
    <script src="static/js/from.js"></script>

    <script>
        $(document).ready(() => {
            $(".loading").fadeOut(1500);
        });
    </script>

    <!-- for icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php ob_end_flush() ?>