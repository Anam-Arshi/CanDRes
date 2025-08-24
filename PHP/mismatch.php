<?php
include("connect.php");
	include('header.php');
	
	
?>
<style>
pre{
		white-space: pre-line;
		font-size: 15px;
		margin-left: 20px;
		margin-bottom: 20px;
		margin-top: 0;
	}
	
	
	.red{
	color: red;
	font-weight : 600;
	background: #C3BB91;
	cursor: pointer;
	position: relative;
	
}
	
.mutation {
    background-color: yellow;
	cursor: pointer;
	color: red;
	font-weight: bold;
	font-size: 14px;
}
.mutation-popup {
    position: absolute;
    top: 0;
    left: 0;
    border: 0.1em solid black;
    padding: 8px;
	font: 12px/20px Arial, Helvetica, sans-serif;
	background-color: antiquewhite;
	max-width: 300;
	word-wrap: break-word;
	margin: auto;
}
	
	.seq{
		padding: 2px;
		margin: 0 auto;
		background: white;
		width: 1400px;
	}
	
	.spa{
		margin-left: 20px;
		margin-top: 10px;
		font-weight: bold;
		margin-bottom: 0;
		font-family: Arial, "sans-serif";
		
	}



</style>
<?php
/* SELECT organism, GROUP_CONCAT(DISTINCT gene) AS distinct_genes,
COUNT(DISTINCT gene) AS total_unique_genes
FROM gene_mut
GROUP BY organism;
 */
