function customer()
{
    console.log('Customer Login');
    document.getElementById('register_option').style.display = "none";
    document.getElementById('redirect').style.display = "none";
    document.getElementsByClassName('text')[0].style.display = "none";
    document.getElementsByClassName('text')[1].style.display = "none";
    document.getElementsByClassName('text')[2].style.display = "none";
    document.getElementById('customer_register').style.display = "block";
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