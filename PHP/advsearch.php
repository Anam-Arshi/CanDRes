<?php
session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Advanced search</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
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
	
</style>
</head>

<body>
<?php
include("header2.php");
?>
<main>
<?php
#SELECT state_ut, COUNT(state_ut) as cont FROM state_city GROUP BY state_ut;
include("connect.php");     $getsps = mysqli_query($conn, "select distinct species from sps_prevalence order by species ASC");
$cntsp = 0;
while($row=mysqli_fetch_array($getsps))
{
	$sp = $row["species"];
	if($cntsp==0){
	$spa = $sp;
	}
	else{
	$spa = $spa."|".$sp;	
	}
								
	$cntsp++;
}
	#echo $spa;

$getni = mysqli_query($conn, "select distinct niche from niche_infected where niche !='-' order by niche ASC");
$cntni = 0;
while($row1=mysqli_fetch_array($getni))
{
	$ni = $row1["niche"];
	if($cntni==0){
	$nia = $ni;
	}
	else{
	$nia = $nia."|".$ni;	
	}
								
	$cntni++;
}
	#echo $nia;

$getcan1 = mysqli_query($conn, "select distinct type_of_candidiasis from candidiasis where type_of_candidiasis !='-' order by type_of_candidiasis ASC");
$cntcan = 0;
while($rowcan=mysqli_fetch_array($getcan1))
{
	$can = $rowcan["type_of_candidiasis"];
	if($cntcan==0){
	$cana = $can;
	}
	else{
	$cana = $cana."|".$can;	
	}
								
	$cntcan++;
}
$getdr1 = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
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
$getst1 = mysqli_query($conn, "select distinct state_ut from state_city where state_ut !='' order by state_ut ASC");
$cntst = 0;
while($rowst=mysqli_fetch_array($getst1))
{
	$st = $rowst["state_ut"];
	if($cntst==0){
	$sta = $st;
	}
	else{
	$sta = $sta."|".$st;	
	}
								
	$cntst++;
}
	
$getstde = mysqli_query($conn, "select distinct Study_Design from study_design where Study_Design !='NA' order by Study_Design ASC");
$cntstde = 0;
while($rowstde=mysqli_fetch_array($getstde))
{
	$stde = $rowstde["Study_Design"];
	if($cntstde==0){
	$std = $stde;
	}
	else{
	$std = $std."|".$stde;	
	}
								
	$cntstde++;
}
$getye1 = mysqli_query($conn, "select distinct Year_of_Publication from data ORDER BY Year_of_Publication ASC");
$cntye = 0;
while($rowye=mysqli_fetch_array($getye1))
{
	$ye = $rowye["Year_of_Publication"];
	if($cntye==0){
	$yea = $ye;
	}
	else{
	$yea = $yea."|".$ye;	
	}
								
	$cntye++;
}

