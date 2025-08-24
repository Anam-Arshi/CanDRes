<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Validation of Mutations</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	

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
	table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date, table.dataTable td.dt-type-numeric, table.dataTable td.dt-type-date {
    text-align: left;
}

/* Custom tooltip styles */
        .tooltip-inner {
            background-color: #333; /* Tooltip background color */
            color: #fff; /* Tooltip text color */
            font-size: 14px; /* Tooltip font size */
            border-radius: 5px; /* Tooltip border radius */
			max-width: 300px; /* Tooltip max width */
            width: 250px; /* Tooltip fixed 
        }
        .tooltip-arrow {
            border-top-color: #333 !important; /* Arrow color */
        }
	</style>
</head>

<body>
<?php
include("header.php");
include("connect.php");

?>
<main class="main">

<h4 align="center">Association of mutation to drug resistance</h4>
<table id="example" class="table table-striped table-bordered" style="width:100%">
	<thead>
	<tr style="background-color: #5F6469; color: white;">
	<th width='15%'>Mutation</th>
	<th>Gene</th>
	<th>Species</th>
	
	<th>Validation status</th>
	<th>Validation technique(s)</th>
	<th>Validation reference(s)</th>
	<th>Resistance mechanism(s)</th>
	<th>Validation score <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="A score of 2 signifies mutations validated experimentally, whereas a score of 1 indicates mutations that haven't been validated."></i> </th>
	</tr>
	</thead>
	
	<tbody>
	<?php
	if(isset($_REQUEST["mut"])){
		$sps = $_REQUEST["sps"];
		$mut = $_REQUEST["mut"];
		$query = mysqli_query($conn, "select * from validation_score where mutation = '$mut' AND organism = '$sps'");
		
		
	}else{
	$query = mysqli_query($conn, "select * from validation_score");
	}
	while($row = mysqli_fetch_array($query)){
		$pmids = $row["validated_references"];
		$pmids = str_replace(" ", "", $pmids);
		$pmids = explode(",", $pmids);
		//$pmids = str_replace(",", "<br>", $pmids);
		// $mutRef = $row["mutation_references"];
		// $mutRef = str_replace(" ", "", $mutRef);
		// $mutRef = str_replace(",", "<br>", $mutRef);
		
		
	echo "<tr>
	<td>$row[mutation]</td>
	<td>$row[gene]</td>
	<td><em>$row[organism]</em></td>
	
	<td>$row[validated]</td>
	<td>$row[validated_techniques]</td>";
	echo "<td>";
	foreach($pmids as $pmid){
		echo "<a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank1'>$pmid</a><br>";
	}
	echo "</td>
	<td>$row[resistance_mechanism]</td>
	<td>$row[score]</td>
	</tr>";
	}

	?>
	
	</tbody>
	</table>
	<script>
$('#example').DataTable();
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
<br>
</main>
	
<?php
include("foot.php");


?>	
</body>
</html>