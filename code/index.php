<?php
  $content = '<div class="row">
                <div data-rechten="afdelingHoofd" class="rechten col-md-4 col-sm-6 col-xs-12">
                  <a href="/src/pages/clienten/">
                    <div class="info-box">
                      <!-- Apply any bg-* class to to the icon to color it -->
                      <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Clienten</span>
                        <span class="info-box-number clienten-aantal"></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div data-rechten="admin" class="rechten col-md-4 col-sm-6 col-xs-12">
                  <a href="/src/pages/begeleiders/">
                    <div class="info-box">
                      <!-- Apply any bg-* class to to the icon to color it -->
                      <span class="info-box-icon bg-orange"><i class="fa fa-address-card"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Begeleiders</span>
                        <span class="info-box-number begeleiders-aantal"></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div data-rechten="admin" class="rechten col-md-4 col-sm-6 col-xs-12">
                  <a href="/src/pages/afdelingen/">
                    <div class="info-box">
                      <!-- Apply any bg-* class to to the icon to color it -->
                      <span class="info-box-icon bg-blue"><i class="fa fa-building"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Afdelingen</span>
                        <span class="info-box-number afdelingen-aantal"></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div data-rechten="admin" class="rechten col-md-4 col-sm-6 col-xs-12">
                  <a href="/src/pages/nieuwtjes/">
                    <div class="info-box">
                      <!-- Apply any bg-* class to to the icon to color it -->
                      <span class="info-box-icon bg-red"><i class="fa fa-info"></i> </span>
                      <div class="info-box-content">
                        <span class="info-box-text">Nieuwtjes</span>
                        <span class="info-box-number nieuwtjes-aantal"></span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                

              </div>
              <div class="callout callout-warning ">
                <h4>Tip!</h4>
                <p>Is er ergens iets niet duidelijk? Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf" target="_blank">documentatie</a> als hulpmiddel!</p>
              </div>';
  include('src/template.php');
?>
<script>
  $(document).ready(function(){
    //alle clienten ophalen 
    $.ajax({
        type: "GET",
        url: "/api/client/read.php",
        dataType: 'json',
        success: function(data) {
            $(".clienten-aantal").text(data.length)
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
    //alle begeleiders ophalen 
    $.ajax({
        type: "GET",
        url: "/api/begeleider/read.php",
        dataType: 'json',
        success: function(data) {
            $(".begeleiders-aantal").text(data.length)
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
    //alle afdelingen ophalen 
    $.ajax({
        type: "GET",
        url: "/api/afdeling/read.php?read=all",
        dataType: 'json',
        success: function(data) {
            $(".afdelingen-aantal").text(data.length)
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
    //alle infoSegmenten ophalen 
    $.ajax({
        type: "GET",
        url: "/api/nieuwtjes/read.php",
        dataType: 'json',
        success: function(data) {
            $(".nieuwtjes-aantal").text(data.length)
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });
</script>