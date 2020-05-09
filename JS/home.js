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

function getcardetails()
{
    var cardetails = createreqobj();

    cardetails.onreadystatechange = function(){

        if(this.readyState===4&&this.status===200)
        {
            result = JSON.parse(this.responseText);

            for(var x in result)
            {
                var card = "<div class='col-sm-3'>"+
      
                "<div class='card'>"+
                "<img src='"+result[x].images+"' class='card-img-top' alt='Car image'>"+
                "<div class='card-body'>"+
                "<h5 class='card-title'>"+result[x].name+"</h5>"+
                "<h6 class='card-subtitle mb-2'>"+result[x].status+" | TYPE : "+result[x].cartype+"</h6>";

                for(i=0;i<result[x].features.length;i++)
                {
                    card += "<li>"+result[x].features[i]+"</li>";
                }

                card +="<hr><a href='#' class='card-link'>More Details</a>"+
                "</div>"+
                "</div>"+
                "</div>";

                document.getElementsByClassName("row")[0].innerHTML += card;
            }
        }
    };

    cardetails.open("GET","cardetails.php",true);
    cardetails.send();
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

        var param='query='+query;

        searchresults.open("POST","searchresults.php",true);
        searchresults.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        searchresults.send(param);

    }
}