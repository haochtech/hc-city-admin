<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$info=pdo_get('zhtc_information',array('id'=>$_GPC['id']));
if(empty($info['dq_time'])){
	$info['dq_time']=time();
}
if($info['lat']){
	$info['coordinates']=$info['lat'].','.$info['lng'];
}
//$info['coordinates']=$info['lat'].','.$info['lng'];
$type=pdo_getall('zhtc_type',array('uniacid'=>$_W['uniacid'],'state'=>1),array(),'','num asc');
$type2=pdo_get('zhtc_type2',array('id'=>$info['type2_id']));
$system=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
if($info['img']){
	if(strpos($info['img'],',')){
		$img= explode(',',$info['img']);
	}else{
		$img=array(
			0=>$info['img']
			);
	}
}
if(checksubmit('submit')){
	if($_GPC['img']){
		$data['img']=implode(",",$_GPC['img']);
	}else{
		$data['img']='';
	}
	$arr=explode(",",$_GPC['coordinates']);
	$data['user_name']=$_GPC['user_name'];
	$data['views']=$_GPC['views'];
	$data['user_tel']=$_GPC['user_tel'];
	$data['details']=$_GPC['details'];
	$data['hot']=$_GPC['hot'];
	$data['top']=$_GPC['top'];
	$data['address']=$_GPC['address'];
	$data['cityname']=$_GPC['cityname'];
	$data['type_id']=$_GPC['type_id'];
	$data['type2_id']=$_GPC['type2_id'];
	$data['lat']=$arr['0'];
	$data['lng']=$arr['1'];
	if($_GPC['dq_time']!="1970-01-01"){
		$data['dq_time']=strtotime($_GPC['dq_time']);
	}
	$res = pdo_update('zhtc_information', $data, array('id' => $_GPC['id']));
	if($res){
		message('编辑成功',$this->createWebUrl('information',array('type'=>$_GPC['type'],'page'=>$_GPC['page'])),'success');
	}else{
		message('编辑失败','','error');
	}
}
include $this->template('web/informationinfo');