<?php 
$id=$_REQUEST['id'];
include "../connect.php";
$result=mysql_query("SELECT * FROM strudb WHERE dbid ='$id'");
while($row = mysql_fetch_array($result))
{
	$dbid=$row['dbid'];
	$pdbId = $row['pdb_id'];
	$chainId = $row['chain_id'];
	$scopId = $row['scop_id'];
	$pfamAccession = $row['pfam_accession'];
	$structureTitle = $row['stru_title'];
	$pubmedId = $row['pubmed_id'];
	$source = $row['source'];
	$seq = $row['seq'];
	$seq = preg_replace('/\s+/','',$seq);
	$uniprotId = $row['db_id'];
	$seqSs = $row['seq_ss'];
	$cathDomain = $row['cath_domain'];
	$exp_method = $row['exp_method'];
	$resolution = $row['resolution'];
	$length = $row['length'];
	$activity = $row['activity'];
	$array = str_split($seq,60);
	$arlen=count($array);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Structure Details</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="Jmol.js"></script>
<style type="text/css">
	.headerFont {
		font-family: "Copperplate Gothic Bold";
		color: #4B6887;
		font-size: 24px;
	}
</style>
</head>
<body bgcolor="#556477">
<script type="text/javascript">jmolInitialize()</script>
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
            <tr>
					
					<td colspan="2" align="center" class="parahead"><?php echo $dbid;?></td>                                
			  </tr>
				<tr>
					<td align="right" width="208" bgcolor="#B9D6E6"><b>Title :</b></td>
					<td width="496" align="left"><?php echo $structureTitle;?></td>                                
				</tr>
                
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>PDB :</b></td>
					<td align="left"><?php echo "<a href=http://www.rcsb.org/pdb/search/structidSearch.do?structureId=".$pdbId." target=_blank>".$pdbId."</a>"; ?></td>
           	  </tr>
                            
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Chain  :</b></td>
					<td align="left"><?php echo $chainId;?></td>
           	  </tr>
				<?php 
				$pdbFile=$pdbId."."."pdb"; if(file_exists($pdbFile)){?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Structure :</b></td>
					<td align="center" colspan="2"><?php include("jsmol/jsmol/jsmol.php"); ?></td>
				</tr>
				<?php }?>
                <?php if ($source!=""){ ?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Source :</b></td>
					<td align="left"><?php echo $source;?></td>                                
				</tr>
                <?php }?>
                <?php if ($uniprotId!=""){ ?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>UniProt :</b></td>
					<td align="left"><?php echo "<a href=http://www.uniprot.org/uniprot/".$uniprotId." target=_blank>".$uniprotId."</a>"; ?></td>
           	  </tr>
                            <?php }?>
                            <?php if ($pubmedId!=""){ ?>
                                <tr>
					<td align="right" bgcolor="#B9D6E6"><b>PubMed :</b></td>
					<td align="left"><?php echo "<a href=http://www.ncbi.nlm.nih.gov/pubmed/?term=".$pubmedId." target=_blank>".$pubmedId."</a>"; ?></td>
                        	</tr>
                            <?php }?>
							<?php if ($exp_method!=""){ ?>
                                <tr>
					<td align="right" bgcolor="#B9D6E6"><b>Experimental Method :</b></td>
					<td align="left"><?php echo $exp_method; ?></td>
                        	</tr>
                            <?php }?>
				<?php if ($resolution!=""){ ?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Resolution :</b></td>
					<td align="left"><?php echo $resolution;?> A<sup>o</sup></td>
           	  </tr>
				<?php }?>
                
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Length :</b></td>
					<td align="left"><?php echo $length;?></td>
           	  </tr>
                            
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Activity :</b></td>
					<td align="left"><?php echo $activity;?></td>
           	  </tr>
                            <?php if ($scopId!=""){ 
							
							?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>SCOP :</b></td>
					<td align="left"><?php echo "<a href=http://scop.mrc-lmb.cam.ac.uk/scop/rsgen.cgi?chime=1;pd=".$pdbId.";pc=".$chainId." target=_blank >".$scopId."</a>";?></td>
           	  </tr>
                            <?php }?>
                            <?php if ($pfamAccession!=""){ ?>
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Pfam :</b></td>
					<td align="left"><?php echo "<a href=http://pfam.sanger.ac.uk/family/".$pfamAccession." target =_blank>".$pfamAccession."</a>";?></td>
           	  </tr>
                            <?php }
							
							$ai=0;
							if ($pdbId!=""){
							$rr=mysql_query("select distinct dbid from camp where pdbid like '%$pdbId%'");
							$cntr=mysql_num_rows($rr);
								while($rw1 = mysql_fetch_array($rr))
								{
									$dbid1 = $rw1['dbid'];
								if($ai==0)
								{
								$xa1="<a href=../seqDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
								}
								else
								{
								$xa1=$xa1.", <a href=../seqDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
								}
								
								$ai++;
								} 
								if($cntr >0)
								{
								?>
							
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Sequence database :</b></td>
					<td align="left"><?php echo $xa1;?></td>
           	  </tr>
                            <?php }}?>
                            <tr>
                
					<td align="right" bgcolor="#B9D6E6" class="linktextart" width="208"><b>Sequence :</b></td>
                   <td colspan="2" align="justify" class="fasta"><?php for($x=0;$x<$arlen;$x++){ echo $array[$x]; echo "<br>";}?></td>
				</tr>				
          </table>
                        
                        <table align="center" border="0" width="750">
				<tr bgcolor="#B9D6E6">
					<td align="left" class="linktextart"><b>Sequence With Secondary Structure Details</b></td>
					</tr>
                        </table>
                        <table align="center" border="0" width="750" bgcolor="#FFFFFF">
				<tr>
					<td align="center" width="600"><pre><?php echo $seqSs;?></pre>
					</td>								
				</tr>
				<tr>
					<td align="center">
					<?php $cha=explode( ',', $chainId ); 
					?>
					<img src="http://www.rcsb.org/pdb/explore/remediatedChain.do?structureId=<?php 
					
					echo $pdbId;?>&chainId=<?php echo $cha[0];?>"/>
					</td>
				</tr>
                        </table>
						<FORM>
  <div align="center">
    <INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);return true;"> 
  </div>
</FORM>
          </td>
	</tr>
</table>
</body>
</html>