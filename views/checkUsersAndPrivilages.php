<?php

require_once '../config/dbc.php';
require_once '../class/systemSetting.php';
$system = new setting();

if (array_key_exists("logSystem", $_POST)) {
    if (isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $user = ($_POST['userName']);
        $pass = ($_POST['password']);
        $userQuery = "SELECT
in_usr.usrID,
in_usr.usrName,
in_usr.usrPwd,
in_usr.usrStatus,
in_usr.usrLevel,
in_usr.userBranchID
FROM
in_usr
WHERE
(in_usr.usrStatus = '1') AND
in_usr.usrName = '{$user}' LIMIT 1";
//        echo $userQuery.'<br/>';
        
        $userAvailability = $system->getCountByQuery($userQuery);
//        echo 'lalalal';
        if ($userAvailability > 0) {
            $userDetails = $system->prepareSelectQuery($userQuery);
            $encriptedPass = sha1('MDCC' . $pass . 'badboyes');
            foreach ($userDetails as $ud) {
                if ($ud['usrPwd'] == $encriptedPass) {
                    //Set Cookie if select remember btn
                    session_start();
                    $_SESSION['htl_user_id'] = $ud['usrID'];
                    $_SESSION['htl_user_name'] = $ud['usrName'];
                    $_SESSION['htl_user_level'] = $ud['usrLevel'];
                    $_SESSION['htl_usrStatus'] = $ud['usrStatus'];
                    $_SESSION['htl_branch'] = $ud['userBranchID'];
                    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);

                    if (isset($_POST['remember']) && $_POST['remember'] == 'r') {
                        setcookie("htl_user_id", $_SESSION['htl_user_id'], time() + 60 * 60 * 24 * COOKIE_TIME_OUT, "/");
                        setcookie("htl_user_name", $_SESSION['htl_user_name'], time() + 60 * 60 * 24 * COOKIE_TIME_OUT, "/");
                    }
                    echo json_encode(array(array("msgType" => 0, "msg" => "")));
                } else {
                    echo json_encode(array(array("msgType" => 1, "msg" => "Password was incorrect.Please Check your Password")));
                }
            }
        } else {
            echo json_encode(array(array("msgType" => 2, "msg" => "User was not available in database,plase check your username")));
        }
    } else {
        echo json_encode(array(array("msgType" => 3, "msg" => "Please enter username or password")));
    }
}

if (array_key_exists("logout", $_POST)) {
    session_start();
    unset($_SESSION['htl_user_id']);
    unset($_SESSION['htl_user_name']);
    unset($_SESSION['htl_user_level']);
    unset($_SESSION['htl_usrStatus']);
    unset($_SESSION['HTTP_USER_AGENT']);
    echo 1;
}

if (array_key_exists('pageProtect', $_POST)) {
    session_start();
    if (isset($_SESSION['HTTP_USER_AGENT']) && isset($_SESSION['htl_usrStatus'])) {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 1;
    }
}

if (array_key_exists('checkUrl', $_POST)) {
    $ok = 0;
    $back = 0;
    session_start();
    $getUserPrivilages = $system->prepareSelectQuery("SELECT
in_usrprvlg.usrID,
in_sysprvlg.usrPrvMnuPath
FROM
in_usrprvlg
INNER JOIN in_sysprvlg ON in_usrprvlg.usrPrvCode = in_sysprvlg.prvCode
WHERE in_usrprvlg.usrID = '{{$_SESSION['htl_user_id']}'");
    if ($getUserPrivilages) {
        foreach ($getUserPrivilages AS $aa) {
            if ($_POST['path'] == '/accounts_system/' . $aa['usrPrvMnuPath']) {
                $ok++;
            } else {
                $back++;
            }
        }
        echo json_encode(array("ok" => $ok, "back" => $back));
    }
}

