<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
<?php
include("connect.php");
$qry = mysqli_query($conn, "select * from mut");	

	
while($res = mysqli_fetch_array($qry)){
 $gm = array();
	$s_no = $res['s_no'];
	$gm1 = $res['gm1'];
	$gm2 = $res['gm2'];
	$gm3 = $res['gm3'];
	$gm4 = $res['gm4'];
	$gm5 = $res['gm5'];
	
	$gm = array($gm1, $gm2, $gm3, $gm4, $gm5);
	
	foreach($gm as $val)
	{
		if($val != '')
		{
			$split = preg_split("/[,()]/", $val, -1, PREG_SPLIT_NO_EMPTY);
			//var_dump($split);
			
			$pattern = '/^([a-zA-Z]*)(\d+)([a-zA-Z]*)$/';
            $matches = array();
			
			
			
			for($i=1; $i< count($split); $i++)
			{
			
		    $gene = trim($split[0]);
				
			$spl = trim($split[$i]);
			
			echo $spl."<br>";
			
				if(preg_match($pattern, $spl, $matches)){
			  
				
				$waa = trim($matches[1]);
				$pos = trim($matches[2]);
				$caa = trim($matches[3]);
				
					//echo $waa."<br>";
					
			
			  }
				//$ins = mysqli_query($conn, "insert into mutation_details values('$s_no', '$gene', '$spl','$waa', '$pos', '$caa')");
				
			}
			
			
		}
	}
	
	
	
}
	//var_dump($gm);
?>
</body>
</html>