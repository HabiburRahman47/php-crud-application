<?php
 ob_start();
 session_start();
 if($_SESSION['access'] !='okay'){
     header('location: login.php');
 }
?>
<?php
  include('connection.php');
  if(isset($_REQUEST['id'])){
      $id=$_REQUEST['id'];
  }
  else{
      header('location: show.php');
  }
  if(isset($_POST['form2'])){
        
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

            $data=" UPDATE student set name='$name',age=$age,email='$email' where id='$id'";
            mysqli_query($conn,$data);
            $success_message="Data successfully updated";
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
    <title>Update Page</title>
</head>
<body>
    <h2>Update Your information</h2>
    <?php
     if(isset($error_message)){
       echo $error_message;
     }
     if(isset($success_message)){
       echo $success_message;
    }
      $student="select * from student where id='$id'";
      $result=mysqli_query($conn,$student);
      while($rows=mysqli_fetch_array($result)){
          $oldName=$rows['name'];
          $oldAge=$rows['age'];
          $oldEmail=$rows['email'];

      }
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo $oldName ?>"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo $oldAge ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $oldEmail ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="update" name="form2"></td>
            </tr>
        </table>
        <!-- <input type="hidden" name="hdn" value="<?php echo $id ?>"> -->
    </form><br>
    <a href="show.php">previous page</a>
</body>
</html>