$ids = array();
$qry = mysqli_query($conn, "SELECT distinct organism from final_data");
while($res = mysqli_fetch_array($qry)){
	$orgs[] = $res['organism'];
}
$textData = "isolate\tpmid\torganism\tgene\twaa\tpos\tcaa\n";
foreach($orgs as $org){
	$qry1 = mysqli_query($conn, "SELECT * from gene_mut where organism = '$org'");
	while($res1 = mysqli_fetch_array($qry1)){
		$gene = $res1['gene'];
		$mut = $res1['mutations'];
		$pmid = $res1['pmid'];
		$isolate = $res1['isolate'];
		$arr = array();
		//echo $mut."<br>";
		$split = explode(",", $mut);
		foreach($split as $spl)
		{
			
			
			$arr[] = trim($spl);
			
		}
		
		
		
		
	$scr = "";
	
	$mutns = array_unique($arr);
    //var_dump($mutns);
	//$pattern = '/^([A-Z]*)(\d+)([A-Z]+)$/i';
	$pattern = '/^([A-Z])(\d+)([A-Z])$/i';
    $matches = array();
    
	$mutations = array();
     foreach($mutns as $mutn)
	 {
		 
    if (preg_match($pattern, $mutn, $matches)) {
    $waa = $matches[1];   // Y
    $pos = $matches[2];  // 132
    $caa = $matches[3];   // F

    /* echo $waa . "\n";     // Y
    echo $pos . "\n";    // 132
    echo $caa . "\n";     // F
	*/	
		//$scr .= "select"." ".$pos.";wireframe 75; spacefill 150; color red; select $pos.C;  label"." ".$mutn."; color label black; set fontsize 12;"." ";
		//echo $mutn."<br>";
		$mutations[$pos-1] = array('waa' => $waa, 'caa' => $caa, 'varn' => $mutn, 'pos' => $pos);
		//$all[] = array('name' => $pos, 'varn' => $mutn, 'pos' => $pos);
		
		$textData .= "$isolate\t$pmid\t$org\t$gene\t$waa\t$pos\t$caa\n";

}else{
	$textData .= "$isolate\t$pmid\t$org\t$gene\t$mutn\t-\t-\n";
} 

	 }
	 
	
var_dump($mutations); 
	
	
    $seq = "dhdfghfdgh";
	//$seq = trim($res1['seq']);
	//$name = $res1['uniprot_ncbi'];

$dnld = "";	
?>

<!---<h4 align="center" class="h4">Sequence</h4>

<span class="spa">Wild type sequence <?php //echo "($name)"; ?></span>
---->
	
<form action="download.php" method="post" enctype="multipart/form-data">
<button type="submit" name="w-butt" value="download" title="Download" style="float: right; margin-right: 20px; margin-bottom: 0px; float: right; background-color: antiquewhite;">
			<i class="fa-solid fa-download" style="padding: 2px;"></i>
</button>
<pre>

	<?php
    //echo($seq);
    //$dnld = $seq;
    ?>

</pre>	
	<br>
	<button type="submit" value="download" title="Download" style="float: right; margin-right: 20px; margin-bottom: 0px; float: right; background-color: antiquewhite;">
			<i class="fa-solid fa-download" style="padding: 2px;"></i>
</button>
	<!--- <span class="spa">Mutant sequence</span> ---->
	<pre>
	
	<?php
	$lines = explode("\n", $seq);

// Extract the first line
$firstLine = $lines[0];
//echo $firstLine;
$dnld_mut = $firstLine."\n";

// Extract the sequence
$sequence = "";
$sequence = implode("", array_slice($lines, 1));
//echo $len;



// Generate the HTML code for the DNA sequence, highlighting the mutation positions
$html = '<div class="dna-sequence">';
for ($i = 0; $i < strlen($sequence); $i++) {
    $base = substr($sequence, $i, 1);
	
	
	
   $class = isset($mutations[$i]) ? 'mutation' : '';
	
	 if ($i % 60 == 0 && $i != 0 ) {
        $html .= "<br>";
		
		$dnld_mut .= "\n";
    }
	
	

	if($class){
		$abc = trim($mutations[$i]['waa']);
		echo "<br>".$mutations[$i]['waa']."..........$base"."<br>";
		if($base == $abc ){
		$arr= $mutations[$i];
		$id = $arr['pos'];
		$ca = $arr['caa'];
        $html .= "<span class=\"$class\" data-position=\"$i\"  id=\"$id\">$ca</span>";
		$dnld_mut .= $ca;
		}
		else
		{
			$ids[] = $pmid;
			echo $pmid;
		}
	}
	else{
		$html .= "$base";
		$dnld_mut .= $base;
	}

}
$html .= '</div>';

// Output the mutation information as a JavaScript variable
echo "<script>";
echo "var mutations = " . json_encode($mutations) . ";";
//echo "var all = " . json_encode($all) . ";";
echo "</script>";

//echo $html;

	
	
	?>
	

	</pre>
	
	<input type="hidden" value="<?php echo $dnld;?>" name="down_seq">
	<input type="hidden" value="<?php echo $dnld_mut;?>" name="down_seq">
	<input type="hidden" value="<?php echo $name;?>" name="ptn_name">
	</form>
	<script>
// Attach event listeners to the DNA sequence base elements
var bases = document.querySelectorAll('.dna-sequence span');
bases.forEach(function(base) {
    var position = base.dataset.position;
	console.log(position);
	console.log(mutations);
	
    var mutationDetails = mutations[position];
    if (mutationDetails) {
		var name = mutationDetails.name;
			var varn = mutationDetails.varn;
            //var id = mutationDetails.id;
			//var vart = mutationDetails.vart;
			var pos = mutationDetails.pos;
			
        base.addEventListener('mouseenter', function(event) {
            // Create and display the popup
			
            var popup = document.createElement('div');
            popup.className = 'mutation-popup';
			popup.id = mutationDetails.id;
            
			
			popup.innerHTML = "<strong>" + varn + "</strong><br>" + "Position: " +pos ;
			
			
            
            document.body.appendChild(popup);
            
			//popup.style.top = event.pageY +'px';
            //popup.style.left = event.pageX + 320 + 'px';
			
			popup.style.top = event.pageY - 10 +'px';
			popup.style.left =   event.pageX +30 +'px';
			
			
        });
        base.addEventListener('mouseleave', function() {
            // Remove the popup when the mouse leaves the base element
            var popup = document.querySelector('.mutation-popup');
            if (popup) {
                document.body.removeChild(popup);
            }
        });
    }
});


</script>

<?php

	}
	//echo "<br>".$pmid.".....ends<br>";
}
//var_dump($ids);
$u_ids = array_unique($ids);

foreach($u_ids as $ar){
	//echo $ar."<br>";
}

// File path
$textFilePath = 'sortedMutationsResidues_08_04_2024.txt';

// Open the file in write mode
$textFile = fopen($textFilePath, 'w');

// Write the text data to the file
fwrite($textFile, $textData);


// Close the file
fclose($textFile);

	include("foot.php");

?>
	