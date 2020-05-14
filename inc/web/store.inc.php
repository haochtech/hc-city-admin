<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$where=" where a.uniacid=:uniacid";
$data[':uniacid']=$_W['uniacid']; 
$type=isset($_GPC['type'])?$_GPC['type']:'wait';
$tztype=pdo_getall('zhtc_storetype',array('uniacid'=>$_W['uniacid']));
$state=$_GPC['state'];
if($type=='wait'){
  $state=1;
}
if(isset($_GPC['keywords'])){
  $where.=" and (a.store_name LIKE  concat('%', :name,'%') || a.tel LIKE  concat('%', :name,'%')) ";
  $data[':name']=$_GPC['keywords'];  
 $type='all'; 
}else{
  if($state){
  $where.=" and  a.state=:state ";
  $data[':state']=$state;   
}
}
if($_GPC['type_id']>0){
  $where.=" and a.storetype_id=".$_GPC['type_id'];

}

$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;


$sql="SELECT a.*,b.type as typename,c.type_name FROM ".tablename('zhtc_store'). " a"  . " left join " . tablename("zhtc_in") . " b on b.id=a.type left join " . tablename("zhtc_storetype") . " c on c.id=a.storetype_id".$where." ORDER BY a.id DESC";
$total=pdo_fetchcolumn("select count(*) from " .tablename('zhtc_store'). " a"  . " left join " . tablename("zhtc_in") . " b on b.id=a.type left join " . tablename("zhtc_storetype") . " c on c.id=a.storetype_id".$where,$data);
//echo $sql;die;
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;

$list=pdo_fetchall($select_sql,$data);

$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
    $res=pdo_delete('zhtc_store',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl('store'), 'success');
        }else{
              message('删除失败！','','error');
        }
}
if($_GPC['op']=='tg'){
  $rst=pdo_get('zhtc_store',array('id'=>$_GPC['id']));
  if(!$rst['sh_time']){//增加
     
		  if($rst['type']==1){
		    $time=24*60*60*7;
		  }
		  if($rst['type']==2){
		    $time=24*182*60*60;
		  }
		  if($rst['type']==3){
		    $time=24*365*60*60;
		  }
  $time2=time();
   $res=pdo_update('zhtc_store',array('state'=>2,'sh_time'=>$time2,'dq_time'=>time()+$time),array('id'=>$_GPC['id']));
  }else{//修改
  	 $res=pdo_update('zhtc_store',array('state'=>2),array('id'=>$_GPC['id']));
  }
 

   
    if($res){
         message('通过成功！', $this->createWebUrl('store'), 'success');
        }else{
              message('通过失败！','','error');
        }
}
if($_GPC['op']=='jj'){
    $res=pdo_update('zhtc_store',array('state'=>3,'sh_time'=>time()),array('id'=>$_GPC['id']));
    if($res){
         message('拒绝成功！', $this->createWebUrl('store'), 'success');
        }else{
              message('拒绝失败！','','error');
        }
}
if(checksubmit('submit2')){
      $res=pdo_update('zhtc_store',array('wallet +='=>$_GPC['reply']),array('id'=>$_GPC['id2']));

      if($res){
       $data2['money']=$_GPC['reply'];
       if($data2['money']>0){
         $data2['store_id']=$_GPC['id2'];
         $data2['type']=1;
         $data2['note']='后台充值';
         $data2['time']=date('Y-m-d H:i:s');
       }elseif($data2['money']<0){
        $data2['store_id']=$_GPC['id2'];
         $data2['type']=2;
         $data2['note']='后台扣费';
         $data2['time']=date('Y-m-d H:i:s');
       }
       
       $res2=pdo_insert('zhtc_store_wallet',$data2); 
       if($res2){
       message('充值成功！', $this->createWebUrl('store'), 'success');
      }else{
       message('充值失败！','','error');
      }
    }
}

if($_GPC['op']=='ql'){
    $res=pdo_get('zhtc_store',array('id'=>$_GPC['id']));
    $res2=pdo_update('zhtc_store',array('wallet -='=>$res['wallet']),array('id'=>$_GPC['id']));

     if($res){
       $data2['money']=$res['wallet'];
       $data2['store_id']=$_GPC['id'];
       $data2['type']=2;
       $data2['note']='后台扣费';
       $data2['time']=date('Y-m-d H:i:s');
       
       $res2=pdo_insert('zhtc_store_wallet',$data2); 
       if($res2){
       message('操作成功！', $this->createWebUrl('store'), 'success');
      }else{
       message('操作失败！','','error');
      }
    }
}



