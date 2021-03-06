<?php
session_start();

include_once 'config.php';

require_once 'class.user.php';

$deluser = new USER();

if(!$deluser->is_logged_in())
{
 $deluser->redirect('login.php');
}


if(isset($_POST['btn-delUser1']))
{
 $id = $_GET['delete_id'];
 $deluser->delete_user($id);
 header("Location: deleteUser.php?deleted");
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Delete user</title>


    <!-- Bootstrap -->
    <link href="templates/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="templates/css/sb-admin.css" rel="stylesheet">
    <link href="templates/mydocs.css" rel="stylesheet">

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
                      <i class="fa fa-trash"></i> Delete User
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>Success!</strong> User was deleted...
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>Warning!</strong> Are you sure you want to remove the following User?
  </div>
        <?php
 }
 ?>


  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
      <div class="table-responsive">
         <table class='table table-bordered'>
         <tr>
           <th>UserID</th>
           <th>Username</th>
           <th>Full Name</th>
           <th>Email</th>
           <th>Role</th>
           <th>Status</th>


         </tr>
         <?php

         $database = new Database();
         $db = $database->dbConnection();
         $conn = $db;

         $stmt =  $db->prepare("SELECT * FROM tbl_users WHERE userID=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
               <td><?php echo $row['userID']; ?></td>
               <td><?php echo $row['userName']; ?></td>
               <td><?php echo $row['userFirstName']; ?> <?php echo $row['userSurname']; ?></td>
               <td><?php echo $row['userEmail']; ?></td>
               <td><?php echo $row['userRole']; ?></td>
               <td><?php echo $row['userStatus']?></td>
               <?php $uid = $row['userID']; ?>

             </tr>
             <?php
         }
         ?>
         </table>
       </div>
         <?php
  }
  ?>

  <?php
  if(isset($_GET['delete_id']))
  {


   ?>
      <div class="table-responsive">
         <table class='table table-bordered'>
         <tr>
           <th>docID</th>
           <th>docTitle</th>
           <th>doc Desc</th>
           <th>doc file</th>


         </tr>
         <?php
         $database = new Database();
         $db = $database->dbConnection();
         $conn = $db;

         $stmt =  $db->prepare("SELECT * FROM tbl_documents WHERE userID=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
               <td><?php echo $row['docID']; ?></td>
               <td><?php echo $row['docTitle']; ?></td>
               <td><?php echo $row['docDesc']; ?></td>
               <td><?php echo $row['docFile']; ?></td>
               <?php $uid = $row['userID']; ?>
               <?php $did = $row['docID']; ?>

             </tr>
             <?php
       }
         ?>
         </table>
       </div>
         <?php

  }
  ?>


<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['docID']; ?>" />
    <?php
    if(isset($did))
    {
     ?>
    <button class="btn btn-info" style="border-radius:10px;" type="submit" name="btn-delUser"><i class="fa fa-trash-o"></i> &nbsp; YES</button>
    <?php
   }
   else
   {
    ?>
    <button class="btn btn-info" style="border-radius:10px;" type="submit" name="btn-delUser1"><i class="fa fa-trash-o"></i> &nbsp; YES</button>
       <?php
   }
   ?>
    <a href="manage_users.php" style="border-radius:10px; background-color:#f05133; color:white;" class="btn"><i class="fa fa-undo"></i> &nbsp; NO</a>
    </form>
 <?php
}
else
{
 ?>
    <a href="manage_users.php" class="btn btn-info"><i class="fa fa-arrow-left"></i> &nbsp; Back to Users</a>
    <?php
}
?>
</p>

<?php

if(isset($_POST['btn-delUser']))
{
  try
  {
    $database = new Database();
    $db = $database->dbConnection();
    $conn = $db;

    $query=("DELETE FROM tbl_documents WHERE userID=:id ");
    $stmt=$conn->prepare($query);
    $stmt->execute(array(
    ":id" => $uid));
    deluser($uid);
    return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage();
   return false;
 }
}

function deluser($uid)
{
  try
  {
    $database = new Database();
    $db = $database->dbConnection();
    $conn = $db;

    $query=("DELETE FROM tbl_users WHERE userID=:id ");
    $stmt=$conn->prepare($query);
    $stmt->execute(array(
    ":id" => $uid));
    return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage();
   return false;
 }
}

   ?>

</div>
<?php include 'templates/foot.php';?></div>
</div>
<script src="templates/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="templates/js/bootstrap.min.js"></script>
</body>
</html>
