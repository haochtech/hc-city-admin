<?php
global $_GPC, $_W;
$action = 'start';
$GLOBALS['frames'] = $this->getNaveMenu($_COOKIE['cityname'], $action);
 $type=pdo_getall('zhtc_zx_type',array('uniacid'=>$_W['uniacid']));

$info=pdo_get('zhtc_zx',array('id'=>$_GPC['id']));
if($info['imgs']){
            if(strpos($info['imgs'],',')){
            $imgs= explode(',',$info['imgs']);
        }else{
            $imgs=array(
                0=>$info['imgs']
                );
        }
        }
if(checksubmit('submit')){
        $data['type_id']=$_GPC['type_id'];
        $data['title']=$_GPC['title'];
        $data['content']=html_entity_decode($_GPC['content']);
        $data['time']=date('Y-m-d H:i:s');
        $data['uniacid']=$_W['uniacid'];
        $data['cityname']=$_COOKIE['cityname'];
       if($_GPC['imgs']){
            $data['imgs']=implode(",",$_GPC['imgs']);
        }else{
            $data['imgs']='';
        }
        $res=pdo_update('zhtc_zx',$data,array('id'=>$_GPC['id']));
        if($res){
             message('编辑成功！', $this->createWebUrl2('dlinzxcheckmanager'), 'success');
        }else{
             message('编辑失败！','','error');
        }
    
}
include $this->template('web/dlinzxcheckinfo');