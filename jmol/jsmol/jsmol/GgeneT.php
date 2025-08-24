<?php 
#error_reporting(0); 
$colr = array("#CC0000", "#00CC00", "#0000CC", "#ff00ff", "#808000", "#600080", "#006080", "#612D21", "#9FAD15", "#6F7C66", "#842C71 ", "#FF5733", "#A70303", "#098EC1", "#59b300", "#996633", "#806000");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8" />
<title>GeDiPNet
</title>
<script src="../../../SpryAssets/SpryMenuBar.js" type="text/javascript">
function goToNewPage()
    {
        var url = document.getElementById('list').value;
        if(url != 'none') {
            window.location = url;
        }
    }
</script>
<link href="../../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../../../css/style.css">
<style>
body { background-color: #DFDFDF; }

p{
  text-align: Center;
  font-family: Verdana;
  }
#wrapper {
  display: flex;
  background:#ffffff;
   height: 135px;
}

#left {
  flex: 0 0 30%;
  
}

#right {
  flex: 1;
}
</style>
<script>

function toggle(thisname) {
tr=document.getElementsByTagName('tr')
for (i=0;i<tr.length;i++){
if (tr[i].getAttribute(thisname)){
if ( tr[i].style.display=='none' ){
tr[i].style.display = '';
}
else {
tr[i].style.display = 'none';
}
}
}
}

</script>
</head>

<body>


<table width="1100" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#FFFFFF"><div align="center"><img src="../../../img/head11.jpg" width="670" height="111" />
      
      
      
      
      
      
      
    </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#01415f">
    <td colspan="3"><ul id="MenuBar1" class="MenuBarHorizontal">
	<li><a href="../../../index.php">Home</a></li>
	<li><a  href="../../../advanced.php">Search</a></li>
        
      <li><a class="MenuBarItemSubmenu" href="#">Browse</a>
        <ul>
          <li><a  href="../../../gene.php">Genes</a>
          </li>
          <li><a  href="../../../Disease.php">Diseases</a></li>
          <li><a href="#">Pathways</a>
<ul>
<li><a href="../../../Pathway.php">Reactome</a></li>
<li><a href="../../../kegg.php">KEGG</a></li>
</ul>
</li>
        </ul>
      </li>
    
     <li><a href="../../../analysis.php">Analysis</a></li>
      <li><a href="../../../stats.php">Statistics</a></li>
	  <li><a href="../../../help.php">Help</a></li>
	  <li><a href="../../../link.php">Links</a></li>
    </ul></td>
  </tr> 
</table>
    </td>
  </tr>
  <tr bgcolor="#ffffff"><td height="248"><?php
//echo "This is test"."<br>";

include("../../../connect.php");
//echo "Connected successfully"."<br>";
$gi=$_REQUEST["GI"];
$gens=$_REQUEST["gens"];
if($gi==0)
{
	$q1 = "SELECT GeneID, GeneName, Symbol, Synonyms, chromosome, map_location, summary, other_ids FROM `gene_information`  where Symbol='$gens'";
	}
