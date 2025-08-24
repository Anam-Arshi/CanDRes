<html>
<head>
</head>
<body>
<?php
include("connect.php");
// $qry = mysqli_query($conn, "select * from final_data where pmid IN ('37222585', '37735719', '36440795', '37974063', '38164742', '38299868', '38265207', '37233291', '37623630', '36209989', '36864040', '33619054', '37358415', '37387494', '37222986', '37233226', '38842332', '37233240', '38557967', '36937265', '37116861', '37026059', '38276031', '38921383', '37428075', '37159900', '37888235', '38179314', '38069194', '36975998', '38206004')");
$qry = mysqli_query($conn, "select * from final_data");

$filePath = "mutationPlotFiles/gene_mut_updated_18_02_2025.txt";
while($row = mysqli_fetch_array($qry)){
	
	$pmid = $row["pmid"];
	$org = $row["organism"];
	$gene = $row["gene"];
	$isolate = $row["isolate"];
	$mutation = $row["mutations"];
	
	

	
	$semcol = explode(";", $mutation);
	var_dump($semcol);
	
	foreach($semcol as $val){
		$data = "$pmid\t$org\t$isolate\t";
		$pattern = '/^([\w.]+)\(([^)]+)\)$/'; // This pattern captures the gene name and the values inside the parentheses

// Perform the regular expression match
if (preg_match($pattern, trim($val), $matches)) {
    $geneName = $matches[1]; // Extract the gene name
    $valuesString = $matches[2]; // Extract the values string
	
	$geneName = str_replace(" ", "", $geneName);
	$valuesString = str_replace(" ", "", $valuesString);

    // Split the values string by commas
    $values = explode(',', $valuesString);
	$impVal = implode(',', $values);

    // Output the results
    echo "Gene Name: $geneName\n";
    echo "Values: " . $impVal . "\n";
	
	$data .= "$geneName\t$impVal\n";
	
	if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        //echo "Gene data written to $filePath successfully.";
    } else {
        //echo "Failed to write gene data to $filePath.";
    }
	
	
} else {
    echo "No match found.\n";
	$data .= "$val\t-\n";
	if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        //echo "Gene data written to $filePath successfully.";
    } else {
        //echo "Failed to write gene data to $filePath.";
    }
}
	}
	
}



?>
</body>
</html>