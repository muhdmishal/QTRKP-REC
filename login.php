<?php
  if (isset($_POST['username']) && isset($_POST['password']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $jsonArray = array( );
    include 'DB.php';
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM `tbl_user` WHERE name = '$username' AND password = '$password' AND status = '1'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $jsonArray = array(
          'loginStatus' => TRUE,
          'userID' => $row['id'],
          'name' => $row['name'],
        );
      }
    } else {
      $jsonArray = array(
        'loginStatus' => FALSE,
      );
    }
    echo json_encode($jsonArray);
    $con->close();
  }

?>
