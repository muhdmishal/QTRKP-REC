<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $userid = $_SESSION['id'];
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    if (isset($_GET['projectid'])) {
      $projectid = $_GET['projectid'];


      $sql = "SELECT *
        FROM `tbl_project`
        WHERE `id` = '$projectid'
        AND `status` = '1'";
      $projects = $con->query($sql);


      $sql = "SELECT tbl_project_employee.project_id,tbl_project_employee.employee_id, tbl_user.*
        FROM `tbl_project_employee`
        INNER JOIN tbl_user
        ON tbl_user.id = tbl_project_employee.employee_id
        WHERE tbl_project_employee.project_id = '$projectid'
        AND tbl_project_employee.status = '1'";
      $project_employees = $con->query($sql);

      $sql = "SELECT tbl_task_employees.employee_id,tbl_user.name, tbl_task.*
        FROM `tbl_task`
        INNER JOIN tbl_task_employees
        ON tbl_task.id = tbl_task_employees.task_id
        INNER JOIN tbl_user
        ON tbl_user.id = tbl_task_employees.employee_id
        WHERE tbl_task.project_id = '$projectid'
        AND tbl_task.status = '1'";
      $tasks = $con->query($sql);




    }
    else {
      header('Location: dashboard.php');
    }


  } else {
    header('Location: ./');
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add User to Project</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="">
      <?php while ($project = $projects->fetch_assoc()) { ?>
      <h2 class="text-center">Project : <?php echo  $project['title'] ?></h2>
      <table class="center">
        <tr>
          <td>
            Description
          </td>
          <td>
            <?php echo $project['description'] ?>
          </td>
        </tr>

        <tr>
          <td>
            Client Name
          </td>
          <td>
            <?php echo $project['client_name'] ?>
          </td>
        </tr>
        <tr>
          <td>
            Start Date
          </td>
          <td>
            <?php echo $project['startdate'] ?>
          </td>
        </tr>

        <tr>
          <td>
            Delivery Date
          </td>
          <td>
            <?php echo $project['deliverydate'] ?>
          </td>
        </tr>

        <tr>
          <td>
            Users assigned
          </td>
          <td>
            <?php while ($row = $project_employees->fetch_assoc()) { ?>

                <?php echo $row['name'] ?><br>

            <?php } ?>
          </td>
        </tr>
      </table>
      <?php } ?>

    </div>
    <div class="">
      <h3 class="text-center">Tasks</h3>
      <table style="width:100%" >
        <tr>
          <td>
            ID
          </td>
          <td>
            Title
          </td>
          <td>
            Description
          </td>
          <td>
            Time Spend
          </td>
          <td>
            Estimated Time
          </td>
          <td>
            User Assigned
          </td>
        </tr>
        <?php while ($row = $tasks->fetch_assoc()) { ?>
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
            <?php
              $tasid = $row['id'];
              $sql = "SELECT SUM(totaltime) AS totaltimespend
                FROM tbl_track
                WHERE task_id = '$tasid'
                AND status = '1'";
              $time = $con->query($sql);
              while ($totime = $time->fetch_assoc()) {
                echo gmdate("H:i:s", $totime['totaltimespend']);
              }
             ?>
          </td>
          <td>
            <?php echo $row['estimatedtime'] ?>
          </td>
          <td>
            <?php echo $row['name'] ?>
          </td>
        </tr>
        <?php } ?>

      </table>
      <a href="addtask.php?projectid=<?php echo $projectid ?>">Add Task</a>
    </div>
  </body>
</html>
