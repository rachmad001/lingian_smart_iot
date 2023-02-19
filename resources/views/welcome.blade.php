@extends('template')
@section('header')
<style>
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
        width: 100%;
        padding-right: 10px;
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

    select {
        width: 100%;
        padding: 5px;
    }
</style>
@endsection

@section('content')
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
@endsection

@section('script')
<script>
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
                } else {
                    if (projects.length > 0) {
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
        });
        promp.set('onclose', function() {
            closeAlertify();
        });
        promp.set('movable', false);
        promp.show();
        openAlertify();
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
            for (var i = 0; i < projects.length; i++) {
                lroom.innerHTML +=
                    '<div class="card" onclick="toProject(\''+ projects[i].nameProject + '\', event, this)">' +
                    '<div class="judul">' + projects[i].nameProject + '</div>' +
                    '<div class="desc">' + projects[i].details + '</div>' +
                    '<div class="options" onclick="showButton(this)"><b>...</b></div>' +
                    '<div class="delete" onclick="deleteProject(\'' + projects[i].nameProject + '\')"><i class="fa-solid fa-trash-can"></i>Hapus</div>' +
                    '</div>';
            }
        } else {
            lroom.innerHTML +=
                '<div id="not-found">' +
                '<img src="/icon/teknikal.png" alt="">' +
                '<div class="text">' +
                '<p>Ups!</p>' +
                '<p>Kamu belum memiliki target ruangan.</p>' +
                '</div>' +
                '</div>'
        }
    }

    function toProject(target, event, elm){
        // console.log(event);
        console.log(event.target);
        var opt = elm.getElementsByTagName("b")[0];
        var delbtn = elm.getElementsByClassName("delete")[0];
        if(event.target != opt && event.target != delbtn){
            window.location.href = location.origin+"/"+target;
        }
    }
    function deleteProject(target) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {
                alertify.notify(response.msg, 'success', 3, function() {});
            } else {
                alertify.notify(response.msg, 'error', 3, function() {});
            }
        }
        xhr.open("DELETE", location.origin + "/api/app/" + target, true);
        xhr.setRequestHeader('token', '{{$user->token}}');
        xhr.send();
    }
</script>
@endsection