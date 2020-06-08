<?php
require("validationMethods.php");
#echo $_POST['id'];
#echo $_POST['companyname'];
#echo $_POST['balance'];
#echo $_POST['pin'];
#echo $_POST['activationdate'];
#echo $_POST['expirationdate'];

$id = $_POST['id'];


function validateData($id)
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
    else if(checkIDs($id) != true)
    {
        $response = json_encode(array('type'=>'error','message' =>'Provided cards ID (card) does not exists!'));
    }
    else
    {
        $response = json_encode(array('type'=>'success','message' =>'Success!'));
        deleteCardQuery($id);
    }
    echo $response;
}


function deleteCardQuery($id)
{
    $conn = mysqli_connect("localhost", "root", "", "boncard");

    if ($conn->connect_error) {
        #echo("Connection failed: " . $conn->connect_error);
    }
    #echo("Connected successfully");


    #$insertQuery = "UPDATE cards SET Id= ?, CompanyName= ?,Balance = ?, Pin = ?, ActivationDate = ?, ExpirationDate = ?, CreationDate = ? WHERE Id='$id'";

    $sql = "DELETE FROM cards WHERE Id='$id'";

    if ($result = $conn->query($sql))
    {
        #echo ("\n success");
    }
    else
    {
        #echo ("failed");
    }

}


validateData($id);