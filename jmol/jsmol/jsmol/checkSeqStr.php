<?php
error_reporting(E_ALL);


?>
<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>Visualizations - Explore Mutations in Sequences and 3D Structures</title>  
<meta name="description" content="Visualize mutations in protein sequences and corresponding 3D structures for drug resistance-associated genes in Candida species."><style>
/* https://codepen.io/z007/pen/gwyRLQ */
body {
  background: #f69ec4;
  font-family: "Lato", sans-serif;
}

h2 {
  color: #000;
  text-align: center;
  font-size: 2em;
  margin: 20px 0;
}

ul.tabs
{
    padding: 7px 0;
    /* font-size: 0; */
    margin:0;
    list-style-type: none;
    text-align: left;
}
        
ul.tabs li
{
    display: inline;
    margin: 0;
    margin-right:4px;
}
        
ul.tabs li a
{
    font: bold 12px Verdana;
    text-decoration: none;
    position: relative;
    z-index: 1;
    padding: 9px 24px;
    border: 1px solid #CCC;
    /* border-bottom-color:#B7B7B7; */
	border-bottom: 0px;
    color: #000;
    background: #F0F0F0;
    border-radius: 6px 6px 0px 0px;
 -moz-border-radius: 6px 6px 0px 0px;
    outline:none;
}

ul.tabs li a:hover
{
    border: 1px solid #B7B7B7;
    background:#E0E0E0;
}
        
ul.tabs li.selected a
{
    position: relative;
    top: 0px;
    font-weight:bolder;
    background: #d1d6db; /* #1d5289; */
    border: 1px solid #B7B7B7;
    border-bottom-color: white;
	color: #0d1f3d;
	border-bottom: none;
	box-shadow:1px 1px 3px #94afcb;
}
.tabcontents{
	background: white;
	min-height: 300px;
	padding: 0.2px;
	
}

/* seq style */

