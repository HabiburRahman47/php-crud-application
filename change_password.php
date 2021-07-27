<?php
 ob_start();
 session_start();
 if($_SESSION['access'] !='okay'){
     header('location: login.php');
 }
?>
<?php
    include('connection.php');
    if(isset($_POST['form2'])){
        
        try{
            $msg="";  
            if(empty($_POST['old_password'])){
                $msg .= 'Old Password can not be <br>';
            }
            if(empty($_POST['new_password'])){
                $msg .= 'New password can not be empty<br>';
            }
            if(empty($_POST['confirm_password'])){
                $msg .= 'Confirm Password can not be empty<br>';
            }

           //checking old password
           $num=0;
           $password=$_POST['old_password'];
           $password=md5($password);
           $data=" SELECT * from login where password='$password'";
           $result=mysqli_query($conn,$data);
           $num=mysqli_num_rows($result);
           if($num==0)
            {
                $msg .='Old password is wrong<br>';
            }
           if($_POST['new_password'] != $_POST['confirm_password'])
           {
               $msg .='New password is wrong<br>';
           }
           if($msg)
            {
                throw new Exception($msg);
            }

            $new_password=$_POST['new_password'];
            $new_password=md5($new_password);
            $data=" UPDATE login set password='$new_password' where id=1 ";
            mysqli_query($conn,$data);
            $success_message="Password successfully changed";
        }
        catch(Exception $e){
            $error_message =$e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password page</title>
</head>
<body>
    <h2>Change Password:</h2>
    <?php
      if(isset($error_message)){
       echo $error_message;
     }
     if(isset($success_message)){
       echo $success_message;
    }

    ?>
    <form action="#" method="post">
        <table>
            <tr>
                <td>Old Password:</td>
                <td><input type="text" name="old_password"></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="text" name="new_password"></td>
            </tr>
            <tr>
                <td>Confirm New Password:</td>
                <td><input type="text" name="confirm_password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Update" name="form2"></td>
            </tr>
        </table>
    </form><br>
    <a href="index.php">Previous page</a>

</body>
</html>