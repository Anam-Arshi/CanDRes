<?php
error_reporting(E_ALL);
session_start();

?>

<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>Browse Results</title>

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
		
	</style>
	
</head>

<body>
<?php

include("connect.php");
include("header.php");




if(isset($_REQUEST["filter"])){
	$filter = $_REQUEST["filter"];
	if($filter == "all"){
		$query = "select distinct isolate, pmid, organism from gene_mut";
		$cond = "";
	}
	else if($filter == "s_mut"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations NOT LIKE '%,%'";
		$cond = "AND combined_table.mutations NOT LIKE '%,%' AND combined_table.mutations NOT LIKE '%ins%' AND combined_table.mutations NOT LIKE '%frame%' AND combined_table.mutations NOT LIKE '%del%'";
	}
	else if($filter == "d_mut"){
		$query = "select distinct isolate, pmid, organism from gene_mut WHERE LENGTH(mutations) - LENGTH(REPLACE(mutations, ',', '')) = 1";
		$cond = "AND LENGTH(combined_table.mutations) - LENGTH(REPLACE(combined_table.mutations, ',', '')) = 1";
	}
	else if($filter == "m_mut"){
		$query = "select distinct isolate, pmid, organism from gene_mut WHERE LENGTH(mutations) - LENGTH(REPLACE(mutations, ',', '')) > 2";
		$cond = "AND LENGTH(combined_table.mutations) - LENGTH(REPLACE(combined_table.mutations, ',', '')) > 2";
	}
	else if($filter == "ins"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations LIKE '%ins%'";
		$cond = "AND combined_table.mutations LIKE '%ins%'";
	}
	else if($filter == "del"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations LIKE '%del%'";
		$cond = "AND combined_table.mutations LIKE '%del%'";
	}
	else if($filter == "indel"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations LIKE '%del%' AND mutations LIKE '%ins%'";
		$cond = "AND (combined_table.mutations LIKE '%del%' AND combined_table.mutations LIKE '%ins%')";
	}
	else if($filter == "frame"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations LIKE '%frame%'";
		$cond = "AND combined_table.mutations LIKE '%frame%'";
	}
	else if($filter == "complex"){
		$query = "select distinct isolate, pmid, organism from gene_mut where mutations LIKE '%,%' AND (mutations LIKE '%frame%' OR mutations LIKE '%ins%' OR mutations LIKE '%del%')";
		$cond = "AND combined_table.mutations LIKE '%,%' AND (combined_table.mutations LIKE '%frame%' OR combined_table.mutations LIKE '%ins%' OR combined_table.mutations LIKE '%del%')";
	}
	
}
else{
	$query = "select distinct isolate, pmid from merged_table WHERE pmid != ' '";
	// $query = "select distinct isolate, pmid, organism from gene_mut";
	$cond = "";
	$filter = "all";
}

/*$query = "select distinct isolate, pmid, organism from gene_mut where pmid NOT IN ('22514266', '29712651', '23402828', '36012776', '25779577', '27550360', '32690638', 
    '28344162', '15155225', '26259795', '31705810', '34878305', '28353392', '27976986', 
    '33468487', '28065893', '23480635', '20733039', '33077654', '36154919', '28831086', 
    '24323472', '31481447', '27287236', '28533234', '30895218', '23720791', '22278842', 
    '30583013', '25878347', '35323941', '18809934', '26648048', '19682357', '33785623', 
    '31290551', '31325309', '34027824', '32690638', '28344162', '15155225', '22514266', '26259795', '31705810', '34878305', '28353392', '27976986', '33468487', '28065893', '23480635', '20733039', '33077654', '36154919', '28831086', '24323472', '31481447', '27287236', '28533234', '30895218', '23720791', '22278842', '30583013', '25878347', '35323941', '18809934', '26648048', '19682357', '33785623', '31290551', '31325309', '34027824', '36135656', '29712651', '27061369', '24153129', '20368396', '24951808', '31520783', '32899996', '24733474', '35577042', '23089746', '20145084', '29648590', '28630186', '29364212', '25451046', '19148266', '34101035', '17126815', '24051054', '36012776', '19089303', '22948870', '21146713', '18591282', '22257484', '31174994', '21149621', '18443110', '25108876', '36274705', '33820824', '30559734', '25129315', '16048935', '29941644', '27020939', '31762516', '23487382', '26392494', '20837754', '24890592', '34604110', '31111912', '34176429', '35330269', '32015043', '21543574', '20421445', '23089761', '28293420', '11557454', '24829248', '29325167', '36226945', '33175162', '24867987', '30629653', '26030729', '32015032', '23402828', '25779577', '27550360', '35343781', '35867406', '18955538', '21791665', '36329639', '26324281') ";
*/
$qry = mysqli_query($conn, $query);

