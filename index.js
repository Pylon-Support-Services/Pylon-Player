$(document).ready(function(){
    var SelectedGroup = "Default";
    $(document).on("click",".Group",function() {
        $(".Group").not(this).addClass("Closed");
        $(this).toggleClass("Closed");

        SelectedGroup = $(this).find(".GroupLabelText").text();
    });

    var SelectedPlayer = "";
    $(document).on("click",".GroupListPlayer",function() {
        $("#TransferBase").removeClass("Closed");
        $("#TransferPlayer").text($(this).text());
        SelectedPlayer = $(this).text();
        //alert($(this).text());

        $(this).parents(".Group").toggleClass("Closed");
    });
    $(document).on("click","#TransferBase",function() {
        $(this).addClass("Closed");
    });
    $(document).on("click","#TransferBase .GroupDetails",function() {
        //alert(SelectedPlayer +" was moved to group: "+ $(this).find(".GroupDetailsName").text());
        $(".Group."+ SelectedGroup).find(".GroupListPlayer:contains('"+ SelectedPlayer +"')").remove();
        $(".Group."+ $(this).find(".GroupDetailsName").text()).find(".GroupList").append('<div class="GroupListPlayer">'+ SelectedPlayer +'</div>');
        // Make ajax call to server
    });
    
    $(document).on("click","#AudioBase",function() {
        $(this).addClass("Closed");
    });
    var SelectedContent = "";
    $(document).on("click",".audio",function() {
        $("#AudioBase").removeClass("Closed");
        SelectedContent = $(this).siblings(".label").text();
        $("#AudioContent").text(SelectedContent);
    });
    $(document).on("click",".AudioDetails",function() {
        
        $("#Playlist .label:contains('"+ SelectedContent +"')").siblings(".audio").addClass("Set");
        //alert("Background Audio was added to "+ SelectedContent);
        $("#Playlist .label:contains('"+ SelectedContent +"')").siblings(".audio").prop('title', $(this).find(".AudioDetailsName").text());
    });
    $(document).on("contextmenu",".audio",function() {
        $(this).prop("title", "");
        $(this).removeClass("Set");
        return false;
    });
    
    $(document).on("click",".Playlist .dropzone .remove",function() {
        $(this).parents(".dropzone").remove();
    });

    $(document).on("click",".Item",function() {
        //alert($(this).find(".label").text() +" was added to playlist");

        var PlaylistItem = '<div class="dropzone" id="'+Date.now()+'" draggable="true">'+
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>'+
            '<div class="label">'+$(this).find(".label").text()+'</div>'+
            '<div class="labelcover"></div>'+
            '<div class="audio" title="">mp3</div>'+
            '<svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>'+
        '</div>';
        $(".Playlist").append(PlaylistItem);
    });
});



let dragged;
let id;
let index;
let indexDrop;
let list;

  document.addEventListener("dragstart", ({target}) => {
      dragged = target;
      id = target.id;
      list = target.parentNode.children;
      for(let i = 0; i < list.length; i += 1) {
        if(list[i] === dragged){
          index = i;
        }
      }
  });

  document.addEventListener("dragover", (event) => {
      event.preventDefault();
  });

  document.addEventListener("drop", ({target}) => {
   if(target.className == "dropzone" && target.id !== id) {
       dragged.remove( dragged );
      for(let i = 0; i < list.length; i += 1) {
        if(list[i] === target){
          indexDrop = i;
        }
      }
      console.log(index, indexDrop);
      if(index > indexDrop) {
        target.before( dragged );
      } else {
       target.after( dragged );
      }
    }
  });