<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Statistics</title>
<meta name="description" content="This page presents drug resistance-associated genes, species-specific gene mutations, and unique drugs linked to resistance.">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.css">
<style>
	
	table {
		max-width: 95%;
        width: 94%;
        margin: 0 auto;
		text-align: left;
		font-family: verdana;
    }
	h4{
		color: #1a518b;
		font-weight: bold;
		font-family: verdana;
	}
	#PieChart, #doughnutChart {
		height: 500px !important; 
		width: 500px !important; 
	}
	.canvDiv{
		    width: 80%;
    background: whitesmoke;
    /* border: 2px solid darkgray; */
    border-radius: 29px;
    margin: 7px auto;
    box-shadow: 0px 0px 6px darkgrey;
    padding: 30px;
	}
	
	#subDo{
		height: 300px !important; 
		width: 300px !important;
	}
	
	.mutDiv{
		    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
	}
	
	table.dataTable td.dt-type-numeric{
		text-align: left;
	}
	</style>
</head>

<body>
<?php
include("header.php");
include("connect.php");
include("loader.php");
?>
<main class="main">


<form action="download.php" method="post" enctype="multipart/form-data">
<!---<button type="submit" value="download" title="Download" style="float: right; margin-right: 20px; margin-bottom: 0px; float: right; background-color: antiquewhite;">
			<i class="fa-solid fa-download" style="padding: 2px;"></i>
</button> ------>
<br>
<h4 align="center">Drug resistance associated genes in <em>Candida</em> spp.</h4>
<table class="table table-striped table-bordered" style="width:100%">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	<th width='15%'>Species</th>
	<th>Genes</th>
	<th>Count</th>
	</tr>
	</thead>
	
	<tbody>
	<?php
	$query = mysqli_query($conn, "select * from sps_uniq_genes");
	while($row = mysqli_fetch_array($query)){
		$gene = str_replace(",", ", ", $row["distinct_genes"]);
	echo "<tr><td><em>$row[organism]</em></td><td>$gene</td><td>$row[total_unique_gene_count]</td></tr>";
	}

	?>
	
	</tbody>
	</table>
	<script>
//$('#sortTable').DataTable(); Drug resistance associated unique mutation sites in genes of <em>Candida</em> spp.
</script>



<br>
<h4 align="center">Unique mutations in drug resistance associated genes of <em>Candida</em> spp.</h4>
<table class="table table-striped table-bordered" style="width:100%" id="stat2">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	<th width='15%'>Species</th>
	<th>Genes</th>
	<th>Unique mutations</th>
	<th>Count</th>
	
	</tr>
	</thead>
	
	<tbody>
	<?php
	$query1 = mysqli_query($conn, "select * from uniq_mut_sps_wise");
	while($row1 = mysqli_fetch_array($query1)){
		$gene1 = str_replace(",", ", ", $row1["gene"]);
		$pos = str_replace(",", ", ", $row1["distinct_mut_values"]);
	echo "<tr><td><em>$row1[organism]</em></td><td>$gene1</td><td>$pos</td><td>$row1[total_unique_mut_values]</td></tr>";
	}
	?>
	
	</tbody>
	</table>
	<script>
$('#stat2').DataTable();
</script>
	


<!----
<br>
<h4 align="center">Amino acid types in protein sequence of wild and mutant strain of <em>Candida</em> spp.</h4>
<table cellspacing='7' cellpadding='10' align="center" width="94%" border='2' id="stat3">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	<th>Species</th>
	<th>Genes</th>
	<th>Amino acids in wild type strain</th>
	<th>Count</th>
	<th>Amino acids in mutant strain</th>
	<th>Count</th>
	
	
	</tr>
	</thead>
	
	<tbody>
	<?php
	/* $query2 = mysqli_query($conn, "select * from uniq_residue_positions");
	while($row2 = mysqli_fetch_array($query2)){
		
	echo "<tr><td><em>$row2[organism]</em></td><td>$row2[gene]</td><td>$row2[distinct_waa_values]</td><td>$row2[total_unique_waa_values]</td><td>$row2[distinct_caa_values]</td><td>$row2[total_unique_caa_values]</td></tr>";
	} */
	?>
	
	</tbody>
	</table>
	<script>
//$('#stat3').DataTable();
</script>
------>
<br>
<h4 align="center">List of clinical/investigational antifungals and genes involved in drug-resistant  <em>Candida</em> strains</h4>
<table class="table table-striped table-bordered" style="width:100%" id="stat4">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	<th width='15%'>Drugs</th>
	<th>Genes</th>
	<th>Species</th>
	
	
	
	</tr>
	</thead>
	
	<tbody>
	<?php
	$query3 = mysqli_query($conn, "select * from uniq_drg_gene_sps where drug !='Azole' AND drug !='Antifungal' AND drug !='Rhodamine 6G' AND drug !='Rhodamine' AND drug !='Multidrug' AND drug !='Echinocandin'");
	while($row3 = mysqli_fetch_array($query3)){
		$gene3 = $row3['distinct_gene_values'];
		$gene3 = str_replace(",", ", ", $gene3);
		$org3 = $row3['distinct_organism_values'];
		$org3 = str_replace(",", ", ", $org3);
	echo "<tr><td>$row3[drug]</td><td>$gene3</td><td><em>$org3</em></td></tr>";
	}
	?>
	
	</tbody>
	</table>
	<script>
$('#stat4').DataTable();
</script>

	<input type="hidden" value="<?php //echo $dnld;?>" name="down_data">
	</form>
	<br>
	</main>
	
<?php
include("foot.php");


?>	
</body>
</html>