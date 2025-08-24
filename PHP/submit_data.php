<?php
// submit_data.php
header('Content-Type: application/json');
session_start();
include 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    echo json_encode(["success" => false, "message" => "Unauthorized access."]);
    exit;
}

try {
    // Collect strain submission data
    $user_id = $_SESSION['user_id'];
    $strain = $_POST['strain'];
    $species = $_POST['species'];
    $species_other = $_POST['species_other'] ?? null;
    $isolate_type = $_POST['isolate_type'];
    $niche = $_POST['niche'];
    $niche_other = $_POST['niche_other'] ?? null;
    $candidiasis = $_POST['candidiasis'];
    $candidiasis_other = $_POST['candidiasis_other'] ?? null;

    $experiment_type = isset($_POST['experiment_type']) ? implode(',', $_POST['experiment_type']) : '';
    $experiment_other = $_POST['experiment_other'] ?? null;

    $mic_std = $_POST['mic_std'];
    $is_published = $_POST['is_published'];
    $year_of_study = $_POST['year_of_study'] ?? null;
    $pmid = $_POST['pmid'] ?? null;
    $study_title = $_POST['study_title'] ?? null;
    $add_info = $_POST['add_info'] ?? null;

    // Insert into strain_submissions
    $stmt = $conn->prepare("INSERT INTO strain_submissions (user_id, strain, species, species_other, isolate_type, niche, niche_other, candidiasis, candidiasis_other, experiment_type, experiment_other, mic_std, is_published, year_of_study, pmid, study_title, add_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssssssisss", $user_id, $strain, $species, $species_other, $isolate_type, $niche, $niche_other, $candidiasis, $candidiasis_other, $experiment_type, $experiment_other, $mic_std, $is_published, $year_of_study, $pmid, $study_title, $add_info);
    $stmt->execute();
    $submission_id = $stmt->insert_id;
    $stmt->close();

    // Insert gene info
    if (isset($_POST['genes']) && is_array($_POST['genes'])) {
        foreach ($_POST['genes'] as $geneData) {
            $stmt = $conn->prepare("INSERT INTO genes (submission_id, gene, mutation, type_of_mutations, uniprot_id, protein_length, structure_id, sequence_structure) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssiss", $submission_id, $geneData['gene'], $geneData['mutation'], $geneData['type_of_mutations'], $geneData['uniprot_id'], $geneData['protein_length'], $geneData['structure_id'], $geneData['sequence_structure']);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Insert drug info
    if (isset($_POST['drugs']) && is_array($_POST['drugs'])) {
        foreach ($_POST['drugs'] as $drugData) {
            $stmt = $conn->prepare("INSERT INTO drugs (submission_id, name, other_name, cbp, mic, unit) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issdds", $submission_id, $drugData['name'], $drugData['other_name'], $drugData['cbp'], $drugData['mic'], $drugData['unit']);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo json_encode([
        "success" => true,
        "message" => "Submission successful!"
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Server error: " . $e->getMessage()
    ]);
}
exit;
