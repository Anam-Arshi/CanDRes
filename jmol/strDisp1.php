<?php 

	$pdbId = $_REQUEST['pdb_id'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Structure Details</title>

<script type="text/javascript" src="Jmol.js"></script>
<script type="text/javascript" src="jsmolViewer.js"></script>
    
    
</head>
<body>
<script type="text/javascript">jmolInitialize()</script>

			<table align="center" border="0" width="750" bgcolor="#FFFFFF" class="linktextart" cellpadding="10">
            <tr>
					
					<td colspan="2" align="center" class="parahead"><?php echo $dbid;?></td>                                
			  </tr>
				
				<?php 
				
				$pdbFile=$pdbId."."."pdb"; if(file_exists($pdbFile)){?>
				<tr>
					<td width="145" align="right" bgcolor="#B9D6E6"><b>Structure :</b></td>
					<td width="559" colspan="2" align="center"><script type="text/javascript">jmolApplet0._cover(500,"load <?php echo $pdbId;?>.pdb;select *;wireframe off;spacefill off;cartoon on;color structure")</script>
                    <script type="text/javascript">
		$(document).ready(function() {
			console.log('instantiating jmol!');
			
			$("#jmol_box").html(Jmol.getAppletHtml(jmolApplet0,jmolInfo));
			
		});
		</script>
					<script type="text/javascript">jmolApplet0(500,"load <?php echo $pdbId;?>.pdb;select *;wireframe off;spacefill off;cartoon on;color structure")</script></td>
				</tr>
				<?php }?>
                
				
                            	
          </table>
                        
                        
          </td>
	</tr>
</table>
</body>
</html>