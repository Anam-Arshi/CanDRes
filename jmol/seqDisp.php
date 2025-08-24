<?php 
error_reporting(0);
include "../connect.php";

?>
<?php	
		
		$id=$_REQUEST['id']; 
		
		$result=mysql_query("SELECT * FROM camp WHERE dbid='$id'");
while($row = mysql_fetch_array($result))
{
	$dbid=$row['dbid'];
	$name = $row['name'];
	$name=ltrim($name);
	$name=ucfirst($name);
	$gi = $row['gi'];
	$spid = $row['spid'];
	$pdbid = $row['pdbid'];
	$pubid = $row['pubid'];
	$comment = $row['comment'];
	$tax = $row['tax'];
	$species = $row['species'];
	$comname = $row['comname'];
	$taxclass = $row['taxclass'];
	$act = $row['act'];
	$gramnat = $row['gramnat'];
	$target = $row['target'];
	$hemoact = $row['hemoact'];
	$family=$row["family"]; 
	$valid = $row['valid'];
	$len = $row['len'];
	$sequence = $row['seq'];
	$apd = $row['apd'];
	$cid = $row['cid'];
	$bacbase = $row['bacbase'];
	$phytamp = $row['phytamp'];
	$array = str_split($seq,60);
	$arlen=count($array);	
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $name; ?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
<style type="text/css">
	.headerFont {
		font-family: "Copperplate Gothic Bold";
		color: #4B6887;
		font-size: 24px;
	}
body,td,th {
	font-size: 12pt;
}
.style1 {color: #663333}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>
<body bgcolor="#556477">
    <table align="center" width="810" border="0" bgcolor="#FFFFFF">
	    <tr bgcolor="#E6E6E6">
		<td>
		     <table align="center" width="810" height="110" border="0">
			<tr>
			    <td align="center" class="header"><img src="../img/header_n10.jpg" width="800" height="110" /></td>
			</tr>
		    </table>
		    <table align="center" width="810" border="0" height="20" >
			<tr>
			    <td align="center"><ul id="menu">
                <ul>
				    <li><a href="../index.php" class="drop1">Home</a></li>
				    <li><a href="#" class="drop">Databases&nbsp;&nbsp;</a>
					<div class="dropdown_2columns">
					    <div class="col_3">
						<ul>
						    <li><a href="../seqDb.php?page=0"><b>Sequences</b></a></li>
						    <li><a href="../strDb.php?page=0"><b>Structures</b></a></li>
						    <li><a href="../patDb.php?page=0"><b>Patents</b></a></li>
                             <li><a href="../signature.php"><b>Signatures</b></a></li>
						</ul>   
					    </div>           
					</div>
				    </li>
				    <li><a href="#" class="drop">Tools&nbsp;&nbsp; </a>
					<div class="dropdown_2columns">
					    <div class="col_2">
						<ul><li><a href="../prediction.php"><b>AMP Prediction</b></a></li>
						  
						    <li><a href="../ncbiBlast/"><b>BLAST</b></a></li>                                                              <li><a href="http://www.campsign.bicnirrh.res.in"><b>CAMPSign</b></a></li>
						    <li><a href="../clustal.php"><b>Clustal Omega</b></a></li>
						    <li><a href="../ncbiVast.php"><b>VAST</b></a></li>
						    
						     <li><a href="../pratt.php"><b>PRATT</b></a></li>
                            <li><a href="../scanprosite.php"><b>ScanProsite</b></a></li>
                            <li><div align="left"><a href="http://blast.ncbi.nlm.nih.gov/Blast.cgi?PROGRAM=blastp&PAGE_TYPE=BlastSearch" target="_blank"><b>PHI-BLAST</b></a></li>
                            <li><div align="left"><a href="http://hmmer.janelia.org/search/jackhmmer" target="_blank"><b>jackhmmer</b></a></li>
						       
						</ul>   
					    </div>           
					</div>
				    </li>
				    <li><a href="#" class="drop">Search&nbsp;&nbsp;</a>
                    <div class="dropdown_2columns">
					    <div class="col_2">
						<ul>
						    <li><a href="../dbSearch/seqSearch.php"><b>Sequence</b></a></li>
						    <li><a href="../dbSearch/strSearch.php"><b>Structure</b></a></li>                                                                <li><a href="../dbSearch/signSearch.php"><b>Signature</b></a></li>
                            <li><a href="../dbSearch/famSearch.php"><b>Family</b></a></li>
                            
						</ul>   
					    </div>           
					</div>
                    </li>
				    <li><a href="#" class="drop">Links&nbsp;&nbsp;</a>
					<div class="dropdown_2columns">
					    <div class="col_2">
						<ul>
						    <li><a href="../exLinks.php"><b>AMP Databases</b></a></li>
						    
						</ul>   
					    </div>           
					</div>
				    </li>
                    
				    <li><a href="../campHelp.php" class="drop1">Help</a></li> <li><a href="../dbStat.php" class="drop1">Statistics</a></li>                                                            <li><a href="../contactUs.php" class="drop1">Contact Us</a></li>
                    <li><a href="../aboutUs.php" class="drop1">About Us</a></li></ul>
			    </td>
			</tr>
		    </table>
           
			<table align="center" border="0" width="786" bgcolor="#FFFFFF" class="linktextart" cellpadding="10">
            
				<tr height="45">
								
                                <td colspan="2" align="center" class="parahead"><?php echo $dbid; ?></td>                                
			  </tr>
                
				<tr>
								<td width="162" align="right" valign="top"  bgcolor="#B9D6E6"><b>Title :</b></td>
                                <td width="578" align="left"><?php echo $name; ?></td>                                
			  </tr>
			    <?php if ($gi!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>GenInfo Identifier :</b></td>
                                <td align="left"><?php echo "<a href=http://www.ncbi.nlm.nih.gov/protein/".$gi." target=_blank>".$gi."</a>"; ?></td>
							</tr>
                            <?php }?>
                            <?php if ($species!=""){
							$species=ucfirst($species);
							if($comname!="")
							{$species=$species." [".$comname."]";} ?>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>Source :</b></td>
                                <td align="left"><?php echo "$species"; ?></td>                                
							</tr>
                            <?php }?>
                          
                            <?php if ($tax!="")
							{
							?>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>Taxonomy :</b></td>
                                <td align="left"><?php echo $tax;
								if($taxclass!=""){
								echo ", ".$taxclass; }?></td>
              </tr>
                                <?php }?>
								<?php 
								$quu="";
							unset($uprot);
                            if($spid=="")
		{}
		else
		{ $ii=0;
			$uprot=explode(",", $spid);
				foreach($uprot as $uniprot)
				{
					$uniprot=trim($uniprot);
					if ($ii==0)
					{
					$quu= "spid='$uniprot'";
					}
					else
					{
					$quu=$quu." OR spid='$uniprot'";
					}
					$ii++;
					}
					
								 $que=$res1=$cnt="";    
	
  								 $que="select DISTINCT tax_id from tax_id where ".$quu;
   //echo $que;
 								  $res1=mysql_query($que); 
 								  $cnt=mysql_num_rows($res1);
  									 if ($cnt>0)
 								  {
								
							
							?>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>NCBI Taxonomy :</b></td>
                                <td align="left"><?php 
								
								$ai=0;
								while($rw1 = mysql_fetch_array($res1))
								{
								$tax_id = $rw1['tax_id'];
								if($ai==0)
								{
								$ta="<a href=http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?lvl=0&id=".$tax_id." target=_blank>".$tax_id."</a>";
								}
								else
								{
								$ta=$ta.", <a href=http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?lvl=0&id=".$tax_id." target=_blank>".$tax_id."</a>";
								}
								
								$ai++;
								} 
								echo $ta;?>								</td>
              </tr>
                                <?php }}?>
                                <?php if ($spid!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>UniProt:</b></td>
                                <td align="left"><?php echo "<a href=http://www.uniprot.org/uniprot/".$spid." target=_blank>".$spid."</a>"; ?></td>
							</tr>
                            <?php }?>
                            <?php if ($pdbid!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>PDB:</b></td>
                                <td align="left"><?php 
								$pdb = explode(",", $pdbid);
								$ai=0;
								foreach($pdb as $pdb1)
								{
								if($ai==0)
								{
								$xa="<a href=http://www.rcsb.org/pdb/explore/explore.do?structureId=".$pdb1." target=_blank>".$pdb1."</a>";
								}
								else
								{
								$xa=$xa.", <a href=http://www.rcsb.org/pdb/explore/explore.do?structureId=".$pdb1." target=_blank>".$pdb1."</a>";
								}
								
								$ai++;
								} 
								echo $xa;?>							  </td>
							</tr>
                            <?php }?>
                            <?php if ($pdbid!=""){  $ai=0;
								foreach($pdb as $pdb2)
								{
								$rr=mysql_query("select distinct dbid from strudb where pdb_id = '$pdb2'");
								while($rw1 = mysql_fetch_array($rr))
								{
									$dbid1 = $rw1['dbid'];
								if($ai==0)
								{
								$xa1="<a href=jmol/jsmol/jsmol/strDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
								}
								else
								{
								$xa1=$xa1.", <a href=jmol/jsmol/jsmol/strDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
								}
								
								$ai++;
								} 
								}
								if($xa1!="")
								{
								?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Structure Database :</b></td>
                                <td align="left"> <?php echo $xa1;?></td>
							</tr>
                            <?php }}?>
                            <?php if ($pubid!=""){ ?>
                            <tr>
                            	<td align="right" valign="top"  bgcolor="#B9D6E6"><b>PubMed :</b></td>
                                <td align="left"><?php echo "<a href=http://www.ncbi.nlm.nih.gov/pubmed/?term=".$pubid." target=_blank>".$pubid."</a>"; ?></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Length :</b></td>
                                <td align="left"><?php echo $len; ?></td>
							</tr>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>Activity :</b></td>
                                <td align="left"><?php 
								
								$act1 = explode(",", $act);
								$ai=0;
								foreach($act1 as $act2)
								{
								if($ai==0)
								{$xa11=$act2;
								}
								else
								{
								$xa11=$xa11.", ".$act2;
								}
								$ai++;}
								echo $xa11; ?></td>                                
							</tr>
                            <?php if ($gramnat!=""){ ?>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>Gram Nature :</b></td>
                                <td align="left"><?php 
								
								$gramnat1 = explode(",", $gramnat);
								$ai=0;
								foreach($gramnat1 as $gramnat2)
								{
								if($ai==0)
								{$xa1=$gramnat2;
								}
								else
								{
								$xa1=$xa1.", ".$gramnat2;
								}
								$ai++;}
								echo $xa1; ?></td>
                            </tr>
                            <?php }?>
                            <?php if ($target!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Target :</b></td>
                                <td align="left"><?php echo $target; ?></td>
							</tr>
                            <?php }?>
                            <?php if ($hemoact!=""){ ?>
                            <tr>
								<td align="right" valign="top"  bgcolor="#B9D6E6"><b>Hemolytic Activity :</b></td>
                                <td align="left"><?php echo $hemoact; ?></td>
              </tr>
                                <?php }?>
                                <?php if ($valid!=""){ 
								
								$valid=ucfirst($valid);
								?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Validated :</b></td>
                                <td align="left"><?php echo $valid; ?></td>
							</tr>
                            <?php }?>
                            <?php if ($comment!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Comment :</b></td>
                            	<td align="left"><?php echo $comment; ?></td>
              </tr>
                                <?php }
								
		if($spid=="")
		{}
		else
		{ $ii=0;
			$uprot=explode(",", $spid);
				foreach($uprot as $uniprot)
				{
					$uniprot=trim($uniprot);
					if ($ii==0)
					{
					$quu= "spid='$uniprot'";
					}
					else
					{
					$quu=$quu." OR spid='$uniprot'";
					}
					$ii++;
					}
					
        

   $que="select DISTINCT(pfam), pfamID from pfam where ".$quu;
   $res1=mysql_query($que); 
   $cnt=mysql_num_rows($res1);
   if ($cnt>0)
   {
	?>
                                
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Pfam :</b></td>
                                <td align="left">
								
  
  


								
								<?php 
								
	while($row1=mysql_fetch_array($res1))	 
	{
         $pfam_ac=$row1["pfam"];
		  $pfam_ac=trim($pfam_ac);
		  $pfam_id=$row1["pfamID"];
	$res2=mysql_query("select * from pfamDesc where pfamAC='$pfam_ac'"); 
	if(mysql_num_rows($res2) >0)
	{
	while($row2=mysql_fetch_array($res2))	 
	{
			
			$descr=$row2["description"];
			 
			 ?>
  
  
    
   <?php echo "<a href=http://pfam.sanger.ac.uk/family/".$pfam_ac." target =_blank>".$pfam_ac."</a>"; ?>
    <?php echo ": ".$pfam_id; ?>
   <?php echo " ( ".$descr." )<br>"; ?>
  


        <?php
		
	}}
	else
	{
	  echo "<a href=http://pfam.sanger.ac.uk/family/".$pfam_ac." target =_blank>".$pfam_ac."</a>"; 
	    echo ": ".$pfam_id." <br>";
	}
	}
	
								?>							</td>
							</tr>
                              <?php }}
							$quu="";
							unset($uprot);
                            if($spid=="")
		{}
		else
		{ $ii=0;
			$uprot=explode(",", $spid);
				foreach($uprot as $uniprot)
				{
					$uniprot=trim($uniprot);
					if ($ii==0)
					{
					$quu= "spid='$uniprot'";
					}
					else
					{
					$quu=$quu." OR spid='$uniprot'";
					}
					$ii++;
					}
					
    $que=$res1=$cnt="";    
	
   $que="select DISTINCT ipr from ip where ".$quu;
   //echo $que;
   $res1=mysql_query($que); 
   $cnt=mysql_num_rows($res1);
   if ($cnt>0)
   {
	?>
                                
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>InterPro :</b></td>
                                <td align="left">
								
  
  


								
								<?php 
								
	while($row1=mysql_fetch_array($res1))	 
	{
	$interProId=$row1["ipr"];
	//echo "select DISTINCT id from ip where ipr='$interProId'";
	$res2=mysql_query("select DISTINCT id from ip where ipr='$interProId'"); 
	while($row2=mysql_fetch_array($res2))	 
	{
       
	
	$description=$row2["id"];
	   
	    echo "<a href=http://www.ebi.ac.uk/interpro/entry/".$interProId." target =_blank>".$interProId."</a>"; ?>
    <?php echo ": ".$description."<br>"; ?>
   
  


        <?php
		
	}}
								?>							</td>
							</tr>
                            <?php }}?>
							
							<?php if ($cid!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Signature ID :</b></td>
                                <td align="left"><?php echo $cid; ?></td>
							</tr>
                            <?php }?>
                            <?php if ($family!=""){ ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>AMP Family :</b></td>
                                <td align="left"><?php echo $family; ?></td>
							</tr>
                            <?php }?>
                            <?php 
														
							if($spid=="")
		{
		}
		else
		{ $ii=0;
			$uprot=explode(",", $spid);
				foreach($uprot as $uniprot)
				{
					$uniprot=trim($uniprot);
					if ($ii==0)
					{
					$quu= " spid='$uniprot'";
					}
					else
					{
					$quu=$quu." OR spid ='$uniprot'";
					}
					$ii++;
					}
					$cntt=0;
							$que="select * from go where ".$quu;
							
   							$rre=mysql_query($que); 
							
							$cntt=mysql_num_rows($rre);
							if($cntt >0)
							{
							 ?>
                            <tr>
                                <td align="right" valign="top"  bgcolor="#B9D6E6"><b>Gene Ontology :</b></td>
                                <td align="left">
								<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="20%" class="style1">GO ID</td>
    <td width="27%" class="style1">Ontology</td>
    <td width="38%" class="style1">Definition</td>
    <td width="15%" class="style1"><a href="http://www.geneontology.org/GO.evidence.shtml" target="_blank"><div class="style1">Evidence</div></a></td>
  </tr>
 

								<?php
								while($row11=mysql_fetch_array($rre))	 
								{
								$goid=$row11['goid'];
								$goid=trim($goid);
								$goid="GO:".$goid;
								$onto=$row11['onto'];
								$def=$row11['def'];
								$def=ucfirst($def);
								$evidence=$row11['evidence'];
								
								?>
								 <tr>
    							<td><?php echo "<a href=http://amigo.geneontology.org/cgi-bin/amigo/term_details?term=".$goid." target = _blank >".$goid."</a>"; ?></td>
   								 <td><?php echo $onto; ?></td>
   								 <td><?php echo $def; ?></td>
   								 <td><?php echo $evidence; ?></td>
 								 </tr>
								<?php
								
								}?>
								</table>								</td>
							</tr>
                            <?php }}?>
							
                            
              <?php              
                            
				if($sequence !='')
				{
				$res=mysql_query("select * from sequence where dbid ='$id'");
				while($row2=mysql_fetch_array($res))
	{
		$dataset=$row2['dataset'];
		if(($dataset == 'Pattern_family') or ($dataset == 'Pattern_fam_len'))
		{
		$areg=$row2['Antimicrobial_region'];
		}}
 
 ?>
  <tr>
    <td valign="top" bgcolor="#B9D6E6"><strong>Sequence:</strong></td>
    <td class="fasta"><?php 
	
	$sq=str_split($sequence);
	$arlen=count($sq);	
 if($areg=='')
 {
 for($x=0;$x<$arlen;$x++){
	 
	 $y=$x+1; echo $sq[$x]; if ($y%60==0) { echo "<br>"; }
 }
 }
 else
 {
	
	 $areg1=preg_replace('/[-]/', ',', $areg);
	
	 $pos=explode(",", $areg1);
	 $str=$pos[0];
	 $endd=$pos[1];
	 
	 $str=trim($str);
	 $endd=trim($endd);
	 for($x=0;$x<$arlen;$x++){
	 
	 $y=$x+1;
	 if($y==$str)
	 {
		 echo "<strong><font color='#E4431B'>";
	 }
	  echo $sq[$x]; if(($y%60)==0) {echo "<br>"; }
	  if($y==$endd)
	  {echo "</font></strong>";
	  }
 }
 }
	//echo $sequence;
	?></td>
  </tr><?php } ?>
          </table>          </td>
                            </tr>
	    <tr>
	      <td>     <FORM>
  <div align="center">
    <INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"> 
  </div>
</FORM>
	      </td>
  </tr>
</table>
</body>
</html>