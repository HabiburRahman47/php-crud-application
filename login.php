<?php
 include('connection.php');
 if(isset($_POST['login'])){
     try{
         $msg="";
         if(empty($_POST['username'])){
             $msg .= 'Username can not be empty<br>';
         }
         if(empty($_POST['password'])){
             $msg .='Password can not be empyt<br>';
         }
        if($msg)  
        {
            throw new Exception($msg);
        }
        $password=$_POST['password'];
        $password=md5($password);

        $num=0;
        $data=" Select * from login where username='$_POST[username]' and password='$password' ";
        $result=mysqli_query($conn,$data);
        $num=mysqli_num_rows($result);
        if($num>0){
            session_start();
            $_SESSION['access']='okay';
            header('location: index.php');
        }
        else{
            throw new Exception('Invalid username or password');
        }

     }
     catch(Exception $e){
         $error_message=$e->getMessage();
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
   <h2>Please Login with your inforamtion</h2>
   <?php
    if(isset($error_message))
    {
        echo $error_message;
    }
   ?>
   <form action="" method="POST">
      <table>
          <tr>
              <td>User Name:</td>
              <td> <input type="text" name="username"> </td>
          </tr>
          <tr>
              <td>Password:</td>
              <td> <input type="password" name="password"> </td>
          </tr>
          <tr>
            <td> <input type="submit" name="login"> </td>
          </tr>
      </table>
    </form>
</body>
</html>