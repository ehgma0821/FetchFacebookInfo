<?php
	$response = array();
	$con=mysqli_connect("", "", "", "");
	mysqli_set_charset($con,"utf8");
	//echo 'here';
	if (mysqli_connect_errno($con))
	{
		//echo 'connection error';
		$response['recordid']=-1;
		$response['success']=0;
		$response['message']='Error: ' . mysqli_connect_error();
		exit();
	}
	else
	{
		if(!empty($_POST['data_profile'])){
			$data_profile = mysqli_real_escape_string($con, $_POST['data_profile']);
			$response['data_profile']=$data_profile;
		}
		if(!empty($_POST['data_friends'])){
			$data_friends = mysqli_real_escape_string($con, $_POST['data_friends']);
			$response['data_friends']=$data_friends;
		}
		if(!empty($_POST['data_feed'])){
			$data_feed = mysqli_real_escape_string($con, $_POST['data_feed']);
			$response['data_feed']=$data_feed;
		}
		$sql="INSERT SQL";
			
		if (!mysqli_query($con,$sql))
		{
			$response['recordid']=-1;
			$response['success']=0;
			$response['message']='Error: ' . mysqli_error($con);
		}
		else
		{
			//return recordid
			$id = mysqli_insert_id($con);

			if($id > 0){
				$response['recordid']=$id;
				$response['success']=1;
				$response['message']='inserted';
			}
			else{
				$response['recordid']=-1;
				$response['success']=0;
				$response['message']='mysqli_insert_id returns null';
			}
		}
	}
	echo json_encode($response);
	mysqli_close($con);
?>