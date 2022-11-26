<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Begeleider toevoegen</h3>
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
                          <label for="email">Email</label>
                          <input type="text" disabled class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.2rem;">
                          <label for="functie">Functie*</label>
                          <select class="form-control" id="functie">
                            <option value=""></option>
                            <option value="admin">Admin - Volledige beheer rechten</option>
                            <option value="afdelingHoofd">Afdeling Hoofd - Afdeling specifieke beheer rechten</option>
                            <option value="begeleider">Begeleider - Geen beheer rechten</option>
                          </select>
                        </div>

                        <h4 style="padding-bottom: 0.6rem;">Afdelingen <span style="font-size: 1.5rem; color: #3c8dbc; padding-left: 0.5rem;" onClick="AddAfdeling()"><i class="fa fa-plus"></span></i></h4>
                        <div class="form-group" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.5rem;" id="afdelingen"></div>

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
  var afdelingCount= 0;
  var afdelingOptions=""; 
  var lastFunctie =""; 
  $(document).ready(function(){ 
      $.ajax({
        type: "GET",
        url: "/api/afdeling/read.php",
        dataType: 'json',
        success: function(data) {
          //de option tags maken voor elke afdeling
          for(var afdeling in data){
            afdelingOptions += '<option value="'+data[afdeling].afdelingId+'" id="'+data[afdeling].afdelingId+'">'+data[afdeling].naam+'</option>';
          }
          $.ajax({
            type: "GET",
            url: "/api/begeleider/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#voornaam').val(data['voornaam']);
                $('#achternaam').val(data['achternaam']);
                $('#functie').val(data['functie']);
                lastFunctie = data['functie'];
                $('#straat').val(data['straat']);
                $('#huisNr').val(data['huisNr']);
                $('#woonplaats').val(data['woonplaats']);
                $('#postcode').val(data['postcode']);
                $('#telNummer').val(data['telNummer']);
                $('#email').val(data['email']);
                //loop door de afdelingen van de begeleider voor het maken van de select  
                if(data['afdelingen'].length > 0) {
                  for(afdeling in data['afdelingen']){
                    CreateAfdeling(afdelingCount)

                    //de selected attribuut toevoegen aan de juiste afdeling
                    $('#afdeling'+afdelingCount).children('option').each(function(i) { 
                        var value = $(this).val();
                        if(value==data['afdelingen'][afdeling].afdelingId){
                          $(this).attr("selected","selected");
                        }
                    });
                    afdelingCount +=1;

                    //loading animation wegdoen wanneer geladen
                    $(".overlay").css("display",'none')
                  }
                } else {
                  //loading animation wegdoen wanneer geladen
                  $(".overlay").css("display",'none')
                }
                
            },
            error: function (result) {
              console.log(result["responseText"]);
            },
          });   
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
      }); 

      
  });

  function UpdateBegeleider(){
      //check is isadmin has changed from false to positive
      var rechtenConfirm = true;
      if(lastFunctie != $("#functie").val()){
        if($("#functie").val() == "admin"){
          rechtenConfirm = confirm("Ben je zeker dat je deze persoon admin rechten wilt geven?")
        } else if($("#functie").val() == "afdelingHoofd"){
          rechtenConfirm = confirm("Ben je zeker dat je deze persoon rechten wilt geven voor een bepaalde afdeling(en)?")
        }
      } 
      if(validateForm() && rechtenConfirm){
        $.ajax({
          type: "POST",
          url: '/api/begeleider/update.php',
          dataType: 'json',
          data: {
              begeleiderId: <?php echo $_GET['id']; ?>,
              voornaam: $("#voornaam").val(),
              achternaam: $("#achternaam").val(),
              afdelingen: getSelectedAfdelingen(),
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
          },
          success: function (result) {
              if (result['status'] == true) {
                  //alert("Begeleider is succesvol geupdate!");
                  window.location.href = '/src/pages/begeleiders/';
              }
              else {
                  alert(result['message']);
              }
          }
        });
      }
  }

  function getSelectedAfdelingen() {
    var selectedAfdelingen = [];
    for (i = 0; i < afdelingCount; i++) {
      afdelingValue = $('#afdeling'+i).find(":selected").val()
      if(afdelingValue) {
        selectedAfdelingen.push(afdelingValue)
      }
    }
    return selectedAfdelingen
  }

  function CreateAfdeling(afdelingCount) {
    //per afdeling de variable voor de id en name attributen van select
    var afdelingName="afdeling"+afdelingCount
    var afdelingDivName="afdelingDiv"+afdelingCount

    //de select input met options voor elke afdeling 
    var input = ""
    input += '<div id="'+afdelingDivName+'" style="margin-bottom: 0.3rem;"><label style="padding-right: 0.5rem;" for="'+afdelingName+'">'+(afdelingCount+1)+':</label>';
    input += '<select class="afdelingen" name="'+afdelingName+'" id="'+afdelingName+'"><option value=""></option>'+afdelingOptions+'</select>'
    input += '<a style="margin-left: 0.5rem;" href="#" onClick=VerwijderAfdeling('+afdelingDivName+')>Verwijder</a></div>'
    $(input).appendTo($("#afdelingen"));
  }

  function AddAfdeling() {
    CreateAfdeling(afdelingCount)
    afdelingCount +=1
  }

  function VerwijderAfdeling(afdelingDiv) {
    $(afdelingDiv).remove();
    afdelingen = getSelectedAfdelingen()
    if(afdelingen.length == 0){
      AddAfdeling()
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