<?php


defined('IN_IA') or exit('Access Denied');



class Zh_tcwqModule extends WeModule {





	public function welcomeDisplay()

    {   
    	global $_GPC, $_W;

    	$account=pdo_get('zhtc_account',array('uid'=>$_W['user']['uid']));
        $url = $this->createWebUrl('index');
        if ($_W['role'] == 'operator'&& $account['role']==1) {
        	$url = $this->createWebUrl('account');
        }
         if ($_W['role'] == 'operator'&& $account['role']==2) {
         	
        	$url = $this->createWebUrl('log');
        }

        Header("Location: " . $url);

    }

}