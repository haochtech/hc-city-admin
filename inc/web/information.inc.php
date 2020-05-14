<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$where = " where a.uniacid=:uniacid";
$data[':uniacid'] = $_W['uniacid'];
$type = isset($_GPC['type']) ? $_GPC['type'] : 'wait';
$tztype = pdo_getall('zhtc_type', array('uniacid' => $_W['uniacid']));
$state = $_GPC['state'];
if ($type == 'wait') {
    $state = 1;
}
if (isset($_GPC['keywords'])) {
    $where .= " and (a.user_name LIKE  concat('%', :name,'%') || a.user_tel LIKE  concat('%', :name,'%') || a.details LIKE  concat('%', :name,'%') || a.cityname LIKE  concat('%', :name,'%') || a.user_name LIKE  concat('%', :name,'%')) ";
    $data[':name'] = $_GPC['keywords'];
    $type = 'all';
} else {
    if ($state) {
        $where .= " and  a.state=:state";
        $data[':state'] = $state;
    }

}
if (!empty($_GPC['time'])) {
    $start = strtotime($_GPC['time']['start']);
    $end = strtotime($_GPC['time']['end']);
    $where .= " and a.time >={$start} and a.time<={$end}";

}
if ($_GPC['type_id'] > 0) {
    $where .= " and a.type_id=" . $_GPC['type_id'];

}
if ($_GPC['top']) {
    $where .= " and  a.top=:top";
    $data[':top'] = $_GPC['top'];
}
$pageindex = max(1, intval($_GPC['page']));
$pagesize = 10;
$sql = "select a.*,b.type,c.type_name from" . tablename('zhtc_information') . " a" . " left join " . tablename("zhtc_top") . " b on b.id=a.top_type left join " . tablename("zhtc_type") . " c on c.id=a.type_id" . $where . " ORDER BY a.id DESC";
$total = pdo_fetchcolumn("select count(*) from" . tablename('zhtc_information') . " a" . " left join " . tablename("zhtc_top") . " b on b.id=a.top_type" . $where, $data);
$select_sql = $sql . " LIMIT " . ($pageindex - 1) * $pagesize . "," . $pagesize;
$list = pdo_fetchall($select_sql, $data);
$pager = pagination($total, $pageindex, $pagesize);
if ($_GPC['op'] == 'delete') {
    $res = pdo_delete('zhtc_information', array('id' => $_GPC['id']));
    if ($res) {
        message('删除成功！', $this->createWebUrl('information', array('type' => $_GPC['type'], 'page' => $_GPC['page'])), 'success');
    } else {
        message('删除失败！', '', 'error');
    }
}

