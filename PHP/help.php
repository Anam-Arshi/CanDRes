<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Help</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="css/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<script src="css/jquery.dataTables.min.js"></script>
<script src="css/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src='https://cdn.plot.ly/plotly-2.31.1.min.js'></script>
<style>
	
	table {
		max-width: 95%;
        width: 94%;
        margin: 0 auto;
		text-align: left;
		font-family: verdana;
    }
	h4{
		color: #1a518b;
		font-weight: bold;
		font-family: verdana;
	}
	
	
	
	
	h3{
		font-size: 21px;
	}
	.imgDiv{
		margin: 18px;
	}
	ul{
		line-height: 22px;
	}
	p{
		text-align: justify;
	}
	</style>
</head>

<body>
<?php
include("header.php");
include("connect.php");
//https://wou.edu/chemistry/courses/online-chemistry-textbooks/
?>
<main class="main">

<p>This help page offers assistance to users of CanDRes in efficiently navigating and utilizing its repository. It provides detailed instructions for each module, ensuring users can make the most of the database's features.</p>

<h4>Basic search</h4>

<ul>
<li>Basic search can be performed via the search bar on the homepage of CanDRes.</li>
<li>Species name (Ex., C. albicans), gene name (Ex., ERG11), drug name (Ex., Fluconazole), and mutation (Ex., Y132F) be searched directly.</li>
<li>Multi-key (Ex., ERG11 Fluconazole) search terms can also be provided for searching a combination of search terms.</li>
</ul>

<img width='530' height='100' src="images/search.png"/><br>
<img width='750' height='330' src="images/search-result.png"/>

<h4>Advanced search</h4>
<p>In advanced search, several fields can be selected including species, drugs, genes, mutations and year. Detailed lists for these fields can be selected from the drop-down list available in the database.</p>
<img width='600' height='230' src="images/adv-search.png"/><br>
<img width='750' height='400' src="images/adv-search-result.png"/>
<p>Users can also customise search terms with different fields in the search box.</p>



<h4>Browse</h4>
<p>The browse results give the following basic information for each strain: strain, gene, mutation, UniProt ID, protein length, structure ID, species, isolate type, drug resistance, MICs, year of study, sequence, structure and PMID. A column can be reduced or expanded by selecting/ deselecting this field option from the top selection panel.</p>
<img width='730' height='400' src="images/browse-cols.png"/>

<p>Sequence and structure details can be obtained from the link available in a separate column for each strain.</p>
<img width='730' height='330' src="images/uniprot-pdb-link.png"/>

<p>Users can directly browse all mutations recorded in CanDRes. Mutations of a given type (e.g. single substitution, double substitution, multiple substitution, insertion, deletion, Indel, frameshift, stop, complex) can be filtered by clicking on the corresponding tab.</p>
<img width='730' height='400' src="images/mut-type.png"/>
<p>Users can also filter mutation records by providing species, gene and drug names in the filter
option in the left tabs.</p>
<img width='700' height='400' src="images/filter.png"/>

<p>Mutation records can be filtered based on their 3D structure types that include experimentally elucidated, AlphaFold predicted and modelled.</p>
<img width='750' height='300' src="images/3d-filter.png"/>

<p>Mutation records can be also filtered based on drug MICs values used to test resistance.</p>
<img width='750' height='400' src="images/mic-filter-results.png"/>

<p>All these informations can be downloaded by clicking the download symbol button on the upper right of the table.</p>
<img width='500' height='100' src="images/download.png"/>

<h4>Sequences and structures</h4>
<p>Wild and mutant types sequences and structures for mutation records can be visualised and download from browse page of database.</p>
<img width='700' height='400' src="images/str-link.png"/>
<br>
<img width='750' height='500' src="images/seq_detail.png"/><br>
<img width='750' height='500' src="images/str-detail.png"/>

<h4>Grammar</h4>
<p>There are six types of mutation defined in CanDRes:</p>

<ul>
<li><b>Single substitution:</b> A single amino acid is replaced with a different amino acid.</li>
<li><b>Double substitution:</b> Double substitutions occur at different locations.</li>
<li><b>Multiple substitutions:</b> Several single substitutions occurring at different locations.</li>
<li><b>Deletion:</b> One or more amino acids are deleted from the original sequence.</li>
<li><b>Insertion:</b> One or more amino acids are inserted into the original sequence.</li>
<li><b>Indel:</b> One or more amino acids are deleted as well and one or more amino acids are inserted into the same sequence.</li>
<li><b>Stop:</b> It is labelled at protein termination site.</li>
<li><b>Complex:</b> Single or multiple substitutions with additional stops, insertions, deletions and indels.</li>
</ul>

<br>


</main>
	
<?php
include("foot.php");


?>	
</body>
</html>