<?php

  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Begeleiders lijst</h3>
                    <a href="/src/pages/begeleiders/create.php" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="begeleiders" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Functie</th>
                        <th>Contactgegevens</th>
                        <th>Acties</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="overlay" >
                    <i class="fa fa-refresh fa-spin"></i>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="callout callout-warning ">
                  <h4>Tip!</h4>
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=6" target="_blank">documentatie over begeleiders</a> voor meer info!</p>
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
        url: "/api/begeleider/read.php",
        dataType: 'json',
        success: function(data) {
          //loading animation wegdoen wanneer geladen
          $(".overlay").css("display",'none')
          if(data['status']== null){
            var response="";
            for(var begeleider in data){
              var afdelingen='<div>'
              if(data[begeleider].afdelingen.length > 0) {
                for(var afdeling in data[begeleider].afdelingen){
                  afdelingen+='<p class="small">-'+data[begeleider].afdelingen[afdeling].naam+'</p>'
                }
              } 
              
              afdelingen+='</div>';

              response += "<tr>"+
              "<td>"+data[begeleider].voornaam+"</td>"+
              "<td>"+data[begeleider].achternaam+"</td>"
              // "<td>"+afdelingen+"</td>"+
              if(data[begeleider].functie == "admin") {
                response += "<td><p>Admin<p>"
              } else if(data[begeleider].functie == "afdelingHoofd") {
                response += "<td><p>Afdeling Hoofd<p>"
              } else if(data[begeleider].functie == "begeleider") {
                response += "<td><p>Begeleider<p>"
              } else {
                response += data[begeleider].functie
              }
              response += afdelingen+"</td>"+"<td>"

              if(data[begeleider].straat){
                response += data[begeleider].straat
                if(data[begeleider].huisNr){
                  response += " " + data[begeleider].huisNr;
                }
                response += "<br>";
              }
              if(data[begeleider].woonplaats){
                response += data[begeleider].woonplaats;
                if(data[begeleider].postcode){
                } else {
                  response += "<br>";
                }
              }
              if(data[begeleider].postcode) {
                response += " " + data[begeleider].postcode + "<br>";
              }
              if(data[begeleider].telNummer) {
                response += data[begeleider].telNummer + "<br>";
              }
              response += data[begeleider].email+"</td>" +
              "<td><a href='update.php?id="+data[begeleider].begeleiderId+"'>Bewerk</a> | <a href='#' onClick=Remove('"+data[begeleider].begeleiderId+"')>Verwijder</a></td>"+
              "</tr>";
            }
            $(response).appendTo($("#begeleiders"));
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
        }
    });
  });
  function Remove(id){
    var result = confirm("Ben je zeker dat je deze begeleider wilt verwijderen?"); 
    if (result == true) { 
      $.ajax(
      {
        type: "POST",
        url: '/api/begeleider/delete.php',
        dataType: 'json',
        data: {
            id: id
        },
        error: function (result) {
            alert(result.responseText);
        },
        success: function (result) {
            if (result['status'] == true) {
                //alert("Begeleider succesvol verwijdert!");
                window.location.href = '/src/pages/begeleiders/';
            }
            else {
                alert(result['message']);
            }
        }
      });
    }
  }
</script>