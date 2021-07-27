<?php
 ob_start();
 session_start();
 if($_SESSION['access'] !='okay'){
     header('location: login.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View all data</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 15px;
        }
    </style>
</head>
<body>
  <h2>View all Data</h2>
    <table border="1" cellpadding="2" cellspacing="2">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
          include('connection.php');
          $data=" select * from student ";
          $result=mysqli_query($conn,$data);
        //$rows=mysqli_fetch_array($result);
          $i=0;
         while($rows=mysqli_fetch_array($result))
          {
              $i++;
            ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $rows['name'] ?></td>
              <td><?php echo $rows['age'] ?></td>
              <td><?php echo $rows['email'] ?></td>
              <td><a href="edit.php?id=<?php echo $rows['id'] ?>">Edit</a>&nbsp;
              <a onclick="return confirm_function()" href="delete.php?id=<?php echo $rows['id'] ?>">Delete</a></td>
          </tr>

            <?php
          }
        ?>
    </table>
    <a href="index.php">Previous page</a>
    <script>
        function confirm_function()
        {
            return confirm('Do you want to delete this?');
        }
    </script>
</body>
</html>