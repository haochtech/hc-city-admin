<?php
global $_GPC, $_W;

$GLOBALS['frames'] = $this->getMainMenu();
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
$type2=isset($_GPC['type2'])?$_GPC['type2']:'today';
$where=" where a.uniacid=:uniacid ";
$data[':uniacid']=$_W['uniacid']; 
if(isset($_GPC['keywords'])){
  $where.=" and (a.goods_name LIKE  concat('%', :name,'%') || a.order_num LIKE  concat('%', :name,'%') || b.name LIKE  concat('%', :name,'%') || c.store_name LIKE  concat('%', :name,'%'))";
  $data[':name']=$_GPC['keywords']; 
  $type='all';  
}
if($_GPC['time']){
  $start=strtotime($_GPC['time']['start']);
  $end=strtotime($_GPC['time']['end']);
  $where.=" and a.time >='{$start}' and a.time<='{$end}'";
  $type='all';
}else{
 if($type=='wait'){
  $where.=" and a.state=1";
}
if($type=='pay'){
  $where.=" and a.state=2";
}

if($type=='complete'){
  $where.=" and a.state=3";
}
if($type=='close'){
  $where.=" and a.state=4";
}
if($type=='invalid'){
  $where.=" and a.state=5";
} 

}
$sql="SELECT a.*,b.name as nick_name,c.store_name FROM ".tablename('zhtc_grouporder'). " a"  . " left join " . tablename("zhtc_user") . " b on a.user_id=b.id  left join " . tablename("zhtc_store") . " c on a.store_id=c.id " .$where." ORDER BY a.id DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zhtc_grouporder'). " a"  . " left join " . tablename("zhtc_user") . " b on a.user_id=b.id left join " . tablename("zhtc_store") . " c on a.store_id=c.id " .$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;

$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);

if($_GPC['op']=='delete'){
  $res=pdo_delete('zhtc_grouporder',array('id'=>$_GPC['id']));
  if($res){
   message('删除成功！', $this->createWebUrl('grouporder'), 'success');
 }else{
  message('删除失败！','','error');
}
}

//拼团失败,退款
  $ids=pdo_getall('zhtc_group',array('dq_time <='=>time(),'state'=>1,'uniacid'=>$_W['uniacid']),'id');  
  //var_dump($ids);die;
  if($ids){ 
  $uids = array_map('array_shift', $ids);
  $orders=pdo_getall('zhtc_grouporder',array('group_id'=>$uids,'state'=>2,'pay_type'=>1),'id');
  foreach ($orders as $key => $value) {
    include_once IA_ROOT . '/addons/zh_tcwq/cert/WxPay.Api.php';
    load()->model('account');
    load()->func('communication');
    $refund_order =pdo_get('zhtc_grouporder',array('id'=>$value));  
    $WxPayApi = new WxPayApi();
    $input = new WxPayRefund();
    $path_cert = IA_ROOT . "/addons/zh_tcwq/cert/".'apiclient_cert_' .$_W['uniacid'] . '.pem';
    $path_key = IA_ROOT . "/addons/zh_tcwq/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
    $account_info = $_W['account'];   
    $system=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid'])); 
    $appid=$system['appid'];
    $key=$system['wxkey'];
    $mchid=$system['mchid']; 
    $out_trade_no=$refund_order['code'];
    $fee = $refund_order['money'] * 100;
    $input->SetAppid($appid);
    $input->SetMch_id($mchid);
    $input->SetOp_user_id($mchid);
    $input->SetRefund_fee($fee);
    $input->SetTotal_fee($fee);
           // $input->SetTransaction_id($refundid);
    $input->SetOut_refund_no($refund_order['order_num']);
    $input->SetOut_trade_no($out_trade_no);
    $result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);

 ////////////////////////////////////
    if ($result['result_code'] == 'SUCCESS') {//退款成功
        //更改订单操作
      pdo_update('zhtc_grouporder',array('state'=>4),array('id'=>$value));
    }

}

$group=pdo_update('zhtc_group',array('state'=>3),array('id'=>$uids));
}

include $this->template('web/grouporder');