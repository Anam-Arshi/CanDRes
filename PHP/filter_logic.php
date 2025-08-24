<?php
// filter_logic.php

/**
 * Builds the SQL WHERE conditions and parameter bindings for the main query.
 * This centralizes and secures all filter handling logic.
 *
 * @param array $postData The $_POST array.
 * @param array $sessionData The $_SESSION array.
 * @return array An array containing the WHERE clause string and the parameters to bind.
 */
function build_query_conditions(array $postData, array $sessionData): array
{
    $conditions = [];
    $params = [];
    $types = '';

    // --- Structure Type Filter (col) ---
    $structureTypes = $postData['col'] ?? [];
    if (!empty($structureTypes)) {
        $structureConditions = [];
        if (in_array('pdb', $structureTypes)) {
            $structureConditions[] = "(t.pdb_alf_model NOT LIKE '%-%' AND t.pdb_alf_model NOT LIKE '%Model%')";
        }
        if (in_array('alf', $structureTypes)) {
            $structureConditions[] = "t.pdb_alf_model LIKE '%-%'";
        }
        if (in_array('mod', $structureTypes)) {
            $structureConditions[] = "t.pdb_alf_model LIKE '%Model%'";
        }
        if (!empty($structureConditions)) {
            $conditions[] = "(" . implode(' OR ', $structureConditions) . ")";
        }
    }

    // --- Isolate Type Filter (coli) ---
    $isolateTypes = $postData['coli'] ?? [];
    if (!empty($isolateTypes)) {
        // Creates a placeholder for each value, e.g., (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($isolateTypes), '?'));
        $conditions[] = "t.isolate_type IN ($placeholders)";
        foreach ($isolateTypes as $isoType) {
            $params[] = $isoType;
            $types .= 's';
        }
    }

    // --- Mutation Type Filter (colm) ---
    $mutationTypes = $postData['colm'] ?? [];
    if (!empty($mutationTypes)) {
        $placeholders = implode(',', array_fill(0, count($mutationTypes), '?'));
        $conditions[] = "t.type_of_mutations IN ($placeholders)";
        foreach ($mutationTypes as $mutType) {
            $params[] = $mutType;
            $types .= 's';
        }
    }
    
    // Combine all conditions with 'AND'
    $whereClause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
    
    return [
        'where' => $whereClause,
        'params' => $params,
        'types' => $types
    ];
}

/**
 * Checks if a result row matches the MIC filter criteria.
 * This filtering is done in PHP as it's complex to do in SQL with the current schema.
 *
 * @param array|null $micFilter The filter criteria (drug, sign, value).
 * @param string $drugResistanceStr The drug resistance string from the database.
 * @return bool True if the row passes the filter, false otherwise.
 */
function check_mic_filter(?array $micFilter, string $drugResistanceStr): bool
{
    if ($micFilter === null) {
        return true; // No filter applied, so it passes
    }

    $pattern = '/([\w\s-]+)\s*\(([^)]+)\)/';
    preg_match_all($pattern, $drugResistanceStr, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $drugName = trim($match[1]);
        
        if ($drugName === $micFilter['drug']) {
            $resistanceValStr = preg_replace('/[<>=]/', '', $match[2]);
            $value = (float)$resistanceValStr;

            switch ($micFilter['sign']) {
                case 'equals': if ($value == $micFilter['value']) return true; break;
                case 'gt':     if ($value >  $micFilter['value']) return true; break;
                case 'lt':     if ($value <  $micFilter['value']) return true; break;
                case 'ge':     if ($value >= $micFilter['value']) return true; break;
                case 'le':     if ($value <= $micFilter['value']) return true; break;
            }
        }
    }

    return false; // No match found
}
?>