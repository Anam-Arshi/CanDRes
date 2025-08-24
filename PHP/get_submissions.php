<?php
// get_submissions.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once 'connect.php';

$response = array();

try {
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get limit parameter
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $limit = max(1, min(100, $limit)); // Ensure limit is between 1 and 100

    // Query to get strain submissions with their genes
    $sql = "SELECT 
                s.id as strain_id,
                s.user_email,
                s.strain,
                s.species,
                s.isolate_type,
                s.experiment_type,
                s.drug_resistance,
                s.year_of_study,
                s.pmid,
                s.additional_info,
                s.submission_date,
                g.id as gene_id,
                g.gene,
                g.mutation,
                g.type_of_mutations,
                g.uniprot_id,
                g.protein_length,
                g.structure_id,
                g.sequence_structure
            FROM user_submissions_strain s
            LEFT JOIN user_submissions_genes g ON s.id = g.strain_id
            ORDER BY s.submission_date DESC, s.id DESC, g.id ASC
            LIMIT ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $limit);
    
    if (!$stmt->execute()) {
        throw new Exception("Error executing statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $submissions = array();
    $current_strain_id = null;
    $current_submission = null;

    while ($row = $result->fetch_assoc()) {
        if ($row['strain_id'] !== $current_strain_id) {
            // Save previous submission if exists
            if ($current_submission !== null) {
                $submissions[] = $current_submission;
            }
            
            // Start new submission
            $current_strain_id = $row['strain_id'];
            $current_submission = array(
                'strain_id' => $row['strain_id'],
                'user_email' => $row['user_email'],
                'strain' => $row['strain'],
                'species' => $row['species'],
                'isolate_type' => $row['isolate_type'],
                'experiment_type' => $row['experiment_type'],
                'drug_resistance' => $row['drug_resistance'],
                'year_of_study' => $row['year_of_study'],
                'pmid' => $row['pmid'],
                'additional_info' => $row['additional_info'],
                'submission_date' => $row['submission_date'],
                'genes' => array()
            );
        }
        
        // Add gene data if exists
        if ($row['gene_id']) {
            $current_submission['genes'][] = array(
                'gene_id' => $row['gene_id'],
                'gene' => $row['gene'],
                'mutation' => $row['mutation'],
                'type_of_mutations' => $row['type_of_mutations'],
                'uniprot_id' => $row['uniprot_id'],
                'protein_length' => $row['protein_length'],
                'structure_id' => $row['structure_id'],
                'sequence_structure' => $row['sequence_structure']
            );
        }
    }
    
    // Don't forget the last submission
    if ($current_submission !== null) {
        $submissions[] = $current_submission;
    }

    $stmt->close();

    $response['success'] = true;
    $response['submissions'] = $submissions;
    $response['total_count'] = count($submissions);

} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}

echo json_encode($response);
?>
