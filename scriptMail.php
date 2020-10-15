<?php
    $datestamp = date("Y-m-d");


    $dbuser = "XXXX";
    $dbpwd = "XXXX";
    $dbname = "XXXX";
    $filename= "backup-$datestamp.sql.gz";
    $to = "XXXX";
    $from = "XXXX";
    $subject = "MySQL backup file - ". $dbname;

    $command = "mysqldump -u $dbuser --password=$dbpwd $dbname | gzip > $filename";
    $result = passthru($command);

    $attachmentname = array_pop(explode("/", $filename));

    $message = "Compressed database backup file $attachmentname attached.";
    $mime_boundary = "<<<:" . md5(time());
    $data = chunk_split(base64_encode(implode("", file($filename))));

    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: multipart/mixed;\r\n";
    $headers .= " boundary=\"".$mime_boundary."\"\r\n";

    $content = "This is a multi-part message in MIME format.\r\n\r\n";
    $content.= "--".$mime_boundary."\r\n";
    $content.= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
    $content.= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $content.= $message."\r\n";
    $content.= "--".$mime_boundary."\r\n";
    $content.= "Content-Disposition: attachment;\r\n";
    $content.= "Content-Type: Application/Octet-Stream; name=\"$attachmentname\"\r\n";
    $content.= "Content-Transfer-Encoding: base64\r\n\r\n";
    $content.= $data."\r\n";
    $content.= "--" . $mime_boundary . "\r\n";

    mail($to, $subject, $content, $headers);

    unlink($filename);
?>
