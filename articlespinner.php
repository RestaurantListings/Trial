<!Doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>dsdfsdf</title>

</head>
<body>
<?php
$time_start = microtime(true);


	$hname = "localhost";
	$uname = "restaura_dev";

	$pass = "listings";
	$dbname = "restaura_demo";
	$connect=mysql_connect($hname,$uname,$pass,$dbname)or die('No Connection');
	mysql_select_db('restaura_demo');
	
	$get_spin_status = mysql_query("select * from spinning_status order by id desc limit 1");
	$sstatus = mysql_fetch_array($get_spin_status);
	if($sstatus['status'] == '1'){
		$id = $sstatus['r_id'];
	}else{
		exit;
	}
	
	
	echo $id;
	$get_article = mysql_query("select id, text from restaurants_reviews where id > '".$id."' order by id asc limit 30");
	while($arti = mysql_fetch_array($get_article)){
		
	
	$article = $arti['text'];

    $api_url = "http://node21.prothemes.biz/api.php";
    $api_key = "4262b80a3c2a06dcea1b36ade481f2e9";
    $lang = "en";
    
    $cookie=tempnam("/tmp","CURLCOOKIE");
    $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";
    $ch = curl_init();
        
        $article = str_replace("&","%%^%%",$article);
        $data = "api_key=$api_key&article=$article&lang=$lang";
        curl_setopt($ch, CURLOPT_URL,"$api_url");    
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch,CURLOPT_ENCODING,"gzip,deflate");
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded","Accept: */*"));
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_REFERER, "http://node21.prothemes.biz/api.php");
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"$data");
	$html=curl_exec($ch);
	curl_close($ch);
    //echo $article;
	//echo '<br>';
	//echo $html;
	$article = mysql_real_escape_string($article);
	$html = mysql_real_escape_string($html);
	//$html = str_replace("'", "''", $html);
	//$html = str_replace("'''", "''", $html);
	//var_dump("insert into google_reviews (text, new_text) values ('".$article."', '".$html."')");
	
	mysql_query("update restaurants_reviews set review_text = '".$html."'where id = '".$arti['id']."'");
	
	}
	$new_id = $id + 30;
	mysql_query("update spinning_status set r_id = '".$new_id."', status = 1");
	echo("update spinning_status set r_id = '".$new_id."', status = 1");
	// Display Script End time
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';

        
?>
</body>
</html>