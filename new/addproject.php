<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {

    if (isset($_POST['addproject'])) {
      $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

      $title = $_POST['title'];
      $description = $_POST['description'];
      $client_name = $_POST['client_name'];
      $startdate = $_POST['startdate'];
      $deliverydate = $_POST['deliverydate'];
      $userid = $_SESSION['id'];

      $sql = "INSERT INTO `tbl_project`
        (`title`, `description`, `client_name`, `startdate`, `deliverydate`, `userid`, `status`)
        VALUES ('$title','$description','$client_name','$startdate','$deliverydate','$userid','1')";

      $con->query($sql);
      $last_id = $con->insert_id;

      header('Location: projectuser.php?projectid='.$last_id);
    }

  } else {
    header('Location: ./');
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rector Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php require 'header.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Project</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Project Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" type="text" name="title" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="8" cols="40" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <input class="form-control" type="text" name="client_name" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input class="form-control" type="date" name="startdate" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Delivery Date</label>
                                            <input class="form-control" type="date" name="deliverydate" value="" required>
                                        </div>

                                        <input type="submit" class="btn btn-warning" name="addproject" value="Add Project">
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
