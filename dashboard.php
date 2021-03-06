<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();



if(!$user_home->is_logged_in())
{
 $user_home->redirect('login.php');
}

if ($_SESSION['userRole'] == ('Admin'))
{
$user_home->redirect('dashboardAdmin.php');
}



$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//testing login...


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="templates/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="templates/css/sb-admin.css" rel="stylesheet">
    <link href="templates/homepagejoin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="templates/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php  if ($_SESSION['userRole'] == ('Admin'))
      {
        include 'templates/headadmin.php';
      }
  else
  {
    include 'templates/header.php';
  }
      ?>
      <?php if ($_SESSION['userRole'] == ('Distributee'))
        {
          include 'templates/sidebar-dis.php';
        }
        else {
          include 'templates/sidebar.php';
        }
        ?>
  </head>

  <body>
    <div id="wrapper">
    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <font="face:Roboto">
                    Welcome <small> <?php echo $_SESSION['userName']; ?></small>
                </h1> </font>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-home"></i> Home
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="container-big">
        <div class="container-back">
          <!-- Image Header -->
                  <div class="row">
                      <div class="col-lg-12">
                          <img class="img-responsive" src="img/back.jpg" width="1200" height="300" alt="">
                      </div>
                  </div>
        </div>

        <div class="marketing">

                             <div class="col-md-3 col-sm-6">
                                 <div class="panel panel-default text-center">
                                     <div class="panel-heading">
                                         <span class="fa-stack fa-5x">
                                               <i class="fa fa-circle fa-stack-2x text-primary" style="color:#BF3944"></i>
                                               <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                                         </span>
                                     </div>
                                     <div class="panel-body">
                                         <h4>Create</h4>
                                         <p>Create and personalise your own documents. Its super quick and easy to do.</p>
                                         <a href="#info" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Easily create your documents by selecting 'Create Document' from the sidebar. From there you will be able to type up your document." style="background-color:#BF3944; border:1pt solid #BF3944; border-radius: 10px" class="btn btn-primary">Learn More</a>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="panel panel-default text-center">
                                     <div class="panel-heading">
                                         <span class="fa-stack fa-5x">
                                               <i class="fa fa-circle fa-stack-2x text-primary" style="color:#BF3944"></i>
                                               <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
                                         </span>
                                     </div>
                                     <div class="panel-body">
                                         <h4>Share</h4>
                                         <p>Once you are happy with your document, share it with your friends and colleagues.</p>
                                         <a href="#info" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Share your documents with any other user by selecting 'Send Documents' from the sidebar. You will then be able to send your chosen documents to whoever you want." style="background-color:#BF3944; border:1pt solid #BF3944; border-radius: 10px" class="btn btn-primary">Learn More</a>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="panel panel-default text-center">
                                     <div class="panel-heading">
                                         <span class="fa-stack fa-5x">
                                               <i class="fa fa-circle fa-stack-2x text-primary" style="color:#BF3944"></i>
                                               <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                         </span>
                                     </div>
                                     <div class="panel-body">
                                         <h4>View</h4>
                                         <p>View all the documents that you have created easily and make any changes.</p>
                                         <a href="#info" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Select 'My Documents' from the sidebar and from there you will be able to download." style="background-color:#BF3944; border:1pt solid #BF3944; border-radius: 10px" class="btn btn-primary">Learn More</a>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-sm-6">
                                 <div class="panel panel-default text-center">
                                     <div class="panel-heading">
                                         <span class="fa-stack fa-5x">
                                               <i class="fa fa-circle fa-stack-2x text-primary" style="color:#BF3944"></i>
                                               <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                         </span>
                                     </div>
                                     <div class="panel-body">
                                         <h4>Delete</h4>
                                         <p>Delete any documents that you are not happy with easily and quickly.</p>

                                         <a href="#info" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Not happy with your document? Easily delete it by selecting 'My Documents from the sidebar.'" style="background-color:#BF3944; border:1pt solid #BF3944; border-radius: 10px" class="btn btn-primary">Learn More</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                       </div>


  </div>

  <br><br><br>

</div>
</div>
<?php include 'templates/footer.php';?>


    <!-- jQuery -->
    <script src="templates/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="templates/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>

  </body>
</html>
