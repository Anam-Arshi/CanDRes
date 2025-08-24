<?php 
$id=$_REQUEST['id'];

	$pdbId = $_REQUEST['pdb_id'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Structure Details</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="../../Jmol.js"></script>
<style type="text/css">
	.headerFont {
		font-family: "Copperplate Gothic Bold";
		color: #4B6887;
		font-size: 24px;
	}
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
<script type="text/javascript">jmolInitialize()</script>
<table bgcolor="#FFFFFF">
                
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>PDB :</b></td>
					<td align="left"><?php 
					$ppp = explode(",", $pdb_id);
					$xxa=0;
					foreach($ppp as $pdbId)
					{
						$pdbId=trim($pdbId);
						if ($xxa==0)
					{
					echo "<a href=http://www.rcsb.org/pdb/search/structidSearch.do?structureId=".$pdbId." target=_blank>".$pdbId."</a>"; }
					else
					{
						echo ", <a href=http://www.rcsb.org/pdb/search/structidSearch.do?structureId=".$pdbId." target=_blank>".$pdbId."</a>";
					}
					$xxa++; }?></td>
           	  </tr>
                            
				<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Chain  :</b></td>
					<td align="left"><?php echo $chainId;?></td>
           	  </tr>
				<?php 
				$pdbFile=$pdbId."."."pdb"; ?>
	<tr>
					<td align="right" bgcolor="#B9D6E6"><b>Structure :</b></td>
	  <td align="center" colspan="2"><?php include("jsmol.php"); ?></td>
				</tr>
				
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
								$xa1="<a href=../../../seqDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
								}
								else
								{
								$xa1=$xa1.", <a href=../../../seqDisp.php?id=".$dbid1." target=_blank>".$dbid1."</a>";
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