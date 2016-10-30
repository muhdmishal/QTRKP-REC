<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {

    if (isset($_POST['addproject'])) {
      $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

      $title = $_POST['title'];
      $description = $_POST['description'];
      $client_name = $_POST['client_name'];
      $startdate = $_POST['startdate'];
      $deliverydate = $_POST['deliverydate'];
      $userid = $_SESSION['id'];

      $sql = "INSERT INTO `tbl_project`
        (`title`, `description`, `client_name`, `startdate`, `deliverydate`, `userid`, `status`)
        VALUES ('$title','$description','$client_name','$startdate','$deliverydate','$userid','1')";

      $con->query($sql);
      $last_id = $con->insert_id;

      header('Location: projectuser.php?projectid='.$last_id);
    }

  } else {
    header('Location: ./');
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>QTracker :: Add Project</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <a href="dashboard.php">Dashboard</a>
    <div class="">
      <h2 class="text-center">Add New Project</h2>
      <form class="" action="" method="post">
        <table class="center">
          <tr>
            <td>
              Title
            </td>
            <td>
              <input type="text" name="title" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Description
            </td>
            <td>
              <textarea name="description" rows="8" cols="40" required></textarea>
            </td>
          </tr>
          <tr>
            <td>
              Client Name
            </td>
            <td>
              <input type="text" name="client_name" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Start Name
            </td>
            <td>
              <input type="date" name="startdate" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Delivery Date
            </td>
            <td>
              <input type="date" name="deliverydate" value="" required>
            </td>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <input type="submit" name="addproject" value="Add Project">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
