<?php
//$pdbb=$_REQUEST['pdb_id'];
if(strpos($pdbb, "-")){
	$pdbId = "https://alphafold.ebi.ac.uk/files/$pdbb-model_v4.pdb";
}
else if($pdbb == "Model"){
	$pdbId = "./model_structure/$uniprotId"."_prep.pdb";
}
else{
	$pdbId = "https://files.rcsb.org/view/$pdbb.pdb";
}

$organism = str_replace("C. ", "", $org);

$mut = str_replace(" ", "", $mutation);
$mut = str_replace(",", "_", $mut);
$mut = str_replace("-", "_", $mut);
//echo $mut."<br>";
$sPath = "./structures/$pmid/$organism/$gene_name/$uniprotId/$mut.pdb";
/* $filename = $spath;
if (file_exists($filename)) {
    echo "The file $filename exists.";
} else {
    echo "The file $filename does not exist.";
} */


//$pdbId = $pdbb.".pdb"; 
//$exec="wget --ignore-case -O pdb_file/$pdbId https://files.rcsb.org/view/$pdbId";
//echo $exec;
//system($exec);

// *********** USEFULL LINKS ******************* //
// https://teaching.ncl.ac.uk/chemmodels/jmolapps/methods.html
// http://wiki.jmol.org/index.php/Jmol_JavaScript_Object
// http://wiki.jmol.org/index.php/Jmol_JavaScript_Object/Functions
// https://chemapps.stolaf.edu/jmol/docs/

// find /path/to/structures -type d -name 'C. *' -execdir bash -c 'mv "$1" "${1/C. /}"' _ {} \;

?>
<?php 
//jmol/jsmol/jsmol/JSmol.min.js
//echo $pdbId;



?>
<script type="text/javascript" src="JSmol.min.js"></script>

	

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
	//echo $cont."<br>";
?>
	

<script type="text/javascript">
$(document).ready(function(){
//Jmol.setDocument(false);
Jmol._isAsync = false;

// last update 2/18/2014 2:10:06 PM

var jmolAppletN = "jmolAppletN"+<?php echo $cont;  ?>; // set up in HTML table, below
	
var jmolApplet = "jmolApplet"+<?php echo $cont;  ?>;

/* Jmol.setDocument(0);
  Jmol.getApplet(jmolAppletN, Info); // creates the object but does not insert it
  Jmol.getApplet(jmolApplet, Info); */

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
 Jmol._getElement(applet, "appletdiv").style.border="1px solid #d1d6db"
	
    Jmol._getElement(applet, "appletdiv1").style.border="1px solid #d1d6db"

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
	script: "set antialiasDisplay;load <?php echo "$pdbId"; ?>;background white; cartoons only; color [xD6d3d4];",
	//https://alphafold.com/entry/A0A1U8FD60 https://alphafold.ebi.ac.uk/files/AF-A0A0T6TY99-F1-model_v4.pdb https://files.rcsb.org/view/2PQT.pdb  //select ligand; wireframe 0.15; spacefill 0.45; color green;
	
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
	//script: "set antialiasDisplay; load <?php echo "$sPath"; ?>;background white;  cartoons only;  select ligand; wireframe 0.15; spacefill 0.45;  <?php echo $scr; ?>"  ,
	script: "set antialiasDisplay; load <?php echo "$sPath"; ?>;background white;  cartoons only; color [xD6d3d4]; <?php echo $scr; ?>"  ,
	//script: "set antialiasDisplay;try{ load <?php echo "$sPath"; ?>}catch(e){ prompt @{'oops --'  + e}};background white;  cartoons only;  select ligand; wireframe 0.15; spacefill 0.45;  <?php echo $scr; ?>"  ,
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


	$("#<?php echo $appdivn; ?>").html(Jmol.getAppletHtml("jmolAppletN"+<?php echo $cont;  ?>, Info)) //The first parameter for nearly all of these functions, JmolObject, must be a reference to the object that will receive action of the control. Such reference is either the JSO object itself or its name-id (e.g. "myJmol" in the examples above).

  $("#<?php echo $appdiv; ?>").html(Jmol.getAppletHtml("jmolApplet"+<?php echo $cont;  ?>, Info1))
  
})



