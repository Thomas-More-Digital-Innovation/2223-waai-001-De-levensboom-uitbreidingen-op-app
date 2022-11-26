<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header" style="padding-bottom: 0px">
                    <h3 class="box-title"></h3>
                    <a href="" id="createLink" style="float: right; font-size: 2.2rem;"><i class="fa fa-plus"></i></a>
                  </div>                    
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Titel</th>
                        <th>Info blokken</th>
                        <th>Acties</th>
                      </tr>
                      </thead>
                      <tbody id="infoSegmenten">
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
                  <p>Bekijk de <a href="/src/assets/De_Waaiburg_webapp_documentatie.pdf#page=10" target="_blank">documentatie over info segmenten</a> voor meer info!</p>
                </div>
              </div>
            </div>';
    include('../../template.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    //get type of infoSegment
    var type =  <?php echo $_GET['type']; ?>;
    console.log(type);
    var createLink = "/src/pages/infoSegmenten/create.php?type='"+type+"'"
    console.log(createLink);
    $("#createLink").attr("href", createLink)

    //place title
    $(".box-title").text('Info Segmenten voor '+type)

    //De tabel rows drag and drop able maken
    var fixHelper = function(e, ui) {
      ui.children().each(function() {
        $(this).width($(this).width())
      });
      return ui;
    }
    $('tbody').sortable({
      helper: fixHelper,
      stop: function(event, ui) {
        SaveSegmentOrder();
      }
    }).disableSelection();

    //alle infoSegmenten ophalen 
    $.ajax({
        type: "GET",
        url: "/api/infoSegment/read.php?read="+type,
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var infoSegment in data){
                response += '<tr class="infoSegmentRow" data-id="'+data[infoSegment].infoSegmentId+'">'+
                "<td>"+data[infoSegment].titel+"</td>"+
                '<td id="infoBlokken'+data[infoSegment].infoSegmentId+'" > </td>'+
                "<td><a href='update.php?id="+data[infoSegment].infoSegmentId+"'>Bewerk</a> | <a href='#' onClick=Remove('"+data[infoSegment].infoSegmentId+"')>Verwijder</a>"+
                '<span class="dragIcon"><i class="fa fa-bars"></i></span> </td>'+
                "</tr>";
                getInfoBlokken(data[infoSegment].infoSegmentId);
            }
            $(response).appendTo($("#infoSegmenten"));
            SaveSegmentOrder()
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  });

  //functie om een segment te verwijderen
  function Remove(id){
    var result = confirm("Ben je zeker dat je dit info segment wilt verwijderen?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '/api/infoSegment/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    //alert("Info segment succesvol verwijdert!");
                    location.reload();
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }

  //functie die lijst met info blok titels in de table row plaatst van het overeenkomende segment.
  function getInfoBlokken(infoSegmentenId) {
    $.ajax({
        type: "GET",
        url: "/api/infoBlok/readForSegment.php?id="+infoSegmentenId,
        dataType: 'json',
        success: function(data) {
          var blokkenLijst="<ol style='padding-inline-start: 15px ;'>";
            if(data.length > 0) {
              for(var blok in data){
                blokkenLijst += "<li>"+data[blok].titel+"</li>"
              }
              blokkenLijst+="</ol>"
            } else {
              blokkenLijst = "<p class='small'>Geen info blokken<p>"
            }
            $(blokkenLijst).appendTo($("#infoBlokken"+infoSegmentenId));
            
            //loading animation wegdoen wanneer geladen
            $(".overlay").css("display",'none')
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
  }

  //Volgorde van infosegmenten updaten wanneer deze verandert zijn
  var segVolgorde = [] 
  function SaveSegmentOrder(){
    var changed = false;
    var changedSegVolgorde = [];
    $(".infoSegmentRow").each(function( index ) {
      infoSegment_item = []
      infoSegment_item.push($(this).attr("data-id"))
      infoSegment_item.push(index)
      changedSegVolgorde.push(infoSegment_item)
    });
    for (var i = 0; i < segVolgorde.length; ++i) {
      if (segVolgorde[i][0] !== changedSegVolgorde[i][0]){
        changed = true;
      } 
    }
    segVolgorde = changedSegVolgorde
    console.log(segVolgorde)

    if(changed){
      $.ajax(
      {
          type: "POST",
          url: '/api/infoSegment/updateVolgorde.php',
          dataType: 'json',
          data: {
              volgordeArray: segVolgorde,
          },
          error: function (result) {
              alert(result.responseText);
          },
          success: function (result) {
              if (result['status'] != true) {
                alert(result['message']);
              }
              console.log("Changed")
          }
      });
    } else {
      console.log("Not changed")
    }
  }
</script>
