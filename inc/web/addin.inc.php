<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
	$info = pdo_get('zhtc_in',array('uniacid' => $_W['uniacid'],'id'=>$_GPC['id']));
		if(checksubmit('submit')){
			$data['type']=$_GPC['type'];
			$data['money']=$_GPC['money'];
			$data['money2']=$_GPC['money2'];
			$data['num']=$_GPC['num'];
			$data['uniacid']=$_W['uniacid'];
			if($_GPC['id']==''){				
				$res=pdo_insert('zhtc_in',$data);
				if($res){
					message('添加成功',$this->createWebUrl('in',array()),'success');
				}else{
					message('添加失败','','error');
				}
			}else{
				$res = pdo_update('zhtc_in', $data, array('id' => $_GPC['id']));
				if($res){
					message('编辑成功',$this->createWebUrl('in',array()),'success');
				}else{
					message('编辑失败','','error');
				}
			}
		}
include $this->template('web/addin');