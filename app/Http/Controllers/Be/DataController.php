<?php

namespace App\Http\Controllers\Be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

error_reporting(0);
class DataController extends Controller
{
    //
    public function login(Request $req)
    {
        if ($req->input('username') == null || $req->username == '') {
            return json_encode($this->array_response(false, 'username kosong atau tidak ada'), JSON_PRETTY_PRINT);
        }
        if ($req->input('password') == null || $req->password == '') {
            return json_encode($this->array_response(false, 'password kosong atau tidak ada'), JSON_PRETTY_PRINT);
        }

        $result = DB::select('select * from user where username = ? and password = ?', [$req->username, $req->password]);
        if (count($result) > 0) {
            $profile = DB::select('
                select u.*,t.token from user u 
                join token t on t.user = u.username
                where username = ?
            ', [$result[0]->username]);
            // session(['profile' => $profile[0]]);
            session()->put('profile', $profile[0]);
            $create = mkdir(app_path('Models/' . $profile[0]->username));
            if ($create) {
                file_put_contents(app_path('Models/' . $profile[0]->username . '/app.json'), []);
            }
            return json_encode($this->array_response(true, "Berhasil login"), JSON_PRETTY_PRINT);
        } else {
            return json_encode($this->array_response(false, "username atau password salah"), JSON_PRETTY_PRINT);
        }
    }

    public function getApp(Request $req, $type)
    {
        $user = $this->get_user($req);

        if (count($user) < 1) {
            return json_encode($this->array_response(false, 'token invalid', []), JSON_PRETTY_PRINT);
        }

        $app = json_decode(
            file_get_contents(app_path('Models/' . $user[0]->user . '/app.json')),
            true
        );

        $response = $this->curl_listProject($req, '/listProject');

        $remote = json_decode($response, true);

        if ($type == 'app') {
            if (count($app) < 1) {
                return json_encode(
                    $this->array_response(true, 'access granted', array()),
                    JSON_PRETTY_PRINT
                );
            }

            if (count($remote) < 1) {
                file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), "[]");
                return json_encode(
                    $this->array_response(true, 'access granted', []),
                    JSON_PRETTY_PRINT
                );
            }

            $tamp = array();
            for ($i = 0; $i < count($app); $i++) {
                for ($j = 0; $j < count($remote); $j++) {
                    if ($remote[$j]["nameProject"] == $app[$i]["nameProject"]) {
                        array_push($tamp, $app[$i]);
                        break;
                    }
                }
            }

            if (count($tamp) != count($app)) {
                file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), json_encode($tamp, JSON_PRETTY_PRINT));
            }

            return json_encode(
                $this->array_response(true, 'access granted', $tamp),
                JSON_PRETTY_PRINT
            );
        } elseif ($type == 'project') {
            if (count($remote) < 1) {
                return json_encode(
                    $this->array_response(true, 'access granted', []),
                    JSON_PRETTY_PRINT
                );
            }

            $tamp = array();
            foreach ($remote as $list) {
                array_push($tamp, 0);
            }
            for ($i = 0; $i < count($app); $i++) {
                for ($j = 0; $j < count($remote); $j++) {
                    if ($remote[$j]["nameProject"] == $app[$i]["nameProject"]) {
                        $tamp[$j] = 1;
                        break;
                    }
                }
            }

            $tamplp = array();
            for ($i = 0; $i < count($remote); $i++) {
                if ($tamp[$i] == 0) {
                    array_push($tamplp, $remote[$i]);
                }
            }

            return json_encode(
                $this->array_response(true, 'access granted', $tamplp),
                JSON_PRETTY_PRINT
            );
        } elseif ($type == 'device') {
            $project = $req->query('project');
            foreach ($app as $list) {
                if ($list["nameProject"] == $project) {
                    $url = "/listDevices/" . $project;
                    $rdevice = $this->curl_listProject($req, $url);
                    $rdevice = json_decode($rdevice, true);
                    if ($rdevice["status"]) {
                        $tamp = array();
                        for ($i = 0; $i < count($rdevice["data"]); $i++) {
                            foreach ($list["devices"] as $devices) {
                                if ($rdevice["data"][$i] == $devices["name"] && ($devices["type"] != null || $devices["type"] != NULL) && $devices["type"] != '') {
                                    array_push($tamp, $i);
                                }
                            }
                        }

                        for ($i = 0; $i < count($tamp); $i++) {
                            array_splice($rdevice["data"], $tamp[$i] - $i, 1);
                        }

                        return json_encode(
                            $this->array_response(true, "Berhasil mengambil data devices", $rdevice["data"]),
                            JSON_PRETTY_PRINT
                        );
                    } else {
                        return json_encode(
                            $this->array_response(false, "internal : " . $rdevice["msg"], []),
                            JSON_PRETTY_PRINT
                        );
                    }
                }
            }
            return json_encode(
                $this->array_response(false, "Project tidak ditemukan", []),
                JSON_PRETTY_PRINT
            );
        } elseif ($type == 'list-devices') {
            $project = $req->query('project');
            $type = $req->query('type');
            $tamp = array();
            foreach ($app as $list) {
                if ($list["nameProject"] == $project) {
                    foreach ($list["devices"] as $devices) {
                        if ($devices["type"] == $type) {
                            $data = $this->curl_listProject($req, '/lastData/' . $project . '/' . $devices["name"]);
                            $devices["datas"] = json_decode($data, true);
                            array_push($tamp, $devices);
                        }
                    }
                }
            }
            return json_encode(
                $this->array_response(true, 'access granted', $tamp),
                JSON_PRETTY_PRINT
            );
        } else {
            return json_encode(
                $this->array_response(true, 'access granted', []),
                JSON_PRETTY_PRINT
            );
        }
    }

    function addProjectApp(Request $req)
    {
        $user = $this->get_user($req);

        if ($req->input('project', null) == null) {
            return json_encode(
                $this->array_response(false, 'project kosong atau tidak ada'),
                JSON_PRETTY_PRINT
            );
        }

        if (count($user) < 1) {
            return json_encode($this->array_response(false, 'token invalid', []), JSON_PRETTY_PRINT);
        }

        $app = json_decode(
            file_get_contents(app_path('Models/' . $user[0]->user . '/app.json')),
            true
        );

        $response = $this->curl_listProject($req, '/listProject');

        $remote = json_decode($response, true);

        foreach ($remote as $list) {
            if ($list["nameProject"] == $req->project) {
                $list["devices"] = array();
                $app[count($app)] = $list;
                file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), json_encode($app, JSON_PRETTY_PRINT));
                return json_encode(
                    $this->array_response(true, "Berhasil menambahkan project"),
                    JSON_PRETTY_PRINT
                );
                break;
            }
        }
        return json_encode(
            $this->array_response(false, "Gagal menambahkan project"),
            JSON_PRETTY_PRINT
        );
    }

    function deleteProjectApp(Request $req, $nameProject)
    {
        $user = $this->get_user($req);

        if (count($user) < 1) {
            return json_encode($this->array_response(false, 'token invalid', []), JSON_PRETTY_PRINT);
        }

        $app = json_decode(
            file_get_contents(app_path('Models/' . $user[0]->user . '/app.json')),
            true
        );

        for ($i = 0; $i < count($app); $i++) {
            if ($app[$i]["nameProject"] == $nameProject) {
                array_splice($app, $i);
                file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), json_encode($app, JSON_PRETTY_PRINT));
                return json_encode(
                    $this->array_response(true, "Berhasil menghapus project"),
                    JSON_PRETTY_PRINT
                );
            }
        }
        return json_encode(
            $this->array_response(false, "Gagal menghapus project"),
            JSON_PRETTY_PRINT
        );
    }

    function deleteDeviceApp(Request $req, $nameProject, $nameDevice)
    {
        $user = $this->get_user($req);

        if (count($user) < 1) {
            return json_encode($this->array_response(false, 'token invalid', []), JSON_PRETTY_PRINT);
        }

        $app = json_decode(
            file_get_contents(app_path('Models/' . $user[0]->user . '/app.json')),
            true
        );

        for ($i = 0; $i < count($app); $i++) {
            if ($app[$i]["nameProject"] == $nameProject) {
                for ($j = 0; $j < count($app[$i]["devices"]); $j++) {
                    if ($app[$i]["devices"][$j]["name"] == $nameDevice) {
                        array_splice($app[$i]["devices"], $j);
                        file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), json_encode($app, JSON_PRETTY_PRINT));
                        return json_encode(
                            $this->array_response(true, "Berhasil menghapus devices"),
                            JSON_PRETTY_PRINT
                        );
                    }
                }
            }
        }
        return json_encode(
            $this->array_response(false, "Gagal menghapus devices, devices tidak ditemukan"),
            JSON_PRETTY_PRINT
        );
    }

    function addProjectDevice(Request $req, $project)
    {
        $user = $this->get_user($req);

        if (count($user) < 1) {
            return json_encode($this->array_response(false, 'token invalid', []), JSON_PRETTY_PRINT);
        }

        if ($req->input('device', null) == null) {
            return json_encode(
                $this->array_response(false, 'device kosong atau tidak ada'),
                JSON_PRETTY_PRINT
            );
        }
        if ($req->input('type', null) == null) {
            return json_encode(
                $this->array_response(false, 'type kosong atau tidak ada'),
                JSON_PRETTY_PRINT
            );
        }

        $app = json_decode(
            file_get_contents(app_path('Models/' . $user[0]->user . '/app.json')),
            true
        );

        for ($i = 0; $i < count($app); $i++) {
            if ($app[$i]["nameProject"] == $project) {
                $found = false;

                foreach ($app[$i]["devices"] as $devices) {
                    if ($devices["name"] == $req->device) {
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    return json_encode(
                        $this->array_response(false, "device sudah ada"),
                        JSON_PRETTY_PRINT
                    );
                } else {
                    $app[$i]["devices"][] = array("name" => $req->device, "type" => $req->type);
                    $status = file_put_contents(app_path('Models/' . $user[0]->user . '/app.json'), json_encode($app, JSON_PRETTY_PRINT));

                    return json_encode(
                        $this->array_response(true, "device berhasil ditambahkan"),
                        JSON_PRETTY_PRINT
                    );
                }
            }
        }

        return json_encode(
            $this->array_response(false, "project tidak ditemukan", []),
            JSON_PRETTY_PRINT
        );
    }
    function array_response($status, $msg, $data = null)
    {
        if ($data == null) {
            return array(
                'status' => $status,
                'msg' => $msg
            );
        } else {
            return array(
                'status' => $status,
                'msg' => $msg,
                'data' => $data
            );
        }
    }

    function get_user($req)
    {
        $user = DB::select('
            select * from token where token = ?
        ', [$req->header('token')]);
        return $user;
    }

    function curl_listProject($req, $route)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => str_replace(' ', '%20', 'http://platform.penelitianrpla.com' . $route),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'token: ' . $req->header('token')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
