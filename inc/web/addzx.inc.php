<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
 $type=pdo_getall('zhtc_zx_type',array('uniacid'=>$_W['uniacid']));
$system=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
$info=pdo_get('zhtc_zx',array('id'=>$_GPC['id']));
//var_dump($info);die;
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
        $data['video']=$_GPC['video'];
        $data['content']=html_entity_decode($_GPC['content']);    
        $data['uniacid']=$_W['uniacid'];
        $data['state']=2;
        $data['yd_num']=$_GPC['yd_num'];
       if($_GPC['imgs']){
            $data['imgs']=implode(",",$_GPC['imgs']);
        }else{
            $data['imgs']='';
        }
     if($_GPC['id']==''){  
        $data['type']=2;
         $data['time']=date('Y-m-d H:i:s');
         $data['pl_num']=0;
         $data['cityname']=$system['cityname'];
        $res=pdo_insert('zhtc_zx',$data);
        if($res){
             message('添加成功！', $this->createWebUrl('zx'), 'success');
        }else{
             message('添加失败！','','error');
        }
    }else{
        $data['cityname']=$_GPC['cityname'];
        $res=pdo_update('zhtc_zx',$data,array('id'=>$_GPC['id']));
        if($res){
             message('编辑成功！', $this->createWebUrl('zx'), 'success');
        }else{
             message('编辑失败！','','error');
        }
    }
}
include $this->template('web/addzx');