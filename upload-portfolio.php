<?php
$status = 400;
$output_array = array();
if(isset($_FILES['user_photos']['name']) and count($_FILES['user_photos']['name']) > 0){

	foreach($_FILES['user_photos']['name'] as $f_key => $file_name){
		$ext_arr = explode('.', $file_name);
		$ext = array_pop($ext_arr);
		$file_name = time().'_'.rand(1000, 5000).'.'.strtolower($ext);
		if(move_uploaded_file($_FILES['user_photos']['tmp_name'][$f_key], 'images/'.$file_name)){
			$status = 200;
			$output_array['filename'] = $file_name;	
		}
	}

	if($status == 200){
		$output_array['status'] = $status;
		$output_array['message'] = 'File uploaded successfully.';

	} else {
		$output_array['status'] = $status;
		$output_array['message'] = 'Something went wrong, please try again.';
		$output_array['filename'] = '';
	}

} else {
	$output_array['status'] = $status;
	$output_array['message'] = 'Please upload an image file';
	$output_array['filename'] = '';
}

echo json_encode($output_array);
exit;
?>