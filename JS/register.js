function customer()
{
    console.log('Customer Login');
    document.getElementById('select').style.display = "none";
    document.getElementById('redirect').style.display = "none";
    document.getElementsByClassName('text')[0].style.display = "none";
    document.getElementsByClassName('text')[1].style.display = "none";
    document.getElementsByClassName('text')[2].style.display = "none";
    document.getElementById('customer_register').style.display = "block";
}

function dealer()
{
    console.log('Dealer Login');
    document.getElementById('select').style.display = "none";
    document.getElementById('redirect').style.display = "none";
    document.getElementsByClassName('text')[0].style.display = "none";
    document.getElementsByClassName('text')[1].style.display = "none";
    document.getElementsByClassName('text')[2].style.display = "none";
    document.getElementById('dealer_register').style.display = "block";
}