<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
 $item=pdo_get('zhtc_system',array('uniacid'=>$_GPC['uniacid']));
    if(checksubmit('submit')){
            // $data['support']=$_GPC['support'];
            $data['bq_name']=$_GPC['bq_name'];
            $data['link_name']=$_GPC['link_name'];
            $data['link_logo']=$_GPC['link_logo'];
            $data['bq_logo']=$_GPC['bq_logo'];       
            $data['tz_appid']=trim($_GPC['tz_appid']);
            $data['tz_name']=$_GPC['tz_name'];
            $data['cz_password']=$_GPC['cz_password'];
            $data['uniacid']=$_GPC['uniacid'];       
            if($_GPC['id']==''){                
                $res=pdo_insert('zhtc_system',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('copyright',array('uniacid'=>$_GPC['uniacid'])),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('zhtc_system', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('copyright',array('uniacid'=>$_GPC['uniacid'])),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
include $this->template('web/copyright');