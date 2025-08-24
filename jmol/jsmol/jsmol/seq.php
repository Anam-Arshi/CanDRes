
<?php

		$gene = $res1['gene'];
		$mut = $res1['mutations'];
		$arr = array();
		//echo $mut."<br>";
		$split = preg_split("/[,\s+()]/", $mut, -1, PREG_SPLIT_NO_EMPTY);
		foreach($split as $spl)
		{
			
			
			$arr[] = $spl;
			
		}
		
		
		
		
	$scr = "";
	
	$mutns = array_unique($arr);
    //var_dump($mutns);
	$pattern = '/^([A-Z]*)(\d+)([A-Z]+)$/i';
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
	   
	
	
		$scr .= "select"." ".$pos.";wireframe 75; spacefill 150; color red; select $pos.C;  label"." ".$mutn."; color label darkblue; set fontsize 12;"." ";
		//echo $mutn."<br>";
		
		if($mutn == "839Ginsertion")
		{
		$mutations[837] = array('waa' => "", 'caa' => "AG", 'varn' => $mutn, 'pos' => 839);
		}
		else if(strpos($mutn, "fs")){
		   $mutations[$pos-1] = array('waa' => $waa, 'caa' => $waa, 'varn' => $mutn, 'pos' => $pos);
		   
	   }
		else{
		$mutations[$pos-1] = array('waa' => $waa, 'caa' => $caa, 'varn' => $mutn, 'pos' => $pos);
		//$all[] = array('name' => $pos, 'varn' => $mutn, 'pos' => $pos);
		}
}
else{
	//echo "$mutn<br>";
	
	if($mutn == '116RDLARKILSS125insertion'){
		$mutations[116] = array('waa' => "", 'caa' => "RDLARKILSS", 'varn' => $mutn, 'pos' => 116);
	}
	else if($mutn == "226-Ins_KLTQAVN-227"){
		$mutations[226] = array('waa' => "", 'caa' => "KLTQAVN", 'varn' => $mutn, 'pos' => 226);
	}
	else if($mutn == 'I661_L662insF'){
		$mutations[661] = array('waa' => "I", 'caa' => "F", 'varn' => $mutn, 'pos' => 661);
	}
	else if($mutn == "Q320insertPP")
	{
		$mutations[320] = array('waa' => "", 'caa' => "PP", 'varn' => $mutn, 'pos' => 320);
	}
	else if($mutn == "378fs")
	{
		$mutations[378] = array('waa' => "", 'caa' => "", 'varn' => $mutn, 'pos' => 378);
	}
	else{
	
	// Use a regular expression to match numbers
    preg_match_all('/\d+/', $mutn, $matches_del);

    // Extracted numbers will be in $matches[0]
    $numbers = $matches_del[0];
	
	$startn = $numbers[0];
	$endn = $numbers[1] + 1;
	for($m=($startn); $m < ($endn); $m++){
		$mutations[$m] = array('waa' => "", 'caa' => "", 'varn' => $mutn, 'pos' => $m);
	
	}
	
	}

} 

	 }
	
//var_dump($mutations); 
	
	

	$seq = trim($res1['seq']);
	$name = $res1['uniprot_ncbi'];

$dnld = "";	
?>

<h4 align="center" class="h4">Sequence</h4>

<span class="spa">Wild type <?php echo "(<a href='https://www.uniprot.org/uniprotkb/$name' target='_blank'>$name</a>)"; ?></span>
	
<form action="downFasta.php" method="post" enctype="multipart/form-data">
<button type="submit" name="w-butt" value="downloadn" title="Download" style="float: right; margin-right: 20px; margin-bottom: 0px; float: right; border:0px; cursor:pointer;">
			<i class="fa-solid fa-download" style="padding: 2px;"></i>
</button>
<pre class="dna-sequence">

	<?php
    //echo($seq);
    $dnld = $seq;
	
	$lines = explode("\n", $seq);
	//var_dump($lines);
	$sequence = "";

for($c = 1; $c < count($lines); $c++){
	// Extract the sequence
$sequence .= trim($lines[$c]);

}
	
	
// Extract the first line
 $firstLine = $lines[0];
echo $firstLine."<br>";

for ($i = 0; $i < strlen($sequence); $i++) {
    $base = substr($sequence, $i, 1);
	
	 $aaClass = "aa-$base";
	
  
	
	 if ($i % 60 == 0 && $i != 0) {
        echo "  <br>";
		
		$dnld_mut .= "\n";
    }
	

		echo "<span class='$aaClass'>$base</span>";
		$dnld_mut .= $base;
	}


    ?>

