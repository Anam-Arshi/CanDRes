<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Data Submission Form</title>
    <style>
        /* --- General Layout & Body ---
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            margin: 0;
        } */

        main {
            padding: 2rem 0;
        }
        
        .container {
            padding: 20px 40px;
            max-width: 1200px; /* Wider container for the whole form */
            margin: 0 auto;
        }
        
        h2 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: #2c3e50;
        }

        /* --- Form Grid & Groups --- */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px 30px;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }

        /* --- Labels, Inputs, & Textareas --- */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .required {
            color: #e74c3c;
        }
        
        input[type=text],
        input[type=number],
        input[type=email],
        select,
        textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .inline-radio {
            margin-right: 25px;
            font-weight: 500;
        }
        .inline-radio input {
            margin-right: 6px;
            width: auto; /* Override default width for radio buttons */
        }
        
        .published-fields {
            display: none; /* Hidden by default */
        }

        /* --- Section Styling (Contributor, Strain, Gene) --- */
        .form-section {
            border: 2px solid #e8f4f8;
            border-radius: 15px;
            padding: 35px;
            margin-bottom: 35px;
            background: linear-gradient(135deg, #f8fbff 0%, #f0f8ff 100%);
            position: relative;
        }

        .form-section h3 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 1.3rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* --- Buttons --- */
        .submit-btn,
        .add-gene-btn,
        .add-drug-btn {
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: block;
            margin: 20px auto 0;
            min-width: 200px;
        }

        .add-gene-btn {
            background: linear-gradient(135deg, #27ae60, #219a52);
            margin: 20px auto 0;
            display: block;
            min-width: 180px;
        }
        
        .remove-gene-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-gene-btn:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #2980b9, #1f618d);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
        }

        /* --- Drug Susceptibility Table --- */
        #drug-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        #drug-table th,
        #drug-table td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            text-align: left;
            vertical-align: middle;
        }

        #drug-table thead th {
            background-color: #e9ecef;
            font-weight: 600;
        }
        
        /* Set column widths for better layout */
        #drug-table th:nth-child(1) { width: 35%; } /* Drug */
        #drug-table th:nth-child(2) { width: 20%; } /* Clinical Breakpoint */
        #drug-table th:nth-child(3) { width: 20%; } /* Observed MIC */
        #drug-table th:nth-child(4) { width: 15%; } /* Unit */
        #drug-table th:nth-child(5) { width: 10%; } /* Remove button */
        
        .remove-cell {
            text-align: center;
        }

        .remove-drug-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            font-size: 1.5rem;
            line-height: 1;
            padding: 0;
            font-weight: bold;
        }
        .remove-drug-btn:hover {
            color: #a71d2a;
        }
        
        .add-drug-container {
            text-align: left;
        }
        
        .add-drug-btn {
            background-color: #007bff;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }
        .add-drug-btn:hover {
            background-color: #0056b3;
        }
		
		/* Add this style for the 'Other' drug input field */
			.other-drug-input {
			margin-top: 10px;
			}
        
        /* --- Multi-Select Dropdown --- */
        .multi-select-dropdown {
            position: relative;
            width: 100%;
        }

        .multi-select-button {
            width: 100%; /* Corrected width */
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-sizing: border-box;
            min-height: 57px; /* Match other inputs */
        }
        
        #experiment-selected-text {
            color: #333;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            flex: 1;
        }

        #experiment-selected-text.placeholder {
            color: #6c757d;
        }

        .multi-select-options {
            display: none; /* Controlled by JS */
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #e0e6ed;
            border-top: none;
            border-radius: 0 0 10px 10px;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .multi-select-option {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        .multi-select-option:hover {
            background-color: #f8f9fa;
        }
        .multi-select-option input[type="checkbox"] {
            margin-right: 10px;
            width: auto;
        }

        /* --- Messages & Loading Spinner --- */
        .message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
            text-align: center;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* --- Responsive Styles --- */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .form-section {
                padding: 20px;
            }
        }
		
		
		/* --- (RESTORED) Multi-Select Dropdown --- */
.multi-select-dropdown {
    position: relative;
    width: 100%;
}

.multi-select-button {
    width: 100%;
    padding: 15px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    background: white;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    font-size: 1rem;
    box-sizing: border-box;
    min-height: 57px;
}

#experiment-selected-text {
    color: #333;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    flex: 1;
}

