<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    if (isset($_POST['adduser'])) {


      $name = $_POST['name'];
      $role = $_POST['role'];
      $joiningdate = $_POST['joiningdate'];
      $emailid = $_POST['emailid'];
      $password = $_POST['password'];
      $userid = $_SESSION['id'];

      $sql = "INSERT INTO `tbl_user`
        (`name`, `role`, `joiningdate`, `status`, `userid`, `emailid`, `password`)
        VALUES ('$name', '$role', '$joiningdate', '1', '$userid', '$emailid', '$password')";

      $con->query($sql);

      header('Location: dashboard.php');
    }

    $sql = "SELECT * FROM tbl_role";

    $roles = $con->query($sql);

  } else {
    header('Location: ./');
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>QTracker :: Add User</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <a href="dashboard.php">Dashboard</a>
    <div class="">
      <h2 class="text-center">Add New Employee</h2>
      <form class="" action="" method="post">
        <table class="center">
          <tr>
            <td>
              Name
            </td>
            <td>
              <input type="text" name="name" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Role
            </td>
            <td>
              <select class="" name="role" required>
                <option value="">Select Role</option>
                <?php while ($row = $roles->fetch_assoc()) { ?>
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['role'] ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              Email
            </td>
            <td>
              <input type="email" name="emailid" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Password
            </td>
            <td>
              <input type="text" name="password" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              Joining Date
            </td>
            <td>
              <input type="date" name="joiningdate" value="" required>
            </td>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <input type="submit" name="adduser" value="Add Employee">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
