<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Info segment toevoegen</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="titel">Titel*</label>
                          <input type="text" class="form-control" name="titel" id="titel" placeholder="Enter Titel">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="InfoSegmentToevoegen()" value="Toevoegen"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Infoblokken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                      <table id="infoBlokken" class="table table-bordered table-hover">
                        <tbody>
                          <p>Voeg de info blokken toe op de update pagina</p>
                        </tbody>
                      </table>
                    </div>
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
  function InfoSegmentToevoegen(){
    if(validateForm()){
      var type = <?php echo $_GET['type']; ?>;
    var isVolwassenen;
    if(type == "volwassenen"){
      isVolwassenen = 1;
    } else {
      isVolwassenen = 0;
    }
      $.ajax(
      {
        type: "POST",
        url: '/api/infoSegment/create.php',
        dataType: 'json',
        data: {
            titel: $("#titel").val(),   
            isVolwassenen: isVolwassenen
        },
        success: function (result) {
            if (result['status'] == true) {
                //alert("Nieuw info segment is toegevoegd!");
                //going back to previous page and refreshing
                window.location=document.referrer;
            }
            else {
                console.log(result)
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