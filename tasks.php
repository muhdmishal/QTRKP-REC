<?php
  if (isset($_POST['userid']) && isset($_POST['projectid'])) {

    $userid = $_POST['userid'];
    $projectid = $_POST['projectid'];

    $jsonArray = array( );
    include 'DB.php';
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT tbl_task_employees.task_id, tbl_task.*
      FROM `tbl_task_employees`
      INNER JOIN tbl_task
      ON tbl_task.id = tbl_task_employees.task_id
      WHERE tbl_task_employees.employee_id = '$userid'
      AND tbl_task_employees.project_id = '$projectid'
      AND tbl_task_employees.status = '1'";

    $result = $con->query($sql);

    $jsonArray['num_tasks'] = $result->num_rows;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $jsonArray['tasks'][] = array(
          'taskID' => $row['id'],
          'taskTitle' => $row['title'],
        );
      }
    }

    echo json_encode($jsonArray);
    $con->close();
  }

?>
