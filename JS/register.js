var option;
function customer()
{
    console.log('Customer Login');
    document.getElementById('register_option').style.display = "none";
    document.getElementById('redirect').style.display = "none";
    document.getElementsByClassName('text')[0].style.display = "none";
    document.getElementsByClassName('text')[1].style.display = "none";
    document.getElementsByClassName('text')[2].style.display = "none";
    document.getElementById('customer_register').style.display = "block";
    option = 1; 
}

function dealer()
{
    console.log('Dealer Login');
    document.getElementById('register_option').style.display = "none";
    document.getElementById('redirect').style.display = "none";
    document.getElementsByClassName('text')[0].style.display = "none";
    document.getElementsByClassName('text')[1].style.display = "none";
    document.getElementsByClassName('text')[2].style.display = "none";
    document.getElementById('dealer_register').style.display = "block";
    option = 2;
}
var branch_count = 1;
function addBranch()
{
    branch_count++;
    var line = document.createElement('div');
    line.innerHTML= '<hr width="90%" style="background-color:white;border:none;height:2px"></hr>';
    document.getElementById('branch_details').appendChild(line);

    var branch = document.createElement('div');
    branch.setAttribute('class', 'form-group');
    branch.innerHTML = '<label for="branch'+branch_count+'">Branch '+branch_count+' Name</label> <input type="text" class="form-control" name="branch'+branch_count+'" placeholder="Branch '+branch_count+' name" required>';
    document.getElementById('branch_details').appendChild(branch);

    var location = document.createElement('div');
    location.setAttribute('class', 'form-group');
    location.innerHTML = '<label for="location'+branch_count+'">Branch '+branch_count+' Location</label><input type="text" class="form-control" name="location'+branch_count+'" placeholder="Branch '+branch_count+' Location/Address" required>';
    document.getElementById('branch_details').appendChild(location);
}

$(document).ready(function() {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 18;
    if(month < 10)
    month = '0' + month.toString();
    if(day < 10)
    day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#dateID').attr('max', maxDate);
});

function validateEmail()
{
    if (option == 1)
    {
        email = document.getElementById('C_email').value;
    }
    else 
    {
        email = document.getElementById('D_email').value;
    }
    console.log(email);
    console.log(option);
    var mailformat = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(email.match(mailformat))
    {
        console.log("Correct");
        return true;
    }
    else
    {
    alert("Please enter a valid email address!");    //The pop up alert for an invalid email address;
    if (option == 1)
    {
        document.getElementById('C_email').value = "";
    }
    else 
    {
        document.getElementById('D_email').value = "";
    }
    return false;
    }
} 