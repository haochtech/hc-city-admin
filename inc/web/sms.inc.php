<?php
global $_GPC, $_W;
// $action = 'ad';
// $title = $this->actions_titles[$action];
$GLOBALS['frames'] = $this->getMainMenu();
$item=pdo_get('zhtc_sms',array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
            $data['appkey']=trim($_GPC['appkey']);
            $data['tpl_id']=trim($_GPC['tpl_id']);
            $data['tpl2_id']=trim($_GPC['tpl2_id']);
            $data['is_open']=$_GPC['is_open'];
            $data['aliyun_appkey']=trim($_GPC['aliyun_appkey']);
            $data['aliyun_appsecret']=trim($_GPC['aliyun_appsecret']);
            $data['aliyun_sign']=$_GPC['aliyun_sign'];
            $data['item']=$_GPC['item'];
            $data['uniacid']=trim($_W['uniacid']);
            if($_GPC['id']==''){                
                $res=pdo_insert('zhtc_sms',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('sms',array()),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('zhtc_sms', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('sms',array()),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
    include $this->template('web/sms');