if(checksubmit('export_submit', true)) {
  $time=date("Y-m-d");
  $time="'%$time%'";
   $start=$_GPC['time']['start'];
  $end=$_GPC['time']['end'];
  $count = pdo_fetchcolumn("SELECT COUNT(*) FROM". tablename("zhtc_store")." WHERE uniacid={$_W['uniacid']}");
  $pagesize = ceil($count/5000);
        //array_unshift( $names,  '活动名称'); 

  $header = array(
    'id'=>'商家id',
    'store_name' => '商家名称',
    'tel' => '商家电话', 
    'address' => '商家地址', 
    'coordinates' => '坐标地址',
    'logo' => '商家logo',
    'weixin_logo' => '老板微信logo',
    'ad' => '商家轮播图',
    'announcement' => '公告',
    'start_time' => '营业开始时间',
    'end_time' => '营业结束时间',
    'views' => '人气',
    'facilities' => '店内设施',
    'cityname' => '所属城市',
    'details' => '商家简介',
    'type_name' => '行业分类',
    'nTypeName' => '二级栏目分类',
    'is_top' => '是否置顶',
    'is_rm' => '品质商家',
    'state' => '状态'
    );

  $keys = array_keys($header);
  $html = "\xEF\xBB\xBF";
  foreach ($header as $li) {
    $html .= $li . "\t ,";
  }
  $html .= "\n";
  for ($j = 1; $j <= $pagesize; $j++) {
    $sql = "select a.*,b.type_name,c.name as  nTypeName from " . tablename("zhtc_store")."  a"  . " left join " . tablename("zhtc_storetype")." b on a.storetype_id=b.id left join " . tablename("zhtc_storetype2")." c on a.storetype2_id=c.id  WHERE a.uniacid={$_W['uniacid']} limit " . ($j - 1) * 5000 . ",5000 ";
    $list = pdo_fetchall($sql);            
  }

  if (!empty($list)) {
    $size = ceil(count($list) / 500);
    for ($i = 0; $i < $size; $i++) {
      $buffer = array_slice($list, $i * 500, 500);
      $user = array();
      foreach ($buffer as $k =>$row) {
     $row['coordinates']=str_replace(',','#',$row['coordinates']);
     $row['ad']=str_replace(',','#',$row['ad']);
        if($row['state']==1){
          $row['state']='待审核';
        }elseif($row['state']==2){
          $row['state']='已通过';
        }elseif($row['state']==3){
          $row['state']='已拒绝';
        }elseif($row['state']==4){
          $row['state']='已过期';
        }
        if($row['is_top']==1){
          $row['is_top']='是';
        }elseif($row['is_top']==2){
          $row['is_top']='否';
        }
        if($row['is_rm']==1){
          $row['is_rm']='是';
        }elseif($row['is_rm']==2){
          $row['is_rm']='否';
        }
        $row['cityname']=$row['cityname']?:'全国';
        $row['facilities']='';
        if($row['skzf']==1){
          $row['facilities'] .="#刷卡支付";
        }
        if($row['wifi']==1){
          $row['facilities'] .="#WIFI";
        }
        if($row['mftc']==1){
          $row['facilities'] .="#免费停车";
        }
        if($row['jzxy']==1){
          $row['facilities'] .="#禁止吸烟";
        }
        if($row['tgbj']==1){
          $row['facilities'] .="#提供包间";
        }
        if($row['sfxx']==1){
          $row['facilities'] .="#沙发休闲";
        }
        foreach ($keys as $key) {
          $data5[] = $row[$key];
        }
        $user[] = implode("\t ,", $data5) . "\t ,";
        unset($data5);
      }
      $html .= implode("\n", $user) . "\n";
    }
  }
  
  header("Content-type:text/csv");
  header("Content-Disposition:attachment; filename=商家数据.csv");
  echo $html;
  exit();
}

include $this->template('web/store');