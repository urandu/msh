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

function validateFundingAgency()
{

    var x=document.forms["fundingagency"]["funding_agency_name"].value;
    var y=document.forms["fundingagency"]["funding_agency_description"].value;

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


