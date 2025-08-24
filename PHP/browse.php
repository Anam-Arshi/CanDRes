<?php
error_reporting(E_ALL);
// ini_set('display_errors', '1');
session_start();

?>

<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>Browse Results</title>
<meta name="description" content="Explore CanDRes, a manually curated database of Candida species, 
featuring drug resistance-associated mutations across various genes, filter by MIC values, check mutated sequences and structures.">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="css/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<script src="css/jquery.dataTables.min.js"></script>
<script src="css/dataTables.bootstrap4.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/extensions/export/bootstrap-table-export.min.js"></script>


	
	<style>
		
	/* #537393 */
	
	div.dataTables_wrapper {
		max-width: 90%;
        width: 90%;
        margin: auto;
    }
		
	/*	table.display {
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;         
  word-wrap: break-word;        
} */
		td{
			word-wrap: break-word; 
		}
		#parent {
			font-family: system-ui;
    background: white;
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: stretch;
    justify-content: flex-start;
    /* align-items: flex-start; */
}
		#side{
			width: 15%;
			border-right: 4px solid gray;
			background: white;
			height: auto;
			padding: 7px;
			
		}
		#main{
			width: 85%;
			
			
		}
		.table-responsive{
			width: 98%;
			margin: auto;
		}
		#filter label{
			font-weight: bold;
			padding: 2px;
		}
		td li{
			padding: 7px;
			border-bottom: 1px solid #dee2e6;
			list-style: none;
		}
		td li:last-child { border: none; }
		
		.page-item.active .page-link{
			background-color: #6d757d;
		}
		td a{
			color: #456793;
		}
		
		.tdli{
			padding:1px !important;
		}
		.nav-item{
			padding: 5px;
			
		}
		li a span{
			padding-left: 0.5px;
			font: 13px verdana;
			
		}
		.active{
			color: rgb(12 142 221);
			font-weight: bold;
		}
		ul li a{
			text-decoration: none;
			color: black;
		}
		.filter{
			background: #5F6469;
			color: white;
			width: 100%;
		}
		.fil-header{
			background: #5f646985;
			margin: 0 0 13px 0;
			font-weight: bold;
			box-shadow: 2px 2px 1px lightgray;
			width: 100%;
			height: 35px;
			padding: 5px;
		}
		
		.str_fil{
			line-height: 27px;
		}
		.str_fil label{
			display: contents;
			
		}
		.numberInput{
			width: 65%;
			padding: 5px;
			
		}
		.drgSelect{
			padding: 5px;
			margin: 3px;
			
		}
		.sign{
			padding: 5px;
			margin: 3px;
		}
		
		.canBtn{
			
    padding: 5px;
    background-color: #94afcb6b;
    
    border: none;
    cursor: pointer;
    font-size: 11px;
	color:#04203D;
	font-weight: bold;
	font-family: verdana;
	border-radius: 3px;

		}
		.canBtn:hover{
			background-color: #04203D;
			color: white;
			/* border: 1px solid #94AFCB; */
		}
		

	</style>
	
</head>

<body>
<?php

