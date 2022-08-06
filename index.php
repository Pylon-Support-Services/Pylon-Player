<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

    // SQL Connection variables
    $servername = "a2plcpnl0765.prod.iad2.secureserver.net";
    $username = "developer";
    $password = "Champion33";
    $database = "freedom_project";

    // Default return values
    $GroupName = "Default";
    $PlayerName = "Default";
    $Playlist = '{"Content":[ ]}';
    
    // Establish Connection to SQL server
    try{
        $mysqli = new mysqli($servername, $username, $password);
        if($mysqli->connect_errno ) {
            $arr = array('Status' => "Success", "Message" => $mysqli -> connect_error);
            echo json_encode($arr);
        }
        $conn = mysqli_connect($servername,$username,$password,$database) or die(mysqli_error($conn));
        
    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
    

?>

<!DOCTYPE html>
<html>
<head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><!-- <script src="https://cdnout.com/jquery/"></script> -->
<script src="https://kit.fontawesome.com/96d3db657a.js" crossorigin="anonymous"></script>
<script id="js" type="text/javascript" src="javascript.js"></script>
<link rel="stylesheet" type="text/css" href="index.css">

<title>Account</title>
</head>
<body>

    <!-- HOT -->
    <iframe style="display: none;" src="http://pressplay.gopylonservices.com/silence.mp3" allow="autoplay" id="audio"></iframe>

    <div id="Header">
        <a href="http://player.gopylonservices.com">
            <div id="Logo"><img src="http://pressplay.gopylonservices.com/assets/Pylon%20logo-new.png"></div>
        </a>
        <div id="Center"></div>
        <div id="Profile">
            <img src="http://pressplay.gopylonservices.com/assets/Profile.png">
            <div id="Status"></div>
        </div>
    </div>
    <div id="Platform">
        <div id="Players" class="Container">
            <div class="Header">Locations</div>
            <div class="PlayerList">

                <?php
                    // Get Groups
                    $sql = "SELECT * FROM groups";
                    $retval=mysqli_query($conn, $sql); 
                    while($row = mysqli_fetch_assoc($retval)){  

                        // Get Playlist
                        $players = "";
                        $sql = "SELECT * FROM players WHERE GroupName='". $row["Name"] ."'";
                        $Playerretval=mysqli_query($conn, $sql); 
                        while($Playerrow = mysqli_fetch_assoc($Playerretval)){  
                            $Player = $Playerrow['Name'];
                            $players .= '<div class="GroupListPlayer">'. $Player .'</div>';
                        }
                        
                        echo '<div class="Group '. $row["Name"] .' Closed">'.
                        '   <div class="GroupLabel">'.
                        '       <div class="GroupLabelCaret">'.
                        '           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>'.
                        '       </div>'.
                        '       <div class="GroupLabelText">'. $row["Name"] .'</div>'.
                        '       <div class="GroupLabelSelector"></div>'.
                        '   </div>'.
                        '   <div class="GroupList">'.
                                $players .
                        '   </div>'.
                        '</div>';
                    }
                ?>
                <!--
                <div class="Group Default">
                    <div class="GroupLabel">
                        <div class="GroupLabelCaret">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>
                        </div>
                        <div class="GroupLabelText">Default</div>
                        <div class="GroupLabelSelector"></div>
                    </div>
                    <div class="GroupList">
                        <div class="GroupListPlayer">Player1</div>
                        <div class="GroupListPlayer">Player2</div>
                        <div class="GroupListPlayer">Player3</div>
                    </div>
                </div>
                <div class="Group efe Closed">
                    <div class="GroupLabel">
                        <div class="GroupLabelCaret">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"/></svg>
                        </div>
                        <div class="GroupLabelText">efe</div>
                        <div class="GroupLabelSelector"></div>
                    </div>
                    <div class="GroupList">
                        <div class="GroupListPlayer">Player1</div>
                        <div class="GroupListPlayer">Player2</div>
                        <div class="GroupListPlayer">Player3</div>
                    </div>
                </div>
                -->
            </div>
        </div>
        <div id="Playlist" class="Container">
            <div class="Header">Playlist</div>

            <div class="Playlist">
                
                <!--
                <div class="dropzone" id='0' draggable="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>
                    <div class="label">List item 1 of type mp4 in GroupName Playlist.mp4</div>
                    <div class="labelcover"></div>
                    <div class="audio Set" title="Audio 1.mp3">mp3</div>
                    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </div>
                <div class="dropzone" id='1' draggable="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>
                    <div class="label">List item 2.mp4</div>
                    <div class="labelcover"></div>
                    <div class="audio" title="">mp3</div>
                    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </div>
                <div class="dropzone" id='2' draggable="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>
                    <div class="label">List item 3.mp4</div>
                    <div class="labelcover"></div>
                    <div class="audio Set" title="Audio 1.mp3">mp3</div>
                    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </div>
                <div class="dropzone" id='3' draggable="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>
                    <div class="label">List item 4.mp4</div>
                    <div class="labelcover"></div>
                    <div class="audio" title="">mp3</div>
                    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </div>
                <div class="dropzone" id='5' draggable="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H32C14.33 352 0 337.7 0 320C0 302.3 14.33 288 32 288H416zM416 160C433.7 160 448 174.3 448 192C448 209.7 433.7 224 416 224H32C14.33 224 0 209.7 0 192C0 174.3 14.33 160 32 160H416z"/></svg>
                    <div class="label">List item 5.mp4</div>
                    <div class="labelcover"></div>
                    <div class="audio Set" title="Audio 1.mp3">mp3</div>
                    <svg class="remove" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </div>
                -->

            </div>


        </div>
        <div id="Content" class="Container">
            <div class="Header">Content</div>

            <div id="ItemList">

                <!--
                <div class="Item video">
                    <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>
                    <img src="http://pressplay.gopylonservices.com/content/The%20Risky%20Wilderness.jpg">
                    <video autoplay="true" loop muted >
                        <source src="http://pressplay.gopylonservices.com/content/Pylon Player Enterprise background.mp4" type="video/mp4"/>
                    </video>
                    <div class="label">Pylon Player Enterprise background.mp4</div>
                    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                </div>
                <div class="Item">
                    <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>
                    <img src="http://pressplay.gopylonservices.com/content/The%20Risky%20Wilderness.jpg">
                    <video autoplay="true" loop muted >
                        <source src="http://pressplay.gopylonservices.com/content/Pylon Player Enterprise background.mp4" type="video/mp4"/>
                    </video>
                    <div class="label">The Risky Wilderness.jpg</div>
                    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                </div>
                <div class="Item video">
                    <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>
                    <img src="http://pressplay.gopylonservices.com/content/The%20Risky%20Wilderness.jpg">
                    <video autoplay="true" loop muted >
                        <source src="http://pressplay.gopylonservices.com/content/Print Shop Ad.mp4" type="video/mp4"/>
                    </video>
                    <div class="label">Print Shop Ad.mp4</div>
                    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                </div>
                -->

            </div>
        </div>
    </div>
    <div id="TransferBase" class="Closed">
        <div id="Transfer" class=" ">
            <div class="Header">Move <span id="TransferPlayer">Player</span> to another new group</div>
            
            <table>
                <tr class="Heading GroupDetails">
                    <th>Name</th>
                    <th>Display Lock</th>
                    <th>Clock Mode</th>
                    <th>Clock Color</th>
                    <th>Clock Alignment</th>
                </tr>
            </table>
            <div class="TableContainer">
                <table>
                    <?php
                        // Get Groups
                        $sql = "SELECT * FROM groups";
                        $retval=mysqli_query($conn, $sql); 
                        while($row = mysqli_fetch_assoc($retval)){  
                            echo '<tr class="GroupDetails">'.
                        '    <td class="GroupDetailsName">'. $row["Name"] .'</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '</tr>';
                        }
                    ?>

                    <!--
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">Default</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">efe</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">Default</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">efe</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">Default</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">efe</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">Default</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="GroupDetails">
                        <td class="GroupDetailsName">efe</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    -->
                </table>
            </div>
        </div>
    </div>

    <div id="AudioBase" class="Closed">
        <div id="Audio" class=" ">
            <div class="Header">Select background audio for <span id="AudioContent">Content.png</span> </div>
            
            <table>
                <tr class="Heading">
                    <th>Source</th>
                    <th>Label</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Duration</th>
                </tr>
            </table>
            <div class="TableContainer">

                <table>

                    <?php
                        // Get Groups
                        $sql = "SELECT * FROM content WHERE Type='audio/mpeg'";
                        $retval=mysqli_query($conn, $sql); 
                        while($row = mysqli_fetch_assoc($retval)){  
                            echo '<tr class="AudioDetails">'.
                        '    <td class="AudioDetailsName">'. $row["Source"] .'</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '    <td>--</td>'.
                        '</tr>';
                        }
                    ?>
                    <!--
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 1.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 2.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 1.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 2.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 1.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr class="AudioDetails">
                        <td class="AudioDetailsName">Audio 2.mp3</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    -->
                </table>
            </div>
        </div>
    </div>

    <div id="Upload" class="loading ">
        <div id="UploadContainer">
            <svg id="UploadIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M105.4 182.6c12.5 12.49 32.76 12.5 45.25 .001L224 109.3V352c0 17.67 14.33 32 32 32c17.67 0 32-14.33 32-32V109.3l73.38 73.38c12.49 12.49 32.75 12.49 45.25-.001c12.49-12.49 12.49-32.75 0-45.25l-128-128C272.4 3.125 264.2 0 256 0S239.6 3.125 233.4 9.375L105.4 137.4C92.88 149.9 92.88 170.1 105.4 182.6zM480 352h-160c0 35.35-28.65 64-64 64s-64-28.65-64-64H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456z"/></svg>
            <div id="UploadLoader">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/></svg>
            </div>
        </div>
        <label for="file"></label>
        <input type="file" id="file" name="file">
    </div>

    <div id="UploadPercentage"></div>

    <video id="VideoUpload" width="320" height="176" controls>
        <source src="" type="video/mp4">
    </video>


</body>
</html>
