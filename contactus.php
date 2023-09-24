
<!-- database -->
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
    <title>Contact Us</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- main css file -->
    <link rel="stylesheet" href="static/css/home/home.css">
    <link rel="stylesheet" href="static/css/navbar/navbar.css">
    <link rel="stylesheet" href="static/css/footer/footer.css">
    <link rel="stylesheet" href="static/css/contact_us/contactus.css">
</head>

<body>

    <!-- loading -->
    <?php include("loading.php"); ?>

    <!-- Start nav -->
    <?php include("navbar.php"); ?>
    <!-- End nav -->

    <main>
        <div class="container">

            <form method="post" class="login-form">
                <div class="wrapper">
                    <h2>Login</h2>
                    
                    <!-- Start login php code -->
                    <?php 
                        if(isset($_POST['submitlogin'])){
                        
                            $emaillogin = $_POST['emaillogin'];
                            $passwordlogin = $_POST['passwordlogin'];

                            $selectusers = 
                            "SELECT * FROM 
                                `customers` 
                            WHERE 
                                `email` = '$emaillogin' 
                            And
                                `password` = '$passwordlogin'";

                            $resultusers = mysqli_query($dbconnect, $selectusers);

                            $checkerr = '';

                            
                            if(mysqli_num_rows($resultusers) == 1) {
                                
                                foreach($resultusers as $row) {
                                    if($row['email'] == "shadow-admin@gmail.com" 
                                        && $row['password'] == "0100Shadow-@Ad") {
                                        $_SESSION['name'] = $row['username'];
                                        header("location: adminpanel.php");
                                    }
                                    else{
                                        $_SESSION['name'] = $row['username'];
                                        header("location: home.php");
                                    }
                                }
                            }
                            else{
                                $checkerr = 'check password and mail or register';
                            }
                        }
                    ?>  
                    <!-- End login php code -->


                        <!-- register message -->
                        <?php if(empty($checkerr)){} 
                                else{echo "<h5 style='margin:10px 0; font-size:18px; 
                                        text-align:center;'>
                                        {$checkerr}
                                    </h5>";} 
                        ?>

                    <div class="input-box"class="">
                        <span class="icon">
                            <ion-icon name="mail"></ion-icon>
                        </span>
                        <input id="emaillogin" type="email" name="emaillogin" required
                        value="<?php if(empty($emaillogin)){} else{echo $emaillogin;} ?>">
                        <label for="emaillogin">Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input id="passwordlogin" type="password" name="passwordlogin" required
                        value="<?php if(empty($passwordlogin)){} else{echo $passwordlogin;} ?>">
                        <label for="passwordlogin">Password</label>
                    </div>

                    <div class="remember-forgot">
                        <label for="remember">
                            <input id="remember" type="checkbox" name="remember">
                            Remember Me
                        </label>
                        <a href="#">Forgot Password</a>
                    </div>

                    <button type="submit" class="btn" name="submitlogin">Login</button>

                    <div class="login-register">
                        <p>
                            Don't have an account?
                            <a href="#" class="register-link">Register</a>
                        </p>
                    </div>
                </div>
            </form>




            <!-- register form -->
            <form method="post" class="register-form">
                <div class="wrapper">
                    <h2>Register</h2>


                    <!-- Start php register code form -->
                    <?php 
                    
                        if(isset($_POST["register"])) {

                            // getting data from inputs----------------
                            $username = htmlspecialchars(trim($_POST["username"]));
                            $age = htmlspecialchars(trim($_POST["age"]));
                            $email = htmlspecialchars(trim($_POST["email"]));
                            $password = htmlspecialchars(trim($_POST["password"]));
                            $cpassword = htmlspecialchars(trim($_POST["cpassword"]));
                            $country = $_POST["country"];
                            $gender = $_POST["gender"];

                            // write sql queries to insert data 
                            $querysql = "INSERT INTO `customers`
                            (`username`,`age`,`email`,`password`,`country`,`gender`) 
                            VALUES ('$username','$age','$email','$password','$country','$gender')";

                            $passerr = $mailerr = $usernameerr  = $passvalid = '';

                            if(strlen($password) < 8){
                                $passvalid = "password must be at least 8 chars, 
                                    includes symbols,numbers and capital chars as #%5Af68";
                            }
                            else{

                                if($password == $cpassword) {

                                    // select email 
                                    $selectmail = "SELECT * FROM `customers` 
                                    WHERE `email` = '$email'";
                                    $nafez1 = mysqli_query($dbconnect,$selectmail);
                                    
    
                                    // select username 
                                    $selectusername = "SELECT * FROM `customers` 
                                    WHERE `username` = '$username'";
                                    $nafez2 = mysqli_query($dbconnect,$selectusername);
                                    
                                    if(mysqli_num_rows($nafez1) == 1) {
                                        $mailerr = 'This email is already taken';
                                    }
                                    elseif(mysqli_num_rows($nafez2) == 1){
                                        $usernameerr = 'This username is already taken';
                                    }
                                    else{
                                        // connect sql lang with php lang to send data to database
                                        $confirmed = mysqli_query($dbconnect, $querysql); 
                                        header("location: contactus.php");
                                    }
                                }
                                else {
                                    $passerr = 'password does not match';
                                }
                            }
                        }
                    ?>
                    <!-- End php register code form -->


                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="person"></ion-icon>
                        </span>
                        <input id="username" type="text" name="username" required
                        value="<?php if(empty($username)){} else{echo $username;} ?>">
                        <label for="username">Username</label>
                    </div>
                        <?php 
                            if(empty($usernameerr)){} 
                            else{echo "<h6 style='margin:10px 0; font-size:18px;'>{$usernameerr}</h6>";} 
                        ?> 

                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="people"></ion-icon>
                        </span>
                        <input id="age" type="number" name="age" required
                        value="<?php if(empty($age)){} else{echo $age;} ?>">
                        <label for="age">Age</label>
                    </div>

                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="mail"></ion-icon>
                        </span>
                        <input id="email" type="email" name="email" required
                        value="<?php if(empty($email)){} else{echo $email;} ?>">
                        <label for="email">Email</label>
                    </div>
                        <?php 
                            if(empty($mailerr)){} 
                            else{echo "<h6 style='margin:10px 0; font-size:18px;'>{$mailerr}</h6>";} 
                        ?> 

                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input id="password" type="password" name="password" required
                        value="<?php if(empty($password)){} else{echo $password;} ?>">
                        <label for="password">Password</label>
                    </div>
                        <?php 
                            if(empty($passvalid)){} 
                            else{echo "<h6 style='margin:10px 0; font-size:18px;'>{$passvalid}</h6>";} 
                        ?>   

                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input id="cpassword" type="password" name="cpassword" required>
                        <label for="cpassword">Confirm Password</label>
                    </div>
                        <?php 
                            if(empty($passerr)){} 
                            else{echo "<h6 style='margin:10px 0; font-size:18px;'>{$passerr}</h6>";} 
                        ?>

                    <div class="input-box">
                        <select name="country" required>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antartica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo">Congo, the Democratic Republic of the</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                            <option value="Croatia">Croatia (Hrvatska)</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt" selected>Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="France Metropolitan">France, Metropolitan</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                            <option value="Holy See">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran (Islamic Republic of)</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia, Federated States of</option>
                            <option value="Moldova">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint LUCIA">Saint LUCIA</option>
                            <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia (Slovak Republic)</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                            <option value="Span">Spain</option>
                            <option value="SriLanka">Sri Lanka</option>
                            <option value="St. Helena">St. Helena</option>
                            <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan, Province of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Viet Nam</option>
                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                            <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                            <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <select name="gender" required>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                    </div>

                    <div class="remember-forgot">
                        <label for="agree">
                            <input id="agree" type="checkbox" name="agree">
                            agree to the terms and conditions
                        </label>
                    </div>

                    <button id="reig" type="submit" class="btn" name="register">Register</button>
                
                    <?php 
                        // condition for errors
                        if (!empty($passerr) || !empty($mailerr) || 
                        !empty($usernameerr) || !empty($passvalid)) {

                            echo '<script>
                                document.querySelector(".register-form").style.transform = `
                                translateX(0)`;

                                document.querySelector(".container").style.height = `
                                760px`;

                                document.querySelector(".login-form").style.transform = `
                                translateX(-400px)`;
                            </script>';
                        }
                    ?>

                    <div class="login-register">
                        <p>
                            Already have an account?
                            <a href="#" class="login-link">Login</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Start footer -->
    <?php include("footer.php"); ?>
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