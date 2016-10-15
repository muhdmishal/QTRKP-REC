<?php

  $jsonArray = array( );
  if (isset($_POST['timeSpend']) && isset($_POST['taskID']) && isset($_POST['projectID']) && isset($_POST['userID'])) {

    $timeSpend = $_POST['timeSpend'];
    $taskID = $_POST['taskID'];
    $projectID = $_POST['projectID'];
    $userID = $_POST['userID'];
    $startTime = strtotime($_POST['startTime']);
    $endTime = strtotime($_POST['endTime']);


    include 'DB.php';
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "INSERT INTO `tbl_track`
    (`starttime`, `endtime`, `totaltime`, `status`, `employee_id`, `project_id`, `task_id`)
    VALUES ('$startTime', '$endTime', '$timeSpend', '1', '$userID', '$projectID', '$taskID')";

    $result = $con->query($sql);

    $jsonArray['trackStatus'] = TRUE;
    $con->close();
  }
  else {
    $jsonArray['trackStatus'] = FALSE;
  }


  echo json_encode($jsonArray);

?>
