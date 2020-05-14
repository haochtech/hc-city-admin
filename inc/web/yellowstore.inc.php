<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$where=" where a.uniacid=:uniacid ";
if(!empty($_GPC['keywords'])){
    $where.=" and a.company_name LIKE  concat('%', :name,'%') ";
    $data[':name']=$_GPC['keywords'];   
}
if(!empty($_GPC['time'])){
   $start=strtotime($_GPC['time']['start']);
   $end=strtotime($_GPC['time']['end']);
  $where.=" and a.sh_time >={$start} and a.sh_time<={$end} ";

}
if(!empty($_GPC['state'])){
   $start=strtotime($_GPC['time']['start']);
   $end=strtotime($_GPC['time']['end']);
  $where.=" and a.state ={$_GPC['state']}";

}
$data[':uniacid']=$_W['uniacid'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
$sql="SELECT a.*,b.days as typename,c.type_name FROM ".tablename('zhtc_yellowstore'). " a"  . " left join " . tablename("zhtc_yellowset") . " b on b.id=a.rz_type left join " . tablename("zhtc_yellowtype") . " c on c.id=a.type_id ".$where. " ORDER BY a.sort ASC,a.id DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zhtc_yellowstore'). " a" ." left join " . tablename("zhtc_yellowset") . " b on b.id=a.rz_type  left join " . tablename("zhtc_yellowtype") . " c on c.id=a.type_id ".$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
    $res=pdo_delete('zhtc_yellowstore',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl('yellowstore'), 'success');
        }else{
              message('删除失败！','','error');
        }
}
if($_GPC['op']=='tg'){
  $rst=pdo_get('zhtc_yellowstore',array('id'=>$_GPC['id']));
  $time=pdo_get('zhtc_yellowset',array('id'=>$rst['rz_type']));
  $newtime=$time['days']*24*60*60;
    $res=pdo_update('zhtc_yellowstore',array('state'=>2,'sh_time'=>time(),'dq_time'=>time()+$newtime),array('id'=>$_GPC['id']));
    if($res){
         message('通过成功！', $this->createWebUrl('yellowstore'), 'success');
        }else{
          message('通过失败！','','error');
        }
}
if($_GPC['op']=='jj'){
    $res=pdo_update('zhtc_yellowstore',array('state'=>3,'sh_time'=>time()),array('id'=>$_GPC['id']));
    if($res){
         message('拒绝成功！', $this->createWebUrl('yellowstore'), 'success');
        }else{
              message('拒绝失败！','','error');
        }
}
include $this->template('web/yellowstore');