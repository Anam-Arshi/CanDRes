<?php

session_start();

?>

<!doctype html>

<html lang="eng">
<head>
<meta charset="utf-8">
<title>Advanced search</title>
<style>

h3{
		text-align: center;
		
	}
	table{
		border: 0px;
	}
	main{
		padding: 10px;
	}
	button, input{
		cursor: pointer;
	}
.main2 {
    width: 100%;
    background: white;
    margin-top: 5px;
    padding: 10px 0px;
    
}
</style>
</head>

<body>
<?php

include("connect.php");
include("header.php");

?>
<div class="main2">
<?php



#SELECT state_ut, COUNT(state_ut) as cont FROM state_city GROUP BY state_ut;
$getsps = mysqli_query($conn, "select distinct organism from final_data order by organism ASC");
$cntsp = 0;
while($row=mysqli_fetch_array($getsps))
{
	$sp = $row["organism"];
	$species[] = $row['organism'];
	if($cntsp==0){
	$spa = $sp;
	}
	else{
	$spa = $spa."|".$sp;	
	}
								
	$cntsp++;
}
	#echo $spa;




/* $getdr1 = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
$cntdr = 0;
while($rowdr=mysqli_fetch_array($getdr1))
{
	$dr = $rowdr["Drug"];
	if($cntdr==0){
	$dra = $dr;
	}
	else{
	$dra = $dra."|".$dr;	
	}
								
	$cntdr++;
}
 */
	

$getye1 = mysqli_query($conn, "select distinct year from final_data ORDER BY year ASC");
$cntye = 0;
while($rowye=mysqli_fetch_array($getye1))
{
	$ye = $rowye["year"];
	$years[] = $rowye["year"];
	if($cntye==0){
	$yea = $ye;
	}
	else{
	$yea = $yea."|".$ye;	
	}
								
	$cntye++;
} 

$getgene = mysqli_query($conn, "select distinct gene from merged_table ORDER BY gene ASC");
$cntgene = 0;
while($rowge=mysqli_fetch_array($getgene))
{
	$ge = $rowge["gene"];
	$genes[] = $rowge["gene"];
	if($cntgene==0){
	$gen = $ge;
	}
	else{
	$gen = $gen."|".$ge;	
	}
								
	$cntgene++;
} 

$mutationType = "Insertions,Deletions,Indels,Frameshift,Substitutions,Complex";
$mutationRepl = str_replace(",", "|", $mutationType);
$mutationArr = explode(",", $mutationType);


$drugList = ["5-Flucytosine", "Amphotericin B", "Anidulafungin", "Beauvericin", "Caspofungin",
 "Clotrimazole", "Fluconazole", "Isavuconazole", "Itraconazole", "Ibrexafungerp", "Ketoconazole", "Manogepix", "Micafungin", "Nystatin",
 "Posaconazole", "Prochloraz", "Ravuconazole", "Rezafungin", "Voriconazole"];
 
 $drugRepl = implode("|", $drugList);

$drg = "5FC|AMB|AFG|BUV|CAS|CD101|CLT|FLU|ISA|ITR|KET|MGX|MFG|MK-3118|POS|PCZ|RAV|RFG|R6G|SCY078|FK506|VOR";

?>
<h3 align="center">Advanced search</h3>
<table id="tbl-advs" width="98%" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="white">
    <tr>
      <td><table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr align="center">
          <td valign="middle" align="center">
          
         
		    <form name="form1" method="post" action="advsearchResults.php" onSubmit="return checkform(this);showLoading();" target="new">
            <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td height="61" colspan="3"><table width="968" align="center" id="dataTable" cellpadding="0" cellspacing="0">
                  
                    </table>
                    <table width="1066" align="center" id="dataTable" cellpadding="0" cellspacing="0">
                  <tr align="center">
                  <td width="117" height="38"></td>
                    <td width="376" valign="middle"><div align="right">
						
                      <select name="parent" style="width:250px;" id="id_parent" data-child-id="id_child" class="dependent-selects__parent">
						  <option value="">All fields</option>
                        <option value="Species" data-child-options="<?php echo $spa; ?>">Species</option>
                        
                        <!--- <option value="drugs" data-child-options="<?php //echo $drugRepl; ?>">Antifungal drugs</option> ------->
						
						<option value="Drug" data-child-options="<?php echo $drugRepl; ?>">Antifungal drugs</option>
						 <option value="Gene" data-child-options="<?php echo $gen; ?>">Genes</option>
						 <option value="Mutations" data-child-options="<?php echo $mutationRepl; ?>">Type of mutations</option>
						  <option value="Year" data-child-options="<?php echo $yea; ?>">Year</option>
						</select>
                    </div></td>
                    <td width="290" valign="middle"><div align="center" class="select2-selection--single">
                      <!--<input name="trm1" type="text" id="tm" placeholder="Keyword" style="height:20px"/>-->
						<select name="child" id="id_child" style="width:200px;" class="dependent-selects__child" data-text-if-parent-empty="Select field">
						<option value="">---</option>
						<?php
						
							foreach($species as $sps)
							{
						    
								?>
							<option value="<?php echo $sps; ?>"><?php echo $sps; ?></option>
							<?php
							}
							
							
							
							
							foreach($years as $year)
							{
								?>
							<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
							<?php
							}
							
							foreach($genes as $gene)
							{
								?>
							<option value="<?php echo $gene; ?>"><?php echo $gene; ?></option>
							<?php
							}
							
							/* foreach($drugList as $drg)
							{
								?>
							<option value="<?php echo $drg; ?>"><?php echo $drg; ?></option>
							<?php
							} */
							
							

						?>
						
						
