<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Mails</h3>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Onderwerp</th>
                          <th>Acties</th>
                        </tr>
                      </thead>
                      <tbody id="mails"></tbody>
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
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=15" target="_blank">documentatie over mails</a> voor meer info!</p>
                </div>
              </div>
            </div>';
    include('../../template.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){

    //alle mails ophalen 
    $.ajax({
        type: "GET",
        url: "/api/mails/read.php?",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            var response="";
            for(var mail in data){
                response += '<tr class="infoSegmentRow" >'+
                "<td>"+data[mail].titel+"</td>"+
                "<td><a href='update.php?id="+data[mail].mailId+"'>Bewerk</a></td>";
            }
            $(response).appendTo($("#mails"));
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });
</script>