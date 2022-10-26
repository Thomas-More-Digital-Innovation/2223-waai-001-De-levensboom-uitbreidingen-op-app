<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Tevredenheids meting link bewerken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="formLink">Google form link*</label>
                          <input type="text" class="form-control" name="formLink" id="formLink" placeholder="Enter Google form link">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateTevredenheidsMeting()" value="Bewerk"></input>
                      </div>
                    </form>
                    <div class="overlay" >
                      <i class="fa fa-refresh fa-spin"></i>
                    </div>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../../template.php');
?>
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "/api/tevredenheidsMeting/read.php",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            $("#formLink").val(data["formLink"]);
        },
        error: function (result) {
            console.log("Failed to get tevredenheids meting");
        },
    });
  });
    
  function UpdateTevredenheidsMeting(navLink = "/src/pages/tevredenheidsMeting/index.php" ,alerten = false){
    if(validateForm()){
      $.ajax({
        type: "POST",
        url: '/api/tevredenheidsMeting/update.php',
        dataType: 'json',
        data: {
            tevredenheidsMetingId: <?php echo $_GET['id']; ?>,
            formLink: $("#formLink").val()
        },
        error: function (result) {
            alert(result.responseText);
        },
        success: function (result) {
            if (result['status'] == true) {
                console.log(navLink)
                console.log(alerten)
                if(alerten == true){
                  alert("Tevredenheids meting succesvol geupdate!");
                }
                window.location.href = navLink;
            }
            else {
                alert(result['message']);
            }
        }
      });
    }
  }

  function validateForm() {
    var formLink = document.forms["form"]["formLink"].value;

    if (formLink == "") {
      alert("Google Form link moet ingevult zijn");
      return false;
    }else {
      return true;
    }
  }
  
</script>