<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$sql=" select a.*,b.name as nick_name from".tablename('zhtc_grouporder')." a left join ".tablename('zhtc_user')." b on a.user_id=b.id where a.id=:id";
$data[':id']=$_GPC['id'];
$item=pdo_fetch($sql,$data);
//$item=pdo_get('zhtc_grouporder',array('id'=>$_GPC['id']));
//
if($_GPC['op']=='refund'){
  include_once IA_ROOT . '/addons/zh_tcwq/cert/WxPay.Api.php';
    load()->model('account');
    load()->func('communication');
    $refund_order =pdo_get('zhtc_grouporder',array('id'=>$_GPC['order_id']));  
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
        message('操作成功！', $this->createWebUrl('grouporder'), 'success');
    }else{
    	 message($result['return_msg'],'','error');
    }
}

include $this->template('web/grouporderinfo');