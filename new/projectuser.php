<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $userid = $_SESSION['id'];
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
    if (isset($_GET['projectid'])) {
      $projectid = $_GET['projectid'];

      if (isset($_POST['adduserproject'])) {
        $userproj = $_POST['user'];
        $sql = "INSERT INTO `tbl_project_employee`
          (`project_id`, `employee_id`, `userid`, `status`)
          VALUES ('$projectid','$userproj','$userid','1')";
        $con->query($sql);
      }


      $sql = "SELECT *
        FROM `tbl_project`
        WHERE `id` = '$projectid'
        AND `status` = '1'";
      $projects = $con->query($sql);
      while ($row = $projects->fetch_assoc()) {
        $title = $row['title'];
        break;
      }

      $sql = "SELECT tbl_project_employee.project_id,tbl_project_employee.employee_id, tbl_user.*
        FROM `tbl_project_employee`
        INNER JOIN tbl_user
        ON tbl_user.id = tbl_project_employee.employee_id
        WHERE tbl_project_employee.project_id = '$projectid'
        AND tbl_project_employee.status = '1'";
      $project_employees = $con->query($sql);

      $sql = "SELECT * FROM tbl_user WHERE status = '1'";

      $users = $con->query($sql);
      $project_users[] = '';



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
                    <h1 class="page-header">Project: <?php echo $title ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Team
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                  <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <td>
                                          ID
                                        </td>
                                        <td>
                                          User
                                        </td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $project_employees->fetch_assoc()) { ?>
                                      <?php $project_users[] = $row['name']; ?>
                                    <tr>
                                      <td>
                                        <?php echo $row['employee_id'] ?>
                                      </td>
                                      <td>
                                        <?php echo $row['name'] ?>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                  </table>
                                    <form role="form" action="" method="post">

                                        <div class="form-group">
                                            <label>Add user</label>
                                            <select class="form-control" name="user" required>
                                              <option value="">Select User</option>
                                              <?php while ($row = $users->fetch_assoc()) { ?>
                                                <?php if ( !in_array( $row['name'] ,$project_users ) ) { ?>
                                                  <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                              <?php } ?>
                                            </select>
                                        </div>


                                        <input type="submit" class="btn btn-warning" name="adduserproject" value="Add">
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
