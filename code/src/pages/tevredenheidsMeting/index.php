<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title">Tevredenheids Meting</h3>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tevredenheidsMeting" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Google form link</th>
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
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=18" target="_blank">documentatie over de tevredenheids meting</a> voor meer info!</p>
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
        url: "/api/tevredenheidsMeting/read.php",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            if(data['status']== null){
                var response="";

                response += "<tr>"+
                "<td>"+data.formLink+"</td>"+
                "<td><a href='update.php?id="+data.tevredenheidsMetingId+"'>Bewerk</a></td>"+    
                "</tr>";

                $(response).appendTo($("#tevredenheidsMeting"));
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });
</script>
