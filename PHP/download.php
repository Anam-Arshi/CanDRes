<?php
date_default_timezone_set('Asia/Calcutta');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_POST["down_state"])){
$down=$_POST["down_state"];


	header('Content-Disposition: attachment; filename="state.xls"');

	//header('Content-Disposition: attachment; filename="state.txt"');
echo $down;

}
else
if(isset($_POST["down_city"])){
	$down=$_POST["down_city"];
header('Content-Disposition: attachment; filename="city.xls"');
echo $down;
}	
else
if(isset($_POST["down_data"])){
	$down=$_POST["down_data"];

header('Content-Disposition: attachment; filename="dataset.xls"');
echo $down;
}
else
if(isset($_POST["down_drug"])){
	$down=$_POST["down_drug"];
header('Content-Disposition: attachment; filename="drugs.xls"');
echo $down;
}
else
if(isset($_POST["down_niche"])){
	$down=$_POST["down_niche"];
header('Content-Disposition: attachment; filename="niche.xls"');
echo $down;
}
else
if(isset($_POST["down_sps"])){
	$down=$_POST["down_sps"];
header('Content-Disposition: attachment; filename="species.xls"');
echo $down;
}
else
if(isset($_POST["down_advs"])){
	$down=$_POST["down_advs"];
header('Content-Disposition: attachment; filename="advs.xls"');
echo $down;
}
else
if(isset($_POST["down_result"])){
	$down=$_POST["down_result"];
header('Content-Disposition: attachment; filename="result.xls"');
echo $down;
}
?>