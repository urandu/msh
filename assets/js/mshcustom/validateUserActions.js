$(document).ready(function(){
    $("#delete").click(function(){
        if (!confirm("Do you want to delete")){
            return false;
        }
    });
});

$(document).ready(function(){
    $("#update").click(function(){
        if (!confirm("Do you want to update")){
            return false;
        }
    });
});

$(document).ready(function(){
    $("#submit").click(function(){
        if (!confirm("Do you want to submit details?")){
            return false;
        }
    });
});

/* *****************validate the phone no********************** */
$(document).ready(function() {
    $('#txtPhone').blur(function(e) {
        if (validatePhone('txtPhone')) {
            $('#spnPhoneStatus').html('Valid');
            $('#spnPhoneStatus').css('color', 'green');
        }
        else {
            $('#spnPhoneStatus').html('Invalid phone number use....XXX XXX XXXX');
            $('#spnPhoneStatus').css('color', 'red');
        }
    });
});

function validatePhone(txtPhone) {
    var a = document.getElementById(txtPhone).value;
    var filter = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}
/* *****************end validate phone no********************** */

function validateSupplyAgency()
{
    var a=document.forms["reg"]["supply_agency_name"].value;
    var b=document.forms["reg"]["contact_person"].value;
    var c=document.forms["reg"]["contact_phone"].value;
    var d=document.forms["reg"]["supply_chain_description"].value;



    if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
    {
        alert("All Field must be filled out");
        return false;
    }
    if (a==null || a=="")
    {
        alert("Please include the name of the supply agency");
        return false;
    }
    if (b==null || b=="")
    {
        alert("Please inlude the contact person");
        return false;
    }
    if (c==null || c=="")
    {
        alert("Please include the contact phone");
        return false;
    }
    // if (d==null || d=="")
    // {
    // alert("Please include the description");
    // return false;
    // }
}

function validateFundingAgency()
{

    var x=document.forms["FundingArgencyName"]["funding_agency_name"].value;
    var y=document.forms["FundingArgencyName"]["funding_agency_description"].value;

    if ((x==null || x=="") && (y==null || y==""))
    {
        alert("All Field must be filled out");
        return false;
    }
    if (x==null || x=="")
    {
        alert("Input the funding agency name");
        return false;
    }
    if (y==null || y=="")
    {
        alert("Include decription");
        return false;
    }
}

/****************** VALIDATE PENDING STOCK ENTRY****************************************

 ****************************************************************************************/

function validatePendingStock()
{

    var a=document.forms["PendingStock"]["period"].value;
    var b=document.forms["PendingStock"]["commodity_name"].value;
    var c=document.forms["PendingStock"]["funding_agency_name"].value;
    var d=document.forms["PendingStock"]["pending_deliveries"].value;
    var e=document.forms["PendingStock"]["expected_date_delivery"].value;
    var f=document.forms["PendingStock"]["pddescription"].value;



    if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
    {
        alert("All Field must be filled out");
        return false;
    }


    if (a==null || a=="")
    {
        alert("Please include the name of the supply agency");
        return false;
    }


    if (b==null || b=="")
    {
        alert("Please inlude the contact person");
        return false;
    }
    if (c==null || c=="")
    {
        alert("Please include the contact phone");
        return false;
    }
    else{
        validatePhone();
    }

    if (d==null || d=="")
    {
        alert("Please include the description");
        return false;
    }
}
/****************** VALIDATE STATIC PARAMETERS ENTRY*************************************

 ****************************************************************************************/

function validateStaticParams()
{

    var a=document.forms["StaticParams"]["commodity_name"].value;
    var b=document.forms["StaticParams"]["period"].value;
    var c=document.forms["StaticParams"]["pack_size"].value;
    var d=document.forms["StaticParams"]["projected_monthly_consumption"].value;
    var e=document.forms["StaticParams"]["average_monthly_consumption"].value;



    if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
    {
        alert("All Field must be filled out");
        return false;
    }


    if (a==null || a=="")
    {
        alert("Please include the name of the supply agency");
        return false;
    }


    if (b==null || b=="")
    {
        alert("Please inlude the contact person");
        return false;
    }
    if (c==null || c=="")
    {
        alert("Please include the contact phone");
        return false;
    }
    else{
        validatePhone();
    }

    if (d==null || d=="")
    {
        alert("Please include the description");
        return false;
    }
}

/************ VALIDATE CENTRAL LEVEL STOCK ENTRY****************************************

 ****************************************************************************************/

function validateCentralLevelStock()
{

    var a=document.forms["CentralLevelData"]["commodity_name"].value;
    var b=document.forms["CentralLevelData"]["pack_size"].value;
    var c=document.forms["CentralLevelData"]["supply_chain_agency"].value;
    var d=document.forms["CentralLevelData"]["funding_agency"].value;
    var e=document.forms["CentralLevelData"]["receipts_from_suppliers"].value;
    var f=document.forms["CentralLevelData"]["opening_balance"].value;
    var g=document.forms["CentralLevelData"]["closing_balance"].value;
    var h=document.forms["CentralLevelData"]["total_issues"].value;
    var i=document.forms["CentralLevelData"]["earliest_expiry_date"].value;
    var j=document.forms["CentralLevelData"]["quantity_expiring"].value;



    if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
    {
        alert("All Field must be filled out");
        return false;
    }


    if (a==null || a=="")
    {
        alert("Please include the name of the supply agency");
        return false;
    }


    if (b==null || b=="")
    {
        alert("Please inlude the contact person");
        return false;
    }
    if (c==null || c=="")
    {
        alert("Please include the contact phone");
        return false;
    }
    else{
        validatePhone();
    }

    if (d==null || d=="")
    {
        alert("Please include the description");
        return false;
    }
}
/****************** VALIDATE NEW COMMODITY ENTRY****************************************

 ****************************************************************************************/

function validateNewCommodity()
{

    var a=document.forms["NewCommodity"]["commodity_name"].value;
    var b=document.forms["NewCommodity"]["pack_size"].value;
    var c=document.forms["NewCommodity"]["commodity_description"].value;


    if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
    {
        alert("All Field must be filled out");
        return false;
    }


    if (a==null || a=="")
    {
        alert("Please include the name of the supply agency");
        return false;
    }


    if (b==null || b=="")
    {
        alert("Please inlude the contact person");
        return false;
    }
    if (c==null || c=="")
    {
        alert("Please include the contact phone");
        return false;
    }
    else{
        validatePhone();
    }

    if (d==null || d=="")
    {
        alert("Please include the description");
        return false;
    }
}
