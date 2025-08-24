<?php
error_reporting(E_ALL);


?>
<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>visualization</title>
<style>
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
	
	pre{
		white-space: pre-line;
		font-size: 15px;
		margin-left: 20px;
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
    background-color: yellow;
	cursor: pointer;
	color: red;
	font-weight: bold;
	font-size: 14px;
}
.delmutation {
	background-color: #e36fa1;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
}
.stopmut{
	background-color: red;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
}
.insmut{
	background-color: lightseagreen;
	cursor: pointer;
	color: white;
	font-weight: bold;
	font-size: 14px;
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
		margin-left: 20px;
		margin-top: 10px;
		font-weight: bold;
		margin-bottom: 0;
		font-family: Arial, "sans-serif";
		
	}


.main1{
	background: #F0F0F0;  /* #dbdbdb;  #8395a7 */
	
	margin: 0px;
}


</style>
</head>

<body>

<?php
include("connect.php");
	include('header.php');
	
	
?>
<div class="main1">

<ul id="tab_ul" class="tabs">

<?php
	$strain = $_REQUEST["strain"];
	$pid = $_REQUEST["pmid"];
	$qry = mysqli_query($conn, "select * from combined_table where isolate='$strain' AND pmid='$pid'");
	$resCnt = mysqli_num_rows($qry);
	$counter = 0;
	if($resCnt > 0){
		
		while($res=mysqli_fetch_array($qry)){
			$genes[] = $res["gene"];
		}
		$genes = array_unique($genes);
		foreach($genes as $gene){
			if($counter == 0){
				echo "<li class='selected'><a rel='div_$counter' href='#' onclick='javascript:ShowMyDiv(this);'>$gene</a></li>";
			}
			else{
				echo "<li class=''><a rel='div_$counter' href='#' onclick='javascript:ShowMyDiv(this);'>$gene</a></li>";
			}
			
			
			$counter++;
			
		}
		
		mysqli_data_seek($qry, 0); 
?>


 </ul>


<div class="tabcontents">
   
<?php
$cont = 0;
while($res1=mysqli_fetch_array($qry)){
	
$pmid = $res1["pmid"];	
$mutation = $res1["mutations"];
$gene_name = $res1["gene"];
$org = $res1["organism"];
$uniprotId = $res1["uniprot_ncbi"];

if($cont == 0)
{		
echo "<div class='tabcontent' id='div_$cont' style='display: block;'>";
}
else{
	echo "<div class='tabcontent' id='div_$cont' style='display: none;' >";
}

include("seq.php");

$pdb_alf = $res1['pdb_alf_model'];

$pdbb = $pdb_alf;

$appdivn = "appdivn".$cont;
$appdiv = "appdiv".$cont;



include("jsmol.php");

	?>
	
  
    </div>
<script>
function ShowMyDiv(Obj){
  var elements = document.getElementsByTagName('div');
 for (var i = 0; i < elements.length; i++) 
  if(elements[i].className=='tabcontent')
   elements[i].style.display= 'none';

 document.getElementById(Obj.rel).style.display= 'block';
 //------------------------------------

  var ul_el = document.getElementById('tab_ul');
  var li_el = ul_el.getElementsByTagName('li');
 for (var i = 0; i < li_el.length; i++) 
  li_el[i].className="";

 Obj.parentNode.className="selected";
 
 

}

</script>
  <?php
  
 $cont++;
		}
		?>
</div>


<?php

	} 
  ?>
  
</div>

</div>

	
	
	
	<?php
	include("foot.php");
	?>
	
</body>
</html>