//Jmol.jmolButton(myJmol,"spacefill on", "display as vdW spheres");	

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
		/* display: flex;
		justify-content: space-evenly; */
		display: block;
		
	}
	.head-d{
		    display: flex;
    justify-content: space-between;
    font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
    width: 70%;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: space-around;
    align-items: center;
	}
	
	.strTable{
		width: 79%;
		display: inline-table;
		margin: auto 20px;
	}
	#strFilter{
		display: inline-table;
		padding: 5px;
	
		width: 15%;
	}
	</style>
	


<div >
  
	  <span class="h4" align="center"><strong>3D Structure </strong></span>
	  <br>
	  
	 <table cellpadding="3" cellspacing="0" class="strTable">
	 <tr>
	 <td align="center">
	      <h3>Wild type <?php if(strpos($pdbb, "-"))
		{
			echo "(<a href='https://alphafold.com/search/text/$pdbb' target='new_af'>$pdbb</a>)";
		}
		else if($pdbb == "Model"){
			echo "(Model)";
		}
		else{
			echo "(<a href='https://www.rcsb.org/structure/$pdbb' target='new_pdb'>$pdbb</a>)";
		} ?> &nbsp;&nbsp; </h3>
		  
		 </td>
		 <td align="center">
		  <h3>Mutant</h3>
		  </td>
		  <td>
		  </td>
		  </tr>
	
	
	<tr>
	
	<td align="right">
	       <a href="<?php echo $pdbId; ?>" download>
			<i class="fa fa-download" style="padding-top: 15px; color: black; font-size: 16px;margin-right:100px;" title="Download"></i>
			</a>
	</td>
	<td align="right">
		   <a href="<?php echo $sPath; ?>" download>
			<i class="fa fa-download" style="padding-top: 15px; color: black; font-size: 16px;margin-right: 100px;" title="Download"></i>
			</a>
		</td>
		
</tr>		
	
	  
    <tr>
		
		
		<td valign="top" align="center">
		
	 
		<div id="<?php echo $appdivn; ?>" class="struc">
		
		</div>
		</td>
		
		<td valign="top" align="center">
		<div id="<?php echo $appdiv; ?>"  class="struc">
		
		</div>
		</td>
		
      
	  
	 
  </tr>
	</table>
	<div id="strFilter">
	 <p align="center"><strong>Display Options</strong></p>
	  
    <table width="100%" border="0" cellspacing="3" cellpadding="5">
	<tr>
	<td style="background: #04468f;color: white;" align="center"><strong>Wild type structure</strong></td>
	</tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'select *;cartoons off;spacefill only')">Spacefill</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'select *;cartoons off;wireframe -0.1')">Wire</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'select *;cartoons off;spacefill 23%;wireframe 0.15')">Ball and stick</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'select protein or nucleic;cartoons only')">Cartoons</a></td>
      </tr>
      
      
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'color property atomno')">Color atom no.</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'color cpk')">Color CPK</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'color structure')">Color structure</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolAppletN$cont";?>,'color Amino')">Hydrophobicity</a></td>
      </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="3" cellpadding="5">
	<tr>
	<td style="background: #04468f;color: white;" align="center"><strong>Mutant structure</strong></td>
	</tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;cartoons off;spacefill only; <?php echo $scr; ?>')">Spacefill</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;cartoons off;wireframe -0.1; <?php echo $scr; ?>')">Wire</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;cartoons off;spacefill 23%;wireframe 0.15; <?php echo $scr; ?>')">Ball and stick</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select protein or nucleic;cartoons only; <?php echo $scr; ?>')">Cartoons</a></td>
      </tr>
      
      
      
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;color property atomno; <?php echo $scr; ?>')">Color atom no.</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;color cpk; <?php echo $scr; ?>');">Color CPK</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;color structure; <?php echo $scr; ?>')">Color structure</a></td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><a href="javascript:Jmol.script(<?php echo "jmolApplet$cont";?>,'select *;color Amino; <?php echo $scr; ?>')">Hydrophobicity</a></td>
      </tr>
    </table>
	<br>
	</div>
</div>

