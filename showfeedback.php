<?php  
    session_start();
    include("database.php");

    $selectfeedsql = "SELECT * FROM `feedback`";
    $selectusers = mysqli_query($dbconnect, $selectfeedsql);

    ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show feedback</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200720/original/pngtree-mascot-gaming-logo-esport-with-sniper-illustration-png-image_4611888.jpg">

    <link rel="stylesheet" href="static/css/showfeedback/showfeed.css">
</head>

<body>
    <h1>Show user's feedbacks</h1>

    <!-- Start Table -->
    <div class="table">
        <!-- Start Table -->
        <table>
            <thead>
                <tr>
                    <th>iD</th>
                    <th>username</th>
                    <th>email</th>
                    <th>feedback</th>
                    <th>status</th>
                </tr>
            </thead>

            <tbody>

                <?php 
                
                    foreach($selectusers as $data){
                ?>

                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['comment']; ?></td>
                        <td class="green">loged</td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <!-- End Table -->
    </div>
    <!-- End Table -->
</body>

</html>

<?php ob_end_flush(); ?>