$ValidatedMutations = [
    'C. tropicalis' => ['301-304del', 'A297S', 'E133D', 'G464D', 'G464S', 'L168P', 'Q320insertPP', 'R656G', 'Y132F'],
    'C. krusei' => ['A122S', 'A122V', 'A364V', 'E1393G', 'Y140H'],
    'C. glabrata' => ['A15D', 'C198F', 'C469R', 'C866Y', 'D1082G', 'D632G', 'D666G', 'D876Y', 'D987-I998del', 'E1083Q', 'E340G', 'E555K', 'E655A', 'E655K', 'E818K', 'F559S', 'F575L', 'F659V', 'G1099D', 'G119S', 'G11D', 'G122S', 'G210D', 'G346D', 'G348A', 'G71V', 'G73-V81del', 'G943S', 'H576Y', 'H59D', 'I392M', 'I803T', 'K274N', 'K274Q', 'L280F', 'L328F', 'L341del', 'L344S', 'L347F', 'L630I', 'L946S', 'L986P', 'L998F', 'N764I', 'N768D', 'P633T', 'P822L', 'P927S', 'Q386K', 'R1361H', 'R1377stop', 'R250K', 'R265G', 'R295G', 'R376G', 'R376W', 'S316I', 'S343F', 'S391L', 'S663F', 'S942F', 'T292K', 'T588A', 'T607S', 'W1375L', 'W286del', 'W297R', 'W297S', 'Y141H', 'Y372C', 'Y584C'],
    'C. parapsilosis' => ['A395T', 'A619V', 'A854V', 'A859T', 'C866Y', 'D615G', 'E1393G', 'E655A', 'E818K', 'F635Y', 'G111R', 'G53A', 'G583R', 'G604R', 'G650E', 'I283R', 'K143R', 'L518F', 'L779F', 'L978W', 'L986P', 'N803D', 'P272L', 'P660A', 'P660A', 'P660A', 'R135I', 'R479K', 'R772I', 'S656P', 'W182stop'],
    'C. albicans' => ['A15D', 'A446Y', 'A643T', 'A643V', 'A646V', 'A880E', 'D1082G', 'D19E', 'D648S', 'D876Y', 'E517Q', 'E655A', 'E841G', 'F1235C', 'F449V', 'G307S', 'G464S', 'G464S', 'G547R', 'G648D', 'G648S', 'H263Y', 'H283R', 'H741Y', 'H839Y', 'I471T', 'K143Q', 'K143R', 'K684E', 'K884E', 'L122-I125del', 'L144V', 'L193R', 'L370S', 'L962-N969del', 'L979E', 'L998F', 'N1240D', 'N435V', 'N535I', 'N740D', 'N740S', 'N972D', 'N972S', 'N977D', 'N977K', 'P230L', 'P236S', 'P649L', 'P683H', 'P971S', 'P98S', 'Q1388P', 'Q327K', 'Q350L', 'Q714P', 'R1354S', 'R157K', 'R365G', 'R467K', 'R469K', 'R546T', 'R546Y', 'R873T', 'S1037L', 'S165N', 'S405F', 'S466L', 'S469T', 'S480P', 'S542L', 'S542P', 'T123I', 'T145A', 'T220L', 'T225A', 'T381I', 'T386I', 'T470N', 'T540I', 'T83A', 'T896I', 'V162A', 'W1358S', 'W182stop', 'W219C', 'W478C', 'W893R', 'W986L', 'Y132F', 'Y132H', 'Y286D', 'Y447H', 'Y642F'],
    'C. auris' => ['A640V', 'F635Y', 'K143R', 'N647T', 'R1354S', 'W182stop', 'W691L'],
    'C. dubliniensis' => ['C866Y', 'D615G', 'D987-I998del', 'E555K', 'G464S', 'H269N', 'H318N', 'P272L', 'Q160K', 'Q327K', 'T374I', 'T985del', 'Y132H', 'Y372C'],
    'C. kefyr' => ['F641del', 'S218P', 'L107S'],
    'C. metapsilosis' => ['P660A'],
    'C. orthopsilosis' => ['P660A'],
];

// print_r($mutations);



include("connect.php");
include("header.php");
include("loader.php");

$cond = "";
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
	session_unset(); // Remove all session variables
	session_destroy(); // Destroy the session
	
}
if(isset($_POST["resetF"])){
	session_unset(); // Remove all session variables
	session_destroy(); // Destroy the session
	unset($_POST['col']);
	unset($_POST['coli']);
	unset($_POST['colm']);
	unset($_POST["drgSelect"]);
	unset($_POST["drugName"]);
}
$query1 = "select distinct isolate, pmid from merged_table WHERE pmid != ' '";


	if(isset($_POST['col'])){
	
   $col = implode(', ', $_POST['col']);

if(count($_POST['col']) != 3){
	$strTyp = $_POST['col'];
	if(count($_POST['col']) == 2){
			if(strpos($col , "pdb") !== false && strpos($col , "alf") !== false){
			$cond .= " AND (merged_table.pdb_alf_model NOT LIKE '%Model%')";
		}else 
			if(strpos($col , "pdb") !== false && strpos($col , "mod") !== false){
			$cond .= " AND merged_table.pdb_alf_model NOT LIKE '%-%'";
		}else{
			$cond .= " AND (merged_table.pdb_alf_model LIKE '%-%' OR merged_table.pdb_alf_model LIKE '%Model%')";
		}
	
	}
	else{
			if($strTyp[0] == "pdb"){
			$cond .= " AND (merged_table.pdb_alf_model NOT LIKE '%-%' AND merged_table.pdb_alf_model NOT LIKE '%Model%')";
		}else 
			if($strTyp[0] == "alf"){
			$cond .= " AND merged_table.pdb_alf_model LIKE '%-%'";
		}else{
			$cond .= " AND merged_table.pdb_alf_model LIKE '%Model%'";
		}
	}
	
}

	
	}else{
		$col="";

	}
	$coln=str_replace(" ", "", $col);
	$col1= explode(",", $coln);
	$_SESSION["col"] = $col;
	
	
