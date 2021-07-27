<?php
  include('connection.php');
  if(isset($_REQUEST['id']))
  {
      $id=$_REQUEST['id'];
      $delete="DELETE FROM student WHERE id='$id'";
      mysqli_query($conn,$delete);
      header('location: show.php');
  }
  else{
      header('location: show.php');
  }
?>