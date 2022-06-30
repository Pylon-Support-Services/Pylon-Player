<!DOCTYPE html>
<html>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js" integrity="sha512-d+dtcSjz831KbYcB3pS7cd3cqlaZ/gbbnZWC4KeLM8AToNtm83Rbc5au5k3bFBh6EwlphOGJtj7oDg6k+NGbPA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnout.com/jquery/"></script>  
<script src="https://kit.fontawesome.com/96d3db657a.js" crossorigin="anonymous"></script>
<script id="js" type="text/javascript" src="index.js"></script>
<link rel="stylesheet" type="text/css" href="index.css">

<title>Account</title>
</head>
<body>

    <!-- HOT -->
    <iframe style="display: none;" src="http://pressplay.gopylonservices.com/silence.mp3" allow="autoplay" id="audio"></iframe>

    <div id="Header">
        <div id="Logo"><img src="http://pressplay.gopylonservices.com/assets/Pylon%20logo-new.png"></div>
        <div id="Center"></div>
        <div id="Profile">
            <img src="http://pressplay.gopylonservices.com/assets/Profile.png">
            <div id="Status"></div>
        </div>
    </div>
    <div id="Platform">
        <div id="Players" class="Container">
            <div class="Header">Players</div>

            <div class="PlayerList">
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
            </div>
        </div>
        <div id="Playlist" class="Container">
            <div class="Header">Playlist</div>

            <div class="Playlist">
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
            </div>


        </div>
        <div id="Content" class="Container">
            <div class="Header">Content</div>

            <div id="ItemList">
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
                <div class="Item">
                    <svg class="sound" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M412.6 181.9c-10.28-8.344-25.41-6.875-33.75 3.406c-8.406 10.25-6.906 25.37 3.375 33.78C393.5 228.4 400 241.8 400 256c0 14.19-6.5 27.62-17.81 36.87c-10.28 8.406-11.78 23.53-3.375 33.78c4.719 5.812 11.62 8.812 18.56 8.812c5.344 0 10.75-1.781 15.19-5.406C435.1 311.6 448 284.7 448 256S435.1 200.4 412.6 181.9zM301.2 34.84c-11.5-5.187-25.01-3.116-34.43 5.259L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9C272.7 477.2 280.3 480 288 480c4.438 0 8.959-.9313 13.16-2.837C312.7 472 320 460.6 320 448V64C320 51.41 312.7 39.1 301.2 34.84z"/></svg>
                    <img src="http://pressplay.gopylonservices.com/content/The%20Risky%20Wilderness.jpg">
                    <video autoplay="true" loop muted >
                        <source src="http://pressplay.gopylonservices.com/content/Pylon Player Enterprise background.mp4" type="video/mp4"/>
                    </video>
                    <div class="label">The Risky Wilderness.jpg</div>
                    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
                </div>

            </div>
        </div>
    </div>
    <div id="TransferBase" class="Closed">
        <div id="Transfer" class=" ">
            <div class="Header">Move <span id="TransferPlayer">Player</span> to new group</div>
            <table>
                <tr class="Heading">
                    <th>Name</th>
                    <th>Display Lock</th>
                    <th>Clock Mode</th>
                    <th>Clock Color</th>
                    <th>Clock Alignment</th>
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
            </table>
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
            </table>
        </div>
    </div>
</body>
</html>