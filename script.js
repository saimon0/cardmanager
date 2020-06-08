$(document).ready(function()
{
    $("#form form").hide();
    $("#create-button").click(function()
    {
        if (($("#delete-form form").is(':visible')))
        {
            $("#delete-form form").hide();
        }
        if ($("#update-form form").is(':visible'))
        {
            $("#update-form form").hide();
        }

        if ($("#form form").is(':visible'))
        {
            $("#form form").hide();
        }
        else
        {
            $("#form form").show();
        }
    });
});


$(document).ready(function()
{
    $("#delete-form form").hide();
    $("#delete-button").click(function()
    {
        if ($("#update-form form").is(':visible'))
        {
            $("#update-form form").hide();
        }
        if ($("#form form").is(':visible'))
        {
            $("#form form").hide();
        }

        if ($("#delete-form form").is(':visible'))
        {
            $("#delete-form form").hide();
        }
        else
        {
            $("#delete-form form").show();
        }
    });
});


$(document).ready(function()
{
    $("#update-form form").hide();
    $("#update-button").click(function()
    {
        if ($("#form form").is(':visible'))
        {
            $("#form form").hide();
        }
        if (($("#delete-form form").is(':visible')))
        {
            $("#delete-form form").hide();
        }

        if ($("#update-form form").is(':visible'))
        {
            $("#update-form form").hide();
        }
        else
        {
            $("#update-form form").show();
        }
    });
});


    $(document).ready(function () {
        $.ajax({
            url: 'refreshTable.php',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = response.length;
                for (var i = 0; i < len; i++) {
                    console.log(response[i]);
                    var id = response[i].Id;
                    var companyName = response[i].CompanyName;
                    var balance = response[i].Balance;
                    var pin = response[i].Pin;
                    var activationDate = response[i].ActivationDate;
                    var expirationDate = response[i].ExpirationDate;
                    var creationDate = response[i].CreationDate;

                    var tr_str =
                        "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + companyName + "</td>" +
                        "<td>" + balance + "</td>" +
                        "<td>" + pin + "</td>" +
                        "<td>" + activationDate + "</td>" +
                        "<td>" + expirationDate + "</td>" +
                        "<td>" + creationDate + "</td>" +
                        +"</tr>";

                    $("#table-cards tbody").append(tr_str);
                    console.log("RUN");
                }
            },
            error: function (error) {
                alert(JSON.stringify(error));
            }
        });
    });


function executeCreate()
{
        var hr = new XMLHttpRequest();

        var url = "createCard.php";
        var id = document.getElementById("id-create").value;
        var companyName = document.getElementById("company-name-create").value;
        var balance = document.getElementById("balance-create").value;
        var pin = document.getElementById("pin-create").value;
        var activationDate = document.getElementById("activation-date-create").value;
        var expirationDate = document.getElementById("expiration-date-create").value;


        var vars = "id="+id+"&companyname="+companyName+"&balance="+balance+"&pin="+pin+"&activationdate="+activationDate+"&expirationdate="+expirationDate;
        hr.open("POST", url, true);

        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        hr.onreadystatechange = function()
        {
            if(hr.readyState == 4 && hr.status == 200)
            {
                var return_data = hr.responseText;
                alert(return_data);
            }
        };
        hr.send(vars);
}


function executeDelete()
{
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "deleteCard.php";
    var id = document.getElementById("id-delete").value;

    if (!id)
    {
        alert("Insert cards ID!");
    }

    var vars = "id="+id;
    hr.open("POST", url, true);

    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function()
    {
        if(hr.readyState == 4 && hr.status == 200)
        {
            var return_data = hr.responseText;
            alert(return_data);
        }
    };
    hr.send(vars);
}


function executeUpdate()
{
    var hr = new XMLHttpRequest();

    var url = "updateCard.php";
    var id = document.getElementById("id-update").value;
    var companyName = document.getElementById("company-name-update").value;
    var balance = document.getElementById("balance-update").value;
    var pin = document.getElementById("pin-update").value;
    var activationDate = document.getElementById("activation-date-update").value;
    var expirationDate = document.getElementById("expiration-date-update").value;



    var vars = "id="+id+"&companyname="+companyName+"&balance="+balance+"&pin="+pin+"&activationdate="+activationDate+"&expirationdate="+expirationDate;
    hr.open("POST", url, true);

    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function()
    {
        if(hr.readyState == 4 && hr.status == 200)
        {
            var return_data = hr.responseText;
            alert(return_data);
            document.getElementById("status").innerHTML = return_data;
        }
    };
    hr.send(vars);
    document.getElementById("status").innerHTML = "processing...";
}


function refeshTable()
{
    $(document).ready(function ()
    {
        $.ajax({
            url: 'refreshTable.php',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = response.length;
                for (var i = 0; i < len; i++) {
                    console.log(response[i]);
                    var id = response[i].Id;
                    var companyName = response[i].CompanyName;
                    var balance = response[i].Balance;
                    var pin = response[i].Pin;
                    var activationDate = response[i].ActivationDate;
                    var expirationDate = response[i].ExpirationDate;
                    var creationDate = response[i].CreationDate;

                    var tr_str =
                        "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + companyName + "</td>" +
                        "<td>" + balance + "</td>" +
                        "<td>" + pin + "</td>" +
                        "<td>" + activationDate + "</td>" +
                        "<td>" + expirationDate + "</td>" +
                        "<td>" + creationDate + "</td>" +
                        +"</tr>";

                    $("#table-cards tbody").append(tr_str);
                    console.log("RUN");
                }
            },
            error: function (error) {
                alert(JSON.stringify(error));
            }
        });
    });
}


$(document).ready(function()
{
    $("#refresh-button").click(function ()
    {
        $("#table-cards tbody").empty();
        refeshTable();
       alert("Table refreshed successfully!");
    });
});


function getCurrentDateTime()
{

    $(document).ready(function ()
    {
        var today = new Date();
        var date = today.getFullYear()+'-'+("0" + (today.getMonth()+1)).slice(-2) +'-'+ ("0" + today.getDate()).slice(-2);
        var time = ("0" +today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2);
        var dateTime = date+' '+time;

        console.log(dateTime);

        $('#activation-date-create').val(dateTime);
    });
}


function getCurrentDateTimeUpdate()
{

    $(document).ready(function ()
    {
        var today = new Date();
        var date = today.getFullYear()+'-'+("0" + (today.getMonth()+1)).slice(-2) +'-'+ ("0" + today.getDate()).slice(-2);
        var time = ("0" +today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2);
        var dateTime = date+' '+time;

        console.log(dateTime);

        $('#activation-date-update').val(dateTime);
    });
}