//// Isolate type filter //////////
$coliA = array();
if(isset($_POST['coli'])){
	
    $coli = implode(',', $_POST['coli']);

	
	
	$coliA= explode(",", $coli);
	$_SESSION["coli"] = $coli;
	
	if(isset($_SESSION["coli"])){
		if(count($coliA) == 2){
			$iso1 = $coliA[0];	
			$iso2 = $coliA[1];
			$cond .= " AND (merged_table.isolate_type = '$iso1' OR merged_table.isolate_type = '$iso2')";
			
		
		}else if(count($coliA) == 1){
			$iso1 = $coliA[0];	
			$cond .= " AND merged_table.isolate_type = '$iso1'";
		}
	}
}

$colmA = array();
//// Mutation type filter //////////

if(isset($_POST['colm'])){
	
    $colm = implode(',', $_POST['colm']);

	
	
	$colmA= explode(",", $colm);
	$_SESSION["colm"] = $colm;
	
	if (isset($_SESSION["colm"])) {
    if (count($colmA) > 0) {
        $cond .= " AND (";
        foreach ($colmA as $mutV) {
            $cond .= "merged_table.type_of_mutations = '$mutV' OR ";
        }
        $cond = rtrim($cond, " OR "); // remove the trailing " OR "
        $cond .= ")";
    }
}
}


//echo $cond."<br>";
$query1 .= $cond; 
$query1 .= " ORDER BY pmid";
//echo $query1."<br>";
$qry1 = mysqli_query($conn, $query1);

 if(isset($_POST["drgSelect"])){
	$drugName = $_POST["drgSelect"];
	$sign = $_POST["sign"];
	$input = $_POST["inputVal"];
	
	$_SESSION["drugName"] = $drugName;
	$_SESSION["sign"] = $sign;
		$_SESSION["input"] = $input;
		$flag = 0;
	
}else if(isset($_SESSION["drugName"])){
	$drugName = $_SESSION["drugName"];
	$sign = $_SESSION["sign"];
	$input = $_SESSION["input"];
	$flag = 0;
}else{
	$flag = 1;
}

?>
<script>var filter = "<?php echo $filter;?>";</script>

	 <div id="parent">
        <div id="side">
		
		<div id="filter">
		<p align="center" class="fil-header">Filters</p> 
		<label for="filterColumn2">Gene</label>
    <input type="search" id="filterColumn2" class="form-control bootstrap-table-filter-control-gene" placeholder="Enter gene name">
	
   
<br>
    <label for="filterColumn1">Species</label>
    <input type="search" id="filterColumn1" placeholder="Enter candida species" class="form-control search-input bootstrap-table-filter-control-organism">
	<br>
   <label for="filterColumn3">Drug</label>
    <input type="search" id="filterColumn3" class="form-control bootstrap-table-filter-control-resistance" placeholder="Enter drug name">
	
	</div>



<br>
<form action="browse.php" method="post" onsubmit="showLoading();">
<div class="str_fil">
<label style="font-weight: bold; padding: 2px;margin-bottom:5px;">3D Structure</label><div></div>
<input type="checkbox" name="col[]" value="pdb" onChange="this.form.submit()"  <?php if (in_array("pdb", $col1))
  {
  echo "checked";
  }?>><label for="Exp eluc">Experimentally elucidated</label><br>
