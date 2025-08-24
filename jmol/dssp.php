
<?php
$host = "localhost"; // host  
  
    $user = "root"; // username
      
    $pass = ""; // password 
      
    $db_name = "bicnirrh_camp2"; //database name  
      
    mysql_connect($host,$user,$pass) or die("Cannot connect to host.....".mysql_error()); //connecting to mysql  
      
    mysql_select_db($db_name) or die("Cannot connect to Database.....".mysql_error()); //seleccting database    
	
$result1=mysql_query("SELECT DISTINCT pdb_id FROM strudb");
$cnt=mysql_num_rows($result1);
while($row = mysql_fetch_array($result1))
{
$id = $row['pdb_id'];
echo $id."\n";
$var = "dssp-2.0.4-win32.exe -i $id.pdb -o $id.dssp";
echo $var;
system($var);
}

?>


