<?php
 ob_start();
 session_start();
 if($_SESSION['access'] !='okay'){
     header('location: login.php');
 }
?>
<?php
    include('connection.php');
    if(isset($_POST['form1'])){
        
        try{
            $msg="";  
            if(empty($_POST['name'])){
                $msg .= 'Name can not be <br>';
            }
            if(empty($_POST['age'])){
                $msg .= 'Age can not be empty<br>';
            }
            if(empty($_POST['email'])){
                $msg .= 'Email can not be empty<br>';
            }
            if($msg)
            {
                throw new Exception($msg);
            }

            $name=$_POST['name'];
            $age=$_POST['age'];
            $email=$_POST['email'];

            $data=" INSERT INTO student ( name,age,email )
                    VALUES ('$name',$age,'$email')";
            mysqli_query($conn,$data);
            $success_message="Data successfully inserted";
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
    <title>Insert Data</title>
</head>
<body>
    <h2>Insert your information:</h2>
    <?php
      if(isset($error_message)){
       echo $error_message;
     }
     if(isset($success_message)){
       echo $success_message;
    }

    ?>
    <form action="insert.php" method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td><input type="submit" name="form1"></td>
            </tr>
        </table>
    </form><br>
    <a href="index.php">Previous page</a>

</body>
</html>