<?php
  session_start();
  
  if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1){
      header("Location: /");
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
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../../css/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p><b>Waai</b>Burg</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login bij de waaiburg webapp</p>

    <form role="form" name="form">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <p class="invalid-input" id="emailInput"></p>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord">
        <span class="glyphicon glyphicon-eye-close form-control-feedback"  id="eye" style="pointer-events:all;"></span>
        <p class="invalid-input" id="wachtwoordInput"></p>
      </div>

      <div class="" style="margin-bottom: 5px;">
        <button type="button" onClick="Inloggen()" class="btn btn-primary btn-block btn-flat">Inloggen</button>
      </div> 
    </form>
    <div class="overlay" >
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <a onClick="WachtwoordVergeten()" id="wachtwoordVergeten">Wachtwoord vergeten</a><br>
  </div>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $(".overlay").css("display",'none')

    $("#wachtwoordVergeten").hover(function(){
      $(this).css("cursor","pointer");
    });

    //wachtwoort visible/invisible maken
    $(".glyphicon").hover(function(){
        $(this).css("cursor","pointer");
    });
    $("#eye").click(function(){
      if($(this).hasClass("glyphicon-eye-close")) {
        $(this).removeClass("glyphicon-eye-close");
        $(this).addClass("glyphicon-eye-open");
        $("#wachtwoord").attr("type", "text");
      } 
      else if($(this).hasClass("glyphicon-eye-open")) {
        $(this).removeClass("glyphicon-eye-open");
        $(this).addClass("glyphicon-eye-close");
        $("#wachtwoord").attr("type", "password");
      } 
    });
  });

  $(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
      Inloggen()
    }
  });

  function Inloggen(){
    if(validateForm()){
      $.ajax({
        type: "POST",
        url: '/api/auth/login.php',
        dataType: 'json',
        data: {
            email: $("#email").val(),
            wachtwoord: $("#wachtwoord").val(),     
        },
        success: function (result) {
          if(result['status'] == true){
            window.location.href = '../../../';
            console.log("Ingeloged")
          } else {
            console.log(result['message'])
            $("#wachtwoordInput").text("Wachtwoord is fout!");
          }
        },
        error: function (result) {
          console.log("Inloggen mislukt")
          alert(result.responseText);
        }
      });
    }
  }

  function WachtwoordVergeten(){
    $("#emailInput").text("");
    $("#wachtwoordInput").text("");
    var email = document.forms["form"]["email"].value;
    if (email == "") {
      $("#emailInput").text("Vul email address in");
    } else {
      $("#wachtwoordVergeten").css("display",'none');
      $(".overlay").css("display",'block')
      $.ajax({
        type: "POST",
        url: '/api/auth/wachtwoordVergeten.php',
        dataType: 'json',
        data: {
          titel: "Wachtwoord resetten",
          html: "",
          rawTekst:"",
          linkTekst: "Reset wachtwoord",
          email: $("#email").val(),       
        },
        success: function (result) {
          if(result['status'] == true){
            window.location.href = 'emailVerstuurd.php';
          } else {
            $("#wachtwoordVergeten").css("display",'block');
            $(".overlay").css("display",'none')
            console.log(result['message'])
            $("#emailInput").text(result['message']);
          }
        },
        error: function (result) {
          $("#wachtwoordVergeten").css("display",'block');
          $(".overlay").css("display",'none')
          console.log("Wachtwoord vergeten sequence mislukt")
          console.log(result)
          alert(result.responseText);
        }
      });
    }    
  }

  function validateForm() {
    $("#emailInput").text("");
    $("#wachtwoordInput").text("");
    var email = document.forms["form"]["email"].value;
    var wachtwoord = document.forms["form"]["wachtwoord"].value;

    if (email == "") {
      $("#emailInput").text("Vul email address in");
      return false;
    } else if(wachtwoord == "") {
      $("#wachtwoordInput").text("Vul wachtwoord in");
      return false;
    } else {
      return true;
    }
  }
  
</script>
</body>
</html>
