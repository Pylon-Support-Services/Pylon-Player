var baseURL = "http://player.gopylonservices.com/";
//var baseURL = "http://localhost/pylon player/";
$(document).ready(function(){
    var SelectedGroup = "Default";
    var oldSelectedGroup = "Default";
    // document.URL refers to the current url
    var hash = new URL(document.URL).hash;

    var find = '%20';
    var re = new RegExp(find, 'g');

    SelectedGroup = hash.replace("#", "").replace(re, ' ');
    var hashGroup = SelectedGroup;
    oldSelectedGroup = SelectedGroup;
    console.log("G: "+ SelectedGroup);
    $(".Group").addClass("Closed");
    if(SelectedGroup != "") $(".GroupLabelText:contains('"+ SelectedGroup +"')").parents(".Group").removeClass("Closed");
    console.log("Set: "+ hashGroup);
    $(document).on("click",".Group",function() {
        
        $(".Group").not(this).addClass("Closed");
        //Enabling this makes the Group UI glitch
        SelectedGroup = $(this).find(".GroupLabelText").text();

        var find = '%20';
        var re = new RegExp(find, 'g');
        hashGroup = hash.replace("#", "").replace(re, ' ');

        if(hashGroup == SelectedGroup) $(this).toggleClass("Closed");

        console.log(hashGroup, SelectedGroup);

        if(SelectedGroup == oldSelectedGroup) return;
        
        $("#Upload").addClass("loading");

        window.location.href = baseURL +"account/#"+ SelectedGroup;
        $(".Playlist").html("loading...");
        $("#ItemList").html("loading...");

        //await new Promise(resolve => setTimeout(resolve, 250));
        console.log("h: "+ hashGroup);
        window.location.reload(false);

        oldSelectedGroup = SelectedGroup;
    });

    $(document).on("contextmenu","#Players",function() {
        $("#Upload").addClass("loading");
        let NewGroup = prompt("Create new group");
        if (NewGroup != null) {
            var data = new FormData();
            data.append('group', NewGroup);
            console.log(NewGroup);
            $.ajax({
                url: "http://pressplay.gopylonservices.com/group-create.php",
                type: 'POST',
                dataType: 'json',
                data: data,
                processData: false,
                contentType: false,
                enctype: 'text/plain',
                success: function(result)
                {
                    $("#Upload").removeClass("loading");
                    console.log(result);

                    window.location.href = baseURL +"account/#"+ NewGroup;

                    window.location.reload(true);
                }
            });
        }

        return false;
    });


    // Get Playlist
    var data = new FormData();
    data.append('group', SelectedGroup);
    $.ajax({
        url: "http://pressplay.gopylonservices.com/group-playlist.php",
        type: 'POST',
        dataType: 'JSON',
        data: data,
        processData: false,
        contentType: false,
        enctype: 'application/json; charset=utf-8;',
        success: function(data)
        {
            console.log(data);
            if(SelectedGroup == ""){
                $("#Playlist").find(".Playlist").html("Select a group to view playlist!");
                $("#Content").find("#ItemList").html("Select a group to view content!");

                $("#Upload").removeClass("loading");
                return;
            }
            const obj = JSON.parse(data);
            //const obj = data;

            if (obj['Content'] == null){

                $("#Playlist").find(".Playlist").html("Select a group to view playlist!");

                $("#Upload").removeClass("loading");
                return;
            }
            //console.log(obj['Content']);
            //console.log(obj['Content'].length);
            $("#Playlist").find(".Playlist").html("");
            for(var i=0; i<obj['Content'].length; i++){
                var d = new Date();
                var n = d.getMilliseconds();
                //console.log("ns: "+ n);

                var id = "NULL";
                if(obj['Content'][i]['ContentID'] != null){
                    id = obj['Content'][i]['ContentID'];
                }

                var Name = obj['Content'][i]['FileName'];
                var Audio = obj['Content'][i]['BackgroundAudio'];
                var Duration = obj['Content'][i]['PlayDuration'];
                var AudioState = "";
                if(Audio != "") AudioState = "Set";
                var ListItem = '<div class="dropzone" id='+ n +' draggable="true">'+
                '    <div class="id">'+ id +'</div>'+
                '    <div class="duration">'+ Duration +'</div>'+
                '    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>'+
                '    <div class="label">'+ Name +'</div>'+
                '    <div class="labelcover"></div>'+
                '    <div class="audio '+ AudioState +'" title="'+ Audio +'">mp3</div>'+
                '    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>'+
                '</div>';


                $("#Playlist").find(".Playlist").append(ListItem);
            }

            if(obj['Content'].length == 0) $("#Playlist").find(".Playlist").html("No Items");
                    
            // Get Content
            var data2 = new FormData();
            data2.append('group', SelectedGroup);
            $.ajax({
                url: "http://pressplay.gopylonservices.com/group-content.php",
                type: 'POST',
                dataType: 'json',
                data: data2,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(data2)
                {

                    $("#Upload").removeClass("loading");

                    console.log("data2");
                    console.log(data2);
                    const obj = data2;
                    //console.log(SelectedGroup);
                    $("#Content").find("#ItemList").html("");
                    var ValidContentCount = 0;
                    for(var i=0; i<data2.length; i++){
                        
                        var id = data2[i]['id'];
                        var Name = data2[i]['Label'];
                        var Duration = data2[i]['Duration'];
                        var imgSource = "";
                        var vidSource = "";
                        var State = "";
                        if(data2[i]['Type'] == "image/jpeg" || data2[i]['Type'] == "image/png") imgSource = "http://pressplay.gopylonservices.com/content/"+ data2[i]['Source'];
                        if(data2[i]['Type'] == "video/mp4"){
                            vidSource = "http://pressplay.gopylonservices.com/content/"+ data2[i]['Source'];
                            State = "video";
                        } 
                                        
                        console.log(data2[i]['Type']);
                        if(data2[i]['Type'] == "audio/mp3" || data2[i]['Type'] == "audio/mpeg"){
                            continue;
                        } 

                        var ContentItem = '<div class="Item '+ State +'">'+
                        '    <div class="id">'+ id +'</div>'+
                        '    <div class="duration">'+ Duration +'</div>'+
                        '    <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>'+
                        '    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/></svg>'+
                        '    <img src="'+ imgSource +'">'+
                        '    <video autoplay="true" loop muted >'+
                        '        <source src="'+ vidSource +'" type="video/mp4"/>'+
                        '    </video>'+
                        '    <div class="label">'+ Name +'</div>'+
                        '    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>'+
                        '</div>';    
                            


                        $("#Content").find("#ItemList").append(ContentItem);

                        ValidContentCount++;
                    }
                        
                    if(ValidContentCount == 0) $("#Content").find("#ItemList").html("No Items");


                }
            });


        }
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
        $("#Upload").addClass("loading");

        //alert(SelectedPlayer +" was moved to group: "+ $(this).find(".GroupDetailsName").text());
        var TransferGroup = $(this).find(".GroupDetailsName").text();
        
        $(".Group."+ SelectedGroup).find(".GroupListPlayer:contains('"+ SelectedPlayer +"')").remove();
        $(".Group."+ TransferGroup).find(".GroupList").append('<div class="GroupListPlayer">'+ SelectedPlayer +'</div>');
        

        var data = new FormData();
        data.append('player', SelectedPlayer);
        data.append('group', TransferGroup);

        $.ajax({
            
            url: "http://pressplay.gopylonservices.com/transfer.php",
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(data)
            {
                $("#Upload").removeClass("loading");


                console.log(data);

                SelectedGroup = $(this).find(".GroupDetailsName").text();

                window.location.href = baseURL +"account/#"+ TransferGroup;

                window.location.reload(true);
                console.log("Tr: "+TransferGroup);
                console.log("Pl: "+SelectedPlayer);
            }
        });

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


        SavePlaylist();
    });
    $(document).on("contextmenu",".audio",function() {
        $(this).prop("title", "");
        $(this).removeClass("Set");
        return false;
    });
    
    $(document).on("click",".Playlist .dropzone .remove",function() {
        $(this).parents(".dropzone").remove();

        if($("#Playlist").find(".Playlist").html() == ""){
            $("#Playlist").find(".Playlist").html("No Items");
        }

        SavePlaylist();
    });

    $(document).on("click",".Item",function(e) {
        //if(e.target != this) return;
        //console.log(e.target);
        if(e.target != this) return;
        //alert($(this).find(".label").text() +" was added to playlist");
        var id = $(this).find(".id").text();


        $("#Upload").addClass("loading");


        if($("#Playlist").find(".Playlist").html() == "No Items"){
            $("#Playlist").find(".Playlist").html("");
        }


        var PlaylistItem = '<div class="dropzone" id="'+Date.now()+'" draggable="true">'+
        '   <div class="id">'+ id +'</div>'+
        '   <div class="duration">'+ $(this).find(".duration").text() +'</div>'+
        '   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>'+
        '   <div class="label">'+$(this).find(".label").text()+'</div>'+
        '   <div class="labelcover"></div>'+
        '   <div class="audio" title="">mp3</div>'+
        '   <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>'+
        '</div>';
        $(".Playlist").append(PlaylistItem);



        // Save Playlist
        SavePlaylist();
        /*
        var data = new FormData();
        data.append('playlist', PlaylistData);
        data.append('group', SelectedGroup);
        $.ajax({
            url: "http://pressplay.gopylonservices.com/group-save.php",
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(result)
            {
                console.log("result");
                console.log(result);
                $("#Upload").removeClass("loading");
            }
        });
        */

    });

    var Sound = false;
    $(document).on("mouseover",".Item",function() {
        Sound = true;
        $(this).find("video").prop("muted", false);
    });
    $(document).on("mouseleave",".Item",function() {
        Sound = false;
        $(this).find("video").prop("muted", true);
    });

    $(document).on("click",".Item .remove",function(e) {
        $(this).parents(".Item").remove();
        $("#Upload").addClass("loading");
        var id = $(this).parents(".Item").find(".id").text();

        // Make request to server to delete content
        var data = new FormData();
        data.append('id', id);
        $.ajax({
            
            url: "http://pressplay.gopylonservices.com/content-delete.php",
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(result)
            {
                console.log("result");
                console.log(result);
                $("#Upload").removeClass("loading");
                $(".dropzone .id:contains('"+ id +"')").parents(".dropzone").remove();
                if($("#Playlist").find(".Playlist").html() == ""){
                    $("#Playlist").find(".Playlist").html("No Items");
                }

                if($("#Content").find("#ItemList").html() == ""){
                    $("#Content").find("#ItemList").html("No Items");
                }

                SavePlaylist();
            }
        });
    });


    const getVideoDuration = (file) =>
    new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.onload = () => {
        const media = new Audio(reader.result);
        media.onloadedmetadata = () => resolve(media.duration);
      };
      reader.readAsDataURL(file);
      reader.onerror = (error) => reject(error);
    });

    $(document).on("change","#file",function() {
        if($("#file").prop('files')[0] == null) return false;
        console.log($("#file").prop('files')[0]);
        var file = $("#file").prop('files')[0];
        var name = file.name;
        var type = "";
        var imgSRC = "";
        var vidSRC = "";
        var group = $(".Group:not('.Closed')").find(".GroupLabelText").text();
        if(file.type == "video/mp4"){
            type = "video";
            vidSRC = "http://pressplay.gopylonservices.com/content/"+ name;
            $("#VideoUpload source").attr("src", URL.createObjectURL(file) );
            $("#VideoUpload")[0].load();
            $("#VideoUpload")[0].addEventListener('loadeddata', (event) => {
                console.log($("#VideoUpload")[0].duration);
                var duration = $("#VideoUpload")[0].duration;
                UploadFile(file, group, duration, type, imgSRC, vidSRC, name);
            });
        }else
        if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){
            imgSRC = "http://pressplay.gopylonservices.com/content/"+ name;
            UploadFile(file, group, 7, type, imgSRC, vidSRC, name);
        }else{
            $("#Upload").addClass("ERROR");
        }
    });


    function UploadFile(file, group, duration, type, imgSRC, vidSRC, name, folder=""){
        $("#Upload").addClass("loading");
        $("#UploadPercentage").css("width", "0%");
        $("#UploadPercentage").addClass("loading");

        var data = new FormData();
        data.append('file', file);
        data.append('group', group);
        data.append('source', file.name);
        data.append('label', file.name);
        data.append('type', file.type);
        data.append('size', file.size);
        data.append('duration', duration);
        data.append('folder', folder);

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $("#UploadPercentage").css("width", percentComplete +"%");                
                    if (percentComplete === 100) {
                        $("#UploadPercentage").removeClass("loading");
                    }
                    }
                }, false);
                return xhr;
            },
            url: "http://pressplay.gopylonservices.com/upload.php",
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(data)
            {
                console.log(data);
                $("#Upload").removeClass("loading");


                var Item = '<div class="Item '+ type +'">'+
                '   <div class="id">'+ id +'</div>'+
                '   <div class="duration">'+ duration +'</div>'+
                '   <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>'+
                '    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/></svg>'+
                '   <img src="'+ imgSRC +'">'+
                '   <video autoplay="true" loop muted >'+
                '       <source src="'+ vidSRC +'" type="video/mp4"/>'+
                '   </video>'+
                '   <div class="label">'+ name +'</div>'+
                '   <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>'+
                '</div>';

                if($("#Content").find("#ItemList").html() == "No Items"){
                    $("#Content").find("#ItemList").html("");
                }
                $("#ItemList").append(Item);
            }
        });
    }

    function SavePlaylist(){
        $("#Upload").addClass("loading");

        console.log($(".Playlist").find(".dropzone").length);

        var liststart = '{"Content":[';
        var listend = ']}';
        const PlaylistItems = $(".Playlist").find(".dropzone");
        var listcontents = "";    
        var count = 0;
        var AccumulatedTime = 0;
        $(".dropzone").each(function() {
            console.log($(this).find(".label").text());
            var ContentID = $(this).find(".id").text();
            var FileName = $(this).find(".label").text();
            var BackgroundAudio = $(this).find(".audio").prop("title");
            var Duration = parseInt($(this).find(".duration").text());
            listcontents += '{'+
            '"ContentID":"'+ ContentID +'",'+
            '"FileName":"'+ FileName +'",'+
            '"PlayDuration":"'+ Duration +'",'+
            '"BackgroundAudio":"'+ BackgroundAudio +'",'+
            '"StartTime":"'+ AccumulatedTime +'",'+
            '"EndTime":"'+ (AccumulatedTime + Duration) +'"'+
            '}';
            AccumulatedTime += Duration;
            count++;
            if(count < $(".dropzone").length) listcontents += ",";
        });
        var PlaylistData = liststart + listcontents + listend;
        
        console.log(PlaylistData);
        
        var data = new FormData();
        data.append('group', SelectedGroup);
        data.append('playlist', PlaylistData);
        $.ajax({
            url: "http://pressplay.gopylonservices.com/group-save.php",
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(result)
            {
                console.log("result");
                console.log(result);
                $("#Upload").removeClass("loading");
            }
        });
    }
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
        //console.log(index, indexDrop);
        if(index > indexDrop) {
            target.before( dragged );
        }else{
            target.after( dragged );
        }
    }
});
