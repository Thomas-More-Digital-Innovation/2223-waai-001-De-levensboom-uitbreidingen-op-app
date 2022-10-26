<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Afdelingen lijst</h3>
                    <a href="/src/pages/afdelingen/create.php" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="afdelingen" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Naam</th>
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
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=8" target="_blank">documentatie over afdelingen</a> voor meer info!</p>
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
        url: "/api/afdeling/read.php",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            if(data['status']== null){
              var response="";
              for(var afdeling in data){
                response += "<tr>"+
                "<td>"+data[afdeling].naam+"</td>"+
                "<td>"+data[afdeling].straat+" "+data[afdeling].huisNr+"<br>"
                +data[afdeling].woonplaats+" "+data[afdeling].postcode+"<br>"
                +data[afdeling].telNummer+"<br>"+data[afdeling].email+"</td>"+
                "<td><a href='update.php?id="+data[afdeling].afdelingId+"'>Bewerk</a> | <a href='#' onClick=Remove('"+data[afdeling].afdelingId+"')>Verwijder</a></td>"+
                "</tr>";
              }
              $(response).appendTo($("#afdelingen"));
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });
  function Remove(id){
    var result = confirm("Ben je zeker dat je deze afdeling wilt verwijderen?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '/api/afdeling/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    //alert("Afdeling succesvol verwijdert!");
                    window.location.href = '/src/pages/afdelingen/';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
