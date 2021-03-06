<?php
global $_GPC, $_W;
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu2($storeid);
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$type=isset($_GPC['type'])?$_GPC['type']:'all';
$status=$_GPC['status'];
load()->func('tpl');
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=' WHERE  a.uniacid=:uniacid and store_id=:store_id ';
$data[':uniacid']=$_W['uniacid'];
$data[':store_id']=$storeid;
if($_GPC['keywords']){
   $op=$_GPC['keywords'];
   $where.=" and (a.order_num LIKE  concat('%', :order_no,'%') or a.user_name LIKE  concat('%', :order_no,'%'))";	
   $data[':order_no']=$op;
}	
if($status){
   $op=$_GPC['keywords'];
   $where.= " and a.state=$status";
}
if($_GPC['time']){
   $start=strtotime($_GPC['time']['start']);
   $end=strtotime($_GPC['time']['end']);
  $where.=" and a.time >={$start} and a.time<={$end}";

}
$sql="SELECT a.*,b.store_name as seller_name FROM ".tablename('zhtc_order') .  " a"  . " left join " . tablename("zhtc_store") . " b on a.store_id=b.id".$where." ORDER BY a.time DESC";

$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zhtc_order') .  " a"  . " left join " . tablename("zhtc_store") . " b on a.store_id=b.id".$where." ORDER BY a.time DESC",$data);


$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($operation=='delete'){
	$res=pdo_delete('zhtc_order',array('id'=>$_GPC['id']));
   //$res=pdo_update('zhtc_order',array('is_delete'=>1),array('id'=>$_GPC['id']));
	if($res){
		message('删除成功',$this->createWebUrl2('sjddgl',array()),'success');
	}else{
		message('删除失败','','error');
	}
}
if($operation=='delivery'){
	
   $res=pdo_update('zhtc_order',array('state'=>3,'fh_time'=>time()),array('id'=>$_GPC['id']));
	if($res){
		message('操作成功',$this->createWebUrl2('sjddgl',array()),'success');
	}else{
		message('操作失败','','error');
	}
}
if($operation=='receipt'){
	$order=pdo_get('zhtc_order',array('id'=>$_GPC['id']));
   $res=pdo_update('zhtc_order',array('state'=>4,'complete_time'=>time()),array('id'=>$_GPC['id']));
	if($res){
 pdo_update('zhtc_store',array('wallet +='=>$order['money']),array('id'=>$order['store_id']));
         $data3['store_id']=$order['store_id'];
         $data3['money']=$order['money'];
         $data3['note']='商品订单';
         $data3['type']=1;
         $data3['time']=date("Y-m-d H:i:s");
         pdo_insert('zhtc_store_wallet',$data3);
$system=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
if($system['good_jf']>0){
  pdo_update('zhtc_user',array('total_score +='=>$system['good_jf']),array('id'=>$order['user_id']));
  $data2['score']=$system['good_jf'];
  $data2['user_id']=$order['user_id'];
  $data2['tid']=$order['id'];
  $data2['note']='商品订单';
  $data2['type']=1;
  $data2['cerated_time']=date('Y-m-d H:i:s');
  $data2['uniacid']=$_W['uniacid'];//小程序id
  pdo_insert('zhtc_integral',$data2);//添加积分明细 
}

		message('操作成功',$this->createWebUrl2('sjddgl',array()),'success');
	}else{
		message('操作失败','','error');
	}
}
if($operation=='refund'){
    $id=$_GPC['id'];
    include_once IA_ROOT . '/addons/zh_tcwq/cert/WxPay.Api.php';
    load()->model('account');
    load()->func('communication');
    $WxPayApi = new WxPayApi();
    $input = new WxPayRefund();
    $path_cert = IA_ROOT . "/addons/zh_tcwq/cert/".'apiclient_cert_' . $_W['uniacid'] . '.pem';
    $path_key = IA_ROOT . "/addons/zh_tcwq/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
    $account_info = $_W['account'];
    $refund_order =pdo_get('zhtc_order',array('id'=>$id));  
    $res=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
    $appid=$res['appid'];
    $key=$res['wxkey'];
    $mchid=$res['mchid']; 
    $out_trade_no=$refund_order['out_trade_no'];
    $fee = $refund_order['money'] * 100;
    $input->SetAppid($appid);
    $input->SetMch_id($mchid);
    $input->SetOp_user_id($mchid);
    $input->SetRefund_fee($fee);
    $input->SetTotal_fee($fee);
           // $input->SetTransaction_id($refundid);
    $input->SetOut_refund_no($id);

    $input->SetOut_trade_no($out_trade_no);

    $result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);
   //var_dump($result);die;
if ($result['result_code'] == 'SUCCESS') {//退款成功
//更改订单操作
    pdo_update('zhtc_order',array('state'=>6),array('id'=>$id));           
    message('退款成功',$this->createWebUrl2('sjddgl',array()),'success');
}else{
    message('退款失败','','error');
}
}
if($operation=='jj'){
    $id=$_GPC['id'];  
    $res=pdo_update('zhtc_order',array('state'=>7),array('id'=>$id));
    if($res){
        message('拒绝成功',$this->createWebUrl2('sjddgl',array()),'success');
    }else{
        message('拒绝失败','','error');
    }
}

include $this->template('web/sjddgl');