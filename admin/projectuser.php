<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $userid = $_SESSION['id'];
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    if (isset($_GET['projectid'])) {
      $projectid = $_GET['projectid'];

      if (isset($_POST['adduserproject'])) {
        $userproj = $_POST['user'];
        $sql = "INSERT INTO `tbl_project_employee`
          (`project_id`, `employee_id`, `userid`, `status`)
          VALUES ('$projectid','$userproj','$userid','1')";
        $con->query($sql);
      }


      $sql = "SELECT *
        FROM `tbl_project`
        WHERE `id` = '$projectid'
        AND `status` = '1'";
      $projects = $con->query($sql);
      while ($row = $projects->fetch_assoc()) {
        $title = $row['title'];
        break;
      }

      $sql = "SELECT tbl_project_employee.project_id,tbl_project_employee.employee_id, tbl_user.*
        FROM `tbl_project_employee`
        INNER JOIN tbl_user
        ON tbl_user.id = tbl_project_employee.employee_id
        WHERE tbl_project_employee.project_id = '$projectid'
        AND tbl_project_employee.status = '1'";
      $project_employees = $con->query($sql);

      $sql = "SELECT * FROM tbl_user WHERE status = '1'";

      $users = $con->query($sql);
      $project_users[] = '';



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
    <a href="dashboard.php">Dashboard</a>
    <div class="">
      <h2 class="text-center"><?php echo $title ?></h2>
      <table class="center">
        <tr>
          <td>
            ID
          </td>
          <td>
            User
          </td>
        </tr>

        <?php while ($row = $project_employees->fetch_assoc()) { ?>
          <?php $project_users[] = $row['name']; ?>
        <tr>
          <td>
            <?php echo $row['employee_id'] ?>
          </td>
          <td>
            <?php echo $row['name'] ?>
          </td>
        </tr>
        <?php } ?>
      </table>
      <h3 class="text-center">Add User</h3>
      <form class="" action="" method="post">
        <table class="center">
          <tr>
            <td>
              <select name="user" required>
                <option value="">Select User</option>
                <?php while ($row = $users->fetch_assoc()) { ?>
                  <?php if ( !in_array( $row['name'] ,$project_users ) ) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </td>
            <td>
              <input type="submit" name="adduserproject" value="Add">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
