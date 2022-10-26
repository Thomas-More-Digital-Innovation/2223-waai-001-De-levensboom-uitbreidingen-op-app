<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Info segment bewerken</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="titel">Titel*</label>
                          <input type="text" class="form-control" name="titel" id="titel" placeholder="Enter Titel">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateInfoSegment()" value="Bewerk"></input>
                      </div>
                    </form>
                    <div class="overlay" >
                      <i class="fa fa-refresh fa-spin"></i>
                    </div>
                  </div>
                  <!-- /.box -->
                </div>
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Infoblokken</h3>
                      <a id="createInfoBlok"  onClick="" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                      <table class="table table-bordered table-hover">
                        <thead> 
                          <tr>
                            <th>Title</th>
                            <th>Acties</th>
                          </tr>
                        </thead> 
                        <tbody id="infoblokken">
                        </tbody>
                      </table>
                    </div>
                    <div class="overlay" >
                      <i class="fa fa-refresh fa-spin"></i>
                    </div>
                  </div>
                  <!-- /.box -->
                  <div class="callout callout-warning ">
                    <h4>Tip!</h4>
                    <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=11" target="_blank">documentatie over info blokken</a> voor meer info!</p>
                  </div>
                </div>
              </div>';
  include('../../template.php');
?>

<script>
  var isVolwassenen;
  var backLink = "/src/pages/infoSegmenten/index.php?type="
  $(document).ready(function(){
    var fixHelper = function(e, ui) {
      ui.children().each(function() {
        $(this).width($(this).width())
      });
      return ui;
    }
    $('tbody').sortable({
      helper: fixHelper,
      stop: function(event, ui) {
        UpdateInfoBlokOrder() ;
      }
    }).disableSelection();
    $.ajax({
        type: "GET",
        url: "/api/infoSegment/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')

            $('#titel').val(data["titel"]);
            $('#volgordeNr').val(data['volgordeNr']);
            isVolwassenen = data['isVolwassenen'];
            $("#createInfoBlok").attr("onClick",'UpdateInfoSegment("/src/pages/infoblokken/create.php?id='+<?php echo $_GET["id"]; ?>+'", false)');
            if(isVolwassenen){
              backLink += "'volwassenen'"
            } else {
              backLink += "'jongeren'"
            }

        },
        error: function (result) {
            console.log("Failed to get info segment");
        },
    });
    $.ajax({
        type: "GET",
        url: "/api/infoBlok/readForSegment.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
          if(data['status'] == null){
            var response="";
            for(var infoBlok in data){
                response += '<tr class="infoBlokRow" data-id="'+data[infoBlok].infoBlokId+'">'+
                "<td>"+data[infoBlok].titel+"</td>"+
                "<td><a href='#' onClick='UpdateInfoSegment(\"/src/pages/infoblokken/update.php?id="+data[infoBlok].infoBlokId+"\", false)'>Bewerk</a> |"+
                " <a href='#' onClick=Remove('"+data[infoBlok].infoBlokId+"')>Verwijder</a>"+
                '<span class="dragIcon"><i class="fa fa-bars"></span></td>'
                "</tr>";
            }
            $(response).appendTo($("#infoblokken"));
          }
        },
        error: function (result) {
            console.log("Failed to get info blok");
        },
    });
  });

  function UpdateInfoSegment(navLink = backLink, alerten = false){
    if(validateForm()){
      UpdateInfoBlokOrder()
      $.ajax({
        type: "POST",
        url: '/api/infoSegment/update.php',
        dataType: 'json',
        data: {
            infoSegmentId: <?php echo $_GET['id']; ?>,
            titel: $("#titel").val(),    
            isVolwassenen: isVolwassenen
        },
        error: function (result) {
            console.log("infosegmenten updaten gefaalt")
            console.log(result)
            alert(result.responseText);
        },
        success: function (result) {
            if (result['status'] == true) {
                if(alerten == true){
                  alert("Info segment succesvol geupdate!");
                }
                window.location.href = navLink;
            }
            else {
              UpdateInfoSegment()
              alert(result['message']); 
            }
        }
      });
    }
  }

  function Remove(id){
    var result = confirm("Ben je zeker dat je deze info blok wilt verwijderen?"); 
    if (result == true) { 
        UpdateInfoSegment("", false);
        $.ajax({
            type: "POST",
            url: '/api/infoBlok/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Info blok is succesvol verwijdert!");
                    location.reload();
                }
                else {
                    alert(result['message']);
                }
            },
            error: function (result) {
              console.log("Delete error")
              console.log(result)
            }
        });
    }
  }

  function UpdateInfoBlokOrder() {
    var infoBlokken = [] 
    $(".infoBlokRow").each(function( index ) {
      infoBlok_item = []
      infoBlok_item.push($(this).attr("data-id"))
      infoBlok_item.push(index)
      infoBlokken.push(infoBlok_item)
    });
    console.log(infoBlokken)
  
    $.ajax(
    {
        type: "POST",
        url: '/api/infoBlok/updateVolgorde.php',
        dataType: 'json',
        data: {
            volgordeArray: infoBlokken,
        },
        error: function (result) {
            //alert(result.responseText);
        },
        success: function (result) {
            if (result['status'] != true) {
              //alert(result['message']);
            }
        }
    });
  }

  function validateForm() {
    var titel = document.forms["form"]["titel"].value;
    if (titel == "") {
      alert("Titel moet ingevult zijn");
      return false;
    } else {
      return true;
    }
  }
</script>