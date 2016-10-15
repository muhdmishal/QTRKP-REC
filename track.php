<?php

  $jsonArray = array( );
  if (isset($_REQUEST['timeSpend']) && isset($_REQUEST['taskID']) && isset($_REQUEST['projectID']) && isset($_REQUEST['userID'])) {

    $timeSpend = $_REQUEST['timeSpend'];
    $taskID = $_REQUEST['taskID'];
    $projectID = $_REQUEST['projectID'];
    $userID = $_REQUEST['userID'];
    $startTime = strtotime($_REQUEST['startTime']);
    $endTime = strtotime($_REQUEST['endTime']);


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
