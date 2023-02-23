@extends('template')

@section('header')
<style>
    select {
        width: 100%;
        padding: 5px;
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

    .list-device {
        display: none;
        grid-template-columns: auto auto;
        grid-column-gap: 10px;
        grid-row-gap: 10px;
        width: calc(100% - 5px);
        margin: auto;
        margin-top: 10px;
    }

    .list-device .card {
        display: flex;
        flex-direction: column;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    .list-device .card .icon {
        font-size: 25px;
        width: fit-content;
        margin: auto;
    }

    .list-device .card .name {
        width: fit-content;
        margin: auto;
        text-align: center;
        font-size: 18px;
        font-weight: 500;
        margin-top: 3px;
    }

    .list-device .card .desc {
        font-size: 14px;
        width: fit-content;
        margin: auto;
        margin-top: 2px;
    }

    .list-device .card .control {
        width: fit-content;
        margin: auto;
        margin-top: 5px;
    }

    .list-device .card .options {
        width: fit-content;
        height: fit-content;
        padding: 0px 4px 4px 4px;
        font-size: 20px;
        font-weight: 600;
        position: absolute;
        top: 0;
        right: 0;
        transform: rotate(90deg);
    }

    .list-device .card .delete {
        padding: 4px 10px 5px 10px;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.08);
        width: fit-content;
        position: absolute;
        top: 10px;
        right: 22px;
        font-size: 15px;
        display: none;
        color: #D90000;
    }
</style>
@endsection

@section('content')
<div class="list-device" id="lampu">
    <!-- <div class="card">
        <div class="icon"><i class="fa-solid fa-lightbulb"></i></div>
        <div class="name">Lampu A-12</div>
        <div class="desc">Lampu Mati</div>
        <div class="control">
            <input type="checkbox" name="" id="" class="switch">
        </div>
        <div class="option">...</div>
        <div class="delete"><i class="fa-regular fa-trash-can"></i> Hapus</div>
    </div>
    <div class="card">
        <div class="icon"><i class="fa-solid fa-lightbulb"></i></div>
        <div class="name">Lampu A-12</div>
        <div class="desc">Lampu Mati</div>
        <div class="control">
            <input type="checkbox" name="" id="" class="switch">
        </div>
        <div class="option">...</div>
        <div class="delete"><i class="fa-regular fa-trash-can"></i> Hapus</div>
    </div> -->
</div>
<div class="list-device" id="gorden">
    <!-- <div class="card">
        <div class="icon"><i class="fa-solid fa-lightbulb"></i></div>
        <div class="name">Lampu A-12</div>
        <div class="desc">Lampu Mati</div>
        <div class="control">
            <input type="checkbox" name="" id="" class="switch">
        </div>
    </div> -->
</div>
@endsection

@section('script')
<script>
    choseDevices = function(elm, type) {
        var project_device = document.getElementsByClassName("project")[0].getElementsByTagName("h3")[0];
        var label_project = document.getElementsByClassName("project")[0].getElementsByTagName("h4")[0];
        var btn_project = document.getElementsByClassName("project")[0].getElementsByTagName("button")[0];
        if (elmDevices == null) {
            elm.classList.add("active");
            elmDevices = elm;
            device = type;
            project_device.innerHTML = type;
            label_project.innerHTML = "Pilih " + type + " umtuk kamu Smart-in!";
            btn_project.innerHTML = "Tambah " + type;
            if (device == "lampu") {
                document.getElementById("lampu").style.display = "grid";
                document.getElementById("gorden").style.display = "none";
            } else {
                document.getElementById("lampu").style.display = "none";
                document.getElementById("gorden").style.display = "grid";
            }
        } else {
            if (elmDevices != elm) {
                elmDevices.classList.remove("active");
                elm.classList.add("active");
                elmDevices = elm;
                device = type;
                project_device.innerHTML = type;
                label_project.innerHTML = "Pilih " + type + " umtuk kamu Smart-in!";
                btn_project.innerHTML = "Tambah " + type;
                if (device == "lampu") {
                    document.getElementById("lampu").style.display = "grid";
                    document.getElementById("gorden").style.display = "none";
                } else {
                    document.getElementById("lampu").style.display = "none";
                    document.getElementById("gorden").style.display = "grid";
                }
            }
        }
    }

    var remote_devices = [];
    var device_option = '';
    var list_lampu = [];
    var list_gorden = [];

    var xr_devices = setInterval(function() {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {
                if ('data' in response) {
                    if (JSON.stringify(remote_devices) != JSON.stringify(response.data)) {
                        remote_devices = response.data
                    }
                } else {
                    remote_devices = [];
                }
            }
        }
        xhr.open("GET", "api/app/device?project={{$project}}", true);
        xhr.setRequestHeader('token', '{{$user->token}}');
        xhr.send();
    }, 2000);

    var xr_lampu = setInterval(function() {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {
                if ('data' in response) {
                    if (JSON.stringify(list_lampu) != JSON.stringify(response.data)) {
                        list_lampu = response.data
                        showLamp();
                    }
                } else {
                    list_lampu = [];
                    showLamp();
                }
            }
        }
        xhr.open("GET", "api/app/list-devices?project={{$project}}&type=lampu", true);
        xhr.setRequestHeader('token', '{{$user->token}}');
        xhr.send();
    }, 2000);

    var xr_gorden = setInterval(function() {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {
                if ('data' in response) {
                    if (JSON.stringify(list_gorden) != JSON.stringify(response.data)) {
                        list_gorden = response.data
                        showGorden();
                    }
                } else {
                    list_gorden = [];
                    showGorden();
                }
            }
        }
        xhr.open("GET", "api/app/list-devices?project={{$project}}&type=gorden", true);
        xhr.setRequestHeader('token', '{{$user->token}}');
        xhr.send();

    }, 2000);

    function showLamp() {
        var list_device = document.getElementById("lampu");
        list_device.innerHTML = "";
        for (var i = 0; i < list_lampu.length; i++) {
            var status = '';
            var stateswitch = '';
            if ('data' in list_lampu[i].datas) {
                if ('V0' in list_lampu[i].datas.data) {
                    if (list_lampu[i].datas.data.V0) {
                        status = "Hidup";
                        stateswitch = "checked";
                    } else {
                        status = "Mati";
                        stateswitch = '';
                    }
                }
                if ('V1' in list_lampu[i].datas.data) {
                    if (list_lampu[i].datas.data.V1) {
                        status = "Mati";
                    } else {
                        status = "Hidup";
                        stateswitch = "checked";
                    }
                }
            } else {
                list_lampu[i].datas = {
                    data: {
                        V1: 1
                    }
                };
                status = "Mati";
            }

            list_device.innerHTML +=
                '<div class="card" onclick="toProject(\'{{$project}}\',\'' + list_lampu[i].name + '\', event, this)">' +
                '<div class="icon"><i class="fa-solid fa-lightbulb"></i></div>' +
                '<div class="name">' + list_lampu[i].name + '</div>' +
                '<div class="desc">Lampu ' + status + '</div>' +
                '<div class="control">' +
                '<input type="checkbox" name="" id="" class="switch" onclick="switchBtn(this, \'' + i + '\')"' + stateswitch + '>' +
                '<div class="options" onclick="showButton(this)">...</div>' +
                '<div class="delete" onclick="deleteDevice(\'{{$project}}\', \'' + list_lampu[i].name + '\')"><i class="fa-solid fa-trash-can"></i>Hapus</div>' +
                '</div>' +
                '</div>';
        }
    }

    function toProject(project, device, event, elm) {
        console.log(event.target);
        var optElm = elm.getElementsByClassName("options")[0];
        var delElm = elm.getElementsByClassName("delete")[0];
        var checkbox = elm.getElementsByClassName("switch")[0];
        if (event.target != optElm && event.target != delElm && event.target != checkbox) {
            window.location.href = location.origin + "/" + project + "/" + device;
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

    function deleteDevice(project, device) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {
                alertify.notify(response.msg, "success", 3, function() {});
            } else {
                alertify.notify(response.msg, "error", 3, function() {});
            }
        }
        xhr.open("DELETE", "api/app/device/" + project + "/" + device, true);
        xhr.setRequestHeader("token", "{{$user->token}}");
        xhr.send();
    }

    function showGorden() {
        var list_device = document.getElementById("gorden");
        list_device.innerHTML = "";
        for (var i = 0; i < list_gorden.length; i++) {
            var status = '';
            var stateswitch = '';
            if ('data' in list_gorden[i].datas) {
                if (list_gorden[i].datas.data.state) {
                    status = "Hidup";
                    stateswitch = "checked";
                } else {
                    status = "Mati";
                    stateswitch = '';
                }
            } else {
                list_gorden[i].datas = {
                    data: {
                        state: 1
                    }
                };
                status = "Mati";
                stateswitch = '';
            }

            list_device.innerHTML +=
                '<div class="card">' +
                '<div class="icon"><i class="fa-solid fa-person-booth"></i></div>' +
                '<div class="name">' + list_gorden[i].name + '</div>' +
                '<div class="desc">Gorden ' + status + '</div>' +
                '<div class="control">' +
                '<input type="checkbox" name="" id="" class="switch" onclick="gordenBtn(this, \'' + i + '\')"' + stateswitch + '>' +
                '<div class="options" onclick="showButton(this)">...</div>' +
                '<div class="delete" onclick="deleteDevice(\'{{$project}}\', \'' + list_gorden[i].name + '\')"><i class="fa-solid fa-trash-can"></i>Hapus</div>' +
                '</div>' +
                '</div>';
        }
    }

    function addRooms() {
        device_option = '#'

        var elm = '<select name="" id="" onchange="optionChange(this)">';
        elm += '<option value="#">Pilih Device</option>';
        for (var i = 0; i < remote_devices.length; i++) {
            elm += '<option value="' + remote_devices[i] + '">' + remote_devices[i] + '</option>';
        }
        elm += '</select>';

        var promp = alertify.prompt();
        promp.setContent(elm);
        promp.setHeader('TAMBAH RUANGAN');
        promp.set('onok', function(closeEvent) {
            addProjectsDevice();
        });
        promp.set('onclose', function() {
            closeAlertify();
        });
        promp.set('movable', false);
        promp.show();
        openAlertify();
    }

    function optionChange(elm) {
        device_option = elm.value;
    }

    function addProjectsDevice() {
        if (device_option == '' || device_option == '#') {
            alertify.notify("Silahkan Pilih Devices!", 'warning', 3, function() {});
        } else if (device == '') {
            alertify.notify("Silahkan Pilih Type Devices!", 'warning', 3, function() {});
        } else {
            var data = new FormData();
            data.append("device", device_option);
            data.append("type", device);

            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var response = JSON.parse(this.responseText);
                if (response.status) {
                    alertify.notify(response.msg, "success", 3, function() {});
                } else {
                    alertify.notify(response.msg, "error", 3, function() {});
                }
            }
            xhr.open("POST", "api/app/device/{{$project}}", true);
            xhr.setRequestHeader('token', '{{$user->token}}');
            xhr.send(data);
        }
    }

    function switchBtn(elm, index) {
        var data = new FormData();
        data.append("token", '{{$user->token}}');
        data.append("nameproject", '{{$project}}');
        if (elm.checked) {
            var dataJson = list_lampu[index].datas.data;
            dataJson.V0 = 1;
            dataJson.V1 = 0;
            data.append("data", JSON.stringify(dataJson));
        } else {
            var dataJson = list_lampu[index].datas.data;
            dataJson.V0 = 0;
            dataJson.V1 = 1;
            data.append("data", JSON.stringify(dataJson));
        }
        data.append("namedevices", list_lampu[index].name);

        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {

            } else {

            }
        }
        xhr.open("POST", "http://platform.penelitianrpla.com/addData", true);
        xhr.send(data);
    }

    function gordenBtn(elm, index) {
        var data = new FormData();
        data.append("token", '{{$user->token}}');
        data.append("nameproject", '{{$project}}');
        if (elm.checked) {
            var dataJson = list_gorden[index].datas.data;
            dataJson.state = 1;
            data.append("data", JSON.stringify(dataJson));
        } else {
            var dataJson = list_gorden[index].datas.data;
            dataJson.state = 0;
            data.append("data", JSON.stringify(dataJson));
        }
        data.append("namedevices", list_gorden[index].name);

        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            if (response.status) {

            } else {

            }
        }
        xhr.open("POST", "http://platform.penelitianrpla.com/addData", true);
        xhr.send(data);
    }
</script>
@endsection