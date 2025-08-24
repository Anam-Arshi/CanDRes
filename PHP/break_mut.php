<?php
// Path to the text file
$filePath = 'mutation_details_glabrata.txt';

// Read the entire content of the file
$fileContent = file_get_contents($filePath);

// Split the file content into lines
$lines = explode(PHP_EOL, $fileContent);

// Define an array to store the transformed data
$transformedData = [];

// Loop through each line to extract mutations and drug information
foreach ($lines as $line) {
    if (empty($line)) {
        continue; // Skip empty lines
    }

    // Split the line into mutations and drug information
    list($mutations, $drugs) = explode("\t", $line); // Assuming tab-separated data

    // Split mutations by comma
    $mutationList = explode(',', $mutations);

    // Loop through each mutation and create a new row with the same drug(s)
    foreach ($mutationList as $mutation) {
        $transformedData[] = [
            'Mutation' => trim($mutation),
            'Drug' => trim($drugs),
        ];
    }
}



// Optionally, you can save the transformed data to a new text or CSV file
 $outputFilePath = 'transformed_data_glabrata.txt';
 

// Add header row
 // fputcsv($outputFile, ['Mutation', 'Drug']);

// Add data rows
 foreach ($transformedData as $row) {
	 $data .= "$row[Mutation], \"$row[Drug]\"\n";
    
 }

 if (file_put_contents($outputFilePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        //echo "Gene data written to $filePath successfully.";
    } else {
        //echo "Failed to write gene data to $filePath.";
    }

?>
