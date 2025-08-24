<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


?>

<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Help</title>
<meta name="description" content="Help page of CanDRes guiding user to query the database effectively.">

       <style>
	   body {
            
            margin: 20px;
            line-height: 1.6;
        }
	   img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
			border: 1px solid;
        }
        .figure {
            text-align: center;
			
        }
        .figure-caption {
            font-style: italic;
            font-size: 14px;
			padding-bottom: 7px;
        }
	   </style>
</head>
<body>
<?php
include("header.php");
# include("loader.php");

?>

<main class="main">
  <h3>Help Page</h3>
    <p>The help page offers assistance to users of CanDRes in efficiently navigating and utilizing its repository. It provides detailed instructions for each module, ensuring users can make the most of the database's features.</p>
    <!--- <p>CanDRes database is accessible via URL: <a href="https://mimat.bicnirrh.res.in/candres/index.php">https://mimat.bicnirrh.res.in/candres/index.php</a></p>----->
     <div class="figure">
        <img src="helpImages/fig1.jpg" alt="Homepage of CanDRes database" width="800" height="500">
        <p class="figure-caption">Figure 1: Homepage of CanDRes database.</p>
    </div>
    <h3>Basic Search</h3>
    <ul>
        <li>The search bar on the CanDRes homepage allows users to perform a basic search.</li>
        <li>Users can search using a species name (e.g., C. albicans), gene name (e.g., ERG11), drug name (e.g., Fluconazole), or mutation (e.g., Y132F).</li>
        <li>Multiple keywords can be entered to refine results (e.g., ERG11 Fluconazole).</li>
    </ul>
    <div class="figure">
        <img src="helpImages/fig1.1.jpg" alt="Basic Search Option" width="800" height="500">
        <p class="figure-caption">Figure 1.1: Basic Search Option</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig1.2.jpg" alt="Result page for ERG11 query" width="800" height="500">
        <p class="figure-caption">Figure 1.2: Result page for ERG11 query</p>
    </div>
	
    <h3>Advanced Search</h3>
    <p>Users can select multiple fields, including species, drugs, genes, mutations, and year. Detailed lists for these fields are available in the dropdown menu. Users can customize search terms by combining different fields.</p>
    <div class="figure">
        <img src="helpImages/fig2.1.jpg" alt="Advanced Search Option" width="800" height="500">
        <p class="figure-caption">Figure 2.1: Advanced Search Option</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig2.2.jpg" alt="Dropdown menu for Advanced Search" width="800" height="500">
        <p class="figure-caption">Figure 2.2: Dropdown menu for Advanced Search</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig2.3.jpg" alt="Result page for Advanced Search" width="800" height="500">
        <p class="figure-caption">Figure 2.3: Result page for Advanced Search</p>
    </div>
	
    <h3>Browse Option</h3>
    <p>The Browse Page allows users to explore and filter mutations associated with antifungal drug resistance in Candida species using a customized search.</p>
	<ul>
        <li>Gene: Search for specific genes linked to antifungal drug resistance.</li>
        <li>Species: Filter results by different Candida species.</li>
        <li>Drug: Identify resistance-associated mutations for a particular antifungal drug.</li>
        <li>Mutation Type: View Single substitution, Double substitution, Multiple substitution, Insertion, Deletion, Frameshift, Stop, Complex substitutions.</li>
        <li>3D Structure: Choose between experimentally elucidated, AlphaFold-predicted, or modeled protein structures.</li>
        <li>Isolate Type: Select clinical isolates, laboratory strains, or environmental sources.</li>
        <li>MIC Values: Access Minimum Inhibitory Concentration (MIC) data for resistance assessment.</li>
    </ul>
    <div class="figure">
        <img src="helpImages/fig3.1.jpg" alt="Browse search option from Homepage" width="800" height="500">
        <p class="figure-caption">Figure 3.1: Browse search option from Homepage</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig3.2.jpg" alt="Filter options in Browse Page" width="800" height="500">
        <p class="figure-caption">Figure 3.2: Filter options in Browse Page</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig3.3.jpg" alt="More filter options in Browse Page" width="800" height="500">
        <p class="figure-caption">Figure 3.3: More filter options in Browse Page</p>
    </div>
	
    <h3>Mutation Validation</h3>
    <p>Users can identify experimentally validated mutations in CanDRes using basic, advanced, or browse search. Validated mutations are highlighted as clickable green entries leading to detailed validation information.</p>
     <div class="figure">
        <img src="helpImages/fig4.1.jpg" alt="Validated mutations highlighted in green" width="800" height="500">
        <p class="figure-caption">Figure 4.1: Validated mutations highlighted in green</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig4.2.jpg" alt="Validation Page" width="800" height="500">
        <p class="figure-caption">Figure 4.2: Validation Page</p>
    </div>
	
    <h3>Sequences and Structures</h3>
    <p>Sequence and structure details can be obtained from links available for each strain. Wild and mutant types sequences and structures can be visualized and downloaded.</p>
     <div class="figure">
        <img src="helpImages/fig5.1.jpg" alt="UniProt links and 3D structure" width="800" height="500">
        <p class="figure-caption">Figure 5.1: UniProt links and 3D structure</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig5.2.jpg" alt="Sequence and Structure Information" width="800" height="500">
        <p class="figure-caption">Figure 5.2: Sequence and Structure Information</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig5.3.jpg" alt="Sequence Information Page" width="800" height="500">
        <p class="figure-caption">Figure 5.3: Sequence Information Page</p>
    </div>
	
    <h3>Download Options</h3>
    <p>All information can be downloaded using the download button at the upper right of the table.</p>
   <div class="figure">
        <img src="helpImages/fig6.jpg" alt="Download Option in Browse Page" width="800" height="500">
        <p class="figure-caption">Figure 6: Download Option in Browse Page</p>
    </div>
    
    <h3>Mutation Plots</h3>
    <p>The Mutation Plot feature provides a visual representation of mutations mapped onto a selected gene. Users can filter mutations by gene, species, and drug. The plot is presented as a lollipop plot where solid circles indicate non-validated mutations and diamonds represent validated mutations.</p>
    <div class="figure">
        <img src="helpImages/fig7.1.jpg" alt="Mutation Plot Feature" width="800" height="500">
        <p class="figure-caption">Figure 7.1: Mutation Plot Feature</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig7.2.jpg" alt="Webpage of Mutation Plot" width="800" height="500">
        <p class="figure-caption">Figure 7.2: Webpage of Mutation Plot</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig7.3.jpg" alt="Select Gene for Mutation Plot" width="800" height="500">
        <p class="figure-caption">Figure 7.3: Select Gene for Mutation Plot</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig7.4.jpg" alt="Select Species for Mutation Plot" width="800" height="500">
        <p class="figure-caption">Figure 7.4: Select Species for Mutation Plot</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig7.5.jpg" alt="Select Drug for Mutation Plot" width="800" height="500">
        <p class="figure-caption">Figure 7.5: Select Drug for Mutation Plot</p>
    </div>
    <div class="figure">
        <img src="helpImages/fig7.6.jpg" alt="Save Mutation Plot" width="800" height="500">
        <p class="figure-caption">Figure 7.6: Save Mutation Plot</p>
    </div>
	
