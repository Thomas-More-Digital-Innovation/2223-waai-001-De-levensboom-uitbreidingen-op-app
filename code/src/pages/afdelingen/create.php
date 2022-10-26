<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Afdeling toevoegen</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="naam">Naam*</label>
                          <input type="text" class="form-control" name="naam" id="naam" placeholder="Enter Naam">
                        </div>
                        <div class="form-group">
                          <label for="straat">Straat</label>
                          <input type="text" class="form-control" id="straat" placeholder="Enter straat">
                        </div>
                        <div class="form-group">
                          <label for="huisNr">Huis nummer</label>
                          <input type="text" class="form-control" id="huisNr" placeholder="Enter huis nummer">
                        </div>
                        <div class="form-group">
                          <label for="woonplaats">Woonplaats</label>
                          <input type="text" class="form-control" id="woonplaats" placeholder="Enter woonplaats">
                        </div>
                        <div class="form-group">
                          <label for="postcode">Postcode</label>
                          <input type="text" class="form-control" id="postcode" placeholder="Enter postcode">
                        </div>
                        <div class="form-group">
                          <label for="telNummer">Telefoonnummer</label>
                          <input type="text" class="form-control" id="telNummer" placeholder="Enter telefoonnummer">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" id="email" placeholder="Enter email">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AfdelingToevoegen()" value="Aanmaken"></input>
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
    $("#naam").focus();
  });
  function AfdelingToevoegen(){
    if(validateForm()){
      $.ajax({
        type: "POST",
        url: '/api/afdeling/create.php',
        dataType: 'json',
        data: {
            naam: $("#naam").val(),   
            straat: $("#straat").val(),
            huisNr: $("#huisNr").val(),
            woonplaats: $("#woonplaats").val(),
            postcode: $("#postcode").val(),
            telNummer: $("#telNummer").val(),
            email: $("#email").val()
        },
        success: function (result) {
            if (result['status'] == true) {
                //alert("Nieuwe afdeling is toegevoegd!");
                window.location.href = '/src/pages/afdelingen/';
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
    var naam = document.forms["form"]["naam"].value;
    if (naam == "") {
      alert("Naam moet ingevult zijn");
      return false;
    } else {
      return true;
    }
  }
</script>