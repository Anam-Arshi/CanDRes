<!doctype html>
<html>
<head>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Explore the mutation landscape of candida and its role in antifungal drug resistance. Explore the database now!">
<title>CanDRes: Explore the mutation landscape of drug resistance associated genes of candida species</title>
<style>
	
	
	.card {
  //box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	box-shadow: 1px 4px 5px 2px gray;
  transition: 0.3s;
  width: 278px;
		//float: left;
		background-color: #FFFFFF;
		margin: 10px;
		font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
}

.card:hover {
  //box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	box-shadow: 0 8px 16px 0 rgba(71,47,111,1.00);
	color: black;
	background: white;
	font-weight: bold;
	
}

.container {
  padding: 16px 16px;
}
	

	p{
		line-height: 1.5em;
	}
	
	.sec{
		
		display: flex;
		justify-content: center;
	}
	
	a h4{
		font-family:  "Franklin Gothic Bold", "Arial Black", "sans-serif";
	}
	.sec a{
		color: black;
	}
	
	.bod{
		padding: 5px 12px;
		background: white;
		border-radius: 4px; 
		box-shadow: 1px 1px 4px #0d1f3d;
	}
	.fast{
		background-image: url("images/stats3.png");
        background-repeat: no-repeat;
		background-position: 7px center;
		color: black;
		margin: 20px auto;
		box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
		width: fit-content;
	}
	.key{
		color: #04468f;
		font-weight: bold;
		font-family: system-ui;
	}
	.label{
		color: #c75604;
	}
	#highlights{
		margin-left: 7px;
	}
	#highlights li{
		background: transparent;
		padding: 10px;
		margin-left: 5px;
	}
	.fList{
		/* border-left: 2.3px solid black; */
	}
	
	 /* .key::after {
    content: attr(data-fake);
    display: inline-block;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s, transform 0.5s;
  }

  .key:hover::after {
    content: attr(data-actual);
    opacity: 1;
    transform: translateY(0);
  } */
  
   /* Define colors for each amino acid */
		
        .aa-A { color: #C8C8C8; } /* Light Gray */
        .aa-I, .aa-L, .aa-V { color: #7C7C7C; } /* Dark Gray */
        .aa-M { color: #E6E600; } /* Bright Yellow */
        .aa-F { color: #4169E1; } /* Royal Blue */
        .aa-P { color: #FF6347; } /* Tomato Red */
        .aa-W { color: #00008B; } /* Dark Blue */
        .aa-N, .aa-Q { color: #8FBC8F; } /* Light Green */
        .aa-S { color: #87CEFA; } /* Light Sky Blue */
        .aa-T { color: #4682B4; } /* Steel Blue */
        .aa-Y { color: #DAA520; } /* Goldenrod */
        .aa-D { color: #DC143C; } /* Crimson */
        .aa-E { color: #B22222; } /* Firebrick */
        .aa-K { color: #0000FF; } /* Blue */
        .aa-R { color: #1E90FF; } /* Dodger Blue */
        .aa-H { color: #6495ED; } /* Cornflower Blue */
        .aa-G { color: #D3D3D3; } /* Light Gray */
        .aa-C { color: #FFD700; } /* Gold */
		
		
	</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<?php
//<a href="https://www.flaticon.com/free-icons/protein" title="protein icons">Protein icons created by Freepik - Flaticon</a>
include("header.php");
include("loader.php");
?>

<div class="bod">
<div class="content">
   <!--- <h3>CanDRes</h3> ---->
	 <p align="justify"><b>CanDRes </b>(<em>Candida</em> Drug Resistance) is a curated database of genes and
mutations that are associated with antifungal drug resistance (ADR). This data has been
retrieved by manually curating published literature. CanDRes contains information on
<em>Candida</em> isolates/strains, genes, mutations associated with ADR, antifungal drugs with
MICs. The data is adequately crosslinked to relevant databases like UniProt and PubMed.
Users can visualize the mutation details and positions on sequences. The 3D structures of
the mutants are modeled and available to users in a downloadable format for further
analysis.</p>

    
	<div class="fast" align="center">
	
	<div>
							
<ul id="highlights">
  <a href="homeStats.php" class="statsRef" onclick="showLoading();">
  <li class="fList">
    <div class="key" data-fake="123" data-actual="100537">56</div>
    <div class="label" data-fake="123" data-actual="456">Genes</div>
  </li>
  </a>
  
  <a href="homeStats.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">13</div>
    <div class="label" data-fake="123" data-actual="456">Species</div>
  </li>
  </a>
  
  <a href="browse.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">3204</div> 
    <div class="label" data-fake="123" data-actual="456">Strains</div>
  </li>
  </a>
  
  
  
  <a href="homeStats.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">19</div>
    <div class="label" data-fake="123" data-actual="456">Drugs</div>
  </li>
  </a>
  
  <a href="homeStats.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">1053</div>
    <div class="label" data-fake="123" data-actual="456">Unique mutations</div>
  </li>
  </a>
  
  <a href="browse.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">3465</div>
    <div class="label" data-fake="123" data-actual="456">Mutant sequences</div>
  </li>
  </a>
  
  <a href="browse.php" class="statsRef">
  <li>
    <div class="key" data-fake="123" data-actual="456">3300</div>
    <div class="label" data-fake="123" data-actual="456">Mutant structures</div>
  </li>
  </a>
</ul>
</div>
</div>


	
<!----
2437
<section class="sec" align="center">
<a href="search.php">
<div class="card">
	
  <div class="container" align="center">
	<i class="fa fa-search" style="padding: 2px; color: #04203D; font-weight: bold; font-size: 25px;"></i> 
    <h4><b>Search</b></h4> 
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> 
  </div>
	</div>
	</a>
	
	<a href="browse.php"><div class="card">
  <div class="container" align="center">
	<i class="fa-solid fa-gear" style="padding: 2px; color: #04203D; font-weight: bold; font-size: 25px;"></i> 
    <h4><b>Browse</b></h4> 
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> 
  </div>
</div>
	</a>
	
	<a href="seq.php">
	<div class="card">
  <div class="container" align="center">
	<i class="fa fa-dna" style="padding: 2px; color: #04203D; font-weight: bold; font-size: 25px;"></i> 
    <h4><b>Sequence</b></h4> 
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> 
  </div>
</div>
	</a>
	
	<a href="jmol/jsmol/jsmol/index.php">
	<div class="card">
  <div class="container" align="center">
	<image src="ptn_logo.png" width="27px" height="27px"> 
    <h4><b>Structure</b></h4> 
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> 
  </div>
</div>
		</a>
	</section>
	----->
	
	<?php
	
	include("search.php");
	
	?>

	<p>Please view the video below for guidance on effectively using CanDRes for your research.</p>
<p align="center" style="padding:15px;">
	  <iframe width="560" height="315" src="https://www.youtube.com/embed/TrCoR-gtVbw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
	  </p>
</div>




</div>


<?php
	include("foot.php");
?>

<!---	
<footer class="foot">
	
<p align="center">©2023 - <b>Biomedical Informatics Centre, ICMR-National Institute for Research in Reproductive and Child Health</b></p>	
	
</footer>

---->
	
</body>
</html>