<?php


defined('IN_IA') or exit('Access Denied');

require 'inc/func/core.php';

class Zh_tcwqModuleSite extends Core {


//修改区域
	public function doMobileUpdArea() {
		global $_W,$_GPC;
        if($_GPC['num']){
           $data['num']=$_GPC['num']; 
        }
        $res=pdo_update('zhtc_area',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }	

	}
//修改广告
    public function doMobileUpdAd() {
        global $_W,$_GPC;
        if($_GPC['num']){
           $data['orderby']=$_GPC['num']; 
        }
        $res=pdo_update('zhtc_ad',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }   

    }
    //修改分类
    public function doMobileUpdType(){
        global $_W,$_GPC;
        if($_GPC['num']){
           $data['num']=$_GPC['num']; 
        }
         if($_GPC['money']){
           $data['money']=$_GPC['money']; 
        }
         if($_GPC['sx_money']){
           $data['sx_money']=$_GPC['sx_money']; 
        }
        $res=pdo_update('zhtc_type',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }   
    }

//全部删除二级信息分类
public function doMobileAllDelete(){
    global $_W, $_GPC;
            $res=pdo_delete('zhtc_type2',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('type2',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//全部删除二级商家分类
public function doMobileDeleteType2(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_storetype2',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('storetype2',array()),'success');
        }else{
            message('删除失败','','error');
        }
}


  //修改商家分类（价格+顺序）
    public function doMobileUpdType2(){
        global $_W,$_GPC;
        if($_GPC['num']){
           $data['num']=$_GPC['num']; 
        }
         if($_GPC['money']){
           $data['money']=$_GPC['money']; 
        }
        $res=pdo_update('zhtc_storetype',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }   
    }


    //查询帖子二级分类
    public function doMobileGetInformationType() {
        global $_W,$_GPC;
     $type2=pdo_getall('zhtc_type2',array('type_id'=>$_GPC['id']));
     echo json_encode( $type2);

    }

public function doMobileAlldeleteinfo(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_information',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('删除失败','','error');
        }
}
public function doMobileAlldeleteact(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_activity',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('删除失败','','error');
        }
}
//批量更新(二级信息分类)
public function doMobileAllUpdateInfo(){
    global $_W, $_GPC;
    $arr=$_GPC['arr'];
    if($arr){
        foreach($arr as $v){
            if($v['type']==1){               
               $res= pdo_update('zhtc_type2',array('state'=>2),array('id'=>$v['id']));         
            }

            if($v['type']==2){
                $res=pdo_update('zhtc_type2',array('state'=>1),array('id'=>$v['id']));
            }

        }
    }
    
}

//批量更新(二级商家分类)
public function doMobileAllUpdateStore(){
    global $_W, $_GPC;
    $arr=$_GPC['arr'];
    if($arr){
        foreach($arr as $v){
            if($v['type']==1){               
               $res= pdo_update('zhtc_storetype2',array('state'=>2),array('id'=>$v['id']));         
            }

            if($v['type']==2){
                $res=pdo_update('zhtc_storetype2',array('state'=>1),array('id'=>$v['id']));
            }

        }
    }
    
}

//帖子批量通过
public function doMobileAdoptInfo(){
     global $_W, $_GPC;
    $system=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']));
     for($i=0;$i<count($_GPC['id']);$i++){
     	$tz=pdo_get("zhtc_information",array('id'=>$_GPC['id'][$i]));
     	 if(!$tz['sh_time']){
	      if($tz['top_type']==1){
	    $time=time()+24*60*60;
	    }elseif($tz['top_type']==2){
	      $time=time()+24*60*60*7;
	    }elseif($tz['top_type']==3){
	      $time=time()+24*60*60*30;
	    }
	     $res=pdo_update('zhtc_information',array('state'=>2,'sh_time'=>time(),'dq_time'=>$time),array('id'=>$_GPC['id'][$i]));
	  }else{
	     $res=pdo_update('zhtc_information',array('state'=>2),array('id'=>$_GPC['id'][$i]));
	  }
         if($system['is_jf']==1 and $system['integral']>0){
             $res= pdo_update('zhtc_user',array('total_score +='=>$system['integral']),array('id'=>$tz['user_id']));
             if($res){
                 $data3['score']=$system['integral'];
                 $data3['user_id']=$tz['user_id'];
                 $data3['note']='发帖';
                 $data3['type']=1;
                 $data3['cerated_time']=date('Y-m-d H:i:s');
                 $data3['uniacid']=$_W['uniacid'];//小程序id
                 pdo_insert('zhtc_integral',$data3);//添加积分明细
             }
         }
     }
}

//帖子批量拒绝
public function doMobileRejectInfo(){
     global $_W, $_GPC;

        $res=pdo_update('zhtc_information',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//资讯批量删除
public function doMobileAlldeleteZx(){
    global $_W, $_GPC;
   // print_r($_GPC['id']);die;
        $res=pdo_delete('zhtc_zx',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('zx',array()),'success');
        }else{
            message('删除失败','','error');
        }
}
//视频批量删除
public function doMobileAlldeleteVideo(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_video',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('zx',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//资讯批量通过
public function doMobileAdoptZx(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_zx',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('zx',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//资讯批量拒绝
public function doMobileRejectZx(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_zx',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('zx',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//拼车批量删除
public function doMobileAlldeleteCar(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_car',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('zx',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//拼车批量通过
public function doMobileAdoptCar(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_car',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//拼车批量拒绝
public function doMobileRejectCar(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_car',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//黄页批量删除
public function doMobileDelHy(){
     global $_W, $_GPC;
     $res=pdo_delete('zhtc_yellowstore',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('删除失败','','error');
        }
}
//黄页批量通过
public function doMobileAdoptHy(){
     global $_W, $_GPC;
     for($i=0;$i<count($_GPC['id']);$i++){
     		$rst=pdo_get('zhtc_yellowstore',array('id'=>$_GPC['id'][$i]));
			  $time=pdo_get('zhtc_yellowset',array('id'=>$rst['rz_type']));
			  $newtime=$time['days']*24*60*60;
			    $res=pdo_update('zhtc_yellowstore',array('state'=>2,'sh_time'=>time(),'dq_time'=>time()+$newtime),array('id'=>$_GPC['id'][$i]));
     }
}
//黄页批量拒绝
public function doMobileRejectHy(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_yellowstore',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//商家批量删除
public function doMobileDeleteStore(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_store',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('store',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//商家批量通过
public function doMobileAdoptStore(){
     global $_W, $_GPC;
     for($i=0;$i<count($_GPC['id']);$i++){
     		$rst=pdo_get('zhtc_store',array('id'=>$_GPC['id'][$i]));
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
			   $res=pdo_update('zhtc_store',array('state'=>2,'sh_time'=>$time2,'dq_time'=>time()+$time),array('id'=>$_GPC['id'][$i]));
			  }else{//修改
			  	 $res=pdo_update('zhtc_store',array('state'=>2),array('id'=>$_GPC['id'][$i]));
			  }
     }
}

//商家批量拒绝
public function doMobileRejectStore(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_store',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('information',array()),'success');
        }else{
            message('操作失败','','error');
        }
}


//商品批量删除
public function doMobileDeleteGoods(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_goods',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('goods',array()),'success');
        }else{
            message('删除失败','','error');
        }
}
//优惠券删除
public function doMobileDeleteCoupon(){
    global $_W, $_GPC;
    $res=pdo_delete('zhtc_coupons',array('id'=>$_GPC['id']));
    if($res){
        pdo_delete('zhtc_usercoupons',array('coupons_id'=>$_GPC['id']));
        message('删除成功',$this->createWebUrl('coupon',array()),'success');
    }else{
        message('删除失败','','error');
    }
}


//商品批量通过
public function doMobileAdoptGoods(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_goods',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('goods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//商品批量拒绝
public function doMobileRejectGoods(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_goods',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('goods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//优惠券批量通过
public function doMobileAdoptCoupon(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_coupons',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//优惠券批量拒绝
public function doMobileRejectCoupon(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_coupons',array('state'=>3),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//商品批量上架
public function doMobileGoodsSj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_goods',array('is_show'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('goods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//商品批量下架
public function doMobileGoodsXj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_goods',array('is_show'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('goods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//优惠券批量上架
public function doMobileCouponSj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_coupons',array('is_show'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//优惠券批量下架
public function doMobileCouponXj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_coupons',array('is_show'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('操作失败','','error');
        }
}



//积分商品批量上架
public function doMobileJfGoodsSj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_jfgoods',array('is_open'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('jfgoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//积分商品批量下架
public function doMobileJfGoodsXj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_jfgoods',array('is_open'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('jfgoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//积分商品批量删除
public function doMobileDelJfGoods(){
     global $_W, $_GPC;
        $res=pdo_delete('zhtc_jfgoods',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('jfgoods',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//信息分类批量删除
public function doMobileDeleteType(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_type',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('type',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//信息分类批量启用
public function doMobileQyType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_type',array('state'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('type',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//信息分类批量禁用
public function doMobileJyType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_type',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('type',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//商家分类批量删除
public function doMobileDeleteStoreType(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_storetype',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('storetype',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//商家分类批量启用
public function doMobileQyStoreType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_storetype',array('state'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('storetype',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//商家分类批量禁用
public function doMobileJyStoreType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_storetype',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('storetype',array()),'success');
        }else{
            message('操作失败','','error');
        }
}




//黄页分类批量删除
public function doMobileDeleteYellowType(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_yellowtype',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('Yellowtype',array()),'success');
        }else{
            message('删除失败','','error');
        }
}

//黄页分类批量启用
public function doMobileQyYellowType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_yellowtype',array('state'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('Yellowtype',array()),'success');
        }else{
            message('操作失败','','error');
        }
}

//黄页分类批量禁用
public function doMobileJyYellowType(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_yellowtype',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('Yellowtype',array()),'success');
        }else{
            message('操作失败','','error');
        }
}









//用户批量删除
public function doMobileDelUser(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_user',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('user',array()),'success');
        }else{
            message('删除失败','','error');
        }
}


//查找用户
public function doMobileFindUser(){
global $_W, $_GPC;

$sql =" select id,name from ".tablename('zhtc_user')." where uniacid={$_W['uniacid']}  and id not in (select user_id  from" .tablename('zhtc_store')."where uniacid={$_W['uniacid']}) and  (name like '%{$_GPC['keywords']}%' || openid like '%{$_GPC['keywords']}%')";  
$user=pdo_fetchall($sql);

return json_encode($user);
}

//查找用户
public function doMobileFindUser3(){
global $_W, $_GPC;
$info = pdo_get('zhtc_distribution',array('id'=>$_GPC['id']));
//自己
$level = pdo_getall('zhtc_fxlevel',array('uniacid'=>$_W['uniacid']));
$fxuser=pdo_get('zhtc_fxuser',array('fx_user'=>$info['user_id']));
//查看我的上级
$fxuser=pdo_get('zhtc_distribution',array('user_id'=>$fxuser['user_id']));
//查看上级分销商信
//一级
$sjuser1=pdo_getall('zhtc_fxuser',array('user_id'=>$info['user_id']),'fx_user');
$sjuser1 = array_map('array_shift', $sjuser1);
//二级
$sjuser2=pdo_getall('zhtc_fxuser',array('user_id'=>$sjuser1),'fx_user');
$sjuser2 = array_map('array_shift', $sjuser2);

$yuser=array_merge($sjuser1,$sjuser2);
//var_dump($yuser);die;


array_push($yuser, $info['user_id']);

$yuser=implode(',',$yuser);
$sql =" select id,user_id,user_name as name from ".tablename('zhtc_distribution')." where uniacid={$_W['uniacid']}  and user_id!={$info['user_id']} and user_name like '%{$_GPC['keywords']}%'";  
$user=pdo_fetchall($sql);
return json_encode($user);
}

//查找用户
public function doMobileFindUser2(){
global $_W, $_GPC;
$sql =" select id,name from ".tablename('zhtc_user')." where uniacid={$_W['uniacid']}  and id not in (select user_id  from" .tablename('zhtc_acthxlist')."where act_id={$_GPC['act_id']}) and  (name like '%{$_GPC['keywords']}%' || openid like '%{$_GPC['keywords']}%')";  
$user=pdo_fetchall($sql);

return json_encode($user);
}

//查找城市
public function doMobileFindCity(){
global $_W, $_GPC;
$sql =" select DISTINCT cityname from ".tablename('zhtc_hotcity')." where uniacid={$_W['uniacid']}   and  cityname like '%{$_GPC['keywords']}%'";  
$city=pdo_fetchall($sql);
return json_encode($city);

}



//资讯评论批量删除
public function doMobileDeleteZxAssess(){
    global $_W, $_GPC;
    $res=pdo_delete('zhtc_zx_assess',array('id'=>$_GPC['id']));
    if($res){
        message('删除成功',$this->createWebUrl('zxpinglun',array()),'success');
    }else{
        message('删除失败','','error');
    }

}

//帖子分类列表

public function doMobileTypeList(){
    global $_W, $_GPC;
    $type=pdo_getall('zhtc_type',array('uniacid'=>$_W['uniacid'],'state'=>1),array(),'','num asc');
    $type2=pdo_getall('zhtc_type2',array('uniacid'=>$_W['uniacid'],'state'=>1),array(),'','num asc');
    foreach($type as $key => $value){
         $data=$this->getSon($value['id'],$type2);
         $type[$key]['ej']=$data;

    }
    return json_encode($type);

}

//一级分类详情
public function doMobilePTypeInfo(){
    global $_W, $_GPC;
    $res=pdo_get('zhtc_type',array('uniacid' => $_W['uniacid'],'id'=>$_GPC['id']));
    return json_encode($res);
}

//一级分类保存
public function doMobileSavePType(){
    global $_W, $_GPC;
    $data['img']=$_GPC['img'];
    $data['num']=$_GPC['num'];
    $data['type_name']=$_GPC['type_name'];
    $data['money']=$_GPC['money'];
    $data['state']=$_GPC['state'];
    $data['uniacid']=$_W['uniacid'];
    if($_GPC['id']==''){                
        $res=pdo_insert('zhtc_type',$data);        
    }else{
        $res = pdo_update('zhtc_type', $data, array('id' => $_GPC['id']));
    }
    if($res){
       echo '1';
   }else{
       echo '2';
   }

}

//二级分类详情
public function doMobileSTypeInfo(){
    global $_W, $_GPC;
    $res= pdo_get('zhtc_type2',array('uniacid' => $_W['uniacid'],'id'=>$_GPC['id']));
    return json_encode($res);
}

//二级分类保存
public function doMobileSaveSType(){
    global $_W, $_GPC;
    $data['num']=$_GPC['num'];
    $data['type_id']=$_GPC['type_id'];
    $data['name']=$_GPC['name'];
    $data['state']=$_GPC['state'];
    $data['uniacid']=$_W['uniacid'];
    if($_GPC['id']==''){                
        $res=pdo_insert('zhtc_type2',$data);
    }else{
        $res = pdo_update('zhtc_type2', $data, array('id' => $_GPC['id']));
    }
    if($res){
       echo '1';
   }else{
       echo '2';
   }

}

//查看帖子标签

public  function doMobileQueryTag(){
    global $_W, $_GPC;
    $res=pdo_getall('zhtc_label',array('type2_id'=>$_GPC['type2_id']));
    echo json_encode($res);

}


//删除标签
public function doMobileDelTag(){
    global $_W, $_GPC;
    $res=pdo_delete('zhtc_label',array('id'=>$_GPC['tag_id']));
    if($res){
        echo '1';
    }else{
        echo '2';
    }
}

//修改标签
public function doMobileUpdTag(){
  global $_W, $_GPC;
  $res=pdo_update('zhtc_label',array('label_name'=>$_GPC['label_name']),array('id'=>$_GPC['tag_id']));
  if($res){
    echo '1';
}else{
    echo '2';
}
}


//修改导航排序
public function doMobileUpdNav() {
    global $_W,$_GPC;
    if($_GPC['num']){
    $data['orderby']=$_GPC['num']; 
 }
    $res=pdo_update('zhtc_nav',$data,array('id'=>$_GPC['id']));
    if($res){
        echo '1';
    }else{
        echo '2';
    }
}


//查询商家二级分类
public function doMobileGetStoreType() {
    global $_W,$_GPC;
    $type2=pdo_getall('zhtc_storetype2',array('type_id'=>$_GPC['id']));
    echo json_encode($type2);
}

//查询黄页二级分类
    public function doMobileGetYellowType() {
        global $_W,$_GPC;
     $type2=pdo_getall('zhtc_yellowtype2',array('type_id'=>$_GPC['id']));
     echo json_encode($type2);

    }


    //删除签到活动
    public function doMobileDelQd(){
        global $_W,$_GPC;
        $res=pdo_delete('zhtc_continuous',array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }
    }
    //添加签到规则
    public function doMobileAddQd(){
        global $_W,$_GPC;
        pdo_delete('zhtc_continuous',array('uniacid'=>$_W['uniacid']));
        for($i=0;$i<count($_GPC['list']);$i++){
            $data['day']=$_GPC['list'][$i]['day'];
            $data['integral']=$_GPC['list'][$i]['integral'];
            $data['uniacid']=$_W['uniacid'];
            pdo_insert('zhtc_continuous',$data);
        }
        $res=pdo_get('zhtc_signset',array('uniacid'=>$_W['uniacid']));
        if($res){
            $data2['one']=$_GPC['one'];
            $data2['integral']=$_GPC['integral'];
            $data2['is_open']=$_GPC['is_open'];
            $data2['qd_img']=$_GPC['qd_img'];
            $data2['is_bq']=$_GPC['is_bq'];
            $data2['bq_integral']=$_GPC['bq_integral'];
            pdo_update('zhtc_signset',$data2,array('uniacid'=>$_W['uniacid']));
        }else{
            $data2['one']=$_GPC['one'];
            $data2['integral']=$_GPC['integral'];
            $data2['is_open']=$_GPC['is_open'];
            $data2['qd_img']=$_GPC['qd_img'];
            $data2['is_bq']=$_GPC['is_bq'];
            $data2['bq_integral']=$_GPC['bq_integral'];
            $data2['uniacid']=$_W['uniacid'];
            pdo_insert('zhtc_signset',$data2);
        }
        $res2=pdo_get('zhtc_special',array('uniacid'=>$_W['uniacid']));
        if($res2){
            $data3['day']=$_GPC['day'];
            $data3['integral']=$_GPC['integral2'];
            $data3['title']=$_GPC['title'];
            $data3['color']=$_GPC['color'];
            pdo_update('zhtc_special',$data3,array('uniacid'=>$_W['uniacid']));
        }else{
            $data3['day']=$_GPC['day'];
            $data3['integral']=$_GPC['integral2'];
            $data3['title']=$_GPC['title'];
            $data3['color']=$_GPC['color'];
            $data3['uniacid']=$_W['uniacid'];
            pdo_insert('zhtc_special',$data3);
        }
    }




//刷新帖子
    public function doMobileRefresh(){
        global $_W, $_GPC;
        $res=pdo_update('zhtc_information',array('sh_time'=>time()),array('id'=>$_GPC['id']));
        if($res){
          echo '1';
        }else{
          echo '2';
        }
    }
    




////下架
    public function doMobileGroupXj(){
        global $_W,$_GPC;
        $res=pdo_update('zhtc_groupgoods',array('is_shelves'=>2),array('id'=>$_GPC['id']));
        if($res){
            echo  '1';
        }else{
            echo  '2';
        }
    }
     public function doMobileGroupSj(){
        global $_W,$_GPC;
        $res=pdo_update('zhtc_groupgoods',array('is_shelves'=>1),array('id'=>$_GPC['id']));
        if($res){
            echo  '1';
        }else{
            echo  '2';
        }
    }

    public function doMobileDelGroup(){
        global $_W,$_GPC;
        $res=pdo_delete('zhtc_groupgoods',array('id'=>$_GPC['id']));
        if($res){
            echo  '1';
        }else{
            echo  '2';
        }
    }


        public function doMobileGroupUpdate(){
        global $_W,$_GPC;
        if($_GPC['name']){
           $data['name']=$_GPC['name']; 
        }
        if($_GPC['money']){
           $data['pt_price']=$_GPC['money']; 
        }
        if($_GPC['wm_money']){
           $data['dd_price']=$_GPC['wm_money']; 
        }
        if($_GPC['box_fee']){
           $data['people']=$_GPC['box_fee']; 
        }
        if($_GPC['num']){
           $data['inventory']=$_GPC['num']; 
        }
        if(isset($_GPC['xs_num'])){
           $data['ysc_num']=$_GPC['xs_num']; 
        }
        $res=pdo_update('zhtc_groupgoods',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }
    }




//抢购商品批量上架
public function doMobileqgGoodsSj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_qggoods',array('state'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('qggoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//抢购商品批量下架
public function doMobileqgGoodsXj(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_qggoods',array('state'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('qggoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//抢购商品批量显示
public function doMobileqgGoodsXs(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_qggoods',array('state2'=>1),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('qggoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//抢购商品批量隐藏
public function doMobileqgGoodsYc(){
     global $_W, $_GPC;
        $res=pdo_update('zhtc_qggoods',array('state2'=>2),array('id'=>$_GPC['id']));
        if($res){
            message('操作成功',$this->createWebUrl('qggoods',array()),'success');
        }else{
            message('操作失败','','error');
        }
}
//抢购商品批量删除
public function doMobileDelqgGoods(){
     global $_W, $_GPC;
        $res=pdo_delete('zhtc_qggoods',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('qggoods',array()),'success');
        }else{
            message('删除失败','','error');
        }
}


//帖子评论批量删除
public function doMobileDeleteComments(){
    global $_W, $_GPC;
        $res=pdo_delete('zhtc_comments',array('id'=>$_GPC['id']));
        if($res){
            message('删除成功',$this->createWebUrl('tzpinglun',array()),'success');
        }else{
            message('删除失败','','error');
        }
}


//修改版块导航
    public function doMobileUpdPlate() {
        global $_W,$_GPC;
        if($_GPC['num']){
           $data['sort']=$_GPC['num']; 
        }
        $res=pdo_update('zhtc_plate',$data,array('id'=>$_GPC['id']));
        if($res){
            echo '1';
        }else{
            echo '2';
        }   

    }

}