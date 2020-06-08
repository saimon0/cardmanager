<?php

function selectQuery()
{
    $conn = mysqli_connect("localhost", "root", "", "boncard");

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        #echo "Connected successfully\n\n";
    }


    $selectQuery = "SELECT * FROM cards";
    $result = $conn->query($selectQuery);

    $return_arr = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $id = $row['Id'];
        $companyName = $row['CompanyName'];
        $balance = $row['Balance'];
        $pin = $row['Pin'];
        $activationDate = $row['ActivationDate'];
        $expirationDate = $row['ExpirationDate'];
        $creationDate = $row['CreationDate'];

        $return_arr[] = array('Id' => $id,
            'CompanyName' => $companyName,
            'Balance' => $balance,
            'Pin' => $pin,
            'ActivationDate' => $activationDate,
            'ExpirationDate' => $expirationDate,
            'CreationDate' => $creationDate
        );
    }

    echo json_encode($return_arr);
}

selectQuery();