<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();

$where= " where uniacid=:uniacid";
$data[':uniacid']=$_W['uniacid'];
if($_GPC['keywords']){
	$where.=" and name LIKE  concat('%', :name,'%')";
	 $data[':name']=$_GPC['keywords'];  
}
	$pageindex = max(1, intval($_GPC['page']));

	$pagesize=10;
	$sql="select *  from " . tablename("zhtc_user") .$where." order by id desc";
	$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list = pdo_fetchall($select_sql,$data);	
	$total=pdo_fetchcolumn("select count(*) from " . tablename("zhtc_user") .$where,$data);
	$pager = pagination($total, $pageindex, $pagesize);
	for($i=0;$i<count($list);$i++){
		$userid=$list[$i]['id'];
        $yxtime=time()-60*60*24*7;
        $yxnum=count(pdo_fetchall("select * from ".tablename("zhtc_userformid")." where user_id={$userid} and UNIX_TIMESTAMP(time)>={$yxtime}"));
        $list[$i]['yxnum']=$yxnum;
	}
	if($_GPC['op']=='delete'){
		$res4=pdo_delete("zhtc_user",array('id'=>$_GPC['id']));
		if($res4){
		 message('删除成功！', $this->createWebUrl('user2'), 'success');
		}else{
			  message('删除失败！','','error');
		}
	}
		if($_GPC['op']=='defriend'){
			
		$res4=pdo_update("zhtc_user",array('state'=>2),array('id'=>$_GPC['id']));
		if($res4){
		 message('拉黑成功！', $this->createWebUrl('user2',array('page'=>$_GPC['page'])), 'success');
		}else{
			  message('拉黑失败！','','error');
		}
	}
		if($_GPC['op']=='relieve'){
		$res4=pdo_update("zhtc_user",array('state'=>1),array('id'=>$_GPC['id']));
		if($res4){
		 message('取消成功！', $this->createWebUrl('user2',array('page'=>$_GPC['page'])), 'success');
		}else{
			  message('取消失败！','','error');
		}
	}
	if(checksubmit('submit2')){
      $res=pdo_update('zhtc_user',array('money +='=>$_GPC['reply']),array('id'=>$_GPC['id2']));
      if($res){
      	if($_GPC['reply']!=0){
      		if($_GPC['reply']<0){
      			$data2['type']=2;
		       $data2['note']='后台扣款';	
      		}else{
      			$data2['type']=1;
                $data2['note']='后台充值';
      		}
				$data2['money']=$_GPC['reply'];
		       $data2['user_id']=$_GPC['id2'];
		       $data2['time']=date('Y-m-d H:i:s');
		       $res2=pdo_insert('zhtc_qbmx',$data2); 
		       if($res2){
		       message('充值成功！', $this->createWebUrl('user2'), 'success');
		      }else{
		       message('充值失败！','','error');
		      }
      	}
       
    }
}
if(checksubmit('submit3')){
	$res=pdo_update('zhtc_user',array('total_score +='=>$_GPC['score']),array('id'=>$_GPC['id3']));
	if($res){
		$data2['score']=$_GPC['score'];
		$data2['user_id']=$_GPC['id3'];
		$data2['note']='后台充值';
		$data2['type']=1;
		$data2['cerated_time']=date('Y-m-d H:i:s');
          $data2['uniacid']=$_W['uniacid'];//小程序id
          $res2=pdo_insert('zhtc_integral',$data2);//添加积分明细
          if($res2){
          	message('充值成功！', $this->createWebUrl('user2'), 'success');
          }else{
          	message('充值失败！','','error');
          }

      }
  }




  if(checksubmit('export_submit', true)) {
  $time=date("Y-m-d");
  $time="'%$time%'";
   $start=$_GPC['time']['start'];
  $end=$_GPC['time']['end'];
  $count = pdo_fetchcolumn("SELECT COUNT(*) FROM". tablename("zhtc_user")." WHERE uniacid={$_W['uniacid']}");
  $pagesize = ceil($count/5000);
        //array_unshift( $names,  '活动名称'); 

  $header = array(
    'id'=>'用户id',
    'img' => '用户头像',
    'name' => '用户昵称', 
    'openid' => '用户openid', 
    'time' => '注册时间',
    'commission' => '余额',
    'total_score' => '积分',
    'number' => '发帖数'
    );

  $keys = array_keys($header);
  $html = "\xEF\xBB\xBF";
  foreach ($header as $li) {
    $html .= $li . "\t ,";
  }
  $html .= "\n";
  for ($j = 1; $j <= $pagesize; $j++) {
    $sql = "select * from " . tablename("zhtc_user")."    WHERE uniacid={$_W['uniacid']} limit " . ($j - 1) * 5000 . ",5000 ";
    $list = pdo_fetchall($sql);            
  }

  if (!empty($list)) {
    $size = ceil(count($list) / 500);
    for ($i = 0; $i < $size; $i++) {
      $buffer = array_slice($list, $i * 500, 500);
      $user = array();
      foreach ($buffer as $k =>$row) {
     $row['time']=date("Y-m-d H:i:s",$row['time']);
     $num=pdo_get('zhtc_information',array('user_id'=>$row['id']),array('count(*) as count'));
     	$row['number']=$num['count'];
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


include $this->template('web/user2');