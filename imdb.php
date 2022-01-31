<?php

function get_imdb_id($key){

	str_replace(" ","_",$key);
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=".$key,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"Accept: application/json",
			"x-rapidapi-host: imdb8.p.rapidapi.com",
			"x-rapidapi-key: 11a8bb1b1fmsh3b6f314e9709693p1409e1jsna48cef260257"
		],
	]);

	$err = curl_error($curl);
	if ($err) {
		exit("cURL Error #:" . $err);
	} 
	$response = curl_exec($curl);
	$response=(json_decode($response,true));
	curl_close($curl);

		return $response["d"][0]["id"];
	
}

function get_ratings($id){
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-ratings?tconst=".$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"Accept: application/json",
			"x-rapidapi-host: imdb8.p.rapidapi.com",
			"x-rapidapi-key: 11a8bb1b1fmsh3b6f314e9709693p1409e1jsna48cef260257"
		],
	]);

	$err = curl_error($curl);
	if($err){
		exit("cURL Error #:" . $err);
	}
	$response=curl_exec($curl);
	
	$response=json_decode($response,true);
	curl_close($curl);
	// echo var_dump($response["rating"]);
	echo "imDb Rating of ".$response['title']." is ".$response['rating']."\n";
}

if(!(isset($argv[1]))){
	echo "Error: please enter movie name in args\n";
	exit();
}

$search_key=$argv[1];

get_ratings(get_imdb_id($search_key));

?>