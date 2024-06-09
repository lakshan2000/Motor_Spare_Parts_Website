<?php
session_start();
include 'connection.php';

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $firstname=$_SESSION['firstName'];
} else{
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    td{
        font-size: 1.5rem;
        padding: 0;
    }
</style>
</head>
<body>

    <header>
        <?php 
        include 'header.php';
        ?>
        <div class="down-box"></div>
    </header>



    <div class="productsTable" style=" margin: 0; padding: 0;display: flex; flex-direction: column; align-items: center;min-height:70vh">
        <h2 class="messages">
        <?php
        if(isset($_GET['error'])){
            if($_GET['error']=='successfullyDeleted'){
                echo "Successfully Deleted The Item";
            }
        }
        ?>
        </h2>
        <h2>Messages</h2>
        <table style="width: 98vw;font-size: 1.5rem; margin: 3rem;">
            <thead>
                <td><b>Customer Name</b></td>
                <td><b>Messages</b></td>
                <td><b>Date</b></td>
            </thead>
            
            <?php
            

            $sql = "SELECT  * FROM `message`";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['message'] ?></td>                    
                    <td><?php echo $row['date'] ?></td>  
                    <td> <button onclick="reply('<?php echo $row['name']; ?>')" class="btn">Reply</button></td> 
                </tr>
                <?php }?>
                
        </table>

    
        <div class="addingReview" style="display:none; width:95%" id="replyBox">
                <form action="" method="POST"  enctype="multipart/form-data">
                    <div >
                         <input type="hidden" id="uname" value="<?php echo $_SESSION['firstName']; ?>" name="rn">
                    </div> 
                    <div class="input-box" >
                        <input id="replyInput" type="text" placeholder="" name="msg">
                    </div> 
                    <div class="button">
                        <input type="submit" value="Send" name="send">
                    </div>
             </form>
    </div>
    </div>


    <?php
                    if(isset($_POST['send'])){
                        $name=$_POST['rn'];
                        $replymsg=$_POST['msg'];
                        $currentDateTime = date('l, Y-m-d H:i:s'); 
                        
                        if(empty($replymsg)){
                            echo "<p class='error-msg-box' style='display: none;' >Place Your Message .</p>";
                        }else{
                             echo "<p class='success-msg-box' style='display: none;' >Message Sent  Successfully.</p>";
                             $res=mysqli_query($connect,"INSERT INTO `replyMessage`(`name`, `replymessage`,`date`) VALUES ('$name','$replymsg','$currentDateTime')");
                        }



                    }
                    ?>
    <?php
        include_once 'footer.php';
    ?>



    <script>
    function reply(userName){
        document.getElementById("replyBox").style.display="initial";
        document.getElementById("replyInput").placeholder = "Reply to " + userName;
        document.getElementById("uname").value=userName;
    }
</script>

   
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>   
</body>
</html>