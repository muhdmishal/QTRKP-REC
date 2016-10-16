<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
      $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    if (isset($_GET['projectid'])) {
      $projectid = $_GET['projectid'];
      if (isset($_POST['addtask'])) {
        $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

        $title = $_POST['title'];
        $description = $_POST['description'];
        //$estimatedtime = strtotime($_POST['estimatedtime']);
      //  echo $estimatedtime;
        //die();
        $startdate = $_POST['startdate'];
        $deliverydate = $_POST['deliverydate'];
        $user = $_POST['user'];
        $userid = $_SESSION['id'];

        $sql = "INSERT INTO `tbl_task`
          (`title`, `description`, `startdate`, `enddate`, `userid`, `status`, `project_id`)
          VALUES ('$title','$description','$startdate','$deliverydate','$userid','1','$projectid')";

        $con->query($sql);
        $last_id = $con->insert_id;

        $sql = "INSERT INTO `tbl_task_employees`
          (`task_id`, `employee_id`, `userid`, `status`, `project_id`)
          VALUES ('$last_id','$user','$userid','1','$projectid')";

        $con->query($sql);


        header('Location: project.php?projectid='.$projectid );
      }
      $sql = "SELECT tbl_project_employee.project_id, tbl_user.*
        FROM `tbl_user`
        INNER JOIN tbl_project_employee
        ON tbl_user.id = tbl_project_employee.employee_id
        WHERE tbl_project_employee.project_id = '$projectid'
        AND tbl_user.status = '1'";

      $users =  $con->query($sql);
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
    <title>QTracker :: Add Task</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="">
      <h2 class="text-center">Add New Task</h2>
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
              Start Date
            </td>
            <td>
              <input type="date" name="startdate" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              End Date
            </td>
            <td>
              <input type="date" name="deliverydate" value="" required>
            </td>
          </tr>
          
          <tr>
            <td>
              Assign User
            </td>
            <td>
              <select class="" name="user" required>
                <option value="">Select User</option>
                  <?php while ($row = $users->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                  <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <input type="submit" name="addtask" value="Add Task">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
