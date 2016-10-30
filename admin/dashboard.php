<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    $sql = "SELECT *
      FROM `tbl_project`
      WHERE status = '1'";

    $projects = $con->query($sql);

    $sql = "SELECT *
      FROM `tbl_user`
      WHERE status = '1'";

    $users = $con->query($sql);


  } else {
    header('Location: ./');
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>QTracker Dashboard</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="">
      <h3>Projects</h3>
      <table style="width:100%">
        <tr>
          <td>
            ID
          </td>
          <td>
            Project
          </td>
          <td>
            Description
          </td>
          <td>
            Client
          </td>
          <td>
            Time Spend on Browser
          </td>
          <td>
            Total Time Spend
          </td>
          <td>
            Start Date
          </td>
          <td>
            Completion Date
          </td>
        </tr>
        <?php while ($row = $projects->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php echo $row['id'] ?>
          </td>
          <td>
            <?php echo $row['title'] ?>
          </td>
          <td>
            <?php echo $row['description'] ?>
          </td>
          <td>
            <?php echo $row['client_name'] ?>
          </td>
          <td>
            <?php
              $proid = $row['id'];
              $sql = "SELECT SUM(browsertime) AS browertimespend
                FROM tbl_track
                WHERE project_id = '$proid'
                AND status = '1'";
              $time = $con->query($sql);
              while ($totime = $time->fetch_assoc()) {
                echo gmdate("H:i:s", $totime['browertimespend']);
              }
             ?>
          </td>
          <td>
            <?php
              $proid = $row['id'];
              $sql = "SELECT SUM(totaltime) AS totaltimespend
                FROM tbl_track
                WHERE project_id = '$proid'
                AND status = '1'";
              $time = $con->query($sql);
              while ($totime = $time->fetch_assoc()) {
                echo gmdate("H:i:s", $totime['totaltimespend']);
              }
             ?>
          </td>
          <td>
            <?php echo $row['startdate'] ?>
          </td>
          <td>
            <?php echo $row['deliverydate'] ?>
          </td>
          <td>
            <a href="projectuser.php?projectid=<?php echo $row['id'] ?>">Users</a>
          </td>
          <td>
            <a href="project.php?projectid=<?php echo $row['id'] ?>">View Project</a>
          </td>
        </tr>
        <?php } ?>
      </table>
      <a href="addproject.php">Add new Project</a>
    </div>
    <div class="">
      <h3>Users</h3>
      <table>
        <tr>
          <td>
            ID
          </td>
          <td>
            Name
          </td>

        </tr>

        <?php while ($row = $users->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php echo $row['id'] ?>
          </td>
          <td>
            <?php echo $row['name'] ?>
          </td>

        </tr>
        <?php } ?>
      </table>
      <a href="adduser.php">Add new User</a>
    </div>
  </body>
</html>
