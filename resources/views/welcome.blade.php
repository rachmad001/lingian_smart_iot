<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    
    <link rel="stylesheet" href="/fontawesome-6.3.0/css/all.css">
    <script src="/fontawesome-6.3.0/js/fontawesome.min.js"></script>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }

        body {
            height: 100%;
            width: 100%;
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: 75px auto 75px;
        }
        
        .header {
            /* border: 2px solid red; */
        }
        .logo {
            width: fit-content;
            margin-top: 0px;
            margin: auto;
        }
        .logo h1 {
            color: #386BF6;
            position: relative;
            width: fit-content;
        }
        .logo h1 .circle {
            width: 50px;
            height: 50px;
            position: absolute;
            top: -5px;
            right: 0;
            z-index: -1;
            border-radius: 50%;
            background: linear-gradient(180deg, #DAEDFF 0%, rgba(218, 237, 255, 0) 100%);
        }

        .content {
            /* border: 1px solid blue; */
            width: 90%;
            height: 100%;
            overflow: scroll;
            margin: auto;
            position: relative;
            /* display: grid;
            grid-template-columns: 100%;
            grid-template-rows: auto auto; */
        }

        .content::-webkit-scrollbar {
            width: 0px;
        }

        .devices {
            /* border: 1px solid green; */
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1;
            background-color: #ffffff;
        }

        .devices h4 {
            margin-top: 0px;
            /* border: 2px solid black; */
        }

        .devices .list-devices {
            display: flex;
            width: 100%;
            overflow: scroll;
            /* border: 1px solid black; */
            margin-top: -12px;
        }

        .devices .list-devices .item {
            width: 75px;
            display: flex;
            flex-direction: column;
            padding: 9px 10px 10px 10px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
            margin: 10px;
        }

        .list-devices .item img {
            display: block;
            width: 50px;
            height: 50px;
            margin: auto;
        }

        .list-devices .item p {
            display: block;
            width: fit-content;
            margin: auto;
        }

        .rooms {
            /* border: 1px solid red; */
            padding: 10px 0px 10px 0px;
            width: 100%;
            height: fit-content;
        }

        .rooms h3 {
            /* border: 1px solid black; */
            margin-top: 0px;
        }

        .rooms h4 {
            color: #888888;
            /* border: 1px solid black; */
            margin-top: -5px;
        }

        .rooms .add {
            display: block;
            border: none;
            padding: 7px 15px 8px 15px;
            border-radius: 8px;
            background-color: #386BF6;
            color: #ffffff;
        }

        .list-rooms {
            /* border: 1px solid green; */
            width: 100%;
            height: 100%;
        }

        .list-rooms .card {
            position: relative;
            padding: 5px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
            width: calc(100% - 15px);
            margin: auto;
            margin-top: 10px;
        }

        .list-rooms .card .judul {
            width: 95%;
            font-size: 20px;
        }

        .list-rooms .card .desc {
            width: 100%;
            font-size: 15px;
        }

        .list-rooms .card .options {
            width: fit-content;
            padding: 2px 6px 6px 6px;
            /* border: 1px solid red; */
            font-size: 15px;
            transform: rotate(90deg);
            position: absolute;
            top: 0px;
            right: 0px;
        }

        .list-rooms .card .delete {
            padding: 4px 10px 5px 10px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
            width: fit-content;
            position: absolute;
            top: 8px;
            right: 18px;
            font-size: 15px;
            display: none;
            color: #D90000;
        }

        #not-found {
            position: relative;
            width: 85%;
            height: 200px;
            margin: auto;
            margin-top: 20px;
            /* border: 1px solid red; */
        }

        #not-found img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #not-found .text {
            /* border: 1px solid red; */
            position: absolute;
            top: 0;
            left: 0;
            width: 150px;
            height: fit-content;
            text-align: center;
        }

        #not-found .text p:nth-child(1) {
            font-size: 30px;
            font-weight: 600;
            /* border: 1px solid blue; */
            margin-top: 0px;
        }

        #not-found .text p:nth-child(2) {
            font-size: 15px;
            font-weight: 400;
            /* border: 1px solid blue; */
            color: #0071F2;
            margin-top: -10px;
        }

        .content .active {
            border: 1px solid #386BF6;
            background-color: #E8EEFF;
        }
        .footer {
            /* border: 2px solid red; */
            display: grid;
            grid-template-columns: auto auto;
        }

        .footer .not-active {
            color: #AAAAAA;
            border-top: 2px solid #AAAAAA;
        }

        .footer .active {
            color: #386BF6;
            border-top: 2px solid #386BF6;
        }
        .footer div {
            padding: 10px;
            /* border: 1px solid red; */
        }

        .footer div i {
            font-size: 25px;
            /* border: 1px solid red; */
            display: block;
            width: fit-content;
            margin: auto;
        }

        .footer div p {
            /* border: 1px solid black; */
            display: block;
            width: fit-content;
            margin: auto;
            margin-top: 5px;
            font-size: 17px;
            font-weight: 550;
        }
        
        select {
            width: 100%;
            padding: 5px;
        }

    </style>
    
</head>

