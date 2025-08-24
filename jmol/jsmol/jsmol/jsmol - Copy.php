<?php
//$pdbb=$_REQUEST['pdb_id'];
$pdbId = $pdbb.".pdb"; 
//$exec="wget --ignore-case -O pdb_file/$pdbId https://files.rcsb.org/view/$pdbId";
//echo $exec;
//system($exec);
?>
<?php 

//echo $pdbId; ?>
<script type="text/javascript" src="jmol/jsmol/jsmol/JSmol.min.js"></script>

	

<?php
/* include("connect.php");
	
	$get = mysqli_query($conn, "select distinct gene, mutation from mut_pos where gene = 'ERG11'");
	
	while($res = mysqli_fetch_array($get))
	{
		$gene = $res['gene'];
		$mut = $res['mutation'];
		//echo $mut."<br>";
		$split = preg_split("/[,()]/", $mut, -1, PREG_SPLIT_NO_EMPTY);
		
		foreach($split as $spl)
		{
			$arr[] = $spl; 
		}
		
	}
	$scr = "";
	$mutns = array_unique($arr);
	//var_dump($mutns);
	$pattern = '/^([A-Z])(\d+)([A-Z])$/';
    $matches = array();
    
	$mutations = array();
     foreach($mutns as $mutn)
	 {
		 
    if (preg_match($pattern, $mutn, $matches)) {
    $waa = $matches[1];   // Y
    $pos = $matches[2];  // 132
    $caa = $matches[3];   // F

    $scr .= "select"." ".$pos.";wireframe 75; spacefill 150; color red; select $pos.C;  label"." ".$mutn."; color label black; set fontsize 12;"." ";
		//$scr .= "select"." ".$pos.";wireframe 75; spacefill 150; color red; select $pos.C;  label"." Y132F "."; color label black; set fontsize 12;"." ";
} 
	
	 }
	  */
	//echo $scr."";	
	
?>
	

<script type="text/javascript">

Jmol._isAsync = false;

// last update 2/18/2014 2:10:06 PM

var jmolApplet0; // set up in HTML table, below
	
var jmolApplet1;

// logic is set by indicating order of USE -- default is HTML5 for this test page, though

var s = document.location.search;

// Developers: The _debugCode flag is checked in j2s/core/core.z.js, 
// and, if TRUE, skips loading the core methods, forcing those
// to be read from their individual directories. Set this
// true if you want to do some code debugging by inserting
// System.out.println, document.title, or alert commands
// anywhere in the Java or Jmol code.

Jmol._debugCode = (s.indexOf("debugcode") >= 0);

jmol_isReady = function(applet) {
	document.title = (applet._id + " - Jmol " + Jmol.___JmolVersion)
	Jmol._getElement(applet, "appletdiv").style.border="1px solid darkblue"
	
    Jmol._getElement(applet, "appletdiv1").style.border="1px solid darkblue"

}		


var Info = {
	width: 500,
	height: 500,
	debug: false,
	color: "white",
	addSelectionOptions: false,
	use: "HTML5",   // JAVA HTML5 WEBGL are all optionsm
	j2sPath: "./j2s", // this needs to point to where the j2s directory is.
	jarPath: "./java",// this needs to point to where the java directory is.
	jarFile: "JmolAppletSigned.jar",
	isSigned: true,
	script: "set antialiasDisplay;load <?php echo "./1xwd.pdb"; ?>;background white; cartoons only;",
	//https://alphafold.com/entry/A0A1U8FD60 https://alphafold.ebi.ac.uk/files/AF-A0A0T6TY99-F1-model_v4.pdb  //select ligand; wireframe 0.15; spacefill 0.45; color green;
	
	serverURL: "php/jsmol.php",
	readyFunction: jmol_isReady,
	disableJ2SLoadMonitor: true,
	appletLoadingImage : true,
  disableInitialConsole: true,
  allowJavaScript: true
	//defaultModel: "$dopamine",
	//console: "none", // default will be jmolApplet0_infodiv, but you can designate another div here or "none"
}

var Info1 = {
	width: 500,
	height: 500,
	debug: false,
	color: "white",
	addSelectionOptions: false,
	use: "HTML5",   // JAVA HTML5 WEBGL are all optionsm
	j2sPath: "./j2s", // this needs to point to where the j2s directory is.
	jarPath: "./java",// this needs to point to where the java directory is.
	jarFile: "JmolAppletSigned.jar",
	isSigned: true,
	script: "set antialiasDisplay;load <?php echo "./1xwd.pdb"; ?>;background white;  cartoons only;  select ligand; wireframe 0.15; spacefill 0.45;  <?php echo $scr; ?>"  ,
	//https://alphafold.com/entry/A0A1U8FD60
	//color [x5BFFFF];
	serverURL: "php/jsmol.php",
	readyFunction: jmol_isReady,
	disableJ2SLoadMonitor: true,
	appletLoadingImage : true,
  disableInitialConsole: true,
  allowJavaScript: true
	//defaultModel: "$dopamine",
	//console: "none", // default will be jmolApplet0_infodiv, but you can designate another div here or "none"
}


//Jmol.jmolRadio("jmolApplet0", "select all; cartoon only; color yellow; ", "Default", false, '<br>');
//Jmol.jmolRadio("jmolApplet0", Info.script, "View mutations", true);

$(document).ready(function() {
  $("#appdiv").html(Jmol.getAppletHtml("jmolApplet0", Info))
  $("#appdiv1").html(Jmol.getAppletHtml("jmolApplet1", Info1))
})
	

var lastPrompt=0;
</script>
<style>
	.Legend-colorBox {
    width: 0.6rem;
    height: 0.6rem;
    display: inline-block;
    background-color: blue;
	padding-left: 0px;
	margin: 0px;
	
}
	.Legend {
		padding-left: 10px;
		margin-top: 10px;
		
	}
	.struc{
		float: left;
		margin: 20px;
	}
	
	.st-span{
	font-family: Verdana, 'sans-serif'; 
	background: #d1d6db; 
	color: black; 
	height: 60px;
	display: flex;
    align-items: center;
   justify-content: center;
		margin: 0;
		margin-bottom: 20px;
		
	}
	.head{
		display: flex;
		justify-content: space-evenly;
		font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
	}
	
	</style>
	


<div align="center">
  
	  <span class="st-span" align="center"><strong><?php echo strtoupper($pdbb); ?> &nbsp;&nbsp; </strong><?php echo "(Lanosterol 14-alpha demethylase)"; ?></span>
	  <br>
	  <div class="head">
	      <h3>Wild type structure</h3>
		  <h3>Mutant structure</h3>
	</div>
	  <table cellpadding=0 cellspacing="0">
    <tr>
		
		
		<td valign="top">
		
	 
      
	 
      <div id="appdiv" class="struc">
		
		</div>
		
		<div id="appdiv1"  class="struc">
		
		</div>
		
      </td>
  </tr>
	</table>
</div>

