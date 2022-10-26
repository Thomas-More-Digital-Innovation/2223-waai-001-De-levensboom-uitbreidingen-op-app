<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Afdeling bewerken</h3>
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
                        <input type="button" class="btn btn-primary" onClick="UpdateAfdeling()" value="Bewerk"></input>
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
    $('tbody').sortable();
    $('tbody').disableSelection();
    $.ajax({
        type: "GET",
        url: "/api/afdeling/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            $("#naam").val(data["naam"]);
            $('#straat').val(data['straat']);
            $('#huisNr').val(data['huisNr']);
            $('#woonplaats').val(data['woonplaats']);
            $('#postcode').val(data['postcode']);
            $('#telNummer').val(data['telNummer']);
            $('#email').val(data['email']);
        },
        error: function (result) {
            console.log("Failed to get afdeling");
        },
    });
  });
    
  function UpdateAfdeling(navLink = "/src/pages/afdelingen/index.php" ,alerten = false){
    if(validateForm()){
      $.ajax({
        type: "POST",
        url: '/api/afdeling/update.php',
        dataType: 'json',
        data: {
            afdelingId: <?php echo $_GET['id']; ?>,
            naam: $("#naam").val(),    
            straat: $("#straat").val(),
            huisNr: $("#huisNr").val(),
            woonplaats: $("#woonplaats").val(),
            postcode: $("#postcode").val(),
            telNummer: $("#telNummer").val(),
            email: $("#email").val(),
        },
        error: function (result) {
            alert(result.responseText);
        },
        success: function (result) {
            if (result['status'] == true) {
                console.log(navLink)
                console.log(alerten)
                if(alerten == true){
                  alert("Afdeling succesvol geupdate!");
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
    var naam = document.forms["form"]["naam"].value;
    if (naam == "") {
      alert("Naam moet ingevult zijn");
      return false;
    } else {
      return true;
    }
  }
  
</script>