</pre>	
<input type="hidden" value="<?php echo $dnld;?>" name="down_seq">
<input type="hidden" value="<?php echo $name;?>" name="ptn_name">
</form>
	<br>
	<form action="downFasta.php" method="post" enctype="multipart/form-data">
	<button type="submit" value="downloadm" title="Download" style="float: right; margin-right: 20px; margin-bottom: 0px; float: right; border:0px; cursor:pointer;">
			<i class="fa-solid fa-download" style="padding: 2px;"></i>
</button>
	<span class="spa">Mutant</span>
	<pre id="protein-sequence">
	
	<?php
	//$lines = explode("\n", $seq);
	//var_dump($lines);
	
// Extract the first line
// $firstLine = $lines[0];

$firstLine = ">$uniprotId | $org | $mutation";
echo $firstLine;
$dnld_mut = $firstLine."\n";

//echo count($lines);


//echo $sequence."........";


// Generate the HTML code for the DNA sequence, highlighting the mutation positions
$html = '<div class="dna-sequence">';
for ($i = 0; $i < strlen($sequence); $i++) {
    $base = substr($sequence, $i, 1);
	
	 $aaClass = "aa-$base";
	 
	 
   $class = isset($mutations[$i]) ? 'mutation' : '';
	
	 if ($i % 60 == 0 && $i != 0) {
        $html .="<br>";
		
		$dnld_mut .= "\n";
    }
	
	

	if($class){
		$arr = "";
		//if($mutations[$i]['waa'] == $base){
		$arr= $mutations[$i];
		$id = $arr['pos'];
		$ca = $arr['caa'];
		//echo "<br>$ca<br>";
		$mut_val = $arr['varn'];
		//echo $mut_val."<br>";
		if(stripos($mut_val, "del") ){
			$html .= "<span class=\"delmutation\" data-position=\"$i\"  id=\"$id\">$base</span>";
			$dnld_mut .= "";
		}
		else if(stripos($mut_val, "stop")){
			$html .= "<span class=\"stopmut\" data-position=\"$i\"  id=\"$id\">$base</span>";
			$dnld_mut .= $base;
			break;
		}
		else if(stripos($mut_val, "fs")){
			$html .= "<span class=\"fsM\" data-position=\"$i\"  id=\"$id\">$ca</span>";
			$dnld_mut .= $ca;
			
		}
		else if(stripos($mut_val, "ins") || stripos($mut_val, "insert")){
			$html .= "<span class=\"insmut\" data-position=\"$i\"  id=\"$id\">$ca</span>";
			$dnld_mut .= $ca;
		}
		else{
			$html .= "<span class=\"$class\" data-position=\"$i\"  id=\"$id\">$ca</span>";
			
			$dnld_mut .= $ca;
		}
        
		
		/* }else{
			echo $pmid;
		} */
	}
	else{
		$html .="<span class='$aaClass'>$base</span>";
		$dnld_mut .= $base;
	}

}
$html .= '</div>';

// Output the mutation information as a JavaScript variable
echo "<script>";
echo "var mutations = " . json_encode($mutations) . ";";
//echo "var all = " . json_encode($all) . ";";
echo "</script>";

echo $html;

	
	
	?>
	

	</pre>
	
	<div style="margin-left: 23px;">
		<label class="switch">
		<input type="checkbox" class="toggleSwitch" checked>
		<span class="slider round"></span>
		
		</label>
		<b>Show polarity</b>
		
		<div class="legendB" style="display: inline-block;">
		
        <div class="legend-square" style="background-color: #df0b3038;"></div>
        Hydrophobic amino acids
    
    
        <div class="legend-square" style="background-color: #0e73b142;"></div>
        Hydrophilic amino acids
		
		</div>
		
    
	</div>
	<br>
	
	<input type="hidden" value="<?php echo $dnld_mut;?>" name="down_seq_mut">
	<input type="hidden" value="<?php echo $name;?>" name="ptn_name">
	</form>
	<script>
// Attach event listeners to the DNA sequence base elements
var bases = document.querySelectorAll('.dna-sequence span');
bases.forEach(function(base) {
    var position = base.dataset.position;
	//console.log(position);
	//console.log(mutations);
	
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
 <script>
      /*   // Get the sequence text
        const pre = document.getElementById("protein-sequence");
        const sequence = pre.innerText.trim();

        // Create a new HTML string with colored amino acids
        let coloredSequence = "";

        for (const char of sequence) {
            const aaClass = `aa-${char}`;
            coloredSequence += `<span class="${aaClass}">${char}</span>`;
        }

        pre.innerHTML = coloredSequence; // Set the colored sequence */
    </script>

    
	