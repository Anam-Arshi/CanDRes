
<?php
$host = "localhost"; // host  
  
    $user = "root"; // username
      
    $pass = ""; // password 
      
    $db_name = "bicnirrh_camp2"; //database name  
      
    mysql_connect($host,$user,$pass) or die("Cannot connect to host.....".mysql_error()); //connecting to mysql  
      
    mysql_select_db($db_name) or die("Cannot connect to Database.....".mysql_error()); //seleccting database    
	$result=mysql_query("SELECT DISTINCT pdb_id FROM strudb");
while($row = mysql_fetch_array($result))
{
$id = $row['pdb_id'];
echo $id."\n";
$var = "wget \"http://www.pdb.org./pdb/files/$id.pdb\" -O $id.pdb";
system($var);
}
?>