else
{
$q1 = "SELECT GeneID, GeneName, Symbol, Synonyms, chromosome, map_location, summary, other_ids FROM `gene_information`  where GeneID='$gi'";
}
//echo $q1;
if($result = mysqli_query($conn, $q1)){ 
//echo "This is a bye!";
    if(mysqli_num_rows($result) > 0){ 
 while ($row = mysqli_fetch_array($result)) {
  ?>
      <table width="95%" border="0" cellspacing="3" cellpadding="6" align="center">
        <tr>
          <td bgcolor="#c6ebc6" align="center" colspan="2"><strong>Gene Information</strong></td>
        </tr>
        <tr>
          <td width="20%" bgcolor="#CCFFFF"><strong>Entrez ID</strong></td>
          <td width="78%"><?php $GeneID = $row['GeneID']; ?>
            <a href="https://www.ncbi.nlm.nih.gov/gene/<?php echo $GeneID ; ?>" target="_blank">
              <?php   echo $GeneID; ?>
            </a></td>
          <?php
 $pathw=mysqli_query($conn, "select pathwayid, pathwayname from kegg_path where entrezid='$GeneID'");
$kegg_nu=mysqli_num_rows($pathw);
$pathr=mysqli_query($conn, "select * from reactome where entrezid='$GeneID'");
$rect_nu=mysqli_num_rows($pathr); 
				$diseasen=mysqli_query($conn, "select distinct disease_merge from disease_gdp where geneId='$GeneID'");
				$dsn=mysqli_num_rows($diseasen);
				  ?>
        </tr>
        <?php 
  $GeneName = $row['GeneName']; 
  if($GeneName=="")
  {}
  else
  {
  ?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>Gene Name</strong></td>
          <td><?php 
			 echo ucfirst($GeneName); ?></td>
        </tr>
        <?php }
  $Symbol = $row['Symbol']; 
  if($Symbol=="")
  {}
  else
  {
  ?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>Gene Symbol</strong></td>
          <td><?php 
			 echo $Symbol; ?></td>
        </tr>
        <?php }
   $Synonyms = $row['Synonyms']; 
   $Synonyms=preg_replace('/[|]/', ', ', $Synonyms);
   if($Synonyms =="")
   {}
   else
   {
   ?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>Synonyms</strong></td>
          <td><?php 
			 echo $Synonyms; ?></td>
        </tr>
        <?php }
	$chromosome = $row['chromosome']; 
	if($chromosome=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>Chromosome</strong></td>
          <td><?php 
			 echo $chromosome; ?></td>
        </tr>
        <?php }
    $c_loc = $row['map_location']; 
	if($c_loc=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>Chromosome Location</strong></td>
          <td><?php 
			 echo $c_loc; ?></td>
        </tr>
        <?php
  }
 
	 $summary = $row['summary'];
	 if($summary=="")
	 {}
	 else
	 {
	 ?>
        <tr>
          <td bgcolor="#CCFFFF" ><strong>Summary</strong></td>
          <td align = "justify"><?php  
			 echo $summary; ?></td>
          <td width="2%"></td>
         
        </tr>
       
        <?php }
		$snpsq = "SELECT * FROM dbsnp_data WHERE GeneID = '$GeneID'";
                if ($resultsnp = mysqli_query($conn, $snpsq)) {
                	$snpno = mysqli_num_rows($resultsnp);
                	if($snpno > 0){ 
				
				$snoi=0;
		?>
        
        <tr>
          <td colspan="2" bgcolor="#c6ebc6" align="center"><strong>SNP</strong></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right" onclick="toggle('snpin');"> <a href="#snp">Show/Hide all(<?php echo $snpno; ?></a>)</div>
            <table width="95%" border="0" align="right" cellpadding="4" cellspacing="1">
              <tr>
                <td width="12%"><strong>SNP ID</strong></td>
                <td width="16%"><strong>Variation</strong></td>
                <td width="30%"><strong>Clinical Significance</strong></td>
                <td width="42%"><strong>Consequence</strong></td>
              </tr>
              <?php while ($rws1 = mysqli_fetch_array($resultsnp)) { ?>
              <tr <?php if($snoi > 4) echo "snpin=fred id='hidethis'style='display:none'";?> >
                <td valign="top" ><?php $snp_id=""; $snp_id=$rws1["snp_id"];
				  
				  echo "<a href='https://www.ncbi.nlm.nih.gov/snp/$snp_id' target = '_blank'>$snp_id</a>"; ?></td>
                <td valign="top"><?php $variation=$rws1["variation"];
					
					echo $variation; ?></td>
                <td valign="top"><?php $clinical_significance=$rws1["clinical_significance"];
					$clinical_significance=ucfirst($clinical_significance);
	$clinical_significance=preg_replace('/[;]/', ', ', $clinical_significance);
	$clinical_significance=preg_replace('/[_]/', ' ', $clinical_significance);
					echo $clinical_significance; ?></td>
                <td valign="top"><?php $function_class = $rws1["function_class"]; 
				$function_class=ucfirst($function_class);
	$function_class=preg_replace('/[;]/', ', ', $function_class);
	$function_class=preg_replace('/[_]/', ' ', $function_class);
					echo $function_class; 
				?></td>
              </tr>
              <?php $snoi++; } ?>
            </table>
            </td>
        </tr>
        
        <?php }}

                $qgo = "SELECT * FROM gene2go WHERE GeneID = '$gi'";
                if ($resultgo = mysqli_query($conn, $qgo)) {
                	$gon = mysqli_num_rows($resultgo);
                	if($gon > 0){ 
				
				$goi=0;
			
	?>
        <tr>
          <td colspan="2" bgcolor="#c6ebc6" align="center"><strong>Gene Ontology (GO)</strong></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right" onclick="toggle('goin');"> <a href="#go">Show/Hide all(<?php echo $gon; ?></a>)</div>
            <table width="95%" border="0" align="right" cellpadding="4" cellspacing="1">
              <tr>
                <td width="11%"><strong>GO ID</strong></td>
                <td width="22%"><strong>Ontology</strong></td>
                <td width="40%"><strong>Definition</strong></td>
                <td width="11%"><strong>Evidence</strong></td>
                <td width="16%"><strong>Reference</strong></td>
              </tr>
              <?php while ($rw1 = mysqli_fetch_array($resultgo)) { ?>
              <tr <?php if($goi > 4) echo "goin=fred id='hidethis'style='display:none'";?> >
                <td valign="top" ><?php $go_id=""; $go_id=$rw1["GO_ID"];
				  
				  echo "<a href='http://amigo.geneontology.org/amigo/term/$go_id' target = '_blank'>$go_id</a>"; ?></td>
                <td valign="top"><?php $go_typ=$rw1["Category"];
					$go_typ=ucfirst($go_typ);
					echo $go_typ; ?></td>
                <td valign="top"><?php $go_fun=$rw1["GO_term"];
					$go_fun=ucfirst($go_fun);
					echo $go_fun; ?></td>
                <td valign="top"><?php echo $rw1["Evidence"]; ?></td>
                <td valign="top"><?php $go_pmid="";
					$go_pmid=$rw1["PubMed"]; 
					//$go_pmid = str_replace (" ", "", $go_pmid);
			 $go_pmid1="";
			$go_pmid1=explode("|", $go_pmid);
			$xi=0;
			$go_pp="";
			foreach($go_pmid1 as $go_pmid11)
			{$go_pmid11=trim($go_pmid11);
			settype($go_pmid11, "integer");
			if($go_pmid11 >0)
			{
			if($xi == 0)
			{
			$go_pp = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$go_pmid11'  target='_blank'>".$go_pmid11."</a>";
			
			}
			else
			{
			$go_pp=$go_pp.", <a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$go_pmid11' target='_blank'>".$go_pmid11."</a>";
			}$xi++;
			}}
			echo $go_pp;?></td>
              </tr>
              <?php $goi++; } ?>
            </table>
            </td>
        </tr>
        <?php }} ?>
        <?php $other_ids = $row['other_ids']; 
  
  $oth1=preg_split('/[|]/', $other_ids);
  $mim=$oth1[0];
  $hgnc=$oth1[1];
	$enn=$oth1[2];  
   ?>
        <tr>
          <td colspan="2" bgcolor="#c6ebc6" align="center" ><strong>Other IDs</strong></td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%" border="0" cellspacing="5" cellpadding="5" align="center">
            <tr>
              <td bgcolor="#CCFFFF" width="33%"><strong>MIM</strong></td>
              <td bgcolor="#CCFFFF" width="33%"><strong>HGNC </strong></td>
              <td bgcolor="#CCFFFF"  width="33%"><em> <strong>e<font color="#FF0000">!</font>Ensembl </strong></em></td>
            </tr>
            <tr>
              <td><?php 
	 $mimi=preg_split('/[:]/', $mim);
	  ?>
                <a href="https://www.omim.org/entry/<?php echo $mimi[1]; ?>" target="_blank"><?php echo $mimi[1]; ?></a></td>
              <td><?php 
	$hgnci=preg_split('/[:]/', $hgnc);
	?>
                <a href="https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/HGNC:<?php echo $hgnci[2] ?>" target="_blank"><?php echo $hgnci[2]; ?></a></td>
              <td><?php 
	
	$en1=preg_split('/[:]/', $enn);

	?>
                <a href="http://asia.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=<?php echo $en1[1]; ?>" target="_blank"><?php echo $en1[1]; ?></a></td>
            </tr>
          </table></td>
        </tr>
        <?php 


$q8 = "SELECT * FROM human_uniprot where GeneID='$gi'";

//echo $q1;
if($result8 = mysqli_query($conn, $q8)){ 
//echo "This is a bye!";
//echo "$result8";
 if(mysqli_num_rows($result8) > 0){ 
 
 ?>
        <tr>
          <td colspan="2" bgcolor="#c6ebc6" align="left" height="25%"><strong>Protein Information</strong></td>
        </tr>
        <?php
 while ($row8 = mysqli_fetch_array($result8)) {
 
	$Entry = $row8['Entry']; 
	if($Entry=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>UniProt ID</strong></td>
          <td><a href="https://www.uniprot.org/uniprot/<?php echo $Entry; ?>" target="_blank">
            <?php  echo $Entry; ?>
          </a></td>
        </tr>
        <?php }
	$Proteinnames = $row8['Proteinnames'];
	if(	$Proteinnames=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>Protein Name</strong></td>
          <td><?php  
			 echo $Proteinnames; ?></td>
        </tr>
        <?php }
	$STRING = $row8['STRING'];
	$ensembl_prot = array();
	$ensembl_prot = explode(".", $STRING);
	if($STRING=="")
	{}
	else
	{
	?>
        <?php }
	
   $PubMed_ID1 = $row8['PubMed_ID'];
   $PubMed_ID = preg_split('/[;]/', $PubMed_ID1);
	if($PubMed_ID=="")
	{}
	else
	{ ?>
        <?php } 
	$KEGG = $row8['KEGG'];
	if($KEGG=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>KEGG</strong></td>
          <td><a href="https://www.genome.jp/dbget-bin/www_bget?<?php echo $KEGG ; ?>" target="_blank">
            <?php  echo $KEGG ; ?>
          </a></td>
        </tr>
        <?php }
	$Function = $row8['Function'];
	if( $Function=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>Protein function</strong></td>
          <td align = "justify"><?php $Function = preg_replace('/{(.*?)}./', '', $Function);
			 echo $Function; ?></td>
        </tr>
        <?php }
	$Interacts_with = $row8['Interacts_with']; 
	if($Interacts_with=="")
	{}
	else
	{
			  ?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>Interactions</strong></td>
          <td align = "justify"><?php echo $Interacts_with; ?></td>
        </tr>
        <?php } 
	$PDB1 = $row8['PDB'];
	$PDB=preg_split('/[;]/', $PDB1); 
	if($PDB1=="")
	{}
	else
	{
	?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>PDB</strong></td>
          <td align = "justify"><?php 
	$dfb=0;
	foreach($PDB as $valueb)
	{ 
	if($dfb==0)
	{
	?>
            <a href="https://www.rcsb.org/structure/<?php echo $valueb; ?>" target="_blank">
              <?php  echo $valueb; ?>
            </a>
            <?php }
	else
	{ ?>
            , <a href="https://www.rcsb.org/structure/<?php echo $valueb; ?>" target="_blank">
              <?php  echo $valueb; ?>
              </a>
            <?php } $dfb++; } }?></td>
        </tr>
       
        
        <tr>
          <td colspan="2" valign="top" bgcolor="#ffffff">
          <table border="0" cellspacing="0" cellpadding="3" align="center">
            <tr><?php 
	$dfnm=0;
	global $pdbb; 
	foreach($PDB as $pdbb)
	{  echo "<td>";
	include("../../../jsmol.php");
	if($dfnm%3==0)
	{echo "</td></tr><tr>";
	}
	else
	{
		echo "</td>";
	}
	$dfnm++;
	}
	?>
              
            </tr>
          </table></td>
        </tr>
        <?php }
	
	?>
        <tr>
          <td valign="top" bgcolor="#CCFFFF"><strong>Family and Domains</strong></td>
          <td align = "left">
          <?php 
		  //echo "select * from pfamdata where entrezid='$GeneID'";
		  $upsq=mysqli_query($conn, "select sequence, length from uniprot_protein_sequence where entry ='$Entry'");
		   if(mysqli_num_rows($upsq) > 0){
	while($roseq = mysqli_fetch_array($upsq)) {
		$seq=$roseq['sequence'];
		$seq_len=$roseq['length'];
	}
	      $sequ = str_split($seq);
		  $rpfm=mysqli_query($conn, "select * from pfam where seq_id='$Entry' GROUP BY envelop_start, hmm_acc");
		   if(mysqli_num_rows($rpfm) > 0){ 
		  ?>
          <p align="justify"><strong>Pfam</strong></p>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="21%" align="center"><strong>Accession</strong></td>
              <td width="5%" align="center"><strong>ID</strong></td>
              <td width="26%" align="center"><strong>Position in sequence</strong></td>
              <td width="37%" align="center"><strong>Description</strong></td>
              <td width="11%" align="center"><strong>Type</strong></td>
            </tr>
            <?php  $awe=0;
			$col="";
			while($ropfam = mysqli_fetch_array($rpfm)) {
				$col=$colr[$awe];
				$str=$ropfam['envelop_start']-1;
			  $end=$ropfam['envelop_end']-1; ?>
            <tr>
              <td align="center"><a name="<?php echo $str; ?>"></a> <a href="http://pfam.xfam.org/family/<?php echo $ropfam['hmm_acc']; ?>" target="_blank"><font color='<?php echo $col; ?>'><?php echo $ropfam['hmm_acc']; ?></font></a></td>
              <td align="center"><?php echo $ropfam['hmm_name']; ?></td>
              <td align="center"><div align="center"><?php 
			  
			  echo $ropfam['envelop_start']; ?> <strong>&rarr;</strong> <?php echo $ropfam['envelop_end']; ?></div></td>
              <td align="center"><?php echo $ropfam['description']; ?></td>
              <td align="center"><?php echo $ropfam['type']; ?></td>
            </tr>
            <?php 
			$sequ[$str]="<a href='#$str'><strong><font color='".$col."'>".$sequ[$str];
			$sequ[$end]=$sequ[$end]."</font></strong></a>";
			$awe++;} ?>
          </table>
          <?php } ?>
          </td>
        </tr>
        <?php 
		$Tissue_specificity = $row8['Tissue_specificity'];
	if($Tissue_specificity=="")
	{}
	else
	{?>
        <tr>
          <td bgcolor="#CCFFFF" width="20%"><strong>Tissue Specificity</strong></td>
          <td align = "justify"><?php  echo $Tissue_specificity; ?></td>
        </tr>
        <?php }
		
		
	
	?>
        
          <td bgcolor="#CCFFFF" valign="top"><strong>Sequence</strong></td>
          <td align = "justify"><?php 
		  
		  
		  //echo $seq;
		  ?>
          <table border=0 align="left" cellpadding="1" cellspacing="0">
    <tr>
      <td width="154"><div align="justify">
        <pre><?php 
			
			$j=60;
			$i=0;
			foreach ($sequ as $ns)
			{
			$i++;
			if($ns != " ")
			{  echo "$ns";   }
				if($i == $j)
				{
				echo "<br>";
				$j=$j+60;
				}
			}
			?>
</pre>
      </div></td>
    </tr>
  </table>
           </td>
        </tr>
        <tr>
          <td bgcolor="#CCFFFF" valign="top"><strong>Sequence Length</strong></td>
          <td align = "justify"><?php echo $seq_len; ?> amino acid</td>
        </tr>
        <tr>
          <td bgcolor="#CCFFFF"><strong>PTM's</strong></td>
          <td align = "justify"><?php  echo $ptm; ?></td>
        </tr>
      
        <?php }}
 
 if(($kegg_nu > 0) OR ($rect_nu > 0))
{ ?>
         <tr>
          <td colspan="2" bgcolor="#c6ebc6"><div align="justify" class="style37"><strong><a name="path" id="path"> </a>Pathways</strong></div></td>
        </tr> <tr>
          <td colspan="2"><table width="97%" align="center" cellpadding="6">
            <tr>
              <td width="14%" height="33" class="style14">&nbsp;</td>
              <?php 
			   
			   if($kegg_nu > 0)
			   {
			  ?>
              <td width="38%" class="style14"><div align="justify"> <strong><span onmouseover="tooltip.show('KEGG Pathway');" onmouseout="tooltip.hide();">KEGG</span></strong></div></td>
              <td width="6%" class="style14">&nbsp;</td>
              <?php }
				 
			   if($rect_nu > 0)
			   {
				?>
              <td width="42%" class="style14"><div align="justify"><strong>Reactome</strong></div></td>
              <?php } ?>
            </tr>
            <tr>
              <td class="style14">&nbsp;</td>
              <td valign="top" align="left"><span class="style14">
                <?php 
			 $xi=0; 
  while($kpat=mysqli_fetch_array($pathw))
  {
  $path_acc=$kpat["pathwayid"];
  $path_nam=$kpat["pathwayname"];
			 if($xi == 0)
			{
			$kmid = "<a href='http://www.genome.jp/dbget-bin/show_pathway?$path_acc+$gnen_id' target='_blank'>$path_nam</a>";
			}
			else
			{
			$kmid=$kmid."<br><a href='http://www.genome.jp/dbget-bin/show_pathway?$path_acc+$gnen_id' target='_blank'>$path_nam</a>";
			}$xi++;
			}
			echo $kmid; ?>
                </span></td>
              <td class="style14" valign="top">&nbsp;</td>
              <td valign="top"><?php 
			  $kmid ="";
			  //echo "select * from reactome where entrezid='$gnen_id'";
			 
			 $xi=0; 
  while($rpat=mysqli_fetch_array($pathr))
  {
  $path_acc=$rpat["pathwayid"];
  $path_nam=$rpat["pathwayname"];
			 if($xi == 0)
			{
			$kmid = "<a href='https://reactome.org/content/detail/$path_acc' target='_blank'>$path_nam</a>";
			}
			else
			{
			$kmid=$kmid."<br><a href='https://reactome.org/content/detail/$path_acc' target='_blank'>$path_nam</a>";
			}$xi++;
			}
			echo $kmid; ?></td>
            </tr>
          </table></td>
        </tr>
        <?php } if($dsn > 0)
				{ 
			  ?>
        <tr>
          <td colspan="3" bgcolor="#c6ebc6" align="left"> <strong> <a name="ass_d" id="ass_d"> </a>Associated Diseases</strong></td>
        </tr>
        <tr>
          <td colspan="3"><div align="right" onclick="toggle('adi');"> <a href="#ass_d">Show/Hide all(<?php echo $dsn; ?></a>)</div>
            <table width="100%" border="0" cellpadding="4" cellspacing="0">
              <tr class="style2">
                <td width="25%"><strong>Disease group</strong></td>
                <td width="26%"><strong>Disease Name</strong></td>
                <td width="49%"><strong>References</strong></td>
              </tr>
              <?php 
			  	$dssa=mysqli_num_rows($diseasen);
			  while($row1=mysqli_fetch_array($diseasen))
	{ $par = $row1["disease_merge"];
	$parn=mysqli_query($conn, "select distinct diseaseName from disease_gdp where geneId='$gi' and disease_merge='$par'");
	$dsp=mysqli_num_rows($parn);
	 ?>
              <tr <?php if($dii > 4) echo "adi=fred id='hidethis'style='display:none'";?> <?php if($dii%2 == 0){ ?>bgcolor="#FFFFE8" <?php }
		else{ ?>bgcolor="#FFFFFF" <?php }?>>
                <td rowspan="<?php echo $dsp+1; ?>" valign="top"><?php echo $par; ?></td>
              </tr>
              <?php 
	  if($dsp > 0)
	  {
		  while($rowmr=mysqli_fetch_array($parn))
	{ $disease_merge = $rowmr["diseaseName"];
	//echo $disease_merge;
	//echo "select pmid from disease_tertiary where disease_merge ='$disease_merge' and geneId='$gene_n' and parent='$par'";
	
	
	  ?>
              <tr <?php if($dii > 4) echo "adi=fred id='hidethis'style='display:none'";?> <?php if($dii%2 == 0){ ?>bgcolor="#FFFFE8" <?php }
		else{ ?>bgcolor="#FFFFFF" <?php }?>>
                <td width="25%" valign="top">&nbsp;<?php echo $disease_merge; ?></td>
                <td width="26%" valign="top"><div align="justify">
                  <?php 
		$pmdm=$pmmidd="";
		$pcntt = 0;
		//echo "select pmid from disease_tertiary where disease_merge ='$disease_merge' and geneId='$gene_n' and parent='$par'";
	$pmidd=mysqli_query($conn, "select pmid from disease_gdp where diseaseName ='$disease_merge' and geneId='$gi' and disease_merge='$par'");
	while($rowp=mysqli_fetch_array($pmidd))
	{ $pmmidd = $rowp["pmid"];
	
	if($pcntt == 0)
	{
		$pmdm=$pmmidd;
		
	}
	else
	{
	$pmdm=$pmdm.",".$pmmidd;
	}
	
	$pcntt++;
	}
	$xsd=0;
		$dp_pp="";
		$disease_pmd1="";
		
		$disease_pmid1=explode(",", $pmdm);
		//print_r($disease_pmd1);
		$disease_pmid1=array_unique($disease_pmid1);
			$xqi=0;
			$disease_pmid2="";
			$dp_pp="";
			foreach($disease_pmid1 as $disease_pmid2)
			{$disease_pmid2=trim($disease_pmid2);
			
			if($disease_pmid2 >0)
			{
			if($xqi == 0)
			{
			$dp_pp = "<a href='https://pubmed.ncbi.nlm.nih.gov/$disease_pmid2/'  target='_blank'>".$disease_pmid2."</a>";
			}
			else
			{
			$dp_pp=$dp_pp.", <a href='https://pubmed.ncbi.nlm.nih.gov/$disease_pmid2/' target='_blank'>".$disease_pmid2."</a>";
			}$xqi++;
			}
			
			
			}
			echo "</strong> $dp_pp";
	//echo $pmdm;
		
			  //echo $pubmed_disease_pr_ref;
			   ?>
                </div></td>
              </tr>
              <?php $dii++;
			
				}}}?>
            </table></td>
        </tr>
        <?php  }
			$OmimIDs= $row15['OmimIDs'];
	if( $OmimIDs=="")
	{}
	else
	{
	 ?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>OMIM IDs</strong></td>
          <td><?php 
	echo $OmimIDs; ?></td>
        </tr>
        <?php
	 }
	$PubMedIDs= $row15['PubMedIDs'];
	if( $PubMedIDs=="")
	{}
	else
	{
	$PubMedIDs=explode('|', $PubMedIDs);
	foreach($PubMedIDs as $bs1)

			?>
        <tr>
          <td bgcolor="#CCFFFF"><strong>PubMed IDs </strong></td>
          <td align='justify'><a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $bs1; ?>" target="_blank"><?php echo $bs1; ?></a></td>
        </tr>
        <?php }
			//$source= $row15['source'];
	/*if( $source=="")
	{}
	else
	{}*/
	 ?>
        <?php }
		 ?>
        <?php 
		 }}?>
      </table>
      <?php
}
?>
      <p></p>
  <td align="left">
 
  
  


  </td></tr>
  <tr bgcolor="#C0E3ED" height="100">
    <td><p align="center" class="style13"><small>
     | &copy; 2021,  Biomedical Informatics Centre, NIRRH |<br/>
    ICMR-National Institute for Research in Reproductive Health, Jehangir Merwanji Street, Parel, Mumbai-400012<br>
    Tel: +91-22-24192104, Fax No: +91-22-24139412</small></p></td>
  </tr>
</table>


<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<script src='https://cldup.com/S6Ptkwu_qA.js'></script>

<script  src="../../../js/index.js"></script>
</body>
</html>