<input type="checkbox" name="col[]" value="alf" onChange="this.form.submit()"  <?php if (in_array("alf", $col1))
  {
  echo "checked";
  }?>><label for="Exp eluc af">AlphaFold predicted</label><br>
<input type="checkbox" name="col[]" value="mod" onChange="this.form.submit()"  <?php if (in_array("mod", $col1))
  {
  echo "checked";
  }?>><label for="model">Modeled</label>
</div>
<br>
<div class="str_fil">
<label style="font-weight: bold; padding: 2px;margin-bottom:5px;">Isolate type</label><div></div>
<input type="checkbox" name="coli[]" value="Clinical isolate" onChange="this.form.submit()"  <?php if (in_array("Clinical isolate", $coliA))
  {
  echo "checked";
  }?>><label for="clin">Clinical isolate</label><br>
<input type="checkbox" name="coli[]" value="Laboratory strain" onChange="this.form.submit()"  <?php if (in_array("Laboratory strain", $coliA))
  {
  echo "checked";
  }?>><label for="lab">Laboratory strain</label><br>
<input type="checkbox" name="coli[]" value="Environmental source" onChange="this.form.submit()"  <?php if (in_array("Environmental source", $coliA))
  {
  echo "checked";
  }?>><label for="env">Environmental source</label>
</div>

<br>
<div class="str_fil">
<label style="font-weight: bold; padding: 2px;margin-bottom:5px;">Mutation type</label><div></div>

<input type="checkbox" name="colm[]" value="Single substitution" onChange="this.form.submit()"  <?php if (in_array("Single substitution", $colmA))
  {
  echo "checked";
  }?>><label for="clin">Single substitution</label><br>
  
<input type="checkbox" name="colm[]" value="Double substitution" onChange="this.form.submit()"  <?php if (in_array("Double substitution", $colmA))
  {
  echo "checked";
  }?>><label for="lab">Double substitution</label><br>
  
<input type="checkbox" name="colm[]" value="Multiple substitution" onChange="this.form.submit()"  <?php if (in_array("Multiple substitution", $colmA))
  {
  echo "checked";
  }?>><label for="env">Multiple substitution</label><br>
  
  <input type="checkbox" name="colm[]" value="Insertion" onChange="this.form.submit()"  <?php if (in_array("Insertion", $colmA))
  {
  echo "checked";
  }?>><label for="clin">Insertions</label><br>
  
<input type="checkbox" name="colm[]" value="Deletion" onChange="this.form.submit()"  <?php if (in_array("Deletion", $colmA))
  {
  echo "checked";
  }?>><label for="lab">Deletions</label><br>
  
<input type="checkbox" name="colm[]" value="Frameshift" onChange="this.form.submit()"  <?php if (in_array("Frameshift", $colmA))
  {
  echo "checked";
  }?>><label for="env">Frameshift</label><br>
  
  <input type="checkbox" name="colm[]" value="Stop" onChange="this.form.submit()"  <?php if (in_array("Stop", $colmA))
  {
  echo "checked";
  }?>><label for="clin">Stop</label><br>
  
<input type="checkbox" name="colm[]" value="Complex" onChange="this.form.submit()"  <?php if (in_array("Complex", $colmA))
  {
  echo "checked";
  }?>><label for="lab">Complex</label><br>

</div>


</form>
<br>

<div style="background-color: #d3d3d340; border: 1px solid darkgray;">
<form action="browse.php" method="post" name="micForm" onsubmit="showLoading();">
<label style="font-weight: bold; padding: 2px;margin-bottom:5px;">MIC Filter</label><div></div>
<select name='drgSelect' class="drgSelect">

