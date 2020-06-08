<?php
require("validationMethods.php");
#echo $_POST['id'];
#echo $_POST['companyname'];
#echo $_POST['balance'];
#echo $_POST['pin'];
#echo $_POST['activationdate'];
#echo $_POST['expirationdate'];

$id = $_POST['id'];
$companyName =  $_POST['companyname'];
$balance =  $_POST['balance'];
$pin =  $_POST['pin'];
$activationDate = $_POST['activationdate'];
$expirationDate = $_POST['expirationdate'];
$creationDate = date("Y-m-d h:i");


function validateData($id, $companyName, $balance, $pin, $activationDate, $expirationDate, $creationDate)
{
    if ($id <= 0)
    {
        $response = json_encode(array('type'=>'error','message' =>'Cards ID cannot be less than zero!'));
    }
    else if((strlen($id)) > 3) {
        $response = json_encode(array('type' => 'error', 'message' => 'Cards ID must be 3-digit number!'));
    }
    else if((is_numeric($id)) == false)
    {
        $response = json_encode(array('type'=>'error','message' =>'Cards ID must consists of only numbers!'));
    }
    else if((strlen($companyName)) > 32)
    {
        $response = json_encode(array('type'=>'error','message' =>'Company name cannot be longr than 32 letters!'));
    }
    else if(((is_numeric($balance)) == false))
    {
        $response = json_encode(array('type'=>'error','message' =>'Balance must be a number!'));
    }
    else if($balance <= 0)
    {
        $response = json_encode(array('type'=>'error','message' =>'Balance cannot be less than or equal to zero!'));
    }
    else if((is_numeric($pin)) == false)
    {
        $response = json_encode(array('type'=>'error','message' =>'Pin must be a 4-digit number!'));
    }
    else if((strlen($pin)) != 4)
    {
        $response = json_encode(array('type'=>'error','message' =>'Pin must be a 4-digit number!'));
    }
    else if(validateDateTime($activationDate) != true)
    {
        $response = json_encode(array('type'=>'error','message' =>'Activation Date must be in YYY-MM-DD HH:MM format!'));
    }
    else if(validateDate($expirationDate) != true)
    {
        $response = json_encode(array('type'=>'error','message' =>'Expiration Date must be in YYYY-MM-DD format!'));
    }
    else if(checkIDs($id) == true)
    {
        $response = json_encode(array('type'=>'error','message' =>'Provided cards ID already exists!'));
    }
    else
    {
        $response = json_encode(array('type'=>'success','message' =>'Success!'));
        selectQuery($id,$companyName,$balance,$pin,$activationDate,$expirationDate,$creationDate);
    }
    echo $response;
}

function selectQuery($id,$companyName,$balance,$pin,$activationDate,$expirationDate,$creationDate)
{
    $conn = mysqli_connect("localhost", "root", "", "boncard");

    if ($conn->connect_error) {
        #echo("Connection failed: " . $conn->connect_error);
    }
    #echo("Connected successfully");


    $insertQuery = "INSERT INTO cards (Id,CompanyName,Balance,Pin,ActivationDate,ExpirationDate,CreationDate) 
                    VALUES ('$id','$companyName','$balance','$pin','$activationDate','$expirationDate','$creationDate')";

    #echo $insertQuery;

    if ($result = $conn->query($insertQuery))
    {
        #echo ("\n success");
    }
    else
    {
        #echo ("failed");
    }

}


validateData($id, $companyName, $balance, $pin, $activationDate, $expirationDate, $creationDate);