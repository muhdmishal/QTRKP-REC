<?php

  include '../DB.php';
  session_start();
  $error = '';

  if (isset($_POST['name']) && isset($_POST['password'])) {

    $name = $_POST['name'];
    $password = $_POST['password'];

    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    $sql = "SELECT *
      FROM `tbl_user`
      WHERE name = '$name'
      AND password = '$password'
      AND role = '1'
      AND status = '1'";
      
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $_SESSION['status'] = TRUE;
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header('Location: dashboard.php');
      }
    }
    else {
      $error = 'Username and Password doesnot match.';
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>QTracker Login</title>
  </head>
  <body>
    <div>
      <form class="" action="" method="post">
        <table  class="center">
          <tr>
            <td>
              QTracker Login
            </td>

          </tr>
          <tr>
            <td>
              <?php echo $error; ?>
            </td>

          </tr>
          <tr>
            <td>Username</td>
            <td><input type="text" name="name" value=""></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password" value=""></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="login" value="Login"></td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