?>

	
	<?php
	$dnld = "Strain\tGene\tMutations\tUniProt ID\tProtein length\tStructure ID (PDB/Alpha fold/Model)\tSpecies\tIsolate type\tDrug resistance\tMIC unit\tYear of study\tPMID\n";
    
	while($res = mysqli_fetch_array($qry))
{
	//$pmid = array();
	$pmid = $res["pmid"];
	$isolate = $res["isolate"];
	$org = $res["organism"];
	$dnld="$dnld$isolate\t";
	
	/* $qry1 = mysqli_query($conn, "select distinct pmid from gene_mut where isolate='$isolate'"); 
		
		
			
			
			
			
			
while($res1 = mysqli_fetch_array($qry1))
{
	
	$pmid[] = $res1["pmid"];
	
	
	
}
 */





//for($c = 0; $c < count($pmid); $c++){

$mutations = array();
$uniprot = array();
$length = array();
$pdb = array();
$genes = array();
$drgRes = array();
	$organism = array();
	
	$dist_pmid = array();
	$dist_gene = array();

/* $querryy = "select final_data.organism, final_data.isolate_type, final_data.drug_resistance, 
final_data.mic_unit, final_data.`year`, combined_table.uniprot_ncbi, combined_table.ptn_len, count(combined_table.gene) AS count, 
combined_table.pdb_alf_model, combined_table.gene, combined_table.mutations from final_data 
INNER JOIN combined_table ON final_data.isolate = combined_table.isolate where final_data.isolate='$isolate' AND final_data.pmid = '$pmid' AND combined_table.pmid = '$pmid' AND final_data.organism = '$org' AND combined_table.organism = '$org' AND combined_table.seq LIKE '%>%' $cond"; */
$querryy = "select * from merged_table where pmid = '$pmid' AND isolate = '$isolate'";
$qry2 = mysqli_query($conn, $querryy); 
//echo $querryy."<br>";
while($res2 = mysqli_fetch_array($qry2))
{
	
	$genes[] = $res2["gene"];
	
	$organism = $res2["organism"];
	
	$mutations[] = $res2["mutations"];
	$countG = $res2["count"];
	
	$isTy = $res2["isolate_type"];
	$isoTyp = str_ireplace("I", "i", $isTy);
	
	//$ress = $res2["drug_resistance"];
	//$drgRes = str_ireplace(",", ", ", $ress);
	
	$drgRes[] = $res2["drug_resistance"];
	
	$year = $res2["year"];
	
	$uniprot[] = $res2["uniprot_ncbi"];
	$length[] = $res2["ptn_len"];
	$pdb[] = $res2["pdb_alf_model"];
	
	$mic = $res2["mic_unit"];
	
	$geneName = $res2["gene"];
	$uniprotId = $res2["uniprot_ncbi"];
	$mutn = $res2["mutations"];
	$len = $res2["ptn_len"];
	$pdbId = $res2["pdb_alf_model"];
	$sps = $res2["organism"];
	
	
	
	$org = trim(str_replace("C. ", "", $organism));

$mut = str_replace(" ", "", $mutn);
$mut = str_replace(",", "_", $mut);
$mut = str_replace("-", "_", $mut);

$cntGene = count(array_unique($genes));
$impGene = implode(",", array_unique($genes));
//echo $mut."<br>";
if(strpos($mut, "ins") == false && strpos($mut, "frame") == false && strpos($mut, "fs") == false){
$sPath = "structures/$pmid/$org/$geneName/$uniprotId/$mut.pdb";
$filename = $sPath;
if (file_exists($filename)) {
    echo "The file $filename exists.<br>";
} else {
    //echo "The file $filename does not exist.";
	$strNotFound[] = "$pmid:$sps:$geneName:$mutn:$isolate:$uniprotId:$len:$pdbId:$sPath:$countG";
	// $strNotFound[] = "$pmid: $isolate: $geneName: $cntGene: $countG"; 
}
	
}
	
	
	/* echo "<tr><td>".$isolate."</td>";
	echo "<td>$gene</td>";
	echo "<td>$mutations</td>";
	echo "<td>$uniprot</td>";
	echo "<td>$length</td>";
	echo "<td>$pdb</td>";
	echo "<td>$organism</td>";
	echo "<td>$isoTyp</td>";
	echo "<td>$drgRes</td>";
	echo "<td>$mic</td>";
	echo "<td>$year</td>";
	echo "<td><a href='http://10.1.1.37/candres/jmol/jsmol/jsmol/seq_str.php?strain=$isolate' target='new'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";
	echo "<td>$pmid[$c]</td></tr>"; */
	
}


}
	$uniqA = array_unique($strNotFound);
	foreach($strNotFound as $val){
	echo $val."<br>";
}

	
	include("foot.php");
	?>
	
</body>
</html>