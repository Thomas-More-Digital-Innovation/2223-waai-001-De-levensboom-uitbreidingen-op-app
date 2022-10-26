<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Nieuwtjes</h3>
                    <a href="/src/pages/nieuwtjes/create.php" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Titel</th>
                        <th>Gecreerd op</th>
                        <th>Acties</th>
                      </tr>
                      </thead>
                      <tbody id="nieuwtjes">
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
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=13" target="_blank">documentatie over nieuwtjes</a> voor meer info!</p>
                </div>
              </div>
            </div>';
    include('../../template.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){

    //alle nieuwtjes ophalen 
    $.ajax({
        type: "GET",
        url: "/api/nieuwtjes/read.php?",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            var response="";
            for(var nieuwtje in data){
                response += '<tr class="infoSegmentRow" >'+
                "<td>"+data[nieuwtje].titel+"</td>"+
                '<td>'+data[nieuwtje].createdAt+'</td>'+
                "<td><a href='update.php?id="+data[nieuwtje].nieuwtjesId+"'>Bewerk</a> | <a href='#' onClick=Remove('"+data[nieuwtje].nieuwtjesId+"')>Verwijder</a></tr>";
            }
            $(response).appendTo($("#nieuwtjes"));
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });

  //functie om een nieuwtje te verwijderen
  function Remove(id){
    var result = confirm("Ben je zeker dat je dit nieuwtje wilt verwijderen?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '/api/nieuwtjes/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    //alert("Nieuwtje succesvol verwijdert!");
                    window.location.href = '/src/pages/nieuwtjes/';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>