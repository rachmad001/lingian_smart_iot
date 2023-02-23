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

        .switch {
            position: relative;
            width: 50px;
            height: 20px;
            background-color: #c6c6c6;
            appearance: none;
            outline: none;
            border-radius: 20px;
            transition: .5s;
        }

        .switch:checked {
            background-color: #386BF6;
        }

        .switch:before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 0;
            left: 0;
            border-radius: 20px;
            background-color: #FFFFFF;
            transform: scale(1.2);
            border: 1px solid #002480;
            transition: .5s;
        }

        .switch:checked:before {
            left: 30px;
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
        }

        .footer div i {
            font-size: 25px;
            display: block;
            width: fit-content;
            margin: auto;
        }

        .footer div p {
            display: block;
            width: fit-content;
            margin: auto;
            margin-top: 5px;
            font-size: 17px;
            font-weight: 550;
        }

        .content {
            width: 100%;
            height: 100%;
            overflow-y: scroll;
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: max-content auto 75px;
        }

        .content .onof {
            display: flex;
            justify-content: space-between;
            width: 90%;
            padding: 10px 0px 10px 0px;
            margin: auto;
            margin-top: 0;
        }

        .content .onof .name {
            width: fit-content;
            max-width: 80%;
            height: fit-content;
            font-size: 23px;
            font-weight: 600;
        }

        .content .control {
            width: 90%;
            margin: auto;
            margin-top: 0;
            padding: 10px 0px 11px 0px;
            display: grid;
            grid-template-columns: 100% 100% 100%;
            overflow-x: hidden;
        }

        .icon {
            display: flex;
            justify-content: center;
            font-size: 27px;
            color: #386BF6;
        }

        .controlling {
            display: grid;
            grid-template-columns: auto 180px auto;
            height: 180px;
            margin-top: 15px;
        }

        #brightness .controlling .min,
        #brightness .controlling .plus {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            color: #386BF6;
        }

        .controlling .status {
            position: relative;
        }

        .controlling .status .bg {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #F0F0F0;
        }

        .controlling .status .value {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background-color: #386BF6;
            position: absolute;
            top: 0;
            left: 0;
            clip: rect(0px, 180px, 180px, 0px);
            transition: .5s;
        }

        .controlling .status .hole {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            top: 25px;
            left: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .controlling .status .hole p {
            width: fit-content;
            height: fit-content;
            font-size: 35px;
            font-weight: 700;
        }

        #color .color-control {
            padding: 10px;
            width: 70%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #color .color-control button {
            width: 20px;
            height: 20px;
            border: none;
            margin: 7px;
        }

        #color .color-control .white {
            background-color: #FFFFFF;
            border: 2px solid black;
        }

        #color .color-control .merah {
            background-color: #D90000;
        }

        #color .color-control .hijau {
            background-color: #04BB00;
        }

        .ungu {
            background-color: #6C00D9;
        }

        .kuning {
            background-color: #FFE600;
        }

        .dark-blue {
            background-color: #1400F6;
        }

        #intensity .intensity-control {
            padding: 10px;
            width: 80%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #intensity .intensity-control .btn {
            width: 60px;
            height: 60px;
            margin: 10px;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #386BF6;
        }

        .menus {
            width: 250px;
            height: 50px;
            margin: auto;
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: #D9D9D9;
            border-radius: 25px;
            margin-top: 0;
            overflow: hidden;
        }

        .menus .options {
            width: 100%;
            height: 100%;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #D9D9D9;
        }

        .menus .options p {
            width: fit-content;
            height: fit-content;
            color: #888888;
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
        <div class="onof">
            <div class="name">{{$device["name"]}}</div>
            <input type="checkbox" name="" id="" class="switch" onclick="onof(this)">
        </div>
        <div class="control">
            <div id="brightness">
                <div class="icon"><i class="fa-solid fa-sun"></i></div>
                <div class="controlling">
                    <div class="min" onclick="brightness('-')"><i class="fa-solid fa-minus"></i></div>
                    <div class="status">
                        <div class="bg"></div>
                        <div class="value"></div>
                        <div class="hole">
                            <p>100%</p>
                        </div>
                    </div>
                    <div class="plus" onclick="brightness('+')"><i class="fa-solid fa-plus"></i></div>
                </div>
            </div>
            <div id="color">
                <div class="icon"><i class="fa-solid fa-sun"></i></div>
                <div class="controlling">
                    <div class="min"></div>
                    <div class="status">
                        <div class="bg"></div>
                        <div class="value"></div>
                        <div class="hole"></div>
                    </div>
                    <div class="plus"></div>
                </div>
                <div class="color-control">
                    <button type="button" class="white" onclick="lightColor(['V7','V4', 'V5', 'V17', 'V18', 'V22'], '#386BF6')"></button>
                    <button type="button" class="merah" onclick="lightColor(['V4', 'V5','V7', 'V17', 'V18', 'V22'], '#D90000')"></button>
                    <button type="button" class="hijau" onclick="lightColor(['V5', 'V4','V7', 'V17', 'V18', 'V22'], '#04BB00')"></button>
                    <button type="button" class="ungu" onclick="lightColor(['V17','V5', 'V4','V7', 'V18', 'V22'], '#6C00D9')"></button>
                    <button type="button" class="kuning" onclick="lightColor(['V18','V17','V5', 'V4','V7', 'V22'], '#FFE600')"></button>
                    <button type="button" class="dark-blue" onclick="lightColor(['V22','V18','V17','V5', 'V4','V7'], '#1400F6')"></button>
                </div>
            </div>
            <div id="intensity">
                <div class="icon"><i class="fa-solid fa-sun"></i></div>
                <div class="controlling">
                    <div class="min"></div>
                    <div class="status">
                        <div class="bg"></div>
                        <div class="value"></div>
                        <div class="hole"></div>
                    </div>
                    <div class="plus"></div>
                </div>
                <div class="intensity-control">
                    <div class="btn" onclick="intensity(['V11','V10','V8'],[0, 1, 2])">Smooth</div>
                    <div class="btn" onclick="intensity(['V10','V11','V8'],[1, 0, 2])">Fade</div>
                    <div class="btn" onclick="intensity(['V8','V11','V10'],[2, 0, 1])">Flash</div>
                </div>
            </div>
        </div>
        <div class="menus">
            <div class="options" onclick="menus(['brightness', 'color', 'intensity'], [0, 1, 2])">
                <p>Brightness</p>
            </div>
            <div class="options" onclick="menus(['color', 'brightness', 'intensity'], [1, 0, 2])">
                <p>Color</p>
            </div>
            <div class="options" onclick="menus(['intensity', 'color', 'brightness'], [2, 1, 0])">
                <p>Itensity</p>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="main <?= $apps == "main" ? "active" : "not-active" ?>" onclick="toHome()">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
        </div>
        <div class="profile <?= $apps != "main" ? "active" : "not-active" ?>" onclick="logout()">
            <i class="fa-solid fa-user"></i>
            <p>Profile</p>
        </div>
    </div>
    <script>
        var dataJson = {};
        console.log(dataJson);
        var xr_data = setInterval(function() {
            var xml = new XMLHttpRequest();
            xml.onload = function() {
                var response = JSON.parse(this.responseText);
                if (JSON.stringify(dataJson) != JSON.stringify(response)) {
                    dataJson = response;
                    showData();
                }
            }
            xml.open("GET", "http://platform.penelitianrpla.com/lastData/{{$project}}/{{$device['name']}}", true);
            xml.setRequestHeader("token", "{{$user->token}}");
            xml.send();
        }, 2000);

        function toHome() {
            window.location.href = '/';
        }
        function logout() {
            window.location.href = '/logout';
        }

        function showData() {
            var checkbox = document.getElementsByClassName("switch")[0];
            var cahaya = document.getElementsByClassName("value");
            var icon = document.getElementsByClassName("icon");
            var btn = document.getElementsByClassName("btn");
            var val_cahaya = document.getElementById("brightness").getElementsByClassName("hole")[0].getElementsByTagName("p")[0];
            if ('data' in dataJson) {
                if ('V0' in dataJson.data) {
                    if (dataJson.data.V0) {
                        checkbox.checked = true;
                    } else {
                        checkbox.checked = false;
                    }
                }
                if ('V1' in dataJson.data) {
                    if (dataJson.data.V1) {
                        checkbox.checked = false;
                    } else {
                        checkbox.checked = true;
                    }
                }
                if (!('V0' in dataJson.data) && !('V1' in dataJson.data)) {
                    dataJson.data.V1 = 1;
                    checkbox.checked = false;
                }
                if ('V2' in dataJson.data) {
                    if (dataJson.data.V2) {
                        cahaya[0].style.clip = "rect(0px, 180px, 180px, 0px)";
                        cahaya[1].style.clip = "rect(0px, 180px, 180px, 0px)";
                        cahaya[2].style.clip = "rect(0px, 180px, 180px, 0px)";
                        val_cahaya.innerHTML = "100%";
                    } else {
                        cahaya[0].style.clip = "rect(0px, 180px, 180px, 90px)";
                        cahaya[1].style.clip = "rect(0px, 180px, 180px, 90px)";
                        cahaya[2].style.clip = "rect(0px, 180px, 180px, 90px)";
                        val_cahaya.innerHTML = "50%";
                    }
                }
                if ('V3' in dataJson.data) {
                    if (dataJson.data.V3) {
                        cahaya[0].style.clip = "rect(0px, 180px, 180px, 90px)";
                        cahaya[1].style.clip = "rect(0px, 180px, 180px, 90px)";
                        cahaya[2].style.clip = "rect(0px, 180px, 180px, 90px)";
                        val_cahaya.innerHTML = "50%";
                    } else {
                        cahaya[0].style.clip = "rect(0px, 180px, 180px, 0px)";
                        cahaya[1].style.clip = "rect(0px, 180px, 180px, 0px)";
                        cahaya[2].style.clip = "rect(0px, 180px, 180px, 0px)";
                        val_cahaya.innerHTML = "100%";
                    }
                }
                if (!('V2' in dataJson.data) && !('V3' in dataJson.data)) {
                    dataJson.data.V2 = 1;
                    cahaya[0].style.clip = "rect(0px, 180px, 180px, 0px)";
                    cahaya[1].style.clip = "rect(0px, 180px, 180px, 0px)";
                    val_cahaya.innerHTML = "100%";
                }
                if ('V4' in dataJson.data) {
                    if (dataJson.data.V4) {
                        setColor("#D90000")
                    }
                }
                if ('V5' in dataJson.data) {
                    if (dataJson.data.V5) {
                        setColor("#04BB00")
                    }
                }
                if ('V17' in dataJson.data) {
                    if (dataJson.data.V17) {
                        setColor("#6C00D9")
                    }
                }
                if ('V18' in dataJson.data) {
                    if (dataJson.data.V18) {
                        setColor("#FFE600");
                    }
                }
                if ('V22' in dataJson.data) {
                    if (dataJson.data.V22) {
                        setColor("#1400F6");
                    }
                }
                if ('V11' in dataJson.data) {
                    if (dataJson.data.V11) {
                        btn[0].style.border = "1px solid #386BF6";
                        btn[1].style.border = "none";
                        btn[2].style.border = "none";
                    }
                }
                if ('V10' in dataJson.data) {
                    if (dataJson.data.V10) {
                        btn[0].style.border = "none";
                        btn[1].style.border = "1px solid #386BF6";
                        btn[2].style.border = "none";
                    }
                }
                if ('V8' in dataJson.data) {
                    if (dataJson.data.V8) {
                        btn[0].style.border = "none";
                        btn[1].style.border = "none";
                        btn[2].style.border = "1px solid #386BF6";
                    }
                }
            } else {
                dataJson.V1 = 1;
                dataJson.V2 = 1;
                dataJson.V7 = 1;
                dataJson.V8 = 1;
                checkbox.checked = false;
                cahaya[0].style.clip = "rect(0px, 180px, 180px, 0px)";
                cahaya[1].style.clip = "rect(0px, 180px, 180px, 0px)";
                cahaya[2].style.clip = "rect(0px, 180px, 180px, 0px)";
            }
        }

        function brightness(type) {
            if ('data' in dataJson) {
                if (type == "-") {
                    dataJson.data.V3 = 1;
                    dataJson.data.V2 = 0;
                } else {
                    dataJson.data.V3 = 0;
                    dataJson.data.V2 = 1;
                }
            } else {
                if (type == "-") {
                    dataJson.V3 = 1;
                    dataJson.V2 = 0;
                } else {
                    dataJson.V3 = 0;
                    dataJson.V2 = 1;
                }
            }
            updateValue();
        }

        function lightColor(keys, color) {
            var icon = document.getElementsByClassName("icon");
            var cahaya = document.getElementsByClassName("value");
            if ('data' in dataJson) {
                dataJson.data[keys[0]] = 1;
                for (var i = 1; i < keys.length; i++) {
                    dataJson.data[keys[i]] = 0;
                }
            } else {
                dataJson[keys[0]] = 1;
                for (var i = 1; i < keys.length; i++) {
                    dataJson[keys[i]] = 0;
                }
            }
            icon[0].style.color = color;
            icon[1].style.color = color;
            icon[2].style.color = color;
            cahaya[0].style.backgroundColor = color;
            cahaya[1].style.backgroundColor = color;
            cahaya[2].style.backgroundColor = color;
            updateValue();
        }

        function onof(elm) {
            if ('data' in dataJson) {
                if (elm.checked) {
                    dataJson.data.V0 = 1;
                    dataJson.data.V1 = 0;
                } else {
                    dataJson.data.V0 = 0;
                    dataJson.data.V1 = 1;
                }
            } else {
                if (elm.checked) {
                    dataJson.V0 = 1;
                    dataJson.V1 = 0;
                } else {
                    dataJson.V0 = 1;
                    dataJson.V1 = 0;
                }
            }
            updateValue();
        }

        function updateValue() {
            var data = new FormData();
            if ('data' in dataJson) {
                data.append("data", JSON.stringify(dataJson.data));
            } else {
                data.append("data", JSON.stringify(dataJson));
            }
            data.append("token", "{{$user->token}}");
            data.append("nameproject", "{{$project}}");
            data.append("namedevices", "{{$device['name']}}");

            var xml = new XMLHttpRequest();
            xml.onload = function() {
                var response = JSON.parse(this.responseText);
            }
            xml.open("POST", "http://platform.penelitianrpla.com/addData", true);
            xml.send(data);
        }

        function intensity(keys, index) {
            if ('data' in dataJson) {
                dataJson.data[keys[0]] = 1;
                for (var i = 1; i < keys.length; i++) {
                    dataJson.data[keys[i]] = 0;
                }
            } else {
                dataJson[keys[0]] = 1;
                for (var i = 1; i < keys.length; i++) {
                    dataJson[keys[i]] = 0;
                }
            }

            var btn = document.getElementsByClassName("btn");
            btn[index[0]].style.border = "1px solid #386BF6";
            for (var i = 1; i < index.length; i++) {
                btn[index[i]].style.border = "none";
            }

            updateValue();
        }

        function setColor(color) {
            var cahaya = document.getElementsByClassName("value");
            var icon = document.getElementsByClassName("icon");
            for (var i = 0; i < icon.length; i++) {
                cahaya[i].style.backgroundColor = color;
                icon[i].style.color = color;
            }
        }

        function menus(target, elm) {
            document.getElementById(target[0]).style.display = "block";
            var btn = document.getElementsByClassName("options")[elm[0]];
            btn.style.backgroundColor = "#386BF6";
            btn.getElementsByTagName("p")[0].style.color = "#ffffff";
            // btn.style.color = "#ffffff";
            for (var i = 1; i < target.length; i++) {
                document.getElementById(target[i]).style.display = "none";
                var btn = document.getElementsByClassName("options")[elm[i]];
                console.log(btn);
                btn.style.backgroundColor = "transparent";
                btn.getElementsByTagName("p")[0].style.color = "#888888";
            }
        }
    </script>
</body>

</html>