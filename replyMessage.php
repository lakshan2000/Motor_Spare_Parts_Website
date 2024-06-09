<?php

include 'connection.php';
session_start();

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}


if(isset($_SESSION['user_id'])){
    $user_id   = $_SESSION['user_id'];
    $firstname =  $_SESSION['firstName'];
    $lastname  =  $_SESSION['lastName'];
    $mobile    =  $_SESSION['phoneNumber'];
    $email     =  $_SESSION['user_email'];
    $addres1   =  $_SESSION['addressLine1'];
    $addres2   =  $_SESSION['addressLine2'];
    $addres3   =  $_SESSION['addressLine3'];
}else{
    header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | <?php echo $firstname ;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <?php include 'msg-box.php' ?>
    
</head>
<body>

    <header>
        <?php 
        include 'header.php';
        ?>
        <div class="down-box">
        <div class="outter-box">
                <form action="search.php" method="post" enctype="multipart/form-data"> 
                    <input class="search-bar" name="search-bar" type="text" placeholder="Search Here...">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
                    <button class="search-icon" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>

    



    <section  class="profileData">

    <div class="addingReview">
                        <form action="" method="POST"  enctype="multipart/form-data">
                            <div >
                                <input type="hidden" value="<?php echo $_SESSION['firstName']; ?>" name="rn">
                            </div> 
                            <div class="input-box" >
                                <input type="text" placeholder="Message with Admin" name="msg">
                            </div> 
                            <div class="button">
                                <input type="submit" value="Send" name="send">
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['send'])){
                        $name=$_SESSION['firstName'];
                        $msg=$_POST['msg'];
                        $currentDateTime = date('l, Y-m-d H:i:s');                     
                        
                        if(empty($msg)){
                            echo "<p class='error-msg-box' style='display: none;' >Place Your Message .</p>";
                        }else{
                            echo "<p class='success-msg-box' style='display: none;' >Message Sent  Successfully.</p>";
                            $res=mysqli_query($connect,"INSERT INTO `message`(`name`, `message`,`date`) VALUES ('$name','$msg','$currentDateTime')");
                        }
                        

                    }
                    ?>

    <h1 class="heading">Your<span>Chats</span></h1>
            <div class="orderdiv">
            <?php
                $msg_sql = "SELECT * FROM `message` WHERE `name` ='$firstname'";
                $msgs = mysqli_query($connect ,$msg_sql); 

                $reply_sql = "SELECT * FROM replymessage WHERE `name` ='$firstname'";
                $replies = mysqli_query($connect ,$reply_sql); 
                        
                if(mysqli_num_rows($msgs ) || mysqli_num_rows($replies) ){ ?>
                <div class="tablediv" style="display:flex">
                    <table>
                        <tr>
                            <th >Message</th>
                            <th>Date</th>
                        </tr> 
                <?php
                while($msg = mysqli_fetch_assoc($msgs)){?>
                    <tr>
                        <td><?php echo $msg['message']?></td>
                        <td><?php echo $msg['date']; ?></td>   
                    </tr>
                <?php
                } 
                ?>
                </table>
                <table>
                    <tr >
                        <th>Reply</th>
                        <th>Date</th>
                    </tr> 
                <?php
                while( $reply = mysqli_fetch_assoc($replies)){?>
                    <tr>   
                        <td><?php echo $reply['replymessage']?></td>
                        <td><?php echo $reply['date']; ?></td>    
                    </tr>
                <?php
                } 
                ?>
                </table>
                </div>

                <?php
                }else{ ?>
                    <section class="popular box-empty">
                        <div class="box-container">
                            <div class="box" style="width: 80rem;">
                                <h1 style="font-size: 30px;">Not chats Yet!!!!</h1>
                            </div>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>  
    </section>

    
    <?php
        include_once 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>

</body>
</html>