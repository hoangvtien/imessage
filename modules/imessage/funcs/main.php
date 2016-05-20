<?php

/**
 * @Project ONLINE MESSAGE 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 19 May 2016 08:50:53 GMT
 */

if (!defined('NV_IS_MOD_CHAT'))
    die('Stop!!!');

$page_title = "Chat";

// Xu ly dang nhap
if ($nv_Request->isset_request('login', 'post')) {
    $username = $nv_username = $nv_Request->get_title('username', 'post', '');
    $password = $nv_password = $nv_Request->get_title('password', 'post', '');
    $token = $nv_Request->get_title('token', 'post', '');

    if ($token != md5($global_config['sitekey'] . session_id()))
        die("Error Access !!!");
    if (!$username)
        die($lang_module['err_username']);
    if (!$password)
        die($lang_module['err_pass']);

    if (defined('NV_IS_USER_FORUM')) {
        define('NV_IS_MOD_USER', true);
        require_once (NV_ROOTDIR . '/' . DIR_FORUM . '/nukeviet/login.php');
        if (empty($error))
            die("OK");
        die($error);
    } else {
        if (nv_check_valid_email($nv_username) == '') {
            // Email login
            $nv_username = nv_strtolower($nv_username);
            $sql = "SELECT * FROM " . NV_USERS_GLOBALTABLE . " WHERE email =" . $db->quote($nv_username);
            $login_email = true;
        } else {
            // Username login
            $sql = "SELECT * FROM " . NV_USERS_GLOBALTABLE . " WHERE md5username ='" . nv_md5safe($nv_username) . "'";
            $login_email = false;
        }
        $row = $db->query($sql)->fetch();

        if (! empty($row)) {
            if ((($row['md5username'] == nv_md5safe($nv_username) and $login_email == false) or ($row['email'] == $nv_username and $login_email == true)) and $crypt->validate_password($nv_password, $row['password'])) {
                if (! $row['active']) {
                    $error1 = $lang_module['login_no_active'];
                } else {
                    validUserLog($row, 1, '');
                    die("OK");
                }
            }
        }

        die($lang_module['login_no_correct']);
    }
}

// Dang nhap
if (!defined('NV_IS_USER')) {
    $xtpl = new XTemplate("login.tpl", NV_ROOTDIR . "/modules/" . $module_file . "/imessage");
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('DATAURL', NV_BASE_SITEURL . "modules/" . $module_file . "/imessage/");
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('BASEPOST', NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&login=1&token=" . md5($global_config['sitekey'] . session_id()));
    $xtpl->assign('REGISTERURL', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=users&amp;" . NV_OP_VARIABLE . "=register");

    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    include (NV_ROOTDIR . "/includes/header.php");
    echo nv_site_theme($contents, false);
    include (NV_ROOTDIR . "/includes/footer.php");
}

// Nhom duoc chat
$group_allow = array();
$check_group = nv_user_groups(implode(',', $user_info['in_groups']));
$group_allow = array_intersect($check_group, $config_allow);

// Kiem tra quyen chat
if (empty($group_allow)) {
    $xtpl = new XTemplate("info.tpl", NV_ROOTDIR . "/modules/" . $module_file . "/imessage");
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('DATAURL', NV_BASE_SITEURL . "modules/" . $module_file . "/imessage/");
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);

    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    include (NV_ROOTDIR . "/includes/header.php");
    echo nv_site_theme($contents, false);
    include (NV_ROOTDIR . "/includes/footer.php");
}

// Chieu cao khung chat
$height = 250;
if (isset($array_op[0])) {
    $height = (int)$array_op[0];
}
$nv_Request->set_Session('chat_height_' . $module_data, $height);

// Chuyen trang neu co mot nhom chat
if (sizeof($group_allow) == 1) {
    header("Location: " . nv_url_rewrite(NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=chat/" . $group_allow[0], true));
}

// Tat ca cac nhom
$groups = array();

$sql = "SELECT group_id, title FROM " . NV_GROUPS_GLOBALTABLE;
$result = $db->query($sql);
while ($row = $result->fetch()) {
    $groups[$row['group_id']] = $row['title'];
}

$xtpl = new XTemplate("select.tpl", NV_ROOTDIR . "/modules/" . $module_file . "/imessage");
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('DATAURL', NV_BASE_SITEURL . "modules/" . $module_file . "/imessage/");
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);

foreach ($group_allow as $groupID) {
    $xtpl->assign('TITLE', $groups[$groupID]);
    $xtpl->assign('URL', nv_url_rewrite(NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=chat/" . $groupID));
    $xtpl->parse('main.group');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_site_theme($contents, false);
include (NV_ROOTDIR . "/includes/footer.php");