if ($_GPC['op'] == 'tg') {
    $tz = pdo_get('zhtc_information', array('id' => $_GPC['id']));
    if (!$tz['sh_time']) {
        if ($tz['top_type'] == 1) {
            $time = time() + 24 * 60 * 60;
        } elseif ($tz['top_type'] == 2) {
            $time = time() + 24 * 60 * 60 * 7;
        } elseif ($tz['top_type'] == 3) {
            $time = time() + 24 * 60 * 60 * 30;
        }
        $res = pdo_update('zhtc_information', array('state' => 2, 'sh_time' => time(), 'dq_time' => $time), array('id' => $_GPC['id']));
    } else {
        $res = pdo_update('zhtc_information', array('state' => 2), array('id' => $_GPC['id']));
    }
    if ($res) {
        file_get_contents("" . $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&a=wxapp&do=tgMessage&m=zh_tcwq&information_id=" . $_GPC['id']);//模板消息
        $this->increaseScore($tz['user_id']);
        message('通过成功！', $this->createWebUrl('information', array('type' => $_GPC['type'], 'page' => $_GPC['page'])), 'success');
    } else {
        message('通过失败！', '', 'error');
    }
}
if ($_GPC['op'] == 'jj') {
    $tz = pdo_get('zhtc_information', array('id' => $_GPC['id']));
    $res = pdo_update('zhtc_information', array('state' => 3, 'sh_time' => time()), array('id' => $_GPC['id']));

    if ($res) {
        message('拒绝成功！', $this->createWebUrl('information', array('type' => $_GPC['type'], 'page' => $_GPC['page'])), 'success');
    } else {
        message('拒绝失败！', '', 'error');
    }
}
if ($_GPC['op'] == 'defriend') {
    $res4 = pdo_update("zhtc_user", array('state' => 2), array('id' => $_GPC['id']));
    if ($res4) {
        message('拉黑成功！', $this->createWebUrl('information', array('type' => $_GPC['type'], 'page' => $_GPC['page'])), 'success');
    } else {
        message('拉黑失败！', '', 'error');
    }
}
if ($_GPC['op'] == 'relieve') {
    $res4 = pdo_update("zhtc_user", array('state' => 1), array('id' => $_GPC['id']));
    if ($res4) {
        message('取消成功！', $this->createWebUrl('information', array('type' => $_GPC['type'], 'page' => $_GPC['page'])), 'success');
    } else {
        message('取消失败！', '', 'error');
    }
}


if(checksubmit('export_submit', true)) {
  if($_GPC['time']['start']==$_GPC['time']['end']){
        $dcstart=strtotime(date('Y-m-d 00:00:00'));
        $dcend=strtotime(date('Y-m-d 23:59:59'));
        $note=$_GPC['time']['start']."帖子数据";
    }else{
        $dcstart=strtotime($_GPC['time']['start']." 00:00:00");
        $dcend=strtotime($_GPC['time']['end']." 23:59:59");

        $note=$_GPC['time']['start']."至".$_GPC['time']['end']."帖子数据";
    }
  $count = pdo_fetchcolumn("SELECT COUNT(*) FROM". tablename("zhtc_information")." WHERE uniacid={$_W['uniacid']} and state=2 and time>={$dcstart} and time<={$dcend}");
  $pagesize = ceil($count/5000);
        //array_unshift( $names,  '活动名称'); 

  $header = array(
    'id'=>'帖子id',
    'img' => '图片', 
    'user_name' => '联系人', 
    'user_tel' => '联系电话', 
    'user_id' => '用户id', 
    'type_name' => '一级分类',
    'nTypeName' => '二级分类',
    'money' => '发布金额',
    'time' => '发布时间',
    'hot' => '是否热门',
    'top' => '是否置顶',
    );

  $keys = array_keys($header);
  $html = "\xEF\xBB\xBF";
  foreach ($header as $li) {
    $html .= $li . "\t ,";
  }
  $html .= "\n";
  for ($j = 1; $j <= $pagesize; $j++) {
    $sql = "select a.*,b.type_name,c.name as nTypeName from " . tablename("zhtc_information")."  a"  . " left join " . tablename("zhtc_type")." b on a.type_id=b.id left join " . tablename("zhtc_type2")." c on a.type2_id=c.id  WHERE a.uniacid={$_W['uniacid']} and a.state=2 and a.time>={$dcstart} and a.time<={$dcend} limit " . ($j - 1) * 5000 . ",5000 ";
    $list = pdo_fetchall($sql);            
  }

  if (!empty($list)) {
    $size = ceil(count($list) / 500);
    for ($i = 0; $i < $size; $i++) {
      $buffer = array_slice($list, $i * 500, 500);
      $user = array();
      foreach ($buffer as $k =>$row) {
     $row['img']=str_replace(',','#',$row['img']);
        
        if($row['hot']==1){
          $row['hot']='是';
        }else{
          $row['hot']='否';
        }
        if($row['top']==1){
          $row['top']='是';
        }else{
          $row['top']='否';
        }
        $row['time']=date('Y-m-d H:i:s',$row['time']);
        $row['cityname']=$row['cityname']?:'全国';
        
        foreach ($keys as $key) {
          $data5[] = $row[$key];
        }
        $user[] = implode("\t ,", $data5) . "\t ,";
        unset($data5);
      }
      $html .= implode("\n", $user) . "\n";
    }
  }
  
  header("Content-type:text/csv");
  header("Content-Disposition:attachment; filename=商家数据.csv");
  echo $html;
  exit();
}
include $this->template('web/information');