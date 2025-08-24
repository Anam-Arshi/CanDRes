
<?php
$host = "localhost"; // host  
  
    $user = "root"; // username
      
    $pass = ""; // password 
      
    $db_name = "bicnirrh_camp2"; //database name  
      
    mysql_connect($host,$user,$pass) or die("Cannot connect to host.....".mysql_error()); //connecting to mysql  
      
    mysql_select_db($db_name) or die("Cannot connect to Database.....".mysql_error()); //seleccting database    
	
$result1=mysql_query("SELECT DISTINCT pdb_id FROM strudb");

date_default_timezone_set('Asia/Calcutta');
header('Content-type: plain/text');
header('Content-Disposition: attachment; filename="'."Sec_structure"."_".date('Y-m-d H-i-s').'.txt"');
echo "PDB_id\tChain\tToral_Residue\tNum_Helix\tNum_Turm\tNum_Beta\tNum_Unassigned\tPer_Helix\tPer_Turn\tPer_Beta\tPer_Unassigned\n";
while($row = mysql_fetch_array($result1))
{
$id = $row['pdb_id'];
$result=mysql_query("SELECT PDB_id FROM sec_str where PDB_id='$id'");
$cnt=0;
$cnt=mysql_num_rows($result);
if($cnt < 1)
{
//$id = strtolower($id);

$var = "perl dssp3.pl $id";
system($var);
//echo $id."<br>";
}

}

?>


