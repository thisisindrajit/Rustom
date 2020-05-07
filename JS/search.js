function createreqobj() {
    var xhttp;
    if (window.XMLHttpRequest) {
      // code for modern browsers
      xhttp = new XMLHttpRequest();
      } else {
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return xhttp;
}

function searchcars()
{
    var searchbox=document.getElementsByClassName("searchbox")[0];
    var query=document.getElementById("query").value;
    var searchresults = createreqobj();

    if(query === "")
    {
        searchbox.style.transform="scaleY(0)";
        searchbox.innerHTML = "";
    }
    
    else
    {
        searchbox.style.transform="scaleY(1)";

        searchresults.onreadystatechange = function(){

            if(this.readyState===4&&this.status===200)
            {
                searchbox.innerHTML = '<h3 style="font-weight:lighter">Search Results</h3>'+this.responseText;
            }
        };

        searchresults.open("GET","searchresults.php?query="+query,true);
        searchresults.send(null);

    }
}