.aa-I, .aa-L, .aa-V, .aa-A, .aa-G, .aa-P, .aa-M, .aa-F, .aa-Y, .aa-W { background: #df0b3038; color: black;} /* Hydrophobic */
	.aa-N, .aa-S, .aa-T, .aa-D, .aa-E, .aa-K, .aa-R, .aa-H, .aa-C, .aa-Q {background: #0e73b142; color: black;  } /* Hydrophilic */
	
	pre{
		white-space: pre-line;
		font-size: 15px;
		margin-left: 23px;
		margin-bottom: 20px;
		margin-top: 0;
	}
	
	
	.redSeq{
	color: red;
	font-weight : 600;
	background: #C3BB91;
	cursor: pointer;
	position: relative;
	
}
	
.mutation {
    background-color: yellow !important;
	cursor: pointer;
	color: red;
	font-weight: bold;
	font-size: 14px;
	box-shadow: 1px 1px 8px gray;
}
.delmutation {
	background-color: #db580a;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
	box-shadow: 1px 1px 8px gray;
}
.stopmut{
	background-color: red;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
	box-shadow: 1px 1px 8px gray;
}
.insmut{
	background-color: lightseagreen;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
	box-shadow: 1px 1px 8px gray;
}
.fsM{
	background-color: blue;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
	box-shadow: 1px 1px 8px gray;
	
}
.mutation-popup {
    position: absolute;
    top: 0;
    left: 0;
    border: 0.1em solid black;
    padding: 8px;
	font: 12px/20px Arial, Helvetica, sans-serif;
	background-color: antiquewhite;
	max-width: 300;
	word-wrap: break-word;
	margin: auto;
}
	
	.seq{
		padding: 2px;
		margin: 0 auto;
		background: white;
		width: 1400px;
	}
	
	.spa{
		margin-left: 23px;
		margin-top: 10px;
		font-weight: bold;
		margin-bottom: 0;
		font-family: Arial, "sans-serif";
		
	}


.main1{
	background: white;  /* #dbdbdb;  #8395a7  #F0F0F0 */
	
	margin: 0px;
}
.main1 a{
	color: #04468f;
}

 
        
	/* Style for the legend square */
        .legend-square {
            display: inline-block; /* Makes the div inline, like text */
            width: 12px; /* Set the width of the square */
            height: 12px; /* Set the height of the square */
            border: 1px solid #000; /* Optional border for visibility */
            margin-right: 5px; /* Space between square and text */
			margin-left: 25px;
        }
		
		.switch {
  position: relative;
  display: inline-block;
  width: 43px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>

<body>

<?php
include("connect.php");
	include('header.php');
	// include("loader.php");
	
?>
<div class="main1">
<?php

	$qry = mysqli_query($conn, "select * from merged_table where seq LIKE '%>%'");
	$resCnt = mysqli_num_rows($qry);
	print($resCnt);

	if($resCnt > 0){
	
		while($res=mysqli_fetch_array($qry)){
			$pmid = $res["pmid"];
			$isolate = $res["isolate"];
			$genes[] = $res["gene"];
			//$pmid = $res["pmid"];
			//$isolate = $res["isolate"];
			$uniprotID = $res["uniprot_ncbi"];
			
			$org =  $res["organism"];
			$resist = $res["drug_resistance"];
			$mic = $res["mic_unit"];
		

	
		
$pmid = $res["pmid"];	
$mutation = $res["mutations"];
$gene_name = $res["gene"];
$org = $res["organism"];

$organism = str_replace("C. ", "", $org);
$uniprotId = $res["uniprot_ncbi"];

$mut = str_replace(" ", "", $mutation);
$mut = str_replace(",", "_", $mut);
$mut = str_replace("-", "_", $mut);

if (stripos($mutation, "fs") === false && stripos($mutation, "ins") === false) {	


$seq = trim($res['seq']);
$lines = explode("\n", $seq);
	//var_dump($lines);
	$sequence = "";

for($c = 1; $c < count($lines); $c++){
	// Extract the sequence
$sequence .= trim($lines[$c]);

}


$mutA = $res['mutations'];
		$arr = array();
		//echo $mut."<br>";
		$split = preg_split("/[,\s+()]/", $mutA, -1, PREG_SPLIT_NO_EMPTY);
		foreach($split as $spl)
		{
			
			
			$arr[] = $spl;
			
		}
		
	
	$mutns = array_unique($arr);
    //var_dump($mutns);
	$pattern = '/^([A-Z]*)(\d+)([A-Z]+)$/i';
    $matches = array();
    
	$mutations = array();
     foreach($mutns as $mutn)
	 {
		 
    if (preg_match($pattern, $mutn, $matches)) {
    $waa = $matches[1];   // Y
    $pos = $matches[2];  // 132
    $caa = $matches[3];   // F
	
	$mutations[$pos-1] = array('waa' => $waa, 'caa' => $caa, 'varn' => $mutn, 'pos' => $pos);

	}
	 }
	 
	 /* for ($i = 0; $i < strlen($sequence); $i++) {
    $base = substr($sequence, $i, 1);
	
	 $aaClass = "aa-$base";
	
  
if(isset($mutations[$i])){
	  
	  if($mutations[$i]['waa'] == $base){
		 echo "correct/$uniprotId/".$mutations[$i]['varn']."/$isolate/$pmid/$gene_name<br>";
	 
	  }else{
		 
		 echo "Incorrect/$uniprotId/".$mutations[$i]['varn']."/$isolate/$pmid/$gene_name<br>";
	 }
	

	}

	
} */





$filename = "structures/$pmid/$organism/$gene_name/$uniprotId/$mut.pdb";
// echo $filename."<br>";

$sPath = "structures:$pmid:$organism:$gene_name:$isolate:$uniprotId:$mut.pdb";

 if (file_exists($filename)) {


$pdb_alf = $res['pdb_alf_model'];

//echo "found:$sPath<br>";


}else{
	echo "<b>not-exist:$sPath</b><br>";
} 
	?>
	
  
    </div>

  <?php
  

		}
		}
	}
		?>
</div>



	<?php
	include("foot.php");
	?>
	
</body>
</html>