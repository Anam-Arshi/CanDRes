<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Data Submission Form</title>
    <style>
	/* Submissions Section Styles */
.submissions-container {
    margin-top: 50px;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border: 2px solid #dee2e6;
}

.submissions-container h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 1.4rem;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

.submissions-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.view-submissions-btn {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.view-submissions-btn:hover {
    background: linear-gradient(135deg, #138496, #117a8b);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.3);
}

.btn-icon {
    font-size: 1.1rem;
}

.submissions-filter select {
    padding: 8px 15px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    font-size: 0.9rem;
    background: white;
}

.submissions-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.submissions-table th,
.submissions-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.submissions-table th {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
}

.submissions-table tr:hover {
    background-color: #f8f9fa;
}

.submissions-table td {
    font-size: 0.85rem;
    vertical-align: top;
}

.gene-info {
    background: #e3f2fd;
    padding: 8px;
    margin: 2px 0;
    border-radius: 4px;
    border-left: 3px solid #2196f3;
    font-size: 0.8rem;
}

.gene-name {
    font-weight: bold;
    color: #1976d2;
}

.mutation-info {
    color: #666;
    margin-top: 2px;
}

.submission-date {
    font-size: 0.8rem;
    color: #666;
}

.no-submissions {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    padding: 40px;
    background: white;
    border-radius: 10px;
    border: 2px dashed #dee2e6;
}

.error-message {
    background: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #f5c6cb;
    text-align: center;
}

@media (max-width: 768px) {
    .submissions-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .submissions-table {
        font-size: 0.8rem;
    }
    
    .submissions-table th,
    .submissions-table td {
        padding: 8px 10px;
    }
}
	
	 </style>
</head>
<body>
<?php include("header.php"); ?>

<main class="main">

 <!-- View Recent Submissions Section -->
        <div class="submissions-container">
            <h3>Recent Submissions</h3>
            <div class="submissions-controls">
                <button type="button" class="view-submissions-btn" onclick="loadSubmissions()">
                    <span class="btn-icon">🔄</span> Refresh Submissions
                </button>
                <div class="submissions-filter">
                    <select id="filter-limit">
                        <option value="10">Last 10 submissions</option>
                        <option value="25">Last 25 submissions</option>
                        <option value="50">Last 50 submissions</option>
                    </select>
                </div>
            </div>
            
            <div id="submissions-loading" class="loading" style="display: none;">
                <div class="spinner"></div>
                <p>Loading submissions...</p>
            </div>
            
            <div id="submissions-content">
                <p class="no-submissions">Click "Refresh Submissions" to view recent submissions.</p>
            </div>
        </div>

</main>
<script>
// Add this to your existing JavaScript

function loadSubmissions() {
    const loadingDiv = document.getElementById('submissions-loading');
    const contentDiv = document.getElementById('submissions-content');
    const limit = document.getElementById('filter-limit').value;
    
    // Show loading state
    loadingDiv.style.display = 'block';
    contentDiv.innerHTML = '';
    
    fetch(`get_submissions.php?limit=${limit}`)
        .then(response => response.json())
        .then(data => {
            loadingDiv.style.display = 'none';
            
            if (data.success) {
                if (data.submissions && data.submissions.length > 0) {
                    displaySubmissions(data.submissions);
                } else {
                    contentDiv.innerHTML = '<p class="no-submissions">No submissions found.</p>';
                }
            } else {
                contentDiv.innerHTML = `<div class="error-message">Error loading submissions: ${data.message}</div>`;
            }
        })
        .catch(error => {
            loadingDiv.style.display = 'none';
            contentDiv.innerHTML = '<div class="error-message">Failed to load submissions. Please try again.</div>';
            console.error('Error:', error);
        });
}

function displaySubmissions(submissions) {
    const contentDiv = document.getElementById('submissions-content');
    
    let tableHTML = `
        <table class="submissions-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Strain</th>
                    <th>Species</th>
                    <th>Genes & Mutations</th>
                    <th>Drug Resistance</th>
                    <th>Submitted</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    submissions.forEach(submission => {
        let genesHTML = '';
        if (submission.genes && submission.genes.length > 0) {
            genesHTML = submission.genes.map(gene => `
                <div class="gene-info">
                    <div class="gene-name">${gene.gene}</div>
                    <div class="mutation-info">${gene.mutation} (${gene.type_of_mutations})</div>
                </div>
            `).join('');
        }
        
        tableHTML += `
            <tr>
                <td>${submission.strain_id}</td>
                <td>${submission.user_email}</td>
                <td>${submission.strain}</td>
                <td>${submission.species}</td>
                <td>${genesHTML}</td>
                <td>${submission.drug_resistance}</td>
                <td class="submission-date">${formatDate(submission.submission_date)}</td>
            </tr>
        `;
    });
    
    tableHTML += `
            </tbody>
        </table>
    `;
    
    contentDiv.innerHTML = tableHTML;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
}

// Auto-load submissions when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Your existing DOMContentLoaded code...
    
    // Load submissions automatically
    loadSubmissions();
    
    // Refresh when filter changes
    document.getElementById('filter-limit').addEventListener('change', loadSubmissions);
});



</script>

<?php include("foot.php"); ?>
</body>
</html>