<option value="5-Flucytosine">5-Flucytosine</option>
 
						<option value="Amphotericin B">Amphotericin B</option>
						<option value="Anidulafungin">Anidulafungin</option>
						<option value="Beauvericin">Beauvericin</option>
						<option value="Caspofungin">Caspofungin</option>
						<option value="Clotrimazole">Clotrimazole</option>
						<option value="Fluconazole">Fluconazole</option>
						<option value="Isavuconazole">Isavuconazole</option>
						<option value="Itraconazole">Itraconazole</option>
						<option value="Ibrexafungerp">Ibrexafungerp</option>
						<option value="Ketoconazole">Ketoconazole</option>
						
						<option value="Manogepix">Manogepix</option>
						<option value="Micafungin">Micafungin</option>
						<option value="Nystatin">Nystatin</option>
						<option value="Posaconazole">Posaconazole</option>
						<option value="Prochloraz">Prochloraz</option>
						<option value="Ravuconazole">Ravuconazole</option>
						<option value="Rezafungin">Rezafungin</option>
						
						<option value="Voriconazole">Voriconazole</option>
</select>
<br>
<select name='sign' class="sign">
						<option value="equals">&equals;</option>
						<option value="gt">&gt;</option>
						<option value="lt">&lt;</option>
						<option value="ge">&gt;=</option>
						<option value="le">&lt;=</option>
						
</select>
<input type="number" value="" placeholder="Enter a value" name="inputVal" class="numberInput"/>
<input type="submit" value="Submit" class="" style="margin:5px;" />

</form>
</div>
<form action="browse.php" method="post">
<p style="text-align: center; padding: 5px;"><input type="submit" value="Reset" class="" name="resetF"></p>
</form>
</div>
		
		
	<div id="main">
		<h3 align="center">Mutations associated with antifungal drug resistance in <em>Candida</em> species </h3>
		<br>
		<div class="table-responsive">
		<form action="download.php" method="post" enctype="multipart/form-data">
		<button type="submit" value="download" title="Download" style="float: right; margin: 2px; margin-bottom: 0px;background: transparent; border: none;">
			<i class="fa fa-download" style="padding-top: 15px; color: black; font-size: 16px;"></i>
			</button>
  <div class="buttons-toolbar">
  
</div>

