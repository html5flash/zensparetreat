<?php
class orderClass
{ 
  function getAllorderList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
    $query=$callConfig->selectQuery(TPREFIX.TBL_ORDER,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllorderListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_ORDER,'order_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getOrderData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_ORDER,'*','order_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertOrder($post)
	{
		global $callConfig;
		
		
		if(count($_POST['packages'])!=0)
		{
		  $strpackages=implode(",", $_POST['packages']);
		}
	
		if(count($_POST['certified'])!=0)
		{
		   $strcertified=implode(",", $_POST['certified']);
		}
		
		if(count($_POST['Messenger'])!=0)
		{
		   $strMessenger=implode(",", $_POST['Messenger']);
		}
	foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		$fieldnames=array('order_number'=>$title,'order_packagename'=>$hdname,'order_price'=>$price,'order_otherprice'=>$total,'order_otherpackages'=>$strpackages,'fullname'=>$tofullname,'from_user'=>$from,'buyer_name'=>$buyersfullname,'buyer_phone'=>$buyerstelephone,'buyer_emailid'=>$buyersemailid,'buyermessage'=>$message,'pickup_location'=>$location,'is_certified'=>$strcertified,'cretified_mesage'=>$certified_msg,'is_messanger'=>$strMessenger,'messager_msg'=>$Messenger_msg);
		$res=$callConfig->insertRecord(TPREFIX.TBL_ORDER,$fieldnames);
		if($res="")
		{
				return $res;
		}
		else
		{
				return 'no';
		}
	}
	function insertTempOrder($post,$orderid)
	{
		global $callConfig;
		
		
		if(count($_POST['packages'])!=0)
		{
		  $strpackages=implode(",", $_POST['packages']);
		}
	
		if(count($_POST['certified'])!=0)
		{
		   $strcertified='7.00';
		}
		
		if(count($_POST['Messenger'])!=0)
		{
		   $strMessenger='10.00';
		}
	foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	
		$fieldnames=array('order_number'=>$orderid,'order_packagename'=>$hdname,'order_price'=>$price,'order_otherprice'=>$total,'order_otherpackages'=>$strpackages,'fullname'=>$tofullname,'from_user'=>$from,'buyer_name'=>$buyersfullname,'buyer_phone'=>$buyerstelephone,'buyer_emailid'=>$buyersemailid,'buyermessage'=>$message,'pickup_location'=>$location,'is_certified'=>$strcertified,'cretified_mesage'=>$certified_msg,'is_messanger'=>$strMessenger,'messager_msg'=>$Messenger_msg);
		$res=$callConfig->insertRecord(TPREFIX.TBL_TEMP,$fieldnames);
		return $res;
	}
	
  function getTempData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TEMP,'*','order_id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 function UpdateOrderlist($str)
  {
	global $callConfig;
	 $query=$str;
	return $callConfig->executeQuery($query);
  }
	function updateOrder($post)
	{
		global $callConfig;
			foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		$fieldnames=array('Order_title'=>$title,'Order_one'=>$for_one,'Order_two'=>$for_two,'Order_desc'=>$content,'status'=>$status);
		$res=$callConfig->updateRecord(TPREFIX.TBL_ORDER,$fieldnames,'order_id',$post['hdn_id']);
		if($res==1)
		{
			sitesettingsClass::recentActivities('Order updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=order&err=Order updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Order updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=order&ferr=Order updation failed");
		}
	}
	function OrderDelete($id)
	{
		global $callConfig;
		$res=$callConfig->deleteRecord(TPREFIX.TBL_TEMP,'order_id',$id);
		if($res==1)
		{
			//sitesettingsClass::recentActivities('Order deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
			//$callConfig->headerRedirect("index.php?option=order&err=Order deleted successfully");
			return 'yes';
		}
		else
		{
			//sitesettingsClass::recentActivities('Order deletion failed on >> '.DATE_TIME_FORMAT.'','e');
			//$callConfig->headerRedirect("index.php?option=order&ferr=Order deletion failed");
			return 'no';
		}
	}

}
?>