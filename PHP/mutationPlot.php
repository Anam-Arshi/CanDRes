<?php
error_reporting(E_ALL);

ini_set('display_errors', '1');

?>

<!doctype html>
<html lang="eng">
<head>
<meta charset="utf-8">
<title>Mutation plot</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='dependent-selects-master/dependent-selects.js'></script>
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
	
	
	
	.main2 {
    width: 100%;
    background: white;
    margin-top: 5px;
    padding: 10px 0px;
    
}





	
	/* dropdownCheckbox */
.multiselect {
  width: 65%;
  margin-bottom: 5px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.mySelectOptions {
  display: none;
  border: 0.5px #7c7c7c solid;
  background-color: #ffffff;
  max-height: 150px;
  overflow-y: scroll;
}

.mySelectOptions label {
  display: block;
  font-weight: normal;
  
  white-space: nowrap;
  min-height: 1.5em;
  background-color: #ffffff;
  padding: 0 2.25rem 0 .75rem;
  text-align: left;
  /* padding: .375rem 2.25rem .375rem .75rem; */
}

.mySelectOptions label:hover {
  background-color: #1e90ff;
}

	.mySelectOptions input{
		width: 20px;
		box-sizing: border-box;
		border: 2px solid black;
		font-size: medium;
		padding: 5px;
	    	
	}

	.input-container {
    margin-top: 10px;
  }
  select{
		background-color: slategray;
        color: white;
        padding: 8px;
        width: 250px;
        border: none;
        font-size: medium;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.2);
       -webkit-appearance: button;
        appearance: button;
        outline: none;
		font-weight: bold;
	}
	
	#plot{
		padding: 5px;
		
	}
	</style>
</head>

<body>
<?php
include("header.php");
include("connect.php");
//https://wou.edu/chemistry/courses/online-chemistry-textbooks/

$spa = "C. albicans|C. glabrata";


 
$pdf = "erg11_glabrata_plot.pdf";
 
 if(isset($_POST["species"])){
	 $gene = $_POST["genes"] ;
	 $sps = $_POST["species"] ;
	 $sps  = str_replace(" ", "", $sps);
	 $drg = $_POST["drugs"] ;
	 
	 
	 // echo $drg."<br>";
	 
 if($sps == "C.albicans"){
	 $filename = "transformed_data.txt";
	 $drg_comb = ["Clotrimazole+Fluconazole+Itraconazole+Ketoconazole", "Clotrimazole+Fluconazole+Itraconazole+Ketoconazole+Voriconazole", "Fluconazole", "Fluconazole+Isavuconazole+Itraconazole+Posaconazole+Voriconazole", "Fluconazole+Itraconazole", "Fluconazole+Itraconazole+Ketoconazole", "Fluconazole+Itraconazole+Posaconazole", "Fluconazole+Itraconazole+Posaconazole+Ravuconazole+Voriconazole", "Fluconazole+Itraconazole+Posaconazole+Voriconazole", "Fluconazole+Itraconazole+Voriconazole", "Fluconazole+Ketoconazole", "Fluconazole+Posaconazole+Voriconazole", "Fluconazole+Ravuconazole", "Fluconazole+Ravuconazole+Voriconazole", "Fluconazole+Voriconazole", "Itraconazole", "Itraconazole+Ketoconazole", "Itraconazole+Posaconazole+Voriconazole", "Ketoconazole", "Posaconazole", "Voriconazole"];
 }
 else{
 $filename = "transformed_data_glabrata.txt";
 $drg_comb = ["Fluconazole+Itraconazole+Voriconazole", "Fluconazole+Voriconazole", "Fluconazole+Isavuconazole+Itraconazole+Voriconazole", "Voriconazole"];
 }


 }else{
	 $gene = "ERG11";
	 $drg = "All";
	 $sps = "C.albicans";
	 $filename = "transformed_data.txt";
	 $drg_comb = ["Clotrimazole+Fluconazole+Itraconazole+Ketoconazole", "Clotrimazole+Fluconazole+Itraconazole+Ketoconazole+Voriconazole", "Fluconazole", "Fluconazole+Isavuconazole+Itraconazole+Posaconazole+Voriconazole", "Fluconazole+Itraconazole", "Fluconazole+Itraconazole+Ketoconazole", "Fluconazole+Itraconazole+Posaconazole", "Fluconazole+Itraconazole+Posaconazole+Ravuconazole+Voriconazole", "Fluconazole+Itraconazole+Posaconazole+Voriconazole", "Fluconazole+Itraconazole+Voriconazole", "Fluconazole+Ketoconazole", "Fluconazole+Posaconazole+Voriconazole", "Fluconazole+Ravuconazole", "Fluconazole+Ravuconazole+Voriconazole", "Fluconazole+Voriconazole", "Itraconazole", "Itraconazole+Ketoconazole", "Itraconazole+Posaconazole+Voriconazole", "Ketoconazole", "Posaconazole", "Voriconazole"];
 }
 
?>


