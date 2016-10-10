<?php
  if (isset($_POST['userid']) ) {

    $userid = $_POST['userid'];

    $jsonArray = array( );
    include 'DB.php';
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT tbl_project_employee.project_id, tbl_project.*
      FROM `tbl_project_employee`
      INNER JOIN tbl_project
      ON tbl_project.id = tbl_project_employee.project_id
      WHERE tbl_project_employee.employee_id = '$userid'
      AND tbl_project_employee.status = '1'";

    $result = $con->query($sql);

    $jsonArray['num_projects'] = $result->num_rows;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $jsonArray['projects'][] = array(
          'projectID' => $row['id'],
          'projectTitle' => $row['title'],
        );
      }
    }

    echo json_encode($jsonArray);
    $con->close();
  }

?>
