function validateF()
{
    var name = document.forms["validateForm"]["name"].value;
    var phone = document.forms["validateForm"]["phone"].value;
    var email = document.forms["validateForm"]["email"].value;
    var pmode = document.forms["validateForm"]["pmode"].value;
    var address = document.forms["validateForm"]["address"].value;
    var phonelenngth = phone.length;

    //format of a email address
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+.[a-zA-Z0-9-]*$/;
    //format fo hone number
    var numbers = /^[0-9]+$/;

    //Check whether all fields are empty or not
    if(name==""||phone==""||email==""||pmode==""||address=="")
    {
        alert("All Feilds are Required");
        return false;
    }
    else
    {
        //email validation
        if(mailformat.test(email))
        {
            if(phonelenngth==10 && numbers.test(phone))
            {
                if(pmode=="cards" || pmode=="netbanking" || pmode=="cod")
                {
                    return true;
                }
                else
                {
                    alert("Select Payment type");
                    return false;
                }
            }
            else
            {
                alert("Phone number cannot be exceed 10 numbers. or Enter numbers only.");
                return false;
            }
        }
        else
        {
            alert("Email is Invalid. enter valid one.");
            return false;
        }
    }
}