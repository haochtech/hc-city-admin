<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
 $item=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
            if($item['cz_password']==$_GPC['cz_password']){
                setcookie("cz_password",$item['cz_password']);
                message('验证通过',$this->createWebUrl('settings'),'success');
            }else{
                message('验证失败','','error');
            }

        }
       if($_COOKIE["cz_password"]==$item['cz_password']){
       	include $this->template('web/settings');
       }else{
       	include $this->template('web/password');
       }
