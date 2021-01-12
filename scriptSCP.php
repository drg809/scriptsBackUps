<?php
    $datestamp = date("Y-m-d");


    $dbuser = "XXXXX";
    $dbpwd = "XXXXX";
    $dbname = "XXXXX";
    $filename= "backup-$datestamp.sql.gz";
    $to = "root@XX.XX.XX.XX:/home/".$filename;

    $restore = "mysqldump -u $dbuser --password=$dbpwd $dbname | gzip > $filename";
    $result = passthru($restore);


    $command = "scp $filename $to";
    $result = passthru($command);

    unlink($filename);
?>
