<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Account bewerken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="voornaam">Voornaam*</label>
                          <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Enter voornaam">
                        </div>
                        <div class="form-group">
                          <label for="achternaam">Achternaam*</label>
                          <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Enter achternaam">
                        </div>
                        <div class="form-group">
                          <label for="functie">Functie </label>
                          <input type="text" disabled class="form-control" id="functie" placeholder="Enter functie">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" disabled class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.2rem;">
                            <input type="button" class="btn btn-primary" onClick="UpdateWachtwoord()" value="Wachtwoord bewerken"></input>
                        </div>
                        
                        <div id="afdelingenSectie">
                          <h4 style="padding-bottom: 0.6rem;">Afdelingen</h4>
                          <div class="" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.5rem;" id="afdelingen"></div>  
                        </div>
                        

                        <h4>Contactgevens <span class="small">(optioneel)<span></h4>
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
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateBegeleider()" value="Bewerken"></input>
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
  var begeleiderId = 0;
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "/api/auth/getAccount.php",
        dataType: 'json',
        success: function(data) {
            $('#voornaam').val(data['voornaam']);
            $('#achternaam').val(data['achternaam']);
            $('#functie').val(data['functie']);
            $('#straat').val(data['straat']);
            $('#huisNr').val(data['huisNr']);
            $('#woonplaats').val(data['woonplaats']);
            $('#postcode').val(data['postcode']);
            $('#telNummer').val(data['telNummer']);
            $('#email').val(data['email']);
            //De afdelingen van dit account weergeven  
            var afdelingList = "<ul>";
            if(data['afdelingen'].length == 0) {
              $("#afdelingenSectie").attr("style","display:none;")
            } 
            for(afdeling in data['afdelingen']){
                afdelingList += "<li>" + data['afdelingen'][afdeling]['naam'] + "</li>";
            }
            afdelingList += "</ul>";
            $("#afdelingen").append(afdelingList);

            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')
            
        },
        error: function (result) {
            console.log(result);
            alert(result.responseText);
        },
    });   
  });

  function UpdateWachtwoord(){
    UpdateBegeleider("updateWachtwoord.php")
    console.log("bewerk wachtwoord")
  }

  function UpdateBegeleider(navLink = "/"){
    if(validateForm()){
        $.ajax({
            type: "POST",
            url: '/api/auth/updateAccount.php',
            dataType: 'json',
            data: {
                voornaam: $("#voornaam").val(),
                achternaam: $("#achternaam").val(),
                functie: $("#functie").val(),
                straat: $("#straat").val(),
                huisNr: $("#huisNr").val(),        
                woonplaats: $("#woonplaats").val(),
                postcode: $("#postcode").val(),
                telNummer: $("#telNummer").val(),
                email: $("#email").val()
            },
            error: function (result) {
                alert(result.responseText);
                console.log(result)
            },
            success: function (result) {
                if (result['status'] == true) {
                    //alert("Begeleider is succesvol geupdate!");
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
    var voornaam = document.forms["form"]["voornaam"].value;
    var achternaam = document.forms["form"]["achternaam"].value;

    if (voornaam == "") {
      alert("Voornaam moet ingevult zijn");
      return false;
    } else if(achternaam == "") {
      alert("Achternaam moet ingevult zijn");
      return false;
    } else {
      return true;
    }
  }

</script>