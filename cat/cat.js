function searchlive(str) {
    //var ahb = document.getElementById('scat').value;
    var search = document.getElementById('search').value;
    var cs = document.getElementById('cs').value;
    document.getElementById('livesearch').style.display = "block";

    var fini = search+"&cs="+cs;
    if (str=="") { 
        document.getElementById("livesearch").innerHTML = "";
        return;
    } else {
        document.getElementById('livesearchl').style.display = "block";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();

        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('livesearchl').style.display = "none";
                document.getElementById("livesearch").innerHTML = this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET","search.php?stl="+fini,true);
        xmlhttp.send();
    }
}
function slive(str) {
    document.getElementById('search').value = str;
    document.getElementById('livesearch').style.display = "none";
}

function searcht(str) {
    //var ahb = document.getElementById('scat').value;
    var search = document.getElementById('search').value;
    var cs = document.getElementById('cs').value;
    document.getElementById('livesearch').style.display = "none";
    document.getElementById('grest').style.display = "block";

    var fini = search+"&csr="+cs;
    if (str=="") { 
        document.getElementById("livesearch").innerHTML = "";
        return;
    } else {
        document.getElementById('livesearchl').style.display = "none";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();

        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('livesearchl').style.display = "none";
                document.getElementById('grest').style.display = "none";
                document.getElementById("row").innerHTML = this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET","search.php?sr="+fini,true);
        xmlhttp.send();
    }
}