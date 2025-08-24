<?php
include("connect.php");


// CSV file path
$csvFile = "mutationMismatch.csv";

// Read CSV file
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    // Skip header row if it exists
    fgetcsv($handle);
    
    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE merged_table SET remark = ? WHERE isolate = ? AND pmid = ? AND gene = ?");
    $stmt->bind_param("ssss", $remark, $isolate, $pmid, $gene);
    
    // Set the remark value you want to add
    $remark = "Mismatch"; // Change this to your desired remark
    
    // Process each row in the CSV
    while (($data = fgetcsv($handle)) !== FALSE) {
        $isolate = $data[0]; // First column in CSV
        $pmid = $data[1];    // Second column in CSV
        $gene = $data[2];    // Third column in CSV
        
        // Execute the update
        $stmt->execute();
        
        // Check if row was affected
        if ($stmt->affected_rows > 0) {
            echo "Updated: Isolate $isolate, PMID $pmid, Gene $gene<br>";
        } else {
            echo "No match found: Isolate $isolate, PMID $pmid, Gene $gene<br>";
        }
    }
    
    // Close statement and file
    $stmt->close();
    fclose($handle);
} else {
    echo "Error opening CSV file";
}

// Close connection
$conn->close();
?>