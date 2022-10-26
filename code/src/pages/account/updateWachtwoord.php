<?php
  session_start();
  
  if(!isset($_SESSION["login"]) || $_SESSION["login"] == 0){
    header("Location: /src/pages/account/");
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
    <div id="resetForm">
        <p class="login-box-msg">Bewerk jouw wachtwoord</p>
        <form role="form" name="form">
            <div class="form-group has-feedback" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 0.5rem;">
                <input type="password" class="form-control" id="huidigWachtwoord" placeholder="Huidig wachtwoord">
                <span class="glyphicon glyphicon-eye-close form-control-feedback" id="eye1" style="pointer-events:all;"></span>
                <p class="invalid-input" id="huidigWachtwoordInput"></p>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" id="wachtwoord" placeholder="Nieuw wachtwoord">
                <span class="glyphicon glyphicon-eye-close form-control-feedback" id="eye2" style="pointer-events:all;"></span>
                <p class="invalid-input" id="wachtwoordInput"></p>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" id="herhaalWachtwoord" placeholder="Herhaal nieuw wachtwoord">
                <span class="glyphicon glyphicon-eye-close form-control-feedback" id="eye3" style="pointer-events:all;"></span>
                <p class="invalid-input" id="herhaalWachtwoordInput"></p>
            </div>

            <div class="" style="margin-bottom: 5px;">
                <button type="button" onClick="BewerkWachtwoord()" class="btn btn-primary btn-block btn-flat">Bewerk wachtwoord</button>
            </div> 
        </form>
        <a onClick="Annuleer()" id="annuleer">Annuleer</a><br>
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
    $(document).ready(function(){
        $("#annuleer").hover(function(){
            $(this).css("cursor","pointer");
        });

        //wachtwoort visible/invisible maken
        $(".glyphicon").hover(function(){
            $(this).css("cursor","pointer");
        });
        $("#eye1").click(function(){
            if($(this).hasClass("glyphicon-eye-close")) {
                $(this).removeClass("glyphicon-eye-close");
                $(this).addClass("glyphicon-eye-open");
                $("#huidigWachtwoord").attr("type", "text");
            } 
            else if($(this).hasClass("glyphicon-eye-open")) {
                $(this).removeClass("glyphicon-eye-open");
                $(this).addClass("glyphicon-eye-close");
                $("#huidigWachtwoord").attr("type", "password");
            } 
        });
        $("#eye2").click(function(){
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
        $("#eye3").click(function(){
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

  function BewerkWachtwoord(){
    if(validateForm()){
        $.ajax({
            type: "POST",
            url: '/api/auth/authUser.php',
            dataType: 'json',
            data: {
                wachtwoord: $("#huidigWachtwoord").val(),  
            },
            success: function (result) {
                if(result['status'] == true){
                    console.log(result['message'])
                    $.ajax({
                        type: "POST",
                        url: '/api/auth/updateWachtwoord.php',
                        dataType: 'json',
                        data: {
                            wachtwoord: $("#wachtwoord").val(),  
                        },
                        success: function (result) {
                            if(result['status'] == true){
                                console.log(result['message'])
                                //going back to previous page and refreshing
                                window.location=document.referrer;
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
                } else {
                    $("#huidigWachtwoordInput").text("Foutief wachtwoord!");
                    console.log(result['message'])
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
    $("#huidigWachtwoordInput").text("");
    $("#wachtwoordInput").text("");
    $("#herhaalWachtwoordInput").text("");

    var huidigWachtwoord = document.forms["form"]["huidigWachtwoord"].value;
    var wachtwoord = document.forms["form"]["wachtwoord"].value;
    var herhaalWachtwoord = document.forms["form"]["herhaalWachtwoord"].value;

    if(huidigWachtwoord == "") {
        $("#huidigWachtwoordInput").text("Vul huidig wachtwoord in");
        return false;
    } else if(wachtwoord == "") {
        $("#wachtwoordInput").text("Vul nieuw wachtwoord in");
        return false;
    } else if(herhaalWachtwoord == "") {
        $("#herhaalWachtwoordInput").text("Herhaal nieuw wachtwoord");
        return false;
    } else if(wachtwoord != herhaalWachtwoord) {
        $("#herhaalWachtwoordInput").text("Wachtwoord komt niet overeen");
        return false;
    } else {
        return true;
    }
  }

  function Annuleer(){
      //going back to previous page and refreshing
      window.location=document.referrer;
  }
  
</script>
</body>
</html>
