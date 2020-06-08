<?php

$id = 3;
$companyName =  "Sony";
$balance =  "50";
$pin =  "1111";
$activationDate = "2020-05-03 12:12";
$expirationDate = "2020-06-03";
$creationDate = date("Y-m-d h:i");

function selectQuery($id,$companyName,$balance,$pin,$activationDate,$expirationDate,$creationDate)
{
    $conn = mysqli_connect("localhost", "root", "", "boncard");

    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }
    echo("Connected successfully");


    $insertQuery = "INSERT INTO cards (Id,CompanyName,Balance,Pin,ActivationDate,ExpirationDate,CreationDate) 
                    VALUES ('$id','$companyName','$balance','$pin','$activationDate','$expirationDate','$creationDate')";

    echo $insertQuery;

    if ($result = $conn->query($insertQuery))
    {
        echo ("\n success");
    }
    else
    {
        echo ("failed");
    }

}

selectQuery($id,$companyName,$balance,$pin,$activationDate,$expirationDate,$creationDate);