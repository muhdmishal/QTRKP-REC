<?php

  include 'DB.php';

  if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['projectid']) && isset($_POST['userid']) ) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $projectid = $_POST['projectid'];
    $userid = $_POST['userid'];
    $jsonArray = array( );

    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);


    $sql = "INSERT INTO `tbl_task`
      (`title`, `description`, `userid`, `status`, `project_id`)
      VALUES ('$title','$description','$userid','1','$projectid')";

    $con->query($sql);
    $last_id = $con->insert_id;

    $sql = "INSERT INTO `tbl_task_employees`
      (`task_id`, `employee_id`, `userid`, `status`, `project_id`)
      VALUES ('$last_id','$userid','$userid','1','$projectid')";

    $con->query($sql);

  }

?>