<?php if(isset($_SESSION['drugName'])){echo "<p>Results for the query: ".$_SESSION['drugName']." &".$_SESSION['sign']."; ".$_SESSION['input']."</p>"; }?>

		<table 
		data-toggle="table"
  
  data-pagination="true"
  data-show-columns="true"
  data-sortable="true"
  data-search="true"
  data-searchable="true"
  data-buttons-toolbar=".buttons-toolbar"
   data-filter-control="true"
  data-filter-control-container="#filter"
   data-show-export="false"
  

  id="BrowseTable"
  class="table table-striped table-bordered table-hover display nowrap text-nowrap">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	
	
	<th data-field="strain" data-sortable="true">Strain</th>
	<th data-field="organism" data-sortable="true">Species</th>
	<th data-field="isolate" data-sortable="true">Isolate type</th>
	<th data-field="gene" data-sortable="true"  data-filter-control="input">Gene</th>
	<th data-field="mutations" data-sortable="true">Mutation</th>
	<th data-field="mutTyp" data-sortable="true" data-filter-control="select">Type of mutations</th>
	<th data-field="uniprot" data-sortable="true" >UniProt ID</th>
	<th data-field="length" data-sortable="true">Protein length</th>
	<th data-field="alfa" data-sortable="true" class="th-lg">Structure ID (PDB/Alpha fold/Model)</th>
	<th data-field="seq" data-sortable="true">Sequence & structure</th> 
	 
	<th data-field="resistance" data-sortable="true" data-filter-control="input">Drug resistance (MIC in mg/L)</th>
	
	<th data-field="year" data-sortable="true">Year of study</th>
	
	<th data-field="pubmed" data-sortable="true">PMID</th>
	
	</tr>
	</thead>
	<tbody>
	
	<?php
	$dnld = "Strain\tSpecies\tIsolate type\tGene\tMutations\tType of mutations\tUniProt ID\tProtein length\tStructure ID (PDB/Alpha fold/Model)\tDrug resistance\tYear of study\tPMID\n";
    while($res1 = mysqli_fetch_array($qry1))
{
	$pmid = $res1["pmid"];
	$isolate = $res1["isolate"];
	
$mutTyp = array();
$mutations = array();
$uniprot = array();
$length = array();
$pdb = array();
$genes = array();
$drgRes = array();
$organism = array();
$matches = array();

$remark = array();
$str_info = array();

$query2 = "select * from merged_table where pmid = '$pmid' AND isolate = '$isolate'";
$qry2 = mysqli_query($conn, $query2);
	while($res2 = mysqli_fetch_array($qry2))
{
	$remark[] = $res2["remark"];
	$str_info[] = $res2["structure_info"];
	$genes[] = $res2["gene"];
	
	$organism = $res2["organism"];
	
	$mutations[] = $res2["mutations"];
	
	$mutTyp[] = $res2["type_of_mutations"];
	
	$isoTyp = $res2["isolate_type"];
	
	
	if(isset($_SESSION["drugName"])){
		
	$flag = 0;
		
	$drugResistance = $res2["drug_resistance"];
	$pattern = '/([\w-]+)\(([^)]+)\)/';
	preg_match_all($pattern, $drugResistance, $matches, PREG_SET_ORDER);
	foreach ($matches as $match) {
    // The drug name is in the first capturing group
    $drug_name = $match[1];
    $resistanceVal = $match[2];
	
	$resistanceVal = str_replace(" ", "", $resistanceVal);
	$resistanceVal = str_replace(">", "", $resistanceVal);
	$resistanceVal = str_replace(">=", "", $resistanceVal);
	$resistanceVal = str_replace("<", "", $resistanceVal);
	//echo $resistanceVal."<br>";
    // The value in parentheses is in the second capturing group
    $value = (float)$resistanceVal; // Cast to float
	$input = (float)$input;
	//echo $value."$input <br>";
	
	
	if($drug_name == $drugName){
		
		if($sign == "equals"){
			if($value == $input){
				$flag = 1;
			}
		}
		else if($sign == "gt"){
			if($value > $input ){
				$flag = 1;
			}
		}
		else if($sign == "lt"){
			if($value < $input){
				$flag = 1;
			}
		}
		else if($sign == "ge"){
			if($value > $input || $value == $input ){
				$flag = 1;
			}
		}
		else if($sign == "le"){
			if($value < $input || $value == $input ){
				$flag = 1;
			}
		}
	}
 
}
	}else{
		$flag = 1;
	}
	
	$drgRes[] = $res2["drug_resistance"];
	
	$year = $res2["year"];
	
	$uniprot[] = $res2["uniprot_ncbi"];
	$length[] = $res2["ptn_len"];
	$pdb[] = $res2["pdb_alf_model"];
	
	//$mic = $res2["mic_unit"];
	
	
}// sec while end///

if($flag != 0){


echo "<tr><td>".$isolate."</td>";

echo "<td><em>$organism</em></td>";
echo "<td>$isoTyp</td>";

$dnld="$dnld$isolate\t$organism\t$isoTyp\t";


echo "<td class='tdli'>";
foreach($genes as $gene){
	echo "<li><a href='https://www.ncbi.nlm.nih.gov/gene/?term=$gene' target='_blank1'>$gene</a></li>";
	$dnld="$dnld$gene;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";
foreach($mutations as $mut){
$mutBr = explode(",", $mut);
echo "<li>";

$lastIndex = count($mutBr) - 1; // Get the index of the last element in the array

foreach($mutBr as $index => $indMut) {
	
	if (array_key_exists($organism, $ValidatedMutations)) {
	
    // Check if the mutation exists in the variants array
    if(in_array($indMut, $ValidatedMutations[$organism])) {
        echo "<a href='validationTable.php?mut=$indMut&sps=$organism' class='highlight' data-tooltip='Validated' target='_mut'>$indMut</a>";
    }
	else {
        echo "$indMut"; // Display non-matching variants normally
    }
	 } else {
        echo "$indMut"; // Display non-matching variants normally
    }

    // Add a comma after each mutation except the last one
    if ($index !== $lastIndex) {
        echo ", ";
    }

}

echo "</li>";
	//echo "<li>$mut</li>";
	$dnld="$dnld$mut;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";

foreach($mutTyp as $mTyp){
	echo "<li>$mTyp</li>";
	$dnld="$dnld$mTyp;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";

foreach($uniprot as $uni){
	if($uni != "Not available"){
	echo "<li><a href='https://www.uniprot.org/uniprotkb/$uni' target='_blank'>$uni</a></li>";
	}else{
		echo "<li>Not available</li>";
	}
	$dnld="$dnld$uni;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";

foreach($length as $len){
	echo "<li>$len</li>";
	$dnld="$dnld$len;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";

$pdbCount = count($pdb); // Get total count of elements

for ($i = 0; $i < $pdbCount; $i++) {
    $pdbId = $pdb[$i]; // Get current PDB ID
    
    if ($pdbId != "Model" && $pdbId != "Not available") {
        if (strpos($pdbId, "-")) {
            echo "<li><a href='https://alphafold.com/search/text/$pdbId' target='new_af'>$pdbId</a></li>";
        } else {
            echo "<li><a href='https://www.rcsb.org/structure/$pdbId' target='new_pdb'>$pdbId</a></li>";
        }
    } else {
        if ($pdbId == "Model" && $str_info[$i] != "NULL" ) {
            // echo "<li><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid#strFil' target='_blank8'>$pdbId</a></li>";
			$modelPath = "./model_structure/$uniprot[$i]"."_prep.pdb";
			
			echo "<li><a href='$modelPath' download>Model</a></li>";
			
        }else if($remark[$i] == "Mismatch"){
			echo "<li>Mismatch residue</li>";
		} 
		else {
            echo "<li>Not available</li>";
        }
    }
    
    $dnld .= $pdbId . ";"; // Append to download string
}
$dnld="$dnld\t";
echo "</td>";

// showing sequence and structure
/* if(count($genes) > 1 && is_null($str_info[0])){
	
	echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";

}else{
	
	if($remark[0] == "Mismatch"){
		echo "<td>Mismatch residue</td>";
	}else if(!is_null($str_info[0])){
		echo "<td>Structure not available</td>";
	}else{
		
		echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";
}
	
} */
if(count($genes) > 1){
	
	echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";

}else{
	
	if($remark[0] == "Mismatch"){
		echo "<td>Mismatch residue</td>";
	}else if(!is_null($str_info[0])){
		echo "<td>Structure not available</td>";
	}else{
		
		echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";
}
	
}

	
	echo "<td>";
	$uniqRes = array_unique($drgRes);
	foreach($uniqRes as $ress){
		$resist = str_ireplace(",", ", ", $ress);
		$resist = str_ireplace("(", " (", $resist);
		$resist = str_ireplace(")[", ") [", $resist);
		$resist = str_ireplace(";", "<br>", $resist);
		echo "<p>$resist</p>";
		$dnld="$dnld$resist;";
		
	}
	$dnld="$dnld\t";
	echo "</td>";
	
	//echo "<td>$mic</td>";
	echo "<td>$year</td>";
	echo "<td><a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank1'>$pmid</a></td></tr>";
$dnld="$dnld$year\t$pmid\n";

}
}
	?>
	</tbody>
	
	</table>
	<input type="hidden" value="<?php echo $dnld;?>" name="down_data">
	</form>
	
	</div>
	<script>
 

	$(document).ready(function(){
        // Set the placeholders dynamically
        $('#filterColumn1').attr('placeholder', 'Enter species');
        $('#filterColumn2').attr('placeholder', 'Enter gene name');
		$('#filterColumn3').attr('placeholder', 'Enter drug name');
    });

</script>

<script>
    if(filter){
        // Remove 'active' class from all li elements
        var allItems = document.querySelectorAll('.nav-item');
        allItems.forEach(item => {
            item.classList.remove('active');
        });

        // Set 'active' class to the clicked li element
		element = document.getElementsByName(filter)[0];
        element.parentNode.classList.add('active');

        // Change the class and color for the clicked link
        var icon = element.querySelector('i');
        icon.classList.remove('fa-regular', 'fa-folder');
        icon.classList.add('fa-solid', 'fa-folder-open');
        element.style.color = 'rgb(12 142 221)';
		element.style.fontWeight = 'bold';
		
    }



</script>


		<br>
		</div>
		
		
		</div>
	
	
	
	
	
	<?php
	
	include("foot.php");
	
	?>
	
</body>
</html>