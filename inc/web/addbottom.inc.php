<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$info = pdo_get('zhtc_bottom', array('id' => $_GPC['id']));
if (checksubmit('submit')) {
    if (!$_GPC['title']) {
        message('标题不能为空', '', 'error');
    }
    if (!$_GPC['logo'] || !$_GPC['logo2']) {
        message('图片不能为空', '', 'error');
    }
    $data['title'] = $_GPC['title'];
    $data['logo'] = $_GPC['logo'];
    $data['logo2'] = $_GPC['logo2'];
    if ($_GPC['title_color']) {
        $data['title_color'] = $_GPC['title_color'];
    } else {
        $data['title_color'] = "#ff7f46";
    }
    if ($_GPC['title_color2']) {
        $data['title_color2'] = $_GPC['title_color2'];
    } else {
        $data['title_color2'] = "#888";
    }
    if ($_GPC['item'] == 1) {
        $data['url'] = $_GPC['url'];
    } elseif ($_GPC['item'] == 2) {
        $data['src2'] = $_GPC['src2'];
    } elseif ($_GPC['item'] == 3) {
        $data['xcx_name'] = $_GPC['xcx_name'];
        $data['appid'] = trim($_GPC['appid']);
    }
    $data['item'] = $_GPC['item'];
    $data['num'] = $_GPC['num'];
    $data['uniacid'] = $_W['uniacid'];
    $data['state'] = $_GPC['state'];
    if ($_GPC['id'] == '') {
        $res = pdo_insert('zhtc_bottom', $data);
        if ($res) {
            message('添加成功！', $this->createWebUrl('bottom'), 'success');
        } else {
            message('添加失败！', '', 'error');
        }
    } else {
        $res = pdo_update('zhtc_bottom', $data, array('id' => $_GPC['id']));
        if ($res) {
            message('编辑成功！', $this->createWebUrl('bottom'), 'success');
        } else {
            message('编辑失败！', '', 'error');
        }
    }
}
include $this->template('web/addbottom');