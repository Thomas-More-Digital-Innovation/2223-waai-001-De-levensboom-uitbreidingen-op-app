<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Mail bewerken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="titel">Onderwerp*</label>
                          <input type="text" class="form-control" name="titel" id="titel" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                          <label for="inhoud">Inhoud</label><br>
                          <textarea id="inhoud" class="editor" name="inhoud" rows="6" style="width:100%;" placeholder="Enter inhoud"></textarea>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="MailUpdaten()" value="Bewerken"></input>
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
  var mailId;
  $(document).ready(function(){   
    CKEDITOR.on('instanceReady', function(){
      $.ajax({
        type: "GET",
        url: "/api/mails/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
          mailId = <?php echo $_GET['id']; ?>;
          $('#titel').val(data['titel']);
          $('#inhoud').val(data['inhoud']);

          //loading animation wegdoen wanneer geladen
          $(".overlay").css("display",'none')
        },
        error: function (result) {
          console.log("Failed to get mail");
        },
      });
    });
  });

  function MailUpdaten(){
    if(validateForm()){
      //de inhoud bewerken zodat mogelijke errors vermeden worden 
      var inhoud = $("#inhoud").val().replaceAll(`"`,`'`)
      inhoud = inhoud.replaceAll("<p>​</p>"," ")

      $.ajax({
      type: "POST",
      url: '/api/mails/update.php',
      dataType: 'json',
      data: {
          mailId: mailId,
          titel: $("#titel").val(),
          inhoud: inhoud,    
      },
      success: function (result) {
          if (result['status'] == true) {
              //alert("Deze mail is geupdate!");
              //going back to previous page and refreshing
              window.location=document.referrer;
          }
          else {
              alert(result['message']);
          }
      },
      error: function (result) {
          alert(result.responseText);
      }
    });
    }
  }

  function validateForm() {
    var titel = document.forms["form"]["titel"].value;
    if (titel == "") {
      alert("Titel moet ingevult zijn");
      return false;
    } else {
      return true;
    }
  }
</script>