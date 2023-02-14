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
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <style>
        html {
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
            background-color: #ffffff;
        }
        body {
            width: 95%;
        }
        .subsapa {
            margin-top: -12px;
            color: #b8b6b6;
        }
        .logo {
            width: fit-content;
            margin-top: -10px;
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
        .forms {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .inputs {
            padding: 5px;
            background-color: none;
            border: none;
            border-bottom: 1px solid #b8b6b6;
        }
        .inputs:focus {
            outline: none;
        }
        .password {
            display: flex;
            align-items: flex-end;
            border-bottom: 1px solid #b8b6b6;
            padding: 5px;
        }
        .password input {
            border: none;
            width: calc(100% - 50px);
        }
        .password input:focus {
            outline: none;
        }
        .password .text {
            display: block;
            width: 50px;
            text-align: center;
            color: #386BF6;
        }
        #login {
            display: block;
            width: 70%;
            margin: auto;
            border: none;
            margin-top: 15px;
            padding-top: 6px;
            padding-bottom: 5px;
            border-radius: 10px;
            color: #ffffff;
            font-size: 22px;
            font-weight: 500;
            text-align: center;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 24%, rgba(0,212,255,1) 100%);
        }
    </style>
</head>
<body>
    <h3 class="sapa">Welcome back!</h3>
    <h3 class="subsapa">Login to continue.</h3>
    <div class="logo">
        <h1>
            Smart IoT
            <div class="circle"></div>
        </h1>
    </div>
    <div class="forms">
        <label for="">Username</label>
        <input type="text" name="" id="username" class="inputs" placeholder="Type Your Username">
        <label for="">Password</label>
        <div class="password">
            <input type="password" name="" id="password">
            <div class="text" onclick="showPass()">show</div>
        </div>
    </div>
    <button id="login" type="button" onclick="login()">LOGIN</button>
    <script>
        var see = false;
        function showPass(){
            var elm = document.getElementById("password");
            if(!see){
                elm.type = "text";
            }else {
                elm.type = "password";
            }
            see = !see;
        }
        function login(){
            var username = document.getElementById("username");
            var password = document.getElementById("password");

            var data = new FormData();
            data.append("username", username.value);
            data.append("password", password.value);

            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                var response = JSON.parse(this.responseText);
                if(response.status){
                    window.location.href = location.origin;
                }else {
                    alertify.notify(response.msg, 'error', 5, function(){});
                }
            }
            xhr.open("POST", location.origin+"/api/login", true);
            xhr.send(data);
        }
    </script>
</body>
</html>