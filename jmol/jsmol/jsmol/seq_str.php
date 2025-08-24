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
$strain = $_REQUEST["strain"];
	$pid = $_REQUEST["pmid"];
	$qry = mysqli_query($conn, "select * from merged_table where isolate='$strain' AND pmid='$pid' AND seq LIKE '%>%'");
	$resCnt = mysqli_num_rows($qry);

	if($resCnt > 0){
		?>
		<table border="0" cellpadding="10" cellspacing="10" style="border-collapse: separate; border-spacing: 2px; padding:10px;">
		<?php
		while($res=mysqli_fetch_array($qry)){
			$genes[] = $res["gene"];
			//$pmid = $res["pmid"];
			//$isolate = $res["isolate"];
			$uniprotID = $res["uniprot_ncbi"];
			
			$org =  $res["organism"];
			$resist = $res["drug_resistance"];
			$mic = $res["mic_unit"];
		}
/* $qry1 = mysqli_query($conn, "select drug_resistance, mic_unit from final_data where isolate='$strain' AND pmid='$pid'");
while($res1=mysqli_fetch_array($qry1)){
		$resist = $res1["drug_resistance"];
			$mic = $res1["mic_unit"];	
}	 */		
$resist = str_ireplace(",", ", ", $resist);
$resist = str_ireplace("(", " (", $resist);
$resist = str_ireplace(";", "; ", $resist);
$resist = str_ireplace(")", " mg/L)", $resist);
echo "<tr><td width='18%' align='left' valign='top' class='utd'><b>PMID :</b></td><td align='left'><i><a href='https://pubmed.ncbi.nlm.nih.gov/$pid' target='_blank1'>$pid</a></i></td></tr>";

echo "<tr><td width='18%' align='left' valign='top' class='utd'><b>Species :</b></td><td align='left'><i>$org</i></td></tr>";

echo "<tr><td width='18%' align='left' valign='top' class='utd'><b>Isolate :</b></td><td align='left'><i>$strain</i></td></tr>";

echo "<tr><td width='18%' align='left' valign='top' class='utd'><b>Drug resistance :</b></td><td align='left'><i>$resist</i></td></tr>";

//echo "<tr><td width='18%' align='left' valign='top' class='utd'><b>MIC unit :</b></td><td align='left'><i>$mic</i></td></tr>";
?>
</table>
<br>
<ul id="tab_ul" class="tabs">

<?php
	
	
		$genes = array_unique($genes);
		$counter = 0;
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
$remark = $res1["remark"];	
$pmid = $res1["pmid"];	
$mutation = $res1["mutations"];
$gene_name = $res1["gene"];
$org = $res1["organism"];

$organism = str_replace("C. ", "", $org);
$uniprotId = $res1["uniprot_ncbi"];

$mut = str_replace(" ", "", $mutation);
$mut = str_replace(",", "_", $mut);
$mut = str_replace("-", "_", $mut);

$filename = "structures/$pmid/$organism/$gene_name/$uniprotId/$mut.pdb";
// echo $filename."<br>";



if($cont == 0)
{		
echo "<div class='tabcontent' id='div_$cont' style='display: block;'>";
}
else{
	echo "<div class='tabcontent' id='div_$cont' style='display: none;' >";
}

if (file_exists($filename)) {
include("seq.php");

$pdb_alf = $res1['pdb_alf_model'];

$pdbb = $pdb_alf;

$appdivn = "appdivn".$cont;
$appdiv = "appdiv".$cont;

//echo $mutation;

if (stripos($mutation, "fs") === false && stripos($mutation, "ins") === false) {	
include("jsmol.php");
?>
<p style="margin: 5px 23px;">The mutant-type protein structures for ADR-associated <em>Candida</em> genes were generated using the ‘mutate’ package of Discovery Studio v2021. 
Wild-type 3D protein structures were collected from PDB and AlphaFold, and these were used to generate mutant-type protein structures. </p>
<br>

<?php
}

}else if ($remark == "Mismatch") {
	
	echo "<p>Structural model of the $gene_name gene is unavailable because of residue mismatch at the specified mutation location.</b></p>";
	
}else{
	echo "<p>&nbsp;<b>Structural model of the $gene_name gene is unavailable.</b></p>";
}
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


  
</div>

<?php

	}
  ?>
  

</div>

<script>
function initializeToggles() {
    // Get all toggle switches on the page
    const toggleSwitches = document.querySelectorAll('.toggleSwitch');

    // Function to handle the toggle behavior
    function handleToggle(event) {
        const toggleSwitch = event.target;  // Get the switch that triggered the event
        const dnaSpans = document.querySelectorAll('.dna-sequence span');  // Get the spans inside the dna-sequence div
		const legendDiv = toggleSwitch.parentNode.parentNode.querySelector('.legendB');
		 
		if (toggleSwitch.checked) {
                legendDiv.style.display = "inline-block";
            } 
			else {
                legendDiv.style.display = "none";
            }

        dnaSpans.forEach(span => {
            const base = span.textContent.trim(); // Get the base (A, T, G, C) from the span

            if (toggleSwitch.checked) {
                // If the toggle is ON, add the class "aa-<base>" back to each span
                span.classList.add(`aa-${base}`);
            } else {
                // If the toggle is OFF, remove the class "aa-<base>"
                span.classList.remove(`aa-${base}`);
            }
        });
    }

    // Add event listeners to all toggle switches
    toggleSwitches.forEach(switchElement => {
        // Pass the function as a reference, don't invoke it
        switchElement.addEventListener('change', handleToggle);
    });

    // Initialize all switches in their default state
    toggleSwitches.forEach(switchElement => {
        // Call handleToggle with the default state of each switch (create a fake event object)
        handleToggle({ target: switchElement });
    });
}

// Call the function to initialize the toggles on page load
initializeToggles();

    </script>
	
	
	
	<?php
	include("foot.php");
	?>
	
</body>
</html>