<h3>Mutation Types</h3>
    <ul>
        <li>Single substitution: A single amino acid is replaced with a different amino acid.</li>
        <li>Double substitution: Double substitutions occur at different locations.</li>
        <li>Multiple substitutions: Several single substitutions occurring at different locations.</li>
        <li>Deletion: One or more amino acids are deleted from the original sequence.</li>
        <li>Insertion: One or more amino acids are inserted into the original sequence.</li>
        <li>Indel: One or more amino acids are deleted, and one or more are inserted into the same sequence.</li>
        <li>Stop: It is labeled at the protein termination site.</li>
        <li>Complex: Single or multiple substitutions with additional stops, insertions, deletions, and indels.</li>
    </ul>
	
<br>
<h3>External database links</h3>
  
	<ul>
	<li><b>AFRbase: </b> Antifungal Resistance Database &nbsp;<a href="http://proteininformatics.org/mkumar/afrbase/"> <i class="fa-solid fa-link" ></i></a>&nbsp;&nbsp;<a href="https://doi.org/10.1093/bioinformatics/btad677"><img  style="display: inline; margin: 0px;" width="22" height="18" src="images/RA_icon.png"/></a></li>
	<li><b>MARDy: </b> Mycology Antifungal Resistance Database &nbsp;<a href="http://www.mardy.net/"> <i class="fa-solid fa-link" ></i></a>&nbsp;&nbsp;<a href="https://doi.org/10.1093/bioinformatics/bty321"><img style="display: inline; margin: 0px;" width="22" height="18" src="images/RA_icon.png"/></a></li>
	<li><b>CGD: </b> Candida Genome Database &nbsp;<a href="http://www.candidagenome.org/"> <i class="fa-solid fa-link" ></i></a>&nbsp;&nbsp;<a href="https://doi.org/10.1093/nar/gkw924"><img style="display: inline; margin: 0px;" width="22" height="18" src="images/RA_icon.png"/></a></li>
	<li><b>FungiDB:</b>  Fungal genomes &nbsp;<a href="http://FungiDB.org"> <i class="fa-solid fa-link" ></i></a>&nbsp;&nbsp;<a href="https://doi.org/10.1093/nar/gkr918"><img style="display: inline; margin: 0px;" width="22" height="18" src="images/RA_icon.png"/></a></li>
	</ul>
</main>
	<?php
	
	include("foot.php");
	
	?>
</body>
</html>