#experiment-selected-text.placeholder {
    color: #6c757d;
}

.multi-select-options {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 2px solid #e0e6ed;
    border-top: none;
    border-radius: 0 0 10px 10px;
    max-height: 250px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.multi-select-option {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border-bottom: 1px solid #f0f0f0;
}
.multi-select-option:hover { background-color: #f8f9fa; }
.multi-select-option input[type="checkbox"] { margin-right: 10px; width: auto; }
    </style>
</head>
<body>
<?php // include("header.php"); ?>
 <!--
<main class="main">
    <div class="container"> --->
        <h2>Submit Mutation Data</h2>
        
        
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Submitting your data...</p>
        </div>
        
        <form id="submissionForm" method="POST">
              <!--
            <div class="form-section">
                <h3>Contributor's Details</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="e.g., Dr. Jane Doe">
                    </div>
                    <div class="form-group">
                        <label for="institute_name">Name of Facility <span class="required">*</span></label>
                        <input type="text" id="institute_name" name="institute_name" required placeholder="e.g., ICMR-NIRRCH">
                    </div>
                    <div class="form-group">
                        <label for="department">Department <span class="required">*</span></label>
                        <input type="text" id="department" name="department" required placeholder="e.g., Biomedical Informatics Center">
                    </div>
                    <div class="form-group">
                        <label for="setup">Facility Type <span class="required">*</span></label>
                        <input type="text" id="setup" name="setup" required placeholder="e.g., Hospital, Research Lab">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email Address <span class="required">*</span></label>
                        <input type="email" id="user_email" name="user_email" required placeholder="your.email@example.com">
                    </div>
                </div>
            </div>
			------->

            <div class="form-section">
                <h3>Strain Information</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="strain">Strain <span class="required">*</span></label>
                        <input type="text" id="strain" name="strain" required placeholder="e.g., DUMC136">
                    </div>
                    <div class="form-group">
                        <label for="species">Species <span class="required">*</span></label>
                        <select id="species" name="species" required onchange="toggleOtherSpecies();">
                             <option value="">Select species</option>
                             <option value="C. albicans">C. albicans</option>
                             <option value="C. auris">C. auris</option>
                             <option value="C. glabrata">C. glabrata</option>
                             <option value="C. krusei">C. krusei</option>
                             <option value="C. parapsilosis">C. parapsilosis</option>
                             <option value="C. tropicalis">C. tropicalis</option>
                             <option value="Other">Other</option>
                        </select>
                    </div>
					<div class="form-group" id="other-species-group" style="display: none;">
                        <label for="species_other">Please Specify Other Species <span class="required">*</span></label>
                        <input type="text" id="species_other" name="species_other" placeholder="Enter specific species">
                    </div>
                    <div class="form-group">
                        <label for="isolate_type">Isolate Type <span class="required">*</span></label>
                        <select id="isolate_type" name="isolate_type" required>
                            <option value="">Select isolate type</option>
                            <option value="Clinical isolate">Clinical isolate</option>
                            <option value="Environmental isolate">Environmental isolate</option>
                            <option value="Laboratory strain">Laboratory strain</option>
                            <option value="Reference strain">Reference strain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="niche">Site of Infection <span class="required">*</span></label>
                        <select id="niche" name="niche" required onchange="toggleOtherNiche()">
                            <option value="">Select niche affected</option>
                            <option value="Blood">Blood</option>
                            <option value="Skin">Skin</option>
                            <option value="Urinary Tract">Urinary Tract</option>
                            <option value="Vagina">Vagina</option>
                            <option value="Oropharynx">Oropharynx</option>
                            <option value="Other">Other (please specify)</option>
                        </select>
                    </div>
                    <div class="form-group" id="other-niche-group" style="display: none;">
                        <label for="niche_other">Please Specify Other Site <span class="required">*</span></label>
                        <input type="text" id="niche_other" name="niche_other" placeholder="Enter specific niche">
                    </div>
                    <div class="form-group">
                        <label for="candidiasis">Type of Candidiasis <span class="required">*</span></label>
                        <select id="candidiasis" name="candidiasis" required onchange="toggleOtherCandidiasis()">
                             <option value="">Select type of candidiasis</option>
                             <option value="Candidemia">Candidemia</option>
                             <option value="Invasive Candidiasis">Invasive Candidiasis</option>
                             <option value="Oropharyngeal Candidiasis">Oropharyngeal Candidiasis</option>
                             <option value="Vulvovaginal Candidiasis">Vulvovaginal Candidiasis</option>
                             <option value="Other">Other (please specify)</option>
                        </select>
                    </div>
                    <div class="form-group" id="other-candidiasis-group" style="display: none;">
                        <label for="candidiasis_other">Please Specify Other Type <span class="required">*</span></label>
                        <input type="text" id="candidiasis_other" name="candidiasis_other" placeholder="Enter specific type">
                    </div>
					
					
					<div class="form-group">
    <label for="experiment_type">Experiment(s) performed <span class="required">*</span></label>
    <div class="multi-select-dropdown" id="experiment-dropdown">
        <div class="multi-select-button" onclick="toggleExperimentDropdown()">
            <span id="experiment-selected-text" class="placeholder">Select experiments</span>
            <span class="dropdown-arrow">▼</span>
        </div>
        <div class="multi-select-options" id="experiment-options">
            <label class="multi-select-option"><input type="checkbox" name="experiment_type[]" value="rtpcr" onchange="updateExperimentSelection()"><span>RT-PCR</span></label>
            <label class="multi-select-option"><input type="checkbox" name="experiment_type[]" value="sterol" onchange="updateExperimentSelection()"><span>Sterol analysis</span></label>
            <label class="multi-select-option"><input type="checkbox" name="experiment_type[]" value="mutagenesis" onchange="updateExperimentSelection()"><span>Site-directed mutagenesis</span></label>
            <label class="multi-select-option"><input type="checkbox" name="experiment_type[]" value="other" onchange="updateExperimentSelection(); toggleOtherExperiment();"><span>Other (please specify)</span></label>
        </div>
    </div>
</div>
<div class="form-group" id="other-experiment-group" style="display: none;">
    <label for="experiment_other">Please specify other experiment(s) <span class="required">*</span></label>
    <input type="text" id="experiment_other" name="experiment_other" placeholder="Enter specific experiment(s)">
</div>

                </div>
            </div>
            


            <div id="gene-sections">
                <div class="form-section gene-section" data-gene-index="0">
                    <h3>
                        <span>Gene 1 Information</span>
                        <button type="button" class="remove-gene-btn" onclick="removeGeneSection(0)" style="display: none;">Remove Gene</button>
                    </h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="gene_0">Gene <span class="required">*</span></label>
                            <input type="text" id="gene_0" name="genes[0][gene]" required placeholder="e.g., ERG11">
                        </div>
                        <div class="form-group">
                            <label for="mutation_0">Mutation(s) <span class="required">*</span></label>
                            <input type="text" id="mutation_0" name="genes[0][mutation]" required placeholder="e.g., K128T, Y132H">
                        </div>
                        <div class="form-group">
                            <label for="type_of_mutations_0">Type of Mutation(s) <span class="required">*</span></label>
                            <select id="type_of_mutations_0" name="genes[0][type_of_mutations]" required>
                                <option value="">Select mutation type</option>
                                <option value="Single substitution">Single substitution</option>
                                <option value="Multiple substitution">Multiple substitution</option>
                                <option value="Insertion">Insertion</option>
                                <option value="Deletion">Deletion</option>
                                <option value="Frameshift">Frameshift</option>
                                <option value="Complex">Complex</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uniprot_id_0">UniProt ID / NCBI Accession <span class="required">*</span></label>
                            <input type="text" id="uniprot_id_0" name="genes[0][uniprot_id]" required placeholder="e.g., P10613">
                        </div>
                        <div class="form-group">
                            <label for="protein_length_0">Protein Length <span class="required">*</span></label>
                            <input type="number" id="protein_length_0" name="genes[0][protein_length]" required placeholder="e.g., 528" min="1">
                        </div>
                        <div class="form-group">
                            <label for="structure_id_0">Structure ID (PDB/AlphaFold) <span class="required">*</span></label>
                            <input type="text" id="structure_id_0" name="genes[0][structure_id]" required placeholder="e.g., 5V5Z">
                        </div>
                        <div class="form-group full-width">
                            <label for="sequence_structure_0">Sequence (FASTA format)</label>
                            <textarea id="sequence_structure_0" name="genes[0][sequence_structure]" placeholder=">protein_name | description..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="add-gene-btn" onclick="addGeneSection()">+ Add Another Gene</button>
            <br>
			
			            <div class="form-section">
                <h3>Antifungal Susceptibility</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="mic_std">Susceptibility Test Standard <span class="required">*</span></label>
                        <select id="mic_std" name="mic_std" required>
                            <option value="">Select a standard</option>
                            <option value="CLSI">CLSI</option>
                            <option value="EUCAST">EUCAST</option>
							 <option value="ECVs/ECOFFs">ECVs/ECOFFs</option>
                            <option value="Study-defined">Study-defined</option>
                        </select>
                    </div>
                </div>
                <table id="drug-table">
                    <thead>
                        <tr>
                            <th>Drug <span class="required">*</span></th>
                            <th>Clinical Breakpoint</th>
                            <th>Observed MIC <span class="required">*</span></th>
                            <th>Unit <span class="required">*</span></th>
                            <th class="remove-cell"></th>
                        </tr>
                    </thead>
                    <tbody id="drug-table-body">
                       <tr class="drug-row" data-drug-idx="0">
    <td>
        <select id="drug_0" name="drugs[0][name]" required onchange="toggleOtherDrug(0)">
            <option value="">Select drug</option>
            <option value="5-Flucytosine">5-Flucytosine</option>
                    <option value="Amphotericin B">Amphotericin B</option>
                    <option value="Anidulafungin">Anidulafungin</option>
                    <option value="Beauvericin">Beauvericin</option>
                    <option value="Caspofungin">Caspofungin</option>
                    <option value="Clotrimazole">Clotrimazole</option>
                    <option value="Echinocandin">Echinocandin</option>
                    <option value="Fluconazole">Fluconazole</option>
                    <option value="Ibrexafungerp">Ibrexafungerp</option>
                    <option value="Isavuconazole">Isavuconazole</option>
                    <option value="Itraconazole">Itraconazole</option>
                    <option value="Ketoconazole">Ketoconazole</option>
                    <option value="Manogepix">Manogepix</option>
                    <option value="Micafungin">Micafungin</option>
                    <option value="Nystatin">Nystatin</option>
                    <option value="Posaconazole">Posaconazole</option>
                    <option value="Prochloraz">Prochloraz</option>
                    <option value="Ravuconazole">Ravuconazole</option>
                    <option value="Rezafungin">Rezafungin</option>
                    <option value="Voriconazole">Voriconazole</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" class="other-drug-input" id="other_drug_0" name="drugs[0][other_name]" placeholder="Please specify drug" style="display:none;">
    </td>
    <td>
        <input type="number" step="0.001" id="cbp_0" name="drugs[0][cbp]" placeholder="e.g., 2">
    </td>
    <td>
        <input type="number" step="0.001" id="mic_0" name="drugs[0][mic]" required placeholder="e.g., 64">
    </td>
    <td>
        <input type="text" id="unit_0" name="drugs[0][unit]" required value="mg/L" placeholder="mg/L">
    </td>
    <td class="remove-cell">
        <button type="button" class="remove-drug-btn" onclick="removeDrugRow(0)" style="display:none;">✖</button>
    </td>
</tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="add-drug-container">
                                    <button type="button" class="add-drug-btn" onclick="addDrugRow()">+ Add Another Drug</button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="form-section">
                 <h3>Study & Publication Details</h3>
                 <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Has this study been published? <span class="required">*</span></label>
                        <label class="inline-radio">
                            <input type="radio" id="published_yes" name="is_published" value="yes" required> Yes
                        </label>
                        <label class="inline-radio">
                            <input type="radio" id="published_no" name="is_published" value="no" required> No
                        </label>
                    </div>
                    <div id="publicationFields" class="published-fields form-grid full-width">
                        <div class="form-group">
                            <label for="year_of_study">Year of Study <span class="required">*</span></label>
                            <input type="number" id="year_of_study" name="year_of_study" placeholder="e.g., 2024" min="1900" max="2025">
                        </div>
                        <div class="form-group">
                            <label for="pmid">PMID / DOI <span class="required">*</span></label>
                            <input type="text" id="pmid" name="pmid" placeholder="e.g., 10223934">
                        </div>
                        <div class="form-group full-width">
                            <label for="study_title">Title of Study <span class="required">*</span></label>
                            <input type="text" id="study_title" name="study_title" placeholder="Full article title">
                        </div>
                    </div>
                     <div class="form-group full-width">
                         <label for="additional_info">Additional Information</label>
                         <textarea id="add_info" name="add_info" placeholder="Any other relevant details about the study or strain..."></textarea>
                     </div>
                 </div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">Submit Data</button>
			<div id="message"></div>
        </form>
		
    <!---  </div> 
</main>
---->

<script>
// ======================================================
// --- GLOBAL COUNTERS ---
// ======================================================
let geneCounter = 1;
let drugCounter = 1;

// ======================================================
// --- GENE SECTION DYNAMICS ---
// ======================================================
function addGeneSection() {
    const geneSections = document.getElementById('gene-sections');
    const newSection = document.createElement('div');
    newSection.className = 'form-section gene-section';
    newSection.setAttribute('data-gene-index', geneCounter);
    
    newSection.innerHTML = `
        <h3>
            <span>Gene ${geneCounter + 1} Information</span>
            <button type="button" class="remove-gene-btn" onclick="removeGeneSection(${geneCounter})">Remove Gene</button>
        </h3>
        <div class="form-grid">
            <div class="form-group">
                <label for="gene_${geneCounter}">Gene <span class="required">*</span></label>
                <input type="text" id="gene_${geneCounter}" name="genes[${geneCounter}][gene]" required placeholder="e.g., ERG11">
            </div>
            <div class="form-group">
                <label for="mutation_${geneCounter}">Mutation(s) <span class="required">*</span></label>
                <input type="text" id="mutation_${geneCounter}" name="genes[${geneCounter}][mutation]" required placeholder="e.g., K128T, Y132H">
            </div>
            <div class="form-group">
                <label for="type_of_mutations_${geneCounter}">Type of Mutation(s) <span class="required">*</span></label>
                <select id="type_of_mutations_${geneCounter}" name="genes[${geneCounter}][type_of_mutations]" required>
                    <option value="">Select mutation type</option>
                    <option value="Single substitution">Single substitution</option>
                    <option value="Multiple substitution">Multiple substitution</option>
                    <option value="Insertion">Insertion</option>
                    <option value="Deletion">Deletion</option>
                    <option value="Frameshift">Frameshift</option>
                    <option value="Complex">Complex</option>
                </select>
            </div>
            <div class="form-group">
                <label for="uniprot_id_${geneCounter}">UniProt ID / NCBI Accession <span class="required">*</span></label>
                <input type="text" id="uniprot_id_${geneCounter}" name="genes[${geneCounter}][uniprot_id]" required placeholder="e.g., P10613">
            </div>
            <div class="form-group">
                <label for="protein_length_${geneCounter}">Protein Length <span class="required">*</span></label>
                <input type="number" id="protein_length_${geneCounter}" name="genes[${geneCounter}][protein_length]" required placeholder="e.g., 528" min="1">
            </div>
            <div class="form-group">
                <label for="structure_id_${geneCounter}">Structure ID (PDB/AlphaFold) <span class="required">*</span></label>
                <input type="text" id="structure_id_${geneCounter}" name="genes[${geneCounter}][structure_id]" required placeholder="e.g., 5V5Z">
            </div>
            <div class="form-group full-width">
                <label for="sequence_structure_${geneCounter}">Sequence (FASTA format)</label>
                <textarea id="sequence_structure_${geneCounter}" name="genes[${geneCounter}][sequence_structure]" placeholder=">protein_name | description..."></textarea>
            </div>
        </div>
    `;
    
    geneSections.appendChild(newSection);
    geneCounter++;
    updateRemoveButtons();
    newSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function removeGeneSection(index) {
    const section = document.querySelector(`.gene-section[data-gene-index="${index}"]`);
    if (section) {
        section.remove();
        updateRemoveButtons();
    }
}

function updateRemoveButtons() {
    const sections = document.querySelectorAll('.gene-section');
    sections.forEach((section, index) => {
        const removeBtn = section.querySelector('.remove-gene-btn');
        const titleSpan = section.querySelector('h3 > span');
        
        if (removeBtn) {
            removeBtn.style.display = sections.length > 1 ? 'inline-block' : 'none';
        }
        if(titleSpan) {
            titleSpan.textContent = `Gene ${index + 1} Information`;
        }
    });
}

// ======================================================
// --- DRUG TABLE DYNAMICS ---
// ======================================================
function addDrugRow() {
    const tableBody = document.getElementById('drug-table-body');
    const idx = drugCounter;
    
    const newRow = document.createElement('tr');
    newRow.className = 'drug-row';
    newRow.setAttribute('data-drug-idx', idx);

    // Updated the first <td> to include the 'onchange' event and the hidden input
    newRow.innerHTML = `
        <td>
            <select id="drug_${idx}" name="drugs[${idx}][name]" required onchange="toggleOtherDrug(${idx})">
                <option value="">Select drug</option>
                <option value="5-Flucytosine">5-Flucytosine</option>
                    <option value="Amphotericin B">Amphotericin B</option>
                    <option value="Anidulafungin">Anidulafungin</option>
                    <option value="Beauvericin">Beauvericin</option>
                    <option value="Caspofungin">Caspofungin</option>
                    <option value="Clotrimazole">Clotrimazole</option>
                    <option value="Echinocandin">Echinocandin</option>
                    <option value="Fluconazole">Fluconazole</option>
                    <option value="Ibrexafungerp">Ibrexafungerp</option>
                    <option value="Isavuconazole">Isavuconazole</option>
                    <option value="Itraconazole">Itraconazole</option>
                    <option value="Ketoconazole">Ketoconazole</option>
                    <option value="Manogepix">Manogepix</option>
                    <option value="Micafungin">Micafungin</option>
                    <option value="Nystatin">Nystatin</option>
                    <option value="Posaconazole">Posaconazole</option>
                    <option value="Prochloraz">Prochloraz</option>
                    <option value="Ravuconazole">Ravuconazole</option>
                    <option value="Rezafungin">Rezafungin</option>
                    <option value="Voriconazole">Voriconazole</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" class="other-drug-input" id="other_drug_${idx}" name="drugs[${idx}][other_name]" placeholder="Please specify drug" style="display:none;">
        </td>
        <td>
            <input type="number" step="0.001" id="cbp_${idx}" name="drugs[${idx}][cbp]" placeholder="e.g., 2">
        </td>
        <td>
            <input type="number" step="0.001" id="mic_${idx}" name="drugs[${idx}][mic]" required placeholder="e.g., 64">
        </td>
        <td>
            <input type="text" id="unit_${idx}" name="drugs[${idx}][unit]" required value="mg/L" placeholder="mg/L">
        </td>
        <td class="remove-cell">
            <button type="button" class="remove-drug-btn" onclick="removeDrugRow(${idx})">✖</button>
        </td>
    `;
    
    tableBody.appendChild(newRow);
    drugCounter++;
}

function removeDrugRow(index) {
    const row = document.querySelector(`.drug-row[data-drug-idx="${index}"]`);
    if (row) {
        row.remove();
    }
}

// Add this new function to handle the logic for the "Other" drug input
function toggleOtherDrug(index) {
    const drugSelect = document.getElementById(`drug_${index}`);
    const otherInput = document.getElementById(`other_drug_${index}`);

    if (drugSelect.value === 'Other') {
        otherInput.style.display = 'block';
        otherInput.required = true;
        otherInput.focus();
    } else {
        otherInput.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
    }
}

// ======================================================
// --- DYNAMIC FIELD TOGGLING ---
// ======================================================
function togglePublicationFields() {
    const isPublished = document.getElementById('published_yes').checked;
    const pubDiv = document.getElementById('publicationFields');

    pubDiv.style.display = isPublished ? 'grid' : 'none'; // Use grid to match layout
    
    ['year_of_study', 'pmid', 'study_title'].forEach(id => {
        document.getElementById(id).required = isPublished;
    });
}

function toggleOtherNiche() {
    const nicheSelect = document.getElementById('niche');
    const otherGroup = document.getElementById('other-niche-group');
    const otherInput = document.getElementById('niche_other');
    
    if (nicheSelect.value === 'Other') {
        otherGroup.style.display = 'block';
        otherInput.required = true;
    } else {
        otherGroup.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
    }
}

function toggleOtherSpecies() {
    const speciesSelect = document.getElementById('species');
    const otherGroup = document.getElementById('other-species-group');
    const otherInput = document.getElementById('species_other');
    
    if (speciesSelect.value === 'Other') {
        otherGroup.style.display = 'block';
        otherInput.required = true;
    } else {
        otherGroup.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
    }
}

function toggleOtherCandidiasis() {
    const candidiasisSelect = document.getElementById('candidiasis');
    const otherGroup = document.getElementById('other-candidiasis-group');
    const otherInput = document.getElementById('candidiasis_other');
    
    if (candidiasisSelect.value === 'Other') {
        otherGroup.style.display = 'block';
        otherInput.required = true;
    } else {
        otherGroup.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
    }
}

// --- (RESTORED) MULTI-SELECT DROPDOWN LOGIC ---
function toggleExperimentDropdown() {
    const dropdown = document.getElementById('experiment-dropdown');
    const options = document.getElementById('experiment-options');
    const isActive = options.style.display === 'block';
    options.style.display = isActive ? 'none' : 'block';
    dropdown.querySelector('.multi-select-button').classList.toggle('active', !isActive);
}

function updateExperimentSelection() {
    const checkboxes = document.querySelectorAll('#experiment-options input[type="checkbox"]');
    const selectedText = document.getElementById('experiment-selected-text');
    const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.nextElementSibling.textContent);

    if (selected.length === 0) {
        selectedText.textContent = 'Select experiments';
        selectedText.classList.add('placeholder');
    } else if (selected.length <= 2) {
        selectedText.textContent = selected.join(', ');
        selectedText.classList.remove('placeholder');
    } else {
        selectedText.textContent = `${selected.length} experiments selected`;
        selectedText.classList.remove('placeholder');
    }
}

function toggleOtherExperiment() {
    const otherCheckbox = document.querySelector('#experiment-options input[value="other"]');
    const otherGroup = document.getElementById('other-experiment-group');
    const otherInput = document.getElementById('experiment_other');
    
    if (otherCheckbox.checked) {
        otherGroup.style.display = 'block';
        otherInput.required = true;
    } else {
        otherGroup.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
    }
}

// Logic to close the dropdown when clicking outside of it
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('experiment-dropdown');
    if (dropdown && !dropdown.contains(event.target)) {
        document.getElementById('experiment-options').style.display = 'none';
        dropdown.querySelector('.multi-select-button').classList.remove('active');
    }
});

