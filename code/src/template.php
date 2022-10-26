<?php
  session_start();
  
  if(!isset($_SESSION["login"]) || $_SESSION["login"] == 0){
    header("Location: /src/pages/account/");
    die();
  } 
  else {
    if($_SESSION["functie"] != "admin" && $_SESSION["functie"] != "afdelingHoofd"){
      header("Location: /src/pages/account/noRights.php");
      die();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Waaiburg</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="/src/css/main.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="../../../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WB</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Waaiburg</b></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <span class="user-image hidden-sm hidden-md hidden-lg hidden-xl" style="font-size: 25px !important; vertical-align: bottom !important;"><i class="fa fa-user"></i></span> 
              <!--<img src="/dist/img/avatar5.png" class="user-image" alt="User Image"> -->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs" >
                <?php 
                  echo $_SESSION["voornaam"] ;
                  echo " ";
                  echo $_SESSION["achternaam"];
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="height: 65px">
                <p>
                  <?php 
                    echo $_SESSION["voornaam"] ;
                    echo " ";
                    echo $_SESSION["achternaam"];
                    echo " - ";
                    if($_SESSION["functie"] == "afdelingHoofd") {
                      echo "Afdeling Hoofd";
                    } else if ($_SESSION["functie"] == "admin"){
                      echo "Admin";
                    }
                  ?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
              <div class="pull-left">
                  <a href="/src/pages/account/editAccount.php" class="btn btn-primary " style="background-color:#3c8dbc; color:#fff">Bewerk account</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-danger " style="background-color:#dd4b39; color:#fff" onClick="UitLoggen()">Uitloggen</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Gegevens</li>
        <!-- Optionally, you can add icons to the links -->
        <?php 
          if($_SESSION["functie"] == "admin") {
            echo'<span id="isAdmin" data-isadmin="1" style="display:none;"></span>';
          } else {
            echo'<span id="isAdmin" data-isadmin="0" style="display:none;"></span>';
          }
        ?>
        <li class="rechten" data-rechten="Afdelinghoofd">
          <a href="/src/pages/clienten/"><i class="fa fa-users"></i> <span>Clienten</span>
          </a>
        </li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/begeleiders/"><i class="fa fa-address-card"></i> <span>Begeleiders</span>
          </a>
        </li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/afdelingen/"><i class="fa fa-building"></i> <span>Afdelingen</span>
          </a>
        </li>
        <li class="header">Informatie</li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/infoSegmenten/index.php?type='volwassenen'"><i class="fa fa-user"></i> <span>Volwassenen</span>
          </a>
        </li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/infoSegmenten/index.php?type='jongeren'"><i class="fa fa-child"></i> <span>Jongeren</span>
          </a>
        </li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/nieuwtjes/"><i class="fa fa-info"></i> <span>Nieuwtjes</span>
          </a>
        </li>
        <li class="header">Admin</li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/mails/index.php"><i class="fa fa-at"></i> <span>Mails</span>
          </a>
        </li>
        <li class="rechten" data-rechten="admin">
          <a href="/src/pages/tevredenheidsMeting/index.php"><i class="fa fa-wpforms"></i> <span>Tevredenheids Meting</span>
          </a>
        </li>
        
      </ul>
      
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Welcome to Admin Dashboard</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <?php 
        echo $content; 
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="https://codinginfinite.com">Coding Infinite</a>.</strong> All rights reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script> 
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- CKEditor -->
<script src="/bower_components/ckeditor/ckeditor.js"></script>
<script src="/bower_components/ckeditor/adapters/jquery.js"></script>

<!-- Custom -->
<script src="/src/js/main.js"></script>
<script>
  $(document).ready(function(){

    //rechten
    var isAdmin = $('#isAdmin').attr("data-isadmin")

    var rechtenElement;
    $('.rechten').each(function() {
      rechtenElement = $(this).attr("data-rechten")
      if(isAdmin == 0 && rechtenElement == "admin") {
        $(this).attr("style","display:none;");
      }
    })

    //ckeditor 
    $( 'textarea.editor' ).ckeditor({});
    $( 'textarea.editorSmall' ).ckeditor({
      "height": 100, 
      "toolbar": [[ 'Bold','Italic','Underline','Strike','-','Undo','Redo','-', 'Source']],
      "wordcount":{
        showParagraphs: false,
        showWordCount: false,
        showCharCount: true,
        countHTML:true,
        maxCharCount:350
      }
    });
    
  }); 

  function UitLoggen(){
    $.ajax({
        type: "POST",
        url: "/api/auth/logout.php",
        success: function(data) {
          window.location.href = '/src/pages/account/';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  }
</script>
</body>
</html>