<?php
error_reporting(E_ALL);
session_start();

?>

<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>Advanced Search Results</title>
<meta name="description" content="Results for the complex query searched by user.">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="css/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<script src="css/jquery.dataTables.min.js"></script>
<script src="css/dataTables.bootstrap4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/extensions/export/bootstrap-table-export.min.js"></script>

<style>
	table, main{
		font-family: system-ui;
	}
	 
	
	div.dataTables_wrapper {
        width: 95%;
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
		main{
			padding: 3px;
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
		
		.table-responsive{
			width: 97%;
			margin: auto;
		}
	</style>
</head>

<body>
<?php

include("connect.php");
include("header.php");

?>

<div class="main">

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

$qury = $_POST["qry"];
//echo($qury);
	$qury1=$qury;
	$lookFor="} [";
	$replacement="} OR [";
	$qury=str_replace($lookFor, $replacement, $qury);
	$qury=str_replace('"', '', $qury);
	$lookFor="{";
	$replacement="'%";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="}";
	$replacement="%'";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Species]";
	$replacement="organism LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Drug]";
	$replacement="drug_resistance LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Gene]";
	$replacement="gene LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	$lookFor="[Mutations]";
	$replacement="type_of_mutations LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="Insertions";
	$replacement="Insertion";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="Deletions";
	$replacement="Deletion";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	
	$lookFor="Frameshift";
	$replacement="Frameshift";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="LIKE '%Substitutions%'";
	$replacement="Substitution";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="'%Complex%'";
	$replacement="Complex";
	$qury=str_replace($lookFor, $replacement, $qury);
	
	$lookFor="[year]";
	$replacement="year LIKE ";
	$qury=str_replace($lookFor, $replacement, $qury); 
	
    
	$str="SELECT distinct isolate, pmid FROM merged_table WHERE ".$qury."";
	
	//echo $str;

	
	$qry = mysqli_query($conn, $str); 
	
	//$cnt=mysqli_num_rows($res);
	
	//echo $qry."<br>".$cnt;

?>
<p align="center" style="font-size: 18px; padding:5px; margin: 20px;"><?php
	$qur = str_replace("_", " ", $qury1);
	
	$qr = str_replace("[", "", $qur);
	$qr = str_replace("]", "- ", $qr);
	$qr = str_replace("{", "(", $qr);
    $qr = str_replace("}", ")", $qr);
    
	echo "<b>Query: </b> $qr";
	?>


	</p>
		<br>
		<div class="table-responsive">
		<form action="download.php" method="post" enctype="multipart/form-data">
		<button type="submit" value="download" title="Download" style="float: right; margin: 2px; margin-bottom: 0px;background: transparent; border: none;">
			<i class="fa fa-download" style="padding-top: 15px; color: black; font-size: 16px;"></i>
			</button>
  <div class="buttons-toolbar">
  
</div>



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
	<th data-field="organism" data-sortable="true" data-filter-control="input">Species</th>
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
	while($res = mysqli_fetch_array($qry))
{
	//$pmid = array();
	$pmid = $res["pmid"];
	$isolate = $res["isolate"];
	
$mutTyp = array();
$mutations = array();
$uniprot = array();
$length = array();
$pdb = array();
$genes = array();
$drgRes = array();
	$organism = array();
$matches = array();

$query2 = "select * from merged_table where pmid = '$pmid' AND isolate = '$isolate'";
$qry2 = mysqli_query($conn, $query2);
	while($res2 = mysqli_fetch_array($qry2))
{
$genes[] = $res2["gene"];
	
	$organism = $res2["organism"];
	
	$mutations[] = $res2["mutations"];
	
	$mutTyp[] = $res2["type_of_mutations"];
	
	$isoTyp = $res2["isolate_type"];
	
	
	$drgRes[] = $res2["drug_resistance"];
	
	$year = $res2["year"];
	
	$uniprot[] = $res2["uniprot_ncbi"];
	$length[] = $res2["ptn_len"];
	$pdb[] = $res2["pdb_alf_model"];
	
	//$mic = $res2["mic_unit"];
	
	
}// sec while end///


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
	?>

	</tbody>
	</table>
	
	<input type="hidden" value="<?php echo $dnld;?>" name="down_data">
	</form>
	</div>

		<br>
		</div>
		

<?php
include("foot.php");
?>
</body>
</html>