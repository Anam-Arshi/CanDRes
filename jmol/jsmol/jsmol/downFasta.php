<?php
date_default_timezone_set('Asia/Calcutta');

header('Content-Type: text/plain');

if(isset($_POST["down_seq"])){
    $down=$_POST["down_seq"];
    $ptn =$_POST["ptn_name"];
    header('Content-Disposition: attachment; filename="' . $ptn . '.fasta"');

    echo $down;
}
else if(isset($_POST["down_seq_mut"])){
	$downM=$_POST["down_seq_mut"];
    $ptn =$_POST["ptn_name"];
    header('Content-Disposition: attachment; filename="' . $ptn . '_mut.fasta"');

    echo $downM;
	
}


?>