<?php
  session_start();
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
    <div class="overlay" style="text-align: center;" >
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div id="invalidCodeMessage">
        <p>Deze link is niet meer valide.</p>
        <a href="index.php">Terug naar login pagina</a><br>
    </div>
    <div id="resetForm">
        <p class="login-box-msg">Set jouw wachtwoord</p>
        <form role="form" name="form">
        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="wachtwoord" placeholder="Nieuw wachtwoord">
            <span class="glyphicon glyphicon-eye-close form-control-feedback" id="eye1" style="pointer-events:all;"></span>
            <p class="invalid-input" id="wachtwoordInput"></p>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="herhaalWachtwoord" placeholder="Herhaal nieuw wachtwoord">
            <span class="glyphicon glyphicon-eye-close form-control-feedback" id="eye2" style="pointer-events:all;"></span>
            
            <p class="invalid-input" id="herhaalWachtwoordInput"></p>
        </div>

        <div class="" style="margin-bottom: 5px;">
            <button type="button" onClick="ResetWachtwoord()" class="btn btn-primary btn-block btn-flat">Set wachtwoord</button>
        </div> 
        </form>
    </div>
    
  </div>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  var secretCodeId = null;
  $(document).ready(function(){
      $("#invalidCodeMessage").css("display","none");
      $("#resetForm").css("display","none");

      //checken of code nog valide is
      $.ajax({
          type: "POST",
          url: '/api/auth/authCode.php',
          dataType: 'json',
          data: {
              code: <?php echo $_GET['code']; ?>, 
          },
          success: function (result) {
            if(result['status'] == true){
              console.log(result['message'])
              secretCodeId = result['secretCodeId'];
              console.log(secretCodeId);
              $(".overlay").css("display","none");
              $("#resetForm").css("display","block");
            } else {
              console.log(result['message'])
              $(".overlay").css("display","none");
              $("#invalidCodeMessage").css("display","block");
            }
          },
          error: function (result) {
            console.log(result);
            alert(result.responseText);
          }
      });

      //wachtwoort visible/invisible maken
      $(".glyphicon").hover(function(){
          $(this).css("cursor","pointer");
      });
      $("#eye1").click(function(){
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
      $("#eye2").click(function(){
          if($(this).hasClass("glyphicon-eye-close")) {
              $(this).removeClass("glyphicon-eye-close");
              $(this).addClass("glyphicon-eye-open");
              $("#herhaalWachtwoord").attr("type", "text");
          } 
          else if($(this).hasClass("glyphicon-eye-open")) {
              $(this).removeClass("glyphicon-eye-open");
              $(this).addClass("glyphicon-eye-close");
              $("#herhaalWachtwoord").attr("type", "password");
          } 
      });
  })

  $(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
      ResetWachtwoord()
    }
  });

  function ResetWachtwoord(){
    if(validateForm()){
      $.ajax({
        type: "POST",
        url: '/api/auth/resetWachtwoord.php',
        dataType: 'json',
        data: {
            id: <?php echo $_GET['id']; ?>,
            wachtwoord: $("#wachtwoord").val(),  
            code: <?php echo $_GET['code']; ?>,
            codeId: secretCodeId
        },
        success: function (result) {
          if(result['status'] == true){
            alert("Wachtwoord is succesvol gereset")
            window.location.href = 'index.php';
          } else {
            console.log(result['message'])
            alert(result['message'])
          }
        },
        error: function (result) {
          console.log(result)
          alert(result.responseText);
        }
      });
    }
  }

  function validateForm() {
    $("#wachtwoordInput").text("");
    $("#herhaalWachtwoordInput").text("");
    var wachtwoord = document.forms["form"]["wachtwoord"].value;
    var herhaalWachtwoord = document.forms["form"]["herhaalWachtwoord"].value;

    if (wachtwoord == "") {
      $("#wachtwoordInput").text("Vul nieuw wachtwoord in");
      return false;
    } 
    if (!(isPasswordValid(wachtwoord))) {
      $("#wachtwoordInput").html("- Wachtwoord moet minstens 8 karakters bevatten <br> -	Wachtwoord moet minstens 1 hoofdletter en 1 kleine letter bevatten <br>  -	Wachtwoord moet minstens 1 cijfer bevatten <br>  -	Wachtwoord mag speciale karakters bevatten");
      return false;
    } else if(herhaalWachtwoord == "") {
      $("#herhaalWachtwoordInput").text("Herhaal nieuw wachtwoord");
      return false;
    } else if(wachtwoord != herhaalWachtwoord) {
      $("#herhaalWachtwoordInput").text("Wachtwoorden zijn niet gelijk");
      return false;
    } else {
      return true;
    }
  }

  function isPasswordValid(wachtwoord) {
    //Check if password is valid with regular expression
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    return regex.test(wachtwoord);
  }
  
</script>
</body>
</html>
