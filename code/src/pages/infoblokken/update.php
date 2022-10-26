<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Info blok bewerken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="titel">Titel*</label>
                          <input type="text" class="form-control" name="titel" id="titel" placeholder="Enter Titel">
                        </div>
                        <div class="form-group">
                          <label>Blok Foto</label>
                          <p>Geef een url in van een foto die online staat, of upload een nieuwe foto van op je pc. <br>
                          De geuploade foto zijn url zal dan hieronder worden ingevult.</p>
                          <input type="text" class="form-control" name="blokFotoUrl" id="blokFotoUrl" placeholder="Enter blok foto url">
                          <br>
                          <input type="file" class="form-control" id="blokFotoFile" name="upload">
                        </div>
                        <div class="form-group">
                            <label for="meerInfoLink">MeerInfoLink</label>
                            <input type="text" class="form-control" id="meerInfoLink" placeholder="Enter meerInfoLink">
                        </div>
                        <div class="form-group">
                          <label for="inhoud">Inhoud</label><br>
                          <textarea id="inhoud" class="editor" name="inhoud" rows="10" style="width:100%;" placeholder="Enter inhoud"></textarea>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateInfoBlok()" value="Bewerk"></input>
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
  var infoSegmentId = 0
  $(document).ready(function(){
    CKEDITOR.on('instanceReady', function(){
      $.ajax({
        type: "GET",
        url: "/api/infoBlok/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            infoSegmentId = data['infoSegmentId'];
            $('#titel').val(data['titel']);
            $('#inhoud').val(data['inhoud']);
            $('#blokFotoUrl').val(data['blokFotoUrl']);
            $('#meerInfoLink').val(data['meerInfoLink']);
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')
        },
        error: function (result) {
            console.log("Failed to get info blok");
        },
      });
    }); 
  });
  function UpdateInfoBlok(){
    if(validateForm()){
      $(".overlay").css("display",'block')

      //de inhoud bewerken zodat mogelijke errors vermeden worden 
      var inhoud = $("#inhoud").val().replaceAll(`"`,`'`)
      inhoud = inhoud.replaceAll("<p>​</p>"," ")

      var files = $("#blokFotoFile").prop('files');

      if(files.length > 0) {
        //foto file in formdata steken 
        var fd = new FormData()
        fd.append("upload",files[0]);

        $.ajax({
          type: "POST",
          url: '/api/infoBlok/imageUpload.php',
          dataType: 'json',
          data: fd,
          contentType: false,
          processData: false,
          success: function (result) {
            if (result['status'] == true) {
              $.ajax({
                type: "POST",
                url: '/api/infoBlok/update.php',
                dataType: 'json',
                data: {
                    infoBlokId: <?php echo $_GET['id']; ?>,
                    titel: $("#titel").val(),
                    inhoud: inhoud,
                    blokFotoUrl: result['url'],        
                    meerInfoLink: $("#meerInfoLink").val(),        
                    infoSegmentId: infoSegmentId,
                },
                error: function (result) {
                  $(".overlay").css("display",'none')
                  alert(result.responseText);
                },
                success: function (result) {
                    if (result['status'] == true) {
                      //going back to previous page and refreshing
                      window.location=document.referrer;
                    }
                    else {
                      $(".overlay").css("display",'none')
                      console.log(result)
                      alert(result['message']);
                    }
                }
              });
            }
            else {
              $(".overlay").css("display",'none')
              alert(result['message']);
            }
          },
          error: function (result) {
            $(".overlay").css("display",'none')
            alert(result.responseText);
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: '/api/infoBlok/update.php',
          dataType: 'json',
          data: {
              infoBlokId: <?php echo $_GET['id']; ?>,
              titel: $("#titel").val(),
              inhoud: inhoud,
              blokFotoUrl: $("#blokFotoUrl").val(),        
              meerInfoLink: $("#meerInfoLink").val(),        
              infoSegmentId: infoSegmentId,
          },
          error: function (result) {
            $(".overlay").css("display",'none')
            alert(result.responseText);
          },
          success: function (result) {
              if (result['status'] == true) {
                //going back to previous page and refreshing
                window.location=document.referrer;
              }
              else {
                $(".overlay").css("display",'none')
                console.log(result)
                alert(result['message']);
              }
          }
        });
      }
    }
  }
  function validateForm() {
    var titel = document.forms["form"]["titel"].value;
    var blokFotoType = "image";
    if($("#blokFotoFile").prop('files').length > 0){
      blokFotoType = $("#blokFotoFile").prop('files')[0].type
    }
    if (titel == "") {
      alert("Titel moet ingevult zijn");
      return false;
    } else if(blokFotoType.indexOf("image") == -1){
      alert("Het geselecteerde bestand voor de blokfoto moet een jpeg, jpg of png bestand zijn.");
      return false;
    } else {
      return true;
    }
  }
</script>