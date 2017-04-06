<?php
session_start();
require_once 'class.user.php';
include_once 'config.php';
$user_home = new USER();



if(!$user_home->is_logged_in())
{
 $user_home->redirect('login.php');
}



if(isset($_POST['btn-send']))
{
 $msgTitle = trim($_POST['txttitle']);
 $msgEntry = trim($_POST['txtentry']);
 $userID = trim($_SESSION['userSession']);


  if($user_home->send_message($msgTitle,$msgEntry,$userID))
  {
    $user_home->redirect('send_message.php?success');

  }
  else
  {
    $user_home->redirect('send_message.php?error');

 }
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Send Documents</title>
    <head>
      <meta charset="utf-8">
      <title>dashboard</title>
      <link href="templates/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="templates/css/sb-admin.css" rel="stylesheet">
      <link href="templates/homepagejoin.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="templates/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <?php  if ($_SESSION['userRole'] == ('Admin'))
        {
          include 'templates/headadmin.php';
        }
    else
    {
      include 'templates/header.php';
    }
        ?>

        <?php include 'templates/sidebar.php';?>
    </head>
  <body>
  <div id="wrapper">
    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-envelope"></i> Send Documents
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
          <div class="form-group">
          <?php if(isset($msg)) echo $msg;  ?>
            <form class="form-signin" method="post">
              <input type="text" class="input-block-level" style="width:100%; border-radius:10px; padding:10px; margin-bottom:10px;" placeholder="First Name" name="txttitle" required />
              <input type="text" class="input-block-level" style="width:100%; border-radius:10px; padding:10px; margin-bottom:10px;" placeholder="Last Name" name="txtentry" required />


              <button class="btn btn-info" style="border-radius:10px;" type="submit" name="btn-sned">Send</button>
            </form>
  </div>
</div>
<?php include 'templates/foot.php';?>
</div>



    <!-- jQuery -->
    <script src="templates/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="templates/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="templates/js/plugins/morris/raphael.min.js"></script>
    <script src="templates/js/plugins/morris/morris.min.js"></script>
    <script src="templates/js/plugins/morris/morris-data.js"></script>
  </body>
</html>