<script>
var subjectObject = {
  "ERG11": {
    "C. albicans": ["All", "Clotrimazole", "Fluconazole", "Isavuconazole", "Itraconazole", "Ketoconazole",  "Posaconazole", "Ravuconazole", "Voriconazole"],
    "C. glabrata": ["All", "Fluconazole", "Isavuconazole", "Itraconazole", "Voriconazole"]
    
  }
}
window.onload = function() {
  var subjectSel = document.getElementById("genes");
  var topicSel = document.getElementById("species");
  var chapterSel = document.getElementById("drugs");
  for (var x in subjectObject) {
    subjectSel.options[subjectSel.options.length] = new Option(x, x);
  }
  subjectSel.onchange = function() {
    //empty Chapters- and Topics- dropdowns
    chapterSel.length = 1;
    topicSel.length = 1;
    //display correct values
    for (var y in subjectObject[this.value]) {
      topicSel.options[topicSel.options.length] = new Option(y, y);
    }
  }
  topicSel.onchange = function() {
    //empty Chapters dropdown
    chapterSel.length = 1;
    //display correct values
    var z = subjectObject[subjectSel.value][this.value];
    for (var i = 0; i < z.length; i++) {
      chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i]);
    }
  }
}
</script>
<main class="main2">
<br>
 <form name="form1" method="post" action="" onSubmit="return checkform(this);">
            
                    <table width="1066" align="center" id="dataTable" cellpadding="0" cellspacing="0">
                  <tr align="center">
                  
                    <td width="376" valign="middle"><div align="right">
						
                      <select name="genes" style="width:250px;" id="genes" >
						  <option value="">Select gene</option>
                       
                        
                        
						</select>
                    </div></td>
                    <td width="290" valign="middle"><div align="center" >
                      <!--<input name="trm1" type="text" id="tm" placeholder="Keyword" style="height:20px"/>-->
						<select name="species" id="species" style="width:200px;" >
						<option value="">-----</option>
						
						</select>
						</td>
						
						<td>
					 <select  style="width:200px;"  id="drugs" name="drugs" >
						<option value="">-----</option>
						
						</select>
						
						</td>
                   
              </tr>
              <tr>
                <td colspan="2" valign="middle">&nbsp;</td>
                <!---<td width="65%" valign="middle">&nbsp;<div align="center"><div id='loadingmsg' style='display: none;'>
                    <div align="center">Processing, please wait......</div>
                  </div>
					<div id='loadingover' style='display: none;'></div>  </td>------>
                                  
              </tr>
            </table>
            <p align="center">
              <input type="submit" name="Submit" value="Submit" />
              <input name="Clear" type="button" id="Clear" value="Reset" onclick="clr();" />
            </p>
			<p align = "left">&nbsp;</p>
			
</form>


<div id='plot'>
<?php
$sps_name = str_replace("C.", "", $sps);
if($drg !== "All"){
	
foreach($drg_comb as $drug){

$pdf = "$drug"."_"."$gene"."_"."$sps_name.pdf";	

$filarr = array();
if(stripos($drug, $drg) !== false || $drug == $drg){
	
if(!file_exists("mutationPlotFiles/$pdf")){
$query = mysqli_query($conn, "SELECT distinct mutations, REPLACE(drugs, ',', '+') as drugs FROM `drug_mutations_23_10` where gene = '$gene' AND organism = '$sps'" );
	

 while ($row = mysqli_fetch_array($query)) {
	$drgT = $row["drugs"];
	$mut = $row["mutations"];
	if($drgT === trim($drug)){
		$drug = "\"$drug\"";
		$filarr[] = "$mut\t$drug\n";
	}
	
 }
 
 

//var_dump($filarr);


$file = "$gene"."_"."$sps_name";

$myfile = fopen("mutationPlotFiles/$file.txt", "w") or die("Unable to open file!");

fwrite($myfile, "Mutation, Resistance\n");
$txt = implode("", $filarr);
fwrite($myfile, $txt);
fclose($myfile);

//$pdf = "$file"."_output.pdf";
$Rscript = shell_exec("Rscript mutPlot.R $file.txt $sps $pdf 2>&1");
echo "Rscript mutPlot.R $file.txt $sps $pdf 2>&1<br>";
echo "$Rscript<br>";

unlink("mutationPlotFiles/$file.txt");

?>
<object data="<?php echo "mutationPlotFiles/$pdf"; ?>" type="application/pdf" width="100%" height="500px">
       
    </object>
	<br>
	
<?php
}
else{
?>
<object data="<?php echo "mutationPlotFiles/$pdf"; ?>" type="application/pdf" width="100%" height="500px">
       
    </object>
	<br>
	
<?php	
	
}
}

}
}else{
	
	$pdf = "$drg"."_"."$gene"."_"."$sps_name.pdf";	
	?>
<object data="<?php echo "mutationPlotFiles/$pdf"; ?>" type="application/pdf" width="100%" height="750px">
       
    </object>
	<br>
	
<?php	
	
}

?>
	<br>
	<p align="center">TMD: Transmembrane domain; FSL: Fungus-specific loop; SEC-PPEC: Substrate entry channel & putative product exit channel</p>
	<strong>Note: We are in the process of automating plot generation for rest of the genes</strong>
	
</div>

</main>
	
<?php
include("foot.php");


?>	
</body>
</html>