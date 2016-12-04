<?php

  include '../DB.php';
  session_start();
  $error = '';

  if ($_SESSION['status'] ) {
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);

    if (isset($_POST['adduser'])) {


      $name = $_POST['name'];
      $role = $_POST['role'];
      $joiningdate = $_POST['joiningdate'];
      $emailid = $_POST['emailid'];
      $phone = $_POST['phone'];
      $password = $_POST['password'];
      $userid = $_SESSION['id'];

      $sql = "INSERT INTO `tbl_user`
        (`name`, `role`, `joiningdate`, `status`, `userid`, `emailid`, `phone`, `password`)
        VALUES ('$name', '$role', '$joiningdate', '1', '$userid', '$emailid', '$phone', '$password')";

      $con->query($sql);

      header('Location: users.php');
    }

    $sql = "SELECT * FROM tbl_role";

    $roles = $con->query($sql);

  } else {
    header('Location: ./login.php');
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
                    <h1 class="page-header">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Deails
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Text Input with Placeholder</label>
                                            <select class="form-control" name="role" required>
                                              <option value="">Select Role</option>
                                              <?php while ($row = $roles->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['role'] ?></option>
                                              <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="emailid" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" type="test" name="phone" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="text" name="password" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input class="form-control" type="date" name="joiningdate" value="" required>
                                        </div>

                                        <input type="submit" class="btn btn-warning" name="adduser" value="Add Employee">
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
