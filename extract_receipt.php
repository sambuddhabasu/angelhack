<?php
$url = 'https://api.idolondemand.com/1/api/sync/ocrdocument/v1';

$output_dir = "uploads/";
if(isset($_FILES["file"])) {

	$fileName = md5(date('Y-m-d H:i:s:u')).$_FILES["file"]["name"]; //unique filename

	//move the file to uploads folder
	move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir.$fileName);


	//multipart form post using CURL
	$filePath = realpath($output_dir.$fileName);
	$post = array('apikey' => '967dadb2-a9f9-46e6-a883-1d2b464b7307',
			'mode' => 'document_photo',
			'file' =>'@'.$filePath);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec ($ch);
	curl_close($ch);
//	echo $result;

	$result = str_replace("\\n", " ", $result);
	$json = json_decode($result, true);
	$res = $json['text_block'][0]['text'];
	$response = explode(" ", $res);
	$response_arr = array();
	for($i = 0; $i < count($response); $i += 3) {
		array_push($response_arr, strtolower($response[$i]));
		array_push($response_arr, $response[$i + 1]);
	}
	header('Location: add_item.php?items=' . implode(",", $response_arr));

	//remove the file
	unlink($filePath);
}
?>