// ======================================================
// --- FORM SUBMISSION (AJAX) ---
// ======================================================
document.getElementById('submissionForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const loading = document.getElementById('loading');
    const messageDiv = document.getElementById('message');
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
    loading.style.display = 'block';
    messageDiv.innerHTML = '';
    
    try {
        const formData = new FormData(this);
        const response = await fetch('submit_data.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        if (result.success) {
            messageDiv.innerHTML = `<div class="message success">${result.message}</div>`;
            this.reset(); // Clear form
            
            // Reset dynamic sections
            const geneSections = document.getElementById('gene-sections');
            const allSections = geneSections.querySelectorAll('.gene-section');
            for (let i = 1; i < allSections.length; i++) {
                allSections[i].remove();
            }
            geneCounter = 1;
            updateRemoveButtons();
            
            const drugRows = document.querySelectorAll('.drug-row');
             for (let i = 1; i < drugRows.length; i++) {
                drugRows[i].remove();
            }
            drugCounter = 1;

        } else {
            messageDiv.innerHTML = `<div class="message error">${result.message}</div>`;
        }
    } catch (error) {
        messageDiv.innerHTML = `<div class="message error">An unexpected error occurred. Please check the console and try again.</div>`;
        console.error('Submission Error:', error);
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Data';
        loading.style.display = 'none';
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// ======================================================
// --- INITIALIZATION ON PAGE LOAD ---
// ======================================================
document.addEventListener('DOMContentLoaded', function() {
    // Attach listeners for publication radio buttons
    document.getElementById('published_yes').addEventListener('change', togglePublicationFields);
    document.getElementById('published_no').addEventListener('change', togglePublicationFields);

    // Run toggles once on load to set initial state
    togglePublicationFields();
    toggleOtherNiche();
    toggleOtherCandidiasis();
	toggleOtherSpecies();
    updateRemoveButtons();
	
	// Add these two lines
    updateExperimentSelection();
    toggleOtherExperiment();
});

</script>

<?php // include("foot.php"); ?>
</body>
</html>