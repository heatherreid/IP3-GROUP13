<?php
session_start();
include_once 'config.php';

require_once 'class.user.php';

$edituser = new USER();

if(!$edituser->is_logged_in())
{
 $user_home->redirect('login.php');
}

if ($_SESSION['userRole'] !== ('Admin'))
{
   $user_home->redirect('dashboard.php');
}

if(isset($_POST['btn-update']))
{
 $id = $_GET['edit_id'];
 $fname = $_POST['first_name'];
 $lname = $_POST['last_name'];
 $email = $_POST['userEmail'];
 $uname = $_POST['uname'];

 if($edituser->update($id,$fname,$lname,$email,$uname))
 {
  $msg = "<div class='alert alert-info'>
    <strong>Success!</strong> Record was updated <a href='manage_users.php'>HOME</a>!
    </div>";
 }
 else
 {
  $msg = "<div class='alert alert-warning'>
    <strong>Error!</strong> Somthing went wrong!
    </div>";
 }
}

if(isset($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 extract($edituser->getID($id));
}

if(isset($_POST['btn-activate']))
{
 $user_stat ="Y";
 $user_status = $user_stat;
 $userStatus = $_POST['user_status'];

 if($edituser->activate_user($id,$userStatus))
 {
  $msg = "<div class='alert alert-info'>
    <strong>Success!</strong> User Activated <a href='manage_users.php'>HOME</a>!
    </div>";
 }
 else
 {
  $msg = "<div class='alert alert-warning'>
    <strong>Error!</strong> Somthing went wrong. Please Try again!
    </div>";
 }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>My Documents</title>


    <!-- Bootstrap -->
    <link href="templates/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="templates/css/sb-admin.css" rel="stylesheet">
    <link href="templates/mydocs.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="templates/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <?php include("templates/header.php"); ?>
    <?php include("templates/sidebar.php"); ?>

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
                      <i class="fa fa-pencil-square-o"></i> Edit User
                  </li>
              </ol>
          </div>
      </div>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
 echo $msg;
}
?>
</div>

<div class="clearfix"></div>

<div class="container">

     <form method='post'>

    <table class='table table-bordered'>

        <tr>
            <td>First Name</td>
            <td><input type='text' name='first_name' style="border-radius:10px;" class='form-control' value="<?php echo $userFirstName; ?>" required></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' name='last_name' style="border-radius:10px;" class='form-control' value="<?php echo $userSurname; ?>" required></td>
        </tr>

        <tr>
            <td>User Name</td>
            <td><input type='text' name='uname' class='form-control' style="border-radius:10px;" value="<?php echo $userName; ?>" required></td>
        </tr>

        <tr>
            <td>Your E-mail ID</td>
            <td><input type='text' name='userEmail' style="border-radius:10px;" class='form-control' value="<?php echo $userEmail; ?>" required></td>
        </tr>
        <tr>
            <td>User Status</td>
            <td><input type='text' name='userStatus' style="border-radius:10px;" class='form-control' value="<?php echo $userStatus; ?>" disabled></td>
        </tr>



    </table>

    <button type="submit" class="btn btn-info" style="border-radius:10px;" name="btn-update">
<span class="fa fa-check"></span>  Update
</button>
<?php if($userStatus == ('N')){
  echo '  <button type="submit" class="btn btn-info" style="border-radius:10px;" name="btn-activate"><i class="fa fa-fw fa-check"></i> Activate</button>';
  }else{
  echo '  <button type="submit" class="btn btn-default" style="border-radius:10px;" name="btn-draft"><i class="fa fa-fw fa-archive"></i> Draft</button>';
} ?>
    <a href="manage_users.php" class="btn btn-success" style="border-radius:10px; background-color:#BF3944; border:#BF3944;"><i class="fa fa-ban"></i> &nbsp;Cancel</a>

</form>


</div>
<?php include 'templates/foot.php';?></div>
<script src="templates/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="templates/js/bootstrap.min.js"></script>
</body>
</html>
