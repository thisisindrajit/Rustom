var listisopen=0;

function openlist()
{
    if(listisopen===0)
    {
        document.getElementById("list").style.width="320px";
        listisopen=1;
    }

    else
    {
        document.getElementById("list").style.width="0";
        listisopen=0;
    }
    
}