?>
<h3 align="center">Advanced search</h3>
<table id="tbl-advs" width="98%" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="white">
    <tr>
      <td><table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr align="center">
          <td valign="middle">
          
         
		    <form name="form1" method="post" action="advsearch1.php" onSubmit="return checkform(this);">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td height="61" colspan="3"><table width="968" align="center" id="dataTable" cellpadding="0" cellspacing="0">
                  
                    </table>
                    <table width="1066" align="center" id="dataTable" cellpadding="0" cellspacing="0">
                  <tr align="center">
                  <td width="117" height="38"></td>
                    <td width="376" valign="middle"><div align="right">
						
                      <select name="parent" style="width:250px;" id="id_parent" data-child-id="id_child" class="dependent-selects__parent">
						  <option value="">All fields</option>
                        <option value="Species_Prevalence" data-child-options="<?php echo $spa; ?>">Species</option>
                        <option value="Niche_Infected" data-child-options="<?php echo $nia; ?>">Niche</option>
                        <option value="Type_of_Candidiasis" data-child-options="<?php echo $cana; ?>">Candidiasis</option>
                        <option value="Antifungal_Susceptibility_Profile" data-child-options="<?php echo $dra; ?>">Antifungal drugs</option>
						 <option value="State_Union_Territories" data-child-options="<?php echo $sta; ?>">Location</option>
						  <option value="Study_Design" data-child-options="<?php echo $std; ?>">Study design</option>
						  <option value="Year_of_Publication" data-child-options="<?php echo $yea; ?>">Year</option>
						</select>
                    </div></td>
                    <td width="290" valign="middle"><div align="center" class="select2-selection--single">
                      <!--<input name="trm1" type="text" id="tm" placeholder="Keyword" style="height:20px"/>-->
						<select name="child" id="id_child" style="width:200px;" class="dependent-selects__child" data-text-if-parent-empty="Select field">
						<option value="">---</option>
						<?php
						$getspsa = mysqli_query($conn, "select distinct species from sps_prevalence order by species ASC");
							while($rowsp=mysqli_fetch_array($getspsa))
							{
						    
								?>
							<option value="<?php echo $rowsp["species"]; ?>"><?php echo $rowsp["species"]; ?></option>
							<?php
							}
							
							$getnia = mysqli_query($conn, "select distinct niche from niche_infected where niche !='-' order by niche ASC");
							while($rowni=mysqli_fetch_array($getnia))
							{
								?>
							<option value="<?php echo $rowni["niche"]; ?>"><?php echo $rowni["niche"]; ?></option>
							<?php
							}
							
							$getcan = mysqli_query($conn, "select distinct type_of_candidiasis from candidiasis where type_of_candidiasis !='-' order by type_of_candidiasis ASC");
							while($row2=mysqli_fetch_array($getcan))
							{
								?>
							<option value="<?php echo $row2["type_of_candidiasis"]; ?>"><?php echo $row2["type_of_candidiasis"]; ?></option>
							<?php
							}
							$getdr = mysqli_query($conn, "select distinct Drug from asp where Drug !='Highly sensitive to Clotrimazole, Fluconazole, Itraconazole' AND Drug NOT LIKE '%+%' order by Drug ASC");
							while($row3=mysqli_fetch_array($getdr))
							{
								?>
							<option value="<?php echo $row3["Drug"]; ?>"><?php echo $row3["Drug"]; ?></option>
							<?php
							}
							
							$getst = mysqli_query($conn, "select distinct state_ut from state_city where state_ut !='' order by state_ut ASC");
							while($row4=mysqli_fetch_array($getst))
							{
								?>
							<option value="<?php echo $row4["state_ut"]; ?>"><?php echo $row4["state_ut"]; ?></option>
							<?php
							}
							
							$get_stde = mysqli_query($conn, "select distinct Study_Design from study_design where Study_Design !='NA' order by Study_Design ASC");
							while($row5=mysqli_fetch_array($get_stde))
							{
								?>
							<option value="<?php echo $row5["Study_Design"]; ?>"><?php echo $row5["Study_Design"]; ?></option>
							<?php
							}
							
							$getye = mysqli_query($conn, "select distinct Year_of_Publication from data ORDER BY Year_of_Publication ASC");
							while($row6=mysqli_fetch_array($getye))
							{
								?>
							<option value="<?php echo $row6["Year_of_Publication"]; ?>"><?php echo $row6["Year_of_Publication"]; ?></option>
							<?php
							}

						?>
						
						</select>
						<script src='dependent-selects-master/dependent-selects.js'></script>
                    </div></td>
                    <td width="262" valign="middle"><button name="Add" value="Add" onClick="addq();" type="button" style="height:30px" ><i class="fa fa-plus"></i></button></td>
                  </tr>
                </table></td>
                <td width="14%" valign="bottom"><div align="left">
                  <?php //<INPUT type="button" value="Add" onClick="addRow('dataTable')" /><INPUT type="button" value="Delete" onClick="deleteRow('dataTable')" /> ?>
                  
                  
                </td>
              </tr>
              <tr>
                <td width="5%" height="52">&nbsp;</td>
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
                <td width="65%" valign="middle">&nbsp;<div align="center"><div id='loadingmsg' style='display: none;'>
                    <div align="center">Processing, please wait......</div>
                  </div>
					<div id='loadingover' style='display: none;'></div>  </td>
                <td valign="bottom">&nbsp;</td>
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
</main>
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
<script>
function showLoading() {
    document.getElementById('loadingmsg').style.display = 'block';
    document.getElementById('loadingover').style.display = 'block';
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
<?php

include("footer.php");
?>
</body>
</html>