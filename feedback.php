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
    <title>Feedback-form</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- main css file -->
    <link rel="stylesheet" href="static/css/feedback/feddback.css">
    <link rel="stylesheet" href="static/css/home/home.css">
    <link rel="stylesheet" href="static/css/navbar/navbar.css">
    <link rel="stylesheet" href="static/css/footer/footer.css">
</head>

<body>

    <!-- loading
    <?php // include("loading.php"); ?> -->


    <!-- Start nav -->
    <?php include("navbar.php"); ?>
    <!-- End nav -->

    <div class="container-from">
        <form method="post" class="feed-form">

            <h1>Feedback</h1>

            <!-- start php form -->
            <?php 
                if(isset($_POST['send'])){

                    $username = htmlspecialchars($_POST["username"]);
                    $email = htmlspecialchars($_POST["email"]);
                    $feedback = htmlspecialchars($_POST["feedback"]);

                    // to send data
                    $sendsql = "INSERT INTO `feedback` 
                    (`username`, `email`, `comment`) 
                    VALUES ('$username', '$email', '$feedback')";
                    
                    // to select users
                    $selectsql = "SELECT * FROM `customers` 
                        WHERE `username` = '$username' AND `email` = '$email'";
                    $selectusers = mysqli_query($dbconnect, $selectsql);

                    // to check if user feedback is excist---
                    $selectfeed= "SELECT * FROM `feedback` 
                        WHERE `username` = '$username' AND `email` = '$email'";
                    $selectusersfeed = mysqli_query($dbconnect, $selectfeed);

                    $checkerr = $sucess = $feederror = '';
                    
                    if(mysqli_num_rows($selectusers) == 1){
                        if(mysqli_num_rows($selectusersfeed) == 1) {
                            $feederror = 'you have made a feedback';
                        }
                        else {
                            $senddata = mysqli_query($dbconnect, $sendsql);
                        $sucess = 'your feedback has been sent!';
                        }
                    }
                    else {
                        $checkerr = 'check your email and username or Register First';
                    }
                }
            ?>
            <!-- End php form -->


            <?php if(empty($checkerr)){} else{echo $checkerr;} ?>
            <?php if(empty($feederror)){} else{echo $feederror;} ?>

            <div class="form-box">
                <input type="text" class="form-input" name="username" placeholder="UserName" 
                required value="<?php if(empty($username)){} else{echo $username;} ?>">
            </div>

            <div class="form-box">
                <input type="email" class="form-input" name="email" placeholder="Email" 
                required value="<?php if(empty($email)){} else{echo $email;} ?>">
            </div>

            <div class="form-box">
                <textarea name="feedback" placeholder="Your Feedback"
                required value="<?php if(empty($feedback)){} else{echo $feedback;} ?>">
                </textarea>
            </div>

            <button type="submit" name="send">
                <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
                <span>Send</span>
            </button>

            <?php if(empty($sucess)){} else{echo $sucess;} ?>
        </form>
    </div>


    <!-- Start footer -->
    <?php include("footer.php"); ?>
    <!-- End footer -->

    <!-- jquery file -->
    <script src="static/js/jquery-3.6.4.min.js"></script>
    <!-- main js file -->
    <script src="static/js/home.js"></script>
    <!-- <script>
        $(document).ready(() => {
            $(".loading").fadeOut(1500);
        });
    </script> -->
</body>

</html>

<?php ob_end_flush(); ?>