<?php

global $_GPC, $_W;
/*if($_GPC['cityname']){

  setcookie('cityname',$_GPC['cityname']);
  //$cityname=$_COOKIE['cityname'];
  $_COOKIE['cityname']=$_GPC['cityname'];
}*/

$type=isset($_GPC['type'])?$_GPC['type']:'wait';
$GLOBALS['frames'] = $this->getMainMenu2();
$where=" where a.uniacid=:uniacid and a.cityname=:cityname";
$data[':uniacid']=$_W['uniacid']; 
$data[':cityname']= $_COOKIE['cityname'];
if(isset($_GPC['keywords'])){
     $where.=" and (a.user_name LIKE  concat('%', :name,'%') || a.user_tel LIKE  concat('%', :name,'%') || a.details LIKE  concat('%', :name,'%') || a.cityname LIKE  concat('%', :name,'%') || a.user_name LIKE  concat('%', :name,'%')) ";
    $data[':name']=$_GPC['keywords'];   
 $type='all';
}else{
  if($type=='wait'||$type=='ok'||$type=='no'){
    $where.=" and  a.state=:state";
     $data[':state']=$_GPC['state']; 
}
}
if(!empty($_GPC['time'])){
   $start=strtotime($_GPC['time']['start']);
   $end=strtotime($_GPC['time']['end']);
  $where.=" and a.time >={$start} and a.time<={$end}";

}

if($_GPC['top']){
      $where.=" and  a.top=:top";
     $data[':top']=$_GPC['top']; 
}
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;


$sql="select a.*,b.type from".tablename('zhtc_information'). " a"  . " left join " . tablename("zhtc_top") . " b on b.id=a.top_type".$where." ORDER BY a.id DESC";
$total=pdo_fetchcolumn("select count(*) from".tablename('zhtc_information'). " a"  . " left join " . tablename("zhtc_top") . " b on b.id=a.top_type".$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
    $res=pdo_delete('zhtc_information',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl('ininformation',array('type'=>$_GPC['type'],'page'=>$_GPC['page'])), 'success');
        }else{
              message('删除失败！','','error');
        }
}

if($_GPC['op']=='tg'){
   $tz=pdo_get('zhtc_information',array('id'=>$_GPC['id']));
  if(!$tz['sh_time']){
      if($tz['top_type']==1){
    $time=time()+24*60*60;
    }elseif($tz['top_type']==2){
      $time=time()+24*60*60*7;
    }elseif($tz['top_type']==3){
      $time=time()+24*60*60*30;
    }
     $res=pdo_update('zhtc_information',array('state'=>2,'sh_time'=>time(),'dq_time'=>$time),array('id'=>$_GPC['id']));
  }else{
     $res=pdo_update('zhtc_information',array('state'=>2),array('id'=>$_GPC['id']));
  }
    if($res){
      $this->increaseScore($tz['user_id']);
      file_get_contents("".$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=tgMessage&m=zh_tcwq&information_id=".$_GPC['id']);//模板消息
         message('通过成功！', $this->createWebUrl('ininformation',array('type'=>$_GPC['type'],'page'=>$_GPC['page'])), 'success');
        }else{
              message('通过失败！','','error');
        }
}

if($_GPC['op']=='jj'){
    $res=pdo_update('zhtc_information',array('state'=>3,'sh_time'=>time()),array('id'=>$_GPC['id']));
    if($res){
         message('拒绝成功！', $this->createWebUrl('ininformation',array('type'=>$_GPC['type'],'page'=>$_GPC['page'])), 'success');
        }else{
         message('拒绝失败！','','error');
        }
}
include $this->template('web/ininformation');