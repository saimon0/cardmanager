<?php


function validateDateTime($activationDate)
{
    $format = 'Y-m-d H:i';
    $d = DateTime::createFromFormat($format, $activationDate);
    return $d && $d->format($format) == $activationDate;
}


function validateDate($expirationDate)
{
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $expirationDate);
    return $d && $d->format($format) == $expirationDate;
}


function checkIDs($providedId)
{
    $conn = mysqli_connect("localhost", "root", "", "boncard");
    if ($conn->connect_error)
    {
        echo("Connection failed: " . $conn->connect_error);
    }
    else
    {
        #echo "Connected successfully";
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


    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode(json_encode($return_arr), TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);

    $isFound = 0;

    foreach ($jsonIterator as $key => $val)
    {
        if(is_array($val))
        {
            #echo "$key:\n";
        } else
            {
            #echo "$key => $val\n";
            if ($val == $providedId)
            {
                $isFound = 1;
                break;
            }
        }
    }

    if ($isFound == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

#$providedId = 5;
#$output = checkIDs($providedId);
#echo "\nresult: " . $output;