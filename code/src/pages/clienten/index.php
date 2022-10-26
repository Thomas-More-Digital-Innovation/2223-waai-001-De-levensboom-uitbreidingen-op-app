<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Clienten lijst</h3>
                    <a href="/src/pages/clienten/create.php" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="clienten" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Afdeling(en)</th>
                        <th>Begeleider(s)</th>
                        <th>Geboortedatum</th>
                        <th>Contactgegevens</th>
                        <th>Acties</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                  <div class="overlay" >
                    <i class="fa fa-refresh fa-spin"></i>
                  </div>
                </div>
                <!-- /.box -->
                <div class="callout callout-warning ">
                  <h4>Tip!</h4>
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=3" target="_blank">documentatie over clienten</a> voor meer info!</p>
                </div>
              </div>
            </div>';
    include('../../template.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "/api/client/read.php",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')
            if(data['status']== null){
              $.ajax({
                type: "GET",
                url: "/api/auth/getAccount.php",
                dataType: 'json',
                success: function(account) {
                  var response="";

                  var show;
                  for(var client in data){

                    show = false;
                    if(account["functie"] == "admin"){
                      show = true;
                    } else if(account["functie"] == "afdelingHoofd") {
                      if(data[client].afdelingen.length > 0) {
                        for(var afdeling in data[client].afdelingen){
                          for(var accountAfdeling in account["afdelingen"]) {
                            if(account["afdelingen"][accountAfdeling].afdelingId == data[client].afdelingen[afdeling].afdelingId) {
                              show = true;
                            } 
                          }
                        }
                      } 
                    }

                    if(show) {
                      var afdelingen='<div>'
                      if(data[client].afdelingen.length > 0) {
                        for(var afdeling in data[client].afdelingen){
                          afdelingen+='<p>'+data[client].afdelingen[afdeling].naam+'</p>'
                        }
                      } 
                      
                      afdelingen+='</div>';

                      var begeleiders='<div>'
                      if(data[client].begeleiders.length > 0) {
                        for(var begeleider in data[client].begeleiders){
                          begeleiders+='<p>- '+data[client].begeleiders[begeleider].voornaam+' '+data[client].begeleiders[begeleider].achternaam+'</p>'
                        }
                      } else {
                        begeleiders+='<p class="small">Geen begeleiders toegewezen</p>'
                      }
                      
                      begeleiders+='</div>';

                      response += "<tr>"+
                      "<td>"+data[client].voornaam+"</td>"+
                      "<td>"+data[client].achternaam+"</td>"+
                      "<td>"+afdelingen+"</td>"+
                      "<td>"+begeleiders+"</td>"+
                      "<td>"+data[client].geboorteDatum+"</td>"+"<td>"

                      if(data[client].straat){
                        response += data[client].straat
                        if(data[client].huisNr){
                          response += " " + data[client].huisNr;
                        }
                        response += "<br>";
                      }
                      if(data[client].woonplaats){
                        response += data[client].woonplaats;
                        if(data[client].postcode){
                        } else {
                          response += "<br>";
                        }
                      }
                      if(data[client].postcode) {
                        response += " " + data[client].postcode + "<br>";
                      }
                      if(data[client].telNummer) {
                        response += data[client].telNummer + "<br>";
                      }
                      response += data[client].email+"</td>"+
                      "<td><a href='update.php?id="+data[client].clientId+"'>Bewerk</a> | <a href='#' onClick=Remove('"+data[client].clientId+"')>Verwijder</a></td>"+
                      "</tr>";
                    }
                  }
                  $(response).appendTo($("#clienten"));
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  console.log(errorThrown);
                }
              });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });
  function Remove(id){
    var result = confirm("Ben je zeker dat je deze client wilt verwijderen?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '/api/client/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    //alert("Client succesvol verwijdert!");
                    window.location.href = '/src/pages/clienten/';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>