<?php
    $datestamp = date("Y-m-d");

    $servername = "localhost";
    $username = "XXX";
    $password = "XXX";
    $dbname = "XXX";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if (($handle = fopen('data.csv', "r")) !== FALSE)
    {
        fgets($handle);
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
        {
            $query = "UPDATE pet_breeds SET name_rastreator = '$data4' WHERE name='$data2'";
            $conn->query($query);
        }
    }

    $conn->close();
?>