<body>
    <div class="header">
        <div class="logo">
            <h1>
                Smart IoT
                <div class="circle"></div>
            </h1>
        </div>
    </div>
    <div class="content">
        <div class="devices">
            <h4>Pilih Jenis Perangkat</h4>
            <div class="list-devices">
                <div class="item" onclick="choseDevices(this)">
                    <img src="/icon/lampu.png" alt="">
                    <p>Lampu</p>
                </div>
                <div class="item" onclick="choseDevices(this)">
                    <img src="/icon/gorden.svg" alt="">
                    <p>Gorden</p>
                </div>
            </div>
        </div>
        <div class="rooms">
            <h3>Ruangan</h3>
            <h4>Pilih ruangan untuk kamu Smart-in !</h4>
            <button class="add" onclick="addRooms()">Tambah Ruangan</button>
            <div class="list-rooms">
                <!-- <div id="not-found">
                    <img src="/icon/teknikal.png" alt="">
                    <div class="text">
                        <p>Ups!</p>
                        <p>Kamu belum memiliki target ruangan.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="judul">nama project</div>
                    <div class="desc">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit
                    </div>
                    <div class="options" onclick="showButton(this)"><b>...</b></div>
                    <div class="delete">Hapus</div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="main <?= $apps == "main" ? "active" : "not-active" ?>">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
        </div>
        <div class="profile <?= $apps != "main" ? "active" : "not-active" ?>">
            <i class="fa-solid fa-user"></i>
            <p>Profile</p>
        </div>
    </div>
    <script>
        var elmDevices = null;
        var rooms = '';
        var listProject = [];
        var projects = [];

        var lp = setInterval(function() {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var response = JSON.parse(this.responseText);
                if (response.status) {
                    if (JSON.stringify(listProject) != JSON.stringify(response.data)) {
                        listProject = response.data;
                        console.log(listProject);
                    }
                } else {
                    listProject = [];
                }
            }
            xhr.open("GET", location.origin + "/api/app/project", true);
            xhr.setRequestHeader("token", '{{ $user->token }}');
            xhr.send();
        }, 2000);

        var p = setInterval(function() {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var response = JSON.parse(this.responseText);
                if (response.status) {
                    var available = 'data' in response;
                    if (available) {
                        if (JSON.stringify(projects) != JSON.stringify(response.data)) {
                            projects = response.data;
                            showProjectApp();
                        }
                    }else {
                        if(projects.length > 0){
                            projects = [];
                            showProjectApp();
                        }
                    }
                } else {
                    projects = [];
                }
            }
            xhr.open("GET", location.origin + "/api/app/app", true);
            xhr.setRequestHeader("token", '{{ $user->token }}');
            xhr.send();
        }, 2000);

        function choseDevices(elm){
            if(elmDevices == null){
                elm.classList.add("active");
                elmDevices = elm;
            }else {
                if(elmDevices != elm){
                    elmDevices.classList.remove("active");
                    elm.classList.add("active");
                    elmDevices = elm;
                }
            }
        }
        function optionChange(elm) {
            rooms = elm.value;
            console.log(rooms);
        }

        function addRooms() {
            rooms = "#";

            var elm = '<select name="" id="" onchange="optionChange(this)">';
            elm += '<option value="#">Pilih Project</option>';
            for (var i = 0; i < listProject.length; i++) {
                elm += '<option value="' + listProject[i].nameProject + '">' + listProject[i].nameProject + '</option>';
            }
            elm += '</select>';

            var promp = alertify.prompt();
            promp.setContent(elm);
            promp.setHeader('TAMBAH RUANGAN');
            promp.set('onok', function(closeEvent) {
                addProjectsData();
            })
            promp.show();
        }

        function addProjectsData() {
            if (rooms != "#" && rooms != '') {
                var data = new FormData();
                data.append("project", rooms);

                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    var response = JSON.parse(this.responseText);
                    if (response.status) {
                        alertify.notify(response.msg, 'success', 3, function() {});
                    } else {
                        alertify.notify(response.msg, 'error', 3, function() {});
                    }
                }
                xhr.open("POST", location.origin + "/api/app/project", true);
                xhr.setRequestHeader('token', '{{$user->token}}');
                xhr.send(data);
            } else {
                alertify.notify('Pilih Project!', 'warning', 3, function() {});
            }
        }

        function showButton(elm) {
            var parent = elm.parentElement;
            var btn = parent.getElementsByClassName("delete")[0];
            if (btn.style.display == "none") {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        }

        function showProjectApp() {
            var lroom = document.getElementsByClassName("list-rooms")[0];
            lroom.innerHTML = "";
            if (projects.length > 0) {
                for(var i = 0; i < projects.length; i++){
                    lroom.innerHTML +=
                    '<div class="card">'+
                    '<div class="judul">'+projects[i].nameProject+'</div>'+
                    '<div class="desc">'+projects[i].details+'</div>'+
                    '<div class="options" onclick="showButton(this)"><b>...</b></div>'+
                    '<div class="delete" onclick="deleteProject(\''+projects[i].nameProject+'\')"><i class="fa-solid fa-trash-can"></i>Hapus</div>'+
                    '</div>';
                }
            }else {
                lroom.innerHTML +=
                '<div id="not-found">'+
                    '<img src="/icon/teknikal.png" alt="">'+
                    '<div class="text">'+
                        '<p>Ups!</p>'+
                        '<p>Kamu belum memiliki target ruangan.</p>'+
                    '</div>'+
                '</div>'
            }
        }

        function deleteProject(target){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                var response = JSON.parse(this.responseText);
                if(response.status){
                    alertify.notify(response.msg, 'success', 3, function(){});
                }else {
                    alertify.notify(response.msg, 'error', 3, function(){});
                }
            }
            xhr.open("DELETE", location.origin+"/api/app/"+target, true);
            xhr.setRequestHeader('token', '{{$user->token}}');
            xhr.send();
        }
    </script>
</body>

</html>