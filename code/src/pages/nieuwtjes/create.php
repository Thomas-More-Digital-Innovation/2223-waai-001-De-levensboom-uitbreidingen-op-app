<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Nieuwtje toevoegen</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="titel">Title*</label>
                          <input type="text" class="form-control" name="titel" id="titel" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                          <label for="korteInhoud">Korte inhoud</label><br>
                          <textarea id="korteInhoud" class="editorSmall" name="korteInhoud" rows="3" style="width:100%;" placeholder="Enter korte inhoud"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="inhoud">Inhoud</label><br>
                          <textarea id="inhoud" class="editor" name="inhoud" rows="6" style="width:100%;" placeholder="Enter inhoud"></textarea>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="NieuwtjeToevoegen()" value="Aanmaken"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../../template.php');
?>

<script>
  $(document).ready(function(){
    $("#titel").focus();
  });
  function NieuwtjeToevoegen(){
    if(validateForm()){
      //de inhoud bewerken zodat mogelijke errors vermeden worden 
      var inhoud = $("#inhoud").val().replaceAll(`"`,`'`)
      inhoud = inhoud.replaceAll("<p>​</p>"," ")
      var korteInhoud = $("#korteInhoud").val().replaceAll(`"`,`'`)
      korteInhoud = korteInhoud.replaceAll("<p>​</p>"," ")

      $.ajax({
        type: "POST",
        url: '/api/nieuwtjes/create.php',
        dataType: 'json',
        data: {
            titel: $("#titel").val(),
            korteInhoud: korteInhoud,
            inhoud: inhoud,    
        },
        success: function (result) {
            if (result['status'] == true) {
                //alert("Nieuwe nieuwtje is toegevoegd!");
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