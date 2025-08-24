<html>
<head>
</head>
<body>
<?php
include("connect.php");
$qry = mysqli_query($conn, "select * from final_data");
$data = "pmid\torg\tisolate\tgene\tdrug\n";
$filePath = "sortedDrugDetails_02_04_2024.txt";
while($row = mysqli_fetch_array($qry)){
	
	$pmid = $row["pmid"];
	$org = $row["organism"];
	$gene = $row["gene"];
	$isolate = $row["isolate"];
	$mutation = $row["drug_resistance"];
	$drug = array();
	
   $geneNames = str_replace(" ", "", $gene);
	
	$semcol = preg_split('/[\s,;]+/', $mutation);
	var_dump($semcol);
	
	foreach($semcol as $val){
		$data .= "$pmid\t$org\t$isolate\t$geneNames";
		//$pattern = '/^([\w.]+)\(([^)]+)\)$/'; // This pattern captures the gene name and the values inside the parentheses
		//$pattern = '/^([^()]+)\(.+\)\[.+\]$/';
		//$pattern = '/^([^()]+)\(.+\).*/';
		$pattern = '/^([^()]+)\(.+\).*/'; //single start paranthesis

// Perform the regular expression match
if (preg_match($pattern, trim($val), $matches)) {
    $drug = $matches[1]; // Extract the gene name
    $valuesString = $matches[2]; // Extract the values string

    // Split the values string by commas
    $values = explode(',', $valuesString);
	$impVal = implode(',', $values);

    // Output the results
    echo "Gene Name: $geneName<br>";
    echo "Values: " . $impVal . "<br>";
	
	//$data .= "$geneName\t$impVal\n";
	
	//$impVal = implode(',', $drug);
	$data .= "\t$drug\n";
	if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        //echo "Gene data written to $filePath successfully.";
    } else {
        //echo "Failed to write gene data to $filePath.";
    }
	
} 
else{
    echo "No match found.<br>";
	//$data .= "$val\n";
	
	
}
	}
	
}



?>
</body>
</html>