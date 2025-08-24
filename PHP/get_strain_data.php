<?php
require 'connect.php'; // or wherever your $conn comes from
header('Content-Type: text/html');

$query1 = "select * from merged_table WHERE pmid != ' '";
$qry1 = mysqli_query($conn, $query1);
$dnld = "Strain\tSpecies\tIsolate type\tGene\tMutations\tType of mutations\tUniProt ID\tProtein length\tStructure ID (PDB/Alpha fold/Model)\tDrug resistance\tYear of study\tPMID\n";

	$data = [];

while ($row = mysqli_fetch_assoc($qry1)) {
    $groupKey = $row['pmid'] . '_' . $row['isolate'];
    if (!isset($data[$groupKey])) {
        $data[$groupKey] = [
            'pmid' => $row['pmid'],
            'isolate' => $row['isolate'],
            'organism' => $row['organism'],
            'isolate_type' => $row['isolate_type'],
            'drug_resistance' => [],
            'year' => $row['year'],
            'entries' => [],
            'uniprot' => [],
            'ptn_len' => [],
            'pdb_alf_model' => [],
            'remark' => [],
            'structure_info' => []
        ];
    }
    $data[$groupKey]['entries'][] = [
        'gene' => $row['gene'],
        'mutations' => $row['mutations'],
        'type_of_mutations' => $row['type_of_mutations']
    ];
    $data[$groupKey]['uniprot'][] = $row['uniprot_ncbi'];
    $data[$groupKey]['ptn_len'][] = $row['ptn_len'];
    $data[$groupKey]['pdb_alf_model'][] = $row['pdb_alf_model'];
    $data[$groupKey]['remark'][] = $row['remark'];
    $data[$groupKey]['structure_info'][] = $row['structure_info'];
    $data[$groupKey]['drug_resistance'][] = $row['drug_resistance'];
}

foreach ($data as $groupKey => $group) {
    $isolate = $group['isolate'];
    $organism = $group['organism'];
    $isoTyp = $group['isolate_type'];
    $pmid = $group['pmid'];
    $year = $group['year'];
    $remark = $group['remark'];
    $str_info = $group['structure_info'];

    echo "<tr><td>$isolate</td>";
    echo "<td><em>$organism</em></td>";
    echo "<td>$isoTyp</td>";

    $dnld .= "$isolate\t$organism\t$isoTyp\t";

    // Gene column
    echo "<td class='tdli'>";
    foreach ($group['entries'] as $entry) {
        echo "<li><a href='https://www.ncbi.nlm.nih.gov/gene/?term={$entry['gene']}' target='_blank1'>{$entry['gene']}</a></li>";
        $dnld .= $entry['gene'] . ";";
    }
    echo "</td>";
    $dnld .= "\t";

    // Mutations column
    echo "<td class='tdli'>";
    foreach ($group['entries'] as $entry) {
        $mutBr = explode(",", $entry['mutations']);
        echo "<li>";
        $lastIndex = count($mutBr) - 1;
        foreach ($mutBr as $index => $indMut) {
            echo "$indMut";
            if ($index !== $lastIndex) echo ", ";
        }
        echo "</li>";
        $dnld .= $entry['mutations'] . ";";
    }
    echo "</td>";
    $dnld .= "\t";

    // Mutation Type column
    echo "<td class='tdli'>";
    foreach ($group['entries'] as $entry) {
        echo "<li>{$entry['type_of_mutations']}</li>";
        $dnld .= $entry['type_of_mutations'] . ";";
    }
    echo "</td>";
    $dnld .= "\t";

    // UniProt ID column
    echo "<td class='tdli'>";
    foreach ($group['uniprot'] as $uni) {
        if ($uni != "Not available") {
            echo "<li><a href='https://www.uniprot.org/uniprotkb/$uni' target='_blank'>$uni</a></li>";
        } else {
            echo "<li>Not available</li>";
        }
        $dnld .= "$uni;";
    }
    echo "</td>";
    $dnld .= "\t";

    // Protein length column
    echo "<td class='tdli'>";
    foreach ($group['ptn_len'] as $len) {
        echo "<li>$len</li>";
        $dnld .= "$len;";
    }
    echo "</td>";
    $dnld .= "\t";

    // Structure ID column
    echo "<td class='tdli'>";
    foreach ($group['pdb_alf_model'] as $i => $pdbId) {
        if ($pdbId != "Model" && $pdbId != "Not available") {
            if (strpos($pdbId, "-")) {
                echo "<li><a href='https://alphafold.com/search/text/$pdbId' target='new_af'>$pdbId</a></li>";
            } else {
                echo "<li><a href='https://www.rcsb.org/structure/$pdbId' target='new_pdb'>$pdbId</a></li>";
            }
        } else if ($pdbId == "Model" && $str_info[$i] != "NULL") {
            $modelPath = "./model_structure/{$group['uniprot'][$i]}_prep.pdb";
            echo "<li><a href='$modelPath' download>Model</a></li>";
        } else if ($remark[$i] == "Mismatch") {
            echo "<li>Mismatch residue</li>";
        } else {
            echo "<li>Not available</li>";
        }
        $dnld .= "$pdbId;";
    }
    echo "</td>";
    $dnld .= "\t";

    // Sequence & Structure column
    if (count($group['entries']) > 1) {
        echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40 src='images/seq_str1.png' /></a></td>";
    } else {
        if ($remark[0] == "Mismatch") {
            echo "<td>Mismatch residue</td>";
        } else if (!is_null($str_info[0])) {
            echo "<td>Structure not available</td>";
        } else {
            echo "<td><a href='http://candres.bicnirrh.res.in/jmol/jsmol/jsmol/seq_str.php?strain=$isolate&pmid=$pmid' target='_blank7'><img width=40 height=40 src='images/seq_str1.png' /></a></td>";
        }
    }

    // Drug resistance
    echo "<td>";
    $uniqRes = array_unique($group['drug_resistance']);
    foreach ($uniqRes as $ress) {
        $resist = str_ireplace([",", "(", ")[", ";"], [", ", " (", ") [", "<br>"], $ress);
        echo "<p>$resist</p>";
        $dnld .= "$resist;";
    }
    echo "</td>";
    $dnld .= "\t";

    echo "<td>$year</td>";
    echo "<td><a href='https://pubmed.ncbi.nlm.nih.gov/$pmid' target='_blank1'>$pmid</a></td></tr>";
    $dnld .= "$year\t$pmid\n";
}
?>
