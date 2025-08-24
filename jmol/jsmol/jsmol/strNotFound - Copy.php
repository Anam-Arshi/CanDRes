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
		a span{
			padding-left: 0.5px;
			font: 13px verdana;
			
		}
		.active{
			color: rgb(12 142 221);
			font-weight: bold;
		}
		a{
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
	</style>
	
</head>

<body>
<?php

include("connect.php");
include("header.php");




if(isset($_REQUEST["filter"])){
	$filter = $_REQUEST["filter"];
	if($filter == "all"){
		$query = "select distinct isolate from gene_mut limit 2";
		$cond = "";
	}
	else if($filter == "s_mut"){
		$query = "select distinct isolate from gene_mut where mutations NOT LIKE '%,%'";
		$cond = "AND combined_table.mutations NOT LIKE '%,%' AND combined_table.mutations NOT LIKE '%ins%' AND combined_table.mutations NOT LIKE '%frame%' AND combined_table.mutations NOT LIKE '%del%'";
	}
	else if($filter == "d_mut"){
		$query = "select distinct isolate from gene_mut WHERE LENGTH(mutations) - LENGTH(REPLACE(mutations, ',', '')) = 1";
		$cond = "AND LENGTH(combined_table.mutations) - LENGTH(REPLACE(combined_table.mutations, ',', '')) = 1";
	}
	else if($filter == "m_mut"){
		$query = "select distinct isolate from gene_mut WHERE LENGTH(mutations) - LENGTH(REPLACE(mutations, ',', '')) > 2";
		$cond = "AND LENGTH(combined_table.mutations) - LENGTH(REPLACE(combined_table.mutations, ',', '')) > 2";
	}
	else if($filter == "ins"){
		$query = "select distinct isolate from gene_mut where mutations LIKE '%ins%'";
		$cond = "AND combined_table.mutations LIKE '%ins%'";
	}
	else if($filter == "del"){
		$query = "select distinct isolate from gene_mut where mutations LIKE '%del%'";
		$cond = "AND combined_table.mutations LIKE '%del%'";
	}
	else if($filter == "indel"){
		$query = "select distinct isolate from gene_mut where mutations LIKE '%del%' AND mutations LIKE '%ins%'";
		$cond = "AND (combined_table.mutations LIKE '%del%' AND combined_table.mutations LIKE '%ins%')";
	}
	else if($filter == "frame"){
		$query = "select distinct isolate from gene_mut where mutations LIKE '%frame%'";
		$cond = "AND combined_table.mutations LIKE '%frame%'";
	}
	else if($filter == "complex"){
		$query = "select distinct isolate from gene_mut where mutations LIKE '%,%' AND (mutations LIKE '%frame%' OR mutations LIKE '%ins%' OR mutations LIKE '%del%')";
		$cond = "AND combined_table.mutations LIKE '%,%' AND (combined_table.mutations LIKE '%frame%' OR combined_table.mutations LIKE '%ins%' OR combined_table.mutations LIKE '%del%')";
	}
	
}
else{
	$query = "select distinct isolate from gene_mut";
	$cond = "";
	$filter = "all";
}

	$qry = mysqli_query($conn, $query);

?>
<script>var filter = "<?php echo $filter;?>";</script>

	 <div id="parent">
        <div id="side">
		
		<div id="filter">
		<p align="center" class="fil-header">Filters</p> 
    <label for="filterColumn1">Species</label>
    <input type="search" id="filterColumn1" placeholder="Enter candida species" class="form-control search-input bootstrap-table-filter-control-organism">
<br>
   <label for="filterColumn2">Gene</label>
    <input type="search" id="filterColumn2" class="form-control bootstrap-table-filter-control-gene" placeholder="Enter gene name">
	
	<br>
   <label for="filterColumn3">Drug</label>
    <input type="search" id="filterColumn3" class="form-control bootstrap-table-filter-control-resistance" placeholder="Enter drug name">
</div>
<br>

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

<div>
<ul class="nav features mx-auto" style="padding-left: 0px">
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=all" name="all"><i class="fa-regular fa-folder"></i><span>All</span></a></li>
<li class="nav-item"><a  href="http://10.1.1.37/candres/browse.php?filter=s_mut" name="s_mut"><i class="fa-regular fa-folder"></i><span>Single substitution</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=d_mut" name="d_mut"><i class="fa-regular fa-folder"></i><span>Double substitution</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=m_mut" name="m_mut"><i class="fa-regular fa-folder"></i><span>Multiple substitution</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=ins" name="ins"><i class="fa-regular fa-folder"></i><span>Insertion</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=del" name="del"><i class="fa-regular fa-folder"></i><span>Deletion</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=indel" name="indel"><i class="fa-regular fa-folder"></i><span>Indel</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=frame" name="frame"><i class="fa-regular fa-folder"></i><span>Frameshift</span></a></li>
<li class="nav-item"><a href="http://10.1.1.37/candres/browse.php?filter=complex" name="complex"><i class="fa-regular fa-folder"></i><span>Complex</span></a></li>
</ul>
</div>
<!-----
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
	<th data-field="gene" data-sortable="true"  data-filter-control="input">Gene</th>
	<th data-field="mutations" data-sortable="true">Mutation</th>
	<th data-field="uniprot" data-sortable="true" >UniProt id</th>
	<th data-field="length" data-sortable="true">Protein length</th>
	<th data-field="alfa" data-sortable="true" class="th-lg">Structure id (PDB/Alpha fold/Model)</th>
	<th data-field="organism" data-sortable="true" data-filter-control="input">Species</th>
	<th data-field="isolate" data-sortable="true">Isolate type</th>
	 
	<th data-field="resistance" data-sortable="true" data-filter-control="input">Drug resistance (MIC)</th>
	<th data-field="mic" data-sortable="true">MIC unit</th>
	<th data-field="year" data-sortable="true">Year of study</th>
	
	
	<th data-field="seq" data-sortable="true">Sequence & structure</th> 
	<th data-field="pubmed" data-sortable="true">PMID</th>
	
	</tr>
	</thead>
	<tbody> !---->
	
	<?php
	$dnld = "Strain\tGene\tMutations\tUniProt id\tProtein length\tAlfa fold id\tSpecies\tIsolate type\tDrug resistance\tYear of study\tPMID";
    
	while($res = mysqli_fetch_array($qry))
{
	$pmid = array();
	$isolate = $res["isolate"];
	
	
	$qry1 = mysqli_query($conn, "select distinct pmid from gene_mut where isolate='$isolate'"); 
		
		
			
			$dnld="$dnld\n$isolate\t";
			
			
			
while($res1 = mysqli_fetch_array($qry1))
{
	
	$pmid[] = $res1["pmid"];
	
	
	
}






for($c = 0; $c < count($pmid); $c++){

$mutations = array();
$uniprot = array();
$length = array();
$pdb = array();
$genes = array();
$drgRes = array();
	$organism = array();
	
	$dist_pmid = array();
	$dist_gene = array();

$querryy = "select final_data.organism, final_data.isolate_type, final_data.drug_resistance, 
final_data.mic_unit, final_data.`year`, combined_table.uniprot_ncbi, combined_table.ptn_len, 
combined_table.pdb_alf_model, combined_table.gene, combined_table.mutations from final_data 
INNER JOIN combined_table ON final_data.isolate = combined_table.isolate where final_data.isolate='$isolate' AND final_data.pmid = '$pmid[$c]' AND combined_table.pmid = '$pmid[$c]' $cond";
$qry2 = mysqli_query($conn, $querryy); 
//echo $querryy."<br>";
while($res2 = mysqli_fetch_array($qry2))
{
	
	$genes[] = $res2["gene"];
	
	$organism = $res2["organism"];
	
	$mutations[] = $res2["mutations"];
	
	
	$isoTyp = $res2["isolate_type"];
	
	$drgRes = $res2["drug_resistance"];
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
	
	$org = str_replace("C. ", "", $sps);

$mut = str_replace(" ", "", $mutn);
$mut = str_replace(",", "_", $mut);
//echo $mut."<br>";
$sPath = "structures/$pmid[$c]/$org/$geneName/$uniprotId/$mut.pdb";
$filename = $sPath;
if (file_exists($filename)) {
    echo "The file $filename exists.<br>";
} else {
    //echo "The file $filename does not exist.";
	$strNotFound[] = "$pmid[$c]:$sps:$geneName:$mutn:$isolate:$uniprotId:$len:$pdbId:$sPath";
}
	
}

/* if(count($genes) > 0){
if(($isolate == "Ca5" || $isolate == "Ca1") && $organism == "C. albicans"){
	$isolate = "C.al";
}	

if(($isolate == "Ca5" || $isolate == "Ca1") && $organism == "C. auris"){
	$isolate = "Cau";
}	

echo "<tr><td>".$isolate."</td>";
echo "<td class='tdli'>";

foreach($genes as $gene){
	echo "<li>$gene</li>";
	$dnld="$dnld$gene;";
}
$dnld="$dnld\t";
echo "</td>";


echo "<td class='tdli'>";

foreach($mutations as $mut){
	echo "<li>$mut</li>";
	$dnld="$dnld$mut;";
}
$dnld="$dnld\t";
echo "</td>";



echo "<td class='tdli'>";

foreach($uniprot as $uni){
	echo "<li><a href='https://www.uniprot.org/uniprotkb/$uni' target='_blank'>$uni</a></li>";
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

foreach($pdb as $pdbId){
	echo "<li>$pdbId</li>";
	$dnld="$dnld$pdbId;";
}
$dnld="$dnld\t";
echo "</td>";

	echo "<td>$organism</td>";
	echo "<td>$isoTyp</td>";
	echo "<td>$drgRes</td>";
	echo "<td>$mic</td>";
	echo "<td>$year</td>";
	echo "<td><a href='http://10.1.1.37/candres/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid[$c]' target='new'><img width=40 height=40  src='images/seq_str1.png' /></a></td>";
	echo "<td><a href='https://pubmed.ncbi.nlm.nih.gov/$pmid[$c]' target='_blank1'>$pmid[$c]</a></td></tr>";
$dnld="$dnld\t$organism\t$isoTyp\t$drgRes\t$mic\t$year\t-\t$pmid[$c]\n";
} */




}


}
foreach($strNotFound as $val){
	echo $val."<br>";
}

	?>
	<!----
	</tbody>
	
	</table>
	<input type="hidden" value="<?php echo $dnld;?>" name="down_data">
	</form>
	
	</div>
	<script>
 

	$(document).ready(function(){
        // Set the placeholders dynamically
        $('#filterColumn1').attr('placeholder', 'Enter candida species');
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
-------------->

		<br>
		</div>
		
		
		</div>
	
	
	
	
	
	<?php
	include("foot.php");
	?>
	
</body>
</html>