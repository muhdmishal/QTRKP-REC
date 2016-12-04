<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $userid = $_SESSION['id'];
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    if (isset($_GET['projectid'])) {
      $projectid = $_GET['projectid'];


      $sql = "SELECT *
        FROM `tbl_project`
        WHERE `id` = '$projectid'
        AND `status` = '1'";
      $projects = $con->query($sql);


      $sql = "SELECT tbl_project_employee.project_id,tbl_project_employee.employee_id, tbl_user.*
        FROM `tbl_project_employee`
        INNER JOIN tbl_user
        ON tbl_user.id = tbl_project_employee.employee_id
        WHERE tbl_project_employee.project_id = '$projectid'
        AND tbl_project_employee.status = '1'";
      $project_employees = $con->query($sql);

      $sql = "SELECT *
        FROM `tbl_task`
        WHERE `project_id` = '$projectid'
        AND `status` = '1'";
      $tasks = $con->query($sql);




    }
    else {
      header('Location: dashboard.php');
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

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

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
                    <h1 class="page-header">Project</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>Projects</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>Tasks</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Time</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <?php while ($project = $projects->fetch_assoc()) { ?>
                        <div class="panel-heading">
                            Project : <?php echo  $project['title'] ?> <a class="pull-right btn btn-success" href="addtask.php?projectid=<?php echo  $project['id'] ?>">Add Task</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <h2 class="text-center"></h2>
                          <table class="table table-striped table-bordered table-hover">
                            <tr>
                              <td>
                                Description
                              </td>
                              <td>
                                <?php echo $project['description'] ?>
                              </td>
                            </tr>

                            <tr>
                              <td>
                                Client Name
                              </td>
                              <td>
                                <?php echo $project['client_name'] ?>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Start Date
                              </td>
                              <td>
                                <?php echo $project['startdate'] ?>
                              </td>
                            </tr>

                            <tr>
                              <td>
                                Delivery Date
                              </td>
                              <td>
                                <?php echo $project['deliverydate'] ?>
                              </td>
                            </tr>

                            <tr>
                              <td>
                                Users assigned
                              </td>
                              <td>
                                <?php while ($row = $project_employees->fetch_assoc()) { ?>

                                    <?php echo $row['name'] ?><br>

                                <?php } ?>
                              </td>
                            </tr>
                          </table>


                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Browser Time</th>
                                        <th>Time Spend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php while ($row = $tasks->fetch_assoc()) { ?>
                                  <tr>
                                    <td>
                                      <?php echo $row['id'] ?>
                                    </td>
                                    <td>
                                      <?php echo $row['title'] ?>
                                    </td>
                                    <td>
                                      <?php echo $row['description'] ?>
                                    </td>
                                    <td>
                                      <?php
                                        $tasid = $row['id'];
                                        $sql = "SELECT SUM(browsertime) AS browserspend
                                          FROM tbl_track
                                          WHERE task_id = '$tasid'
                                          AND status = '1'";
                                        $time = $con->query($sql);
                                        while ($totime = $time->fetch_assoc()) {
                                          echo gmdate("H:i:s", $totime['browserspend']);
                                        }
                                       ?>
                                    </td>
                                    <td>
                                      <?php
                                        $tasid = $row['id'];
                                        $sql = "SELECT SUM(totaltime) AS totaltimespend
                                          FROM tbl_track
                                          WHERE task_id = '$tasid'
                                          AND status = '1'";
                                        $time = $con->query($sql);
                                        while ($totime = $time->fetch_assoc()) {
                                          echo gmdate("H:i:s", $totime['totaltimespend']);
                                        }
                                       ?>
                                    </td>
                                  </tr>
                                  <?php } ?>

                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                        </div>
                        <?php } ?>
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

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