<option value="5-Flucytosine">5-Flucytosine</option>
 
						<option value="Amphotericin B">Amphotericin B</option>
						<option value="Anidulafungin">Anidulafungin</option>
						<option value="Beauvericin">Beauvericin</option>
						<option value="Caspofungin">Caspofungin</option>
						<option value="Clotrimazole">Clotrimazole</option>
						<option value="Fluconazole">Fluconazole</option>
						<option value="Isavuconazole">Isavuconazole</option>
						<option value="Itraconazole">Itraconazole</option>
						<option value="Ibrexafungerp">Ibrexafungerp</option>
						<option value="Ketoconazole">Ketoconazole</option>
						
						<option value="Manogepix">Manogepix</option>
						<option value="Micafungin">Micafungin</option>
						<option value="Nystatin">Nystatin</option>
						<option value="Posaconazole">Posaconazole</option>
						<option value="Prochloraz">Prochloraz</option>
						<option value="Ravuconazole">Ravuconazole</option>
						<option value="Rezafungin">Rezafungin</option>
						
						<option value="Voriconazole">Voriconazole</option>
						
						
						<option value="Insertions">Insertions</option>
						<option value="Deletions">Deletions</option>
						<!--- <option value="Indels">Indels</option> --->
						<option value="Frameshift">Frameshift</option>
						<option value="Substitutions">Substitutions</option>
						<option value="Complex">Complex</option>
						</select>
						<script src='dependent-selects-master/dependent-selects.js'></script>
                    </div></td>
                    <td width="262" valign="middle"><button name="Add" value="Add" onClick="addq();" type="button" style="height:30px" ><i class="fa fa-plus"></i></button></td>
                  </tr>
                </table></td>
                <td width="6%" valign="bottom"><div align="left">
                  <?php //<INPUT type="button" value="Add" onClick="addRow('dataTable')" /><INPUT type="button" value="Delete" onClick="deleteRow('dataTable')" /> ?>
                  
                  
                </td>
              </tr>
              <tr>
                <td width="13%" height="52">&nbsp;</td>
                <td width="16%"><div align="center">
                  <input name="AND" type="button" id="AND" value="AND" style="height:20px" onClick="op(this.value);" />
                  <input name="OR" type="button" id="OR" value="OR" style="height:20px" onClick="op(this.value);" />
                  <input name="brac1" type="button" id="brac1" value="(" style="height:20px" onClick="lbrac();" />
                  <input name="brac2" type="button" id="brac2" value=")" style="height:20px" onClick="rbrac();" />
                </div></td>
				  <?php
				  if(isset($_POST["qry"])){
				  $qry = $_POST["qry"];
				  }
				  
				  ?>
                <td><textarea name="qry" cols="90" rows="4"><?php if(!empty($qry)){ echo $qry;} ?></textarea></td>
                <td valign="bottom">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" valign="middle">&nbsp;</td>
                <!---<td width="65%" valign="middle">&nbsp;<div align="center"><div id='loadingmsg' style='display: none;'>
                    <div align="center">Processing, please wait......</div>
                  </div>
					<div id='loadingover' style='display: none;'></div>  </td>------>
                <td valign="bottom">&nbsp;Example: <small>[Gene]{ERG11} AND ([Species]{C. auris} OR [Species]{C. glabrata})</small></td>
              </tr>
            </table>
            <p align="center">
              <input type="submit" name="Submit" value="Submit" />
              <input name="Clear" type="button" id="Clear" value="Reset" onclick="clr();" />
            </p>
			<p align = "left">&nbsp;</p>
</form>
</td>
        </tr>
      </table></td>
    </tr>
</table>

<script language="javascript">
function addq() {
var add=document.form1.qry.value;
var term=document.form1.child.value;
var typ=document.form1.id_parent.value;

add=add+"["+typ+"]{"+term+"} ";
document.form1.qry.value=add;
document.form1.child.value="";
}

function clr() {
document.form1.qry.value="";
document.form1.parent.value="";
document.form1.child.value="";
}

</script>

<script language="javascript">
function addq() {
var add=document.form1.qry.value;
var term=document.form1.child.value;
var typ=document.form1.parent.value;

add=add+"["+typ+"]{"+term+"} ";
document.form1.qry.value=add;
document.form1.child.value="";
}
function op(opt) {
var add=document.form1.qry.value;
var op=opt;
add=add+op+" ";
document.form1.qry.value=add;
}

function lbrac() {
var add=document.form1.qry.value;
add=add+"(";
document.form1.qry.value=add;
}
function rbrac() {
var add=document.form1.qry.value;
add=add+")";
document.form1.qry.value=add;
}

</script>

<script language="JavaScript" type="text/javascript">
<!--
function checkform ( form )
{
  
   if(form.qry.value == "") {
    alert( "Please enter value." );
    return false ;
  }
   else
       {
             showLoading();
       }
}
//-->
</script>


	</div>
	
<?php
include("foot.php");
?>
</body>
</html>