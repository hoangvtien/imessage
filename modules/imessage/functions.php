<?php

/**
 * @Project ONLINE MESSAGE 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 19 May 2016 08:50:53 GMT
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_IS_MOD_CHAT', true);

/**
 * nv_time_type()
 * 
 * @param mixed $time
 * @return
 */
function nv_time_type($time)
{
    global $lang_module;
    // Tinh toan thoi gian
    $timeout = NV_CURRENTTIME - $time;

    if ($timeout > 86400) {
        $time = nv_date("H:i d/m/Y", $time);
    } elseif ($timeout > 3600) {
        $timeout = (int)($timeout / 3600);
        $time = sprintf($lang_module['hago'], $timeout);
    } elseif ($timeout > 60) {
        $timeout = (int)($timeout / 60);
        $time = sprintf($lang_module['mago'], $timeout);
    } elseif ($timeout > 10) {
        $time = sprintf($lang_module['sago'], $timeout);
    } else {
        $time = $lang_module['atamoment'];
    }
    return $time;
}

/**
 * validUserLog()
 *
 * @param mixed $array_user
 * @param mixed $remember
 * @param mixed $opid
 * @return
 */
function validUserLog($array_user, $remember, $opid, $current_mode = 0)
{
    global $db, $global_config, $nv_Request;

    $remember = intval($remember);
    $checknum = md5(nv_genpass(10));
    $user = array(
        'userid' => $array_user['userid'],
        'current_mode' => $current_mode,
        'checknum' => $checknum,
        'checkhash' => md5($array_user['userid'] . $checknum . $global_config['sitekey'] . NV_USER_AGENT),
        'current_agent' => NV_USER_AGENT,
        'last_agent' => $array_user['last_agent'],
        'current_ip' => NV_CLIENT_IP,
        'last_ip' => $array_user['last_ip'],
        'current_login' => NV_CURRENTTIME,
        'last_login' => intval($array_user['last_login']),
        'last_openid' => $array_user['last_openid'],
        'current_openid' => $opid
    );

    $user = nv_base64_encode(serialize($user));

    $stmt = $db->prepare("UPDATE " . NV_USERS_GLOBALTABLE . " SET
		checknum = :checknum,
		last_login = " . NV_CURRENTTIME . ",
		last_ip = :last_ip,
		last_agent = :last_agent,
		last_openid = :opid,
		remember = " . $remember . "
		WHERE userid=" . $array_user['userid']);

    $stmt->bindValue(':checknum', $checknum, PDO::PARAM_STR);
    $stmt->bindValue(':last_ip', NV_CLIENT_IP, PDO::PARAM_STR);
    $stmt->bindValue(':last_agent', NV_USER_AGENT, PDO::PARAM_STR);
    $stmt->bindValue(':opid', $opid, PDO::PARAM_STR);
    $stmt->execute();
    $live_cookie_time = ($remember) ? NV_LIVE_COOKIE_TIME : 0;

    $nv_Request->set_Cookie('nvloginhash', $user, $live_cookie_time);
}

// Cau hinh chat
$config_allow = array();

$sql = "SELECT groupid FROM " . NV_PREFIXLANG . "_" . $module_data . " WHERE is_allow=1";
$list = $nv_Cache->db($sql, 'groupid', $module_name);

if (!empty($list)) {
    foreach ($list as $row)
        $config_allow[$row['groupid']] = $row['groupid'];
}

unset($list, $row, $sql);
