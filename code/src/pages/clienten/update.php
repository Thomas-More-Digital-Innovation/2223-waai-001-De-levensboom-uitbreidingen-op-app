<?php
$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Client bewerken</h3>
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
                          <label for="email">Email*</label>
                          <input type="text" disabled class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="geboorteDatum">Geboortedatum*</label>
                          <input type="text" class="form-control" name="geboorteDatum" id="geboorteDatum" placeholder="Enter geboortedatum Vb: 19-05-1989">
                        </div>
                        <div class="form-group" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.5rem;">
                          <label for="geslacht">Geslacht</label>
                          <select name="geslacht" id="geslacht">
                            <option value="" selected></option>
                            <option value="Man">Man</option>
                            <option value="Vrouw">Vrouw</option>
                          </select>
                        </div>

                        <h4 style="padding-bottom: 0.6rem;">Afdelingen <span style="font-size: 1.5rem; color: #3c8dbc; padding-left: 0.5rem;" onClick="AddAfdeling()"><i class="fa fa-plus"></span></i></h4>
                        <div class="form-group" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.5rem;" id="afdelingen"></div>

                        <h4 style="padding-bottom: 0.6rem;">Begeleiders <span style="font-size: 1.5rem; color: #3c8dbc; padding-left: 0.5rem;" onClick="AddBegeleider()"><i class="fa fa-plus"></span></i></h4>
                        <div class="form-group" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 1.5rem;" id="begeleiders"></div>

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
                        <input type="button" class="btn btn-primary" onClick="UpdateClient()" value="Bewerken"></input>
                      </div>
                    </form>
                    <div class="overlay" >
                      <i class="fa fa-refresh fa-spin"></i>
                    </div> 
                  </div>
                  <div id="tevredenheidsMetingBox" class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Tevredenheids meting</h3>
                    </div>
                    <div class="box-body">
                      <p id="tevredenheidsMetingClientId" style="display:none;"></p>
                      <p id="tevredenheidsMetingTekst">Loading</p>
                      <input id="tevredenheidsMetingBtn" type="button" class="btn" onClick="TevredenheidsMetingVersturen()" value="Tevredenheids meting versturen"></input>

                    </div>
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
  var afdelingCount = 0;
  var afdelingOptions = "";

  var clientvoornaam = "";
  var clientachternaam = "";

  var begeleiderCount = 0;
  var begeleiders = [];

  var tevredenheidsMetingVerstuurd = 0

  $(document).ready(function() {
    var afdelingId = 0

    //Begeleiders ophalen
    $.ajax({
      type: "GET",
      url: "/api/begeleider/read.php",
      dataType: 'json',
      success: function(data) {
        begeleiders = data;

        $.ajax({
          type: "GET",
          url: "/api/auth/getAccount.php",
          dataType: 'json',
          success: function(data) {

            //de option tags maken voor elke afdeling, anders afhankelijk van functie
            if (data["functie"] == "admin") {
              $.ajax({
                type: "GET",
                url: "/api/afdeling/read.php",
                dataType: 'json',
                success: function(data) {
                  for (var afdeling in data) {
                    afdelingOptions += '<option value="' + data[afdeling].afdelingId + '" id="' + data[afdeling].afdelingId + '">' + data[afdeling].naam + '</option>';
                  }

                  $.ajax({
                    type: "GET",
                    url: "/api/client/read_single.php?id=<?php echo $_GET['id']; ?>",
                    dataType: 'json',
                    success: function(data) {
                      $('#voornaam').val(data['voornaam']);
                      $('#achternaam').val(data['achternaam']);
                      $('#geslacht').val(data['geslacht']);
                      $('#geboorteDatum').val(data['geboorteDatum']);
                      $('#straat').val(data['straat']);
                      $('#huisNr').val(data['huisNr']);
                      $('#woonplaats').val(data['woonplaats']);
                      $('#postcode').val(data['postcode']);
                      $('#telNummer').val(data['telNummer']);
                      $('#email').val(data['email']);
                      tevredenheidsMetingVerstuurd = data['tevredenheidsMetingVerstuurd'];

                      clientvoornaam = data['voornaam'];
                      clientachternaam = data['achternaam'];

                      //loop door de afdelingen van de client voor het maken van de select  
                      if (data['afdelingen'].length > 0) {
                        for (afdeling in data['afdelingen']) {
                          CreateAfdeling(afdelingCount)

                          //de selected attribuut toevoegen aan de juiste afdeling
                          $('#afdeling' + afdelingCount).children('option').each(function(i) {
                            var value = $(this).val();
                            if (value == data['afdelingen'][afdeling].afdelingId) {
                              $(this).attr("selected", "selected");
                            }
                          });
                          afdelingCount += 1;
                        }
                      }

                      //loop door de begeleiders van de client voor het maken van de select
                      if (data['begeleiders'].length > 0) {
                        for (clientBegeleider in data['begeleiders']) {
                          CreateBegeleider(begeleiderCount)

                          //de selected attribuut toevoegen aan de juiste afdeling
                          $('#begeleider' + begeleiderCount).children('option').each(function(i) {
                            var value = $(this).val();
                            if (value == data['begeleiders'][clientBegeleider].begeleiderId) {
                              $(this).attr("selected", "selected");
                            }
                          });
                          begeleiderCount += 1;
                        }
                      }

                      //tevredenheids meting sectie aanpassen afhankelijk of deze al eens verstuurd is
                      if (tevredenheidsMetingVerstuurd == 0) {
                        $("#tevredenheidsMetingBox").addClass("box-success")
                        $("#tevredenheidsMetingBtn").addClass("btn-success")
                        $("#tevredenheidsMetingTekst").text("Er is nog geen tevredenheids meting verstuurd naar deze client")
                      } else {
                        $("#tevredenheidsMetingBox").addClass("box-warning")
                        $("#tevredenheidsMetingBtn").addClass("btn-warning")
                        $("#tevredenheidsMetingTekst").text("Een tevredenheids meting is reeds verstuurd naar deze client")
                      }

                      //Client id tonen 
                      $('#tevredenheidsMetingClientId').css("display", 'block')
                      $('#tevredenheidsMetingClientId').text("Client ID = <?php echo $_GET['id']; ?>")

                      //loading animation wegdoen wanneer geladen
                      $(".overlay").css("display", 'none')
                    },
                    error: function(result) {
                      console.log(result['responseText']);
                    },
                  });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  console.log(errorThrown);
                }
              });
            } else if (data["functie"] == "afdelingHoofd") {
              for (var afdeling in data["afdelingen"]) {
                afdelingOptions += '<option value="' + data["afdelingen"][afdeling].afdelingId + '" id="' + data["afdelingen"][afdeling].afdelingId + '">' + data["afdelingen"][afdeling].naam + '</option>';
              }
              $.ajax({
                type: "GET",
                url: "/api/client/read_single.php?id=<?php echo $_GET['id']; ?>",
                dataType: 'json',
                success: function(data) {
                  $('#voornaam').val(data['voornaam']);
                  $('#achternaam').val(data['achternaam']);
                  $('#geslacht').val(data['geslacht']);
                  $('#geboorteDatum').val(data['geboorteDatum']);
                  $('#straat').val(data['straat']);
                  $('#huisNr').val(data['huisNr']);
                  $('#woonplaats').val(data['woonplaats']);
                  $('#postcode').val(data['postcode']);
                  $('#telNummer').val(data['telNummer']);
                  $('#email').val(data['email']);
                  tevredenheidsMetingVerstuurd = data['tevredenheidsMetingVerstuurd']

                  //loop door de afdelingen van de client voor het maken van de select  
                  if (data['afdelingen'].length > 0) {
                    for (afdeling in data['afdelingen']) {
                      CreateAfdeling(afdelingCount)

                      //de selected attribuut toevoegen aan de juiste afdeling
                      $('#afdeling' + afdelingCount).children('option').each(function(i) {
                        var value = $(this).val();
                        if (value == data['afdelingen'][afdeling].afdelingId) {
                          $(this).attr("selected", "selected");
                        }
                      });
                      afdelingCount += 1;
                    }
                  }

                  //loop door de begeleiders van de client voor het maken van de select
                  if (data['begeleiders'].length > 0) {
                    for (clientBegeleider in data['begeleiders']) {
                      CreateBegeleider(begeleiderCount)

                      //de selected attribuut toevoegen aan de juiste afdeling
                      $('#begeleider' + begeleiderCount).children('option').each(function(i) {
                        var value = $(this).val();
                        if (value == data['begeleiders'][clientBegeleider].begeleiderId) {
                          $(this).attr("selected", "selected");
                        }
                      });
                      begeleiderCount += 1;
                    }
                  }

                  //tevredenheids meting sectie aanpassen afhankelijk of deze al eens verstuurd is
                  if (tevredenheidsMetingVerstuurd == 0) {
                    $("#tevredenheidsMetingBox").addClass("box-success")
                    $("#tevredenheidsMetingBtn").addClass("btn-success")
                    $("#tevredenheidsMetingTekst").text("Er is nog geen tevredenheids meting verstuurd naar deze client")
                  } else {
                    $("#tevredenheidsMetingBox").addClass("box-warning")
                    $("#tevredenheidsMetingBtn").addClass("btn-warning")
                    $("#tevredenheidsMetingTekst").text("Een tevredenheids meting is reeds verstuurd naar deze client")
                  }

                  //loading animation wegdoen wanneer geladen
                  $(".overlay").css("display", 'none')
                },
                error: function(result) {
                  console.log(result['responseText']);
                },
              });
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  });

  function UpdateClient() {
    if (validateForm()) {
      $(".overlay").css("display", 'block')
      $.ajax({
        type: "POST",
        url: '/api/client/update.php',
        dataType: 'json',
        data: {
          clientId: <?php echo $_GET['id']; ?>,
          voornaam: $("#voornaam").val(),
          achternaam: $("#achternaam").val(),
          geslacht: $("#geslacht").val(),
          geboorteDatum: $("#geboorteDatum").val(),
          afdelingen: getSelectedAfdelingen(),
          begeleiders: getSelectedBegeleiders(),
          straat: $("#straat").val(),
          huisNr: $("#huisNr").val(),
          woonplaats: $("#woonplaats").val(),
          postcode: $("#postcode").val(),
          telNummer: $("#telNummer").val(),
          email: $("#email").val(),
          tevredenheidsMetingVerstuurd: tevredenheidsMetingVerstuurd
        },
        error: function(result) {
          $(".overlay").css("display", 'none')
          alert(result.responseText);
        },
        success: function(result) {
          if (result['status'] == true) {
            //alert("Client is succesvol geupdate!");
            console.log(result)
            window.location.href = '/src/pages/clienten/';
          } else {
            $(".overlay").css("display", 'none')
            alert(result['message']);
          }
        }
      });
    }
  }

  function TevredenheidsMetingVersturen() {
    if (tevredenheidsMetingVerstuurd == 0) {
      if (confirm("Ben je zeker dat je een tevredenheidsmeting wil versturen naar " + clientvoornaam + " " + clientachternaam + "?")) {} else {
        return;
      }
    }
    if (tevredenheidsMetingVerstuurd == 1) {
      if (confirm("Er is al eerder een tevredenheidsmeting verstuurd naar deze client!\nBen je zeker dat je een tevredenheidsmeting wil versturen naar " + clientvoornaam + " " + clientachternaam + "?")) {} else {
        return;
      }
    }
    tevredenheidsMetingVerstuurd = 1

    $(".overlay").css("display", 'block')

    $.ajax({
      type: "POST",
      url: '/api/tevredenheidsMeting/verstuurTevredenheidsMeting.php',
      dataType: 'json',
      data: {
        email: $("#email").val(),
        clientId: <?php echo $_GET['id']; ?>,
        voornaam: clientvoornaam,
        achternaam: clientachternaam
      },
      error: function(result) {
        $(".overlay").css("display", 'none')
        alert(result.responseText);
      },
      success: function(result) {
        if (result['status'] == true) {
          alert(result['message'])
          UpdateClient()
        } else {
          $(".overlay").css("display", 'none')
          alert(result['message']);
        }
      }
    });
  }

  function getSelectedAfdelingen() {
    var selectedAfdelingen = [];
    for (i = 0; i < afdelingCount; i++) {
      afdelingValue = $('#afdeling' + i).find(":selected").val()
      if (afdelingValue) {
        selectedAfdelingen.push(afdelingValue)
      }
    }
    return selectedAfdelingen
  }

  function getSelectedBegeleiders() {
    var selectedBegeleiders = [];
    for (i = 0; i < begeleiderCount; i++) {
      begeleiderValue = $('#begeleider' + i).find(":selected").val()
      if (begeleiderValue) {
        selectedBegeleiders.push(begeleiderValue)
      }
    }
    return selectedBegeleiders
  }

  function getBegeleiderOptions() {
    var begeleiderOptions = "";

    afdelingIds = getSelectedAfdelingen()
    var begeleiderIsUsed;
    for (begeleider in begeleiders) {
      begeleiderIsUsed = false;
      for (afdeling in begeleiders[begeleider]["afdelingen"]) {
        for (selectedAfdeling in afdelingIds) {
          if (afdelingIds[selectedAfdeling] == begeleiders[begeleider]["afdelingen"][afdeling].afdelingId) {
            if (!begeleiderIsUsed) {
              begeleiderIsUsed = true;
              begeleiderOptions += '<option value="' + begeleiders[begeleider].begeleiderId + '" id="' + begeleiders[begeleider].begeleiderId + '">' + begeleiders[begeleider].voornaam + ' ' + begeleiders[begeleider].achternaam + '</option>';
            }
          }
        }
      }
    }
    return begeleiderOptions;
  }

  function CreateAfdeling(afdelingCount) {
    //per afdeling de variable voor de id en name attributen van select
    var afdelingName = "afdeling" + afdelingCount
    var afdelingDivName = "afdelingDiv" + afdelingCount

    //de select input met options voor elke afdeling 
    var input = ""
    input += '<div id="' + afdelingDivName + '" style="margin-bottom: 0.3rem;"><label style="padding-right: 0.5rem;" for="' + afdelingName + '">' + (afdelingCount + 1) + ':</label>';
    input += '<select class="afdelingen" name="' + afdelingName + '" id="' + afdelingName + '"><option value=""></option>' + afdelingOptions + '</select>'
    input += '<a style="margin-left: 0.5rem;" href="#" onClick=VerwijderAfdeling(' + afdelingDivName + ')>Verwijder</a></div>'
    $(input).appendTo($("#afdelingen"));
  }

  function CreateBegeleider(begeleiderCount) {
    //per begeleider de variable voor de id en name attributen van select
    var begeleiderName = "begeleider" + begeleiderCount
    var begeleiderDivName = "begeleiderDiv" + begeleiderCount

    //de select input met options voor elke begeleider 
    var input = ""
    input += '<div id="' + begeleiderDivName + '" style="margin-bottom: 0.3rem;"><label style="padding-right: 0.5rem;" for="' + begeleiderName + '">' + (begeleiderCount + 1) + ':</label>';
    input += '<select class="begeleiders" name="' + begeleiderName + '" id="' + begeleiderName + '"><option value=""></option>' + getBegeleiderOptions() + '</select>'
    input += '<a style="margin-left: 0.5rem;" href="#" onClick=VerwijderBegeleider(' + begeleiderDivName + ')>Verwijder</a></div>'
    $(input).appendTo($("#begeleiders"));
  }

  function AddAfdeling() {
    CreateAfdeling(afdelingCount)
    afdelingCount += 1
  }

  function AddBegeleider() {
    CreateBegeleider(begeleiderCount)
    begeleiderCount += 1
  }

  function VerwijderAfdeling(afdelingDiv) {
    $(afdelingDiv).remove();
    afdelingen = getSelectedAfdelingen()
    if (afdelingen.length == 0) {
      AddAfdeling()
    }
  }

  function VerwijderBegeleider(begeleiderDiv) {
    $(begeleiderDiv).remove();
    selectedBegeleiders = getSelectedBegeleiders()
    if (selectedBegeleiders.length == 0) {
      AddBegeleider()
    }
  }

  function validateForm() {
    var voornaam = document.forms["form"]["voornaam"].value;
    var achternaam = document.forms["form"]["achternaam"].value;
    var email = document.forms["form"]["email"].value;
    var geboorteDatum = document.forms["form"]["geboorteDatum"].value;
    var afdelingenLijst = getSelectedAfdelingen();
    var begeleidersLijst = getSelectedBegeleiders();
    var regex = /\d{2}-\d{2}-\d{4}/; //Regular extression = deze zegt hoe een datum er moet uitzien 

    if (voornaam == "") {
      alert("Voornaam moet ingevult zijn");
      return false;
    } else if (achternaam == "") {
      alert("Achternaam moet ingevult zijn");
      return false;
    } else if (email == "") {
      alert("Email moet ingevult zijn");
      return false;
    } else if (geboorteDatum == "") {
      alert("Geboortedatum moet ingevult zijn");
      return false;
    } else if (!regex.test(geboorteDatum)) {
      alert("GeboorteDatum is in een verkeert formaat, hier is een voorbeeld van het juiste formaat: 19-05-1989");
      return false;
    } else if (afdelingenLijst.length == 0) {
      alert("Selecteer een afdeling");
      return false;
    } else if (begeleidersLijst.length == 0) {
      alert("Selecteer een begeleider");
      return false;
    } else {
      return true;
    }
  }
</script>