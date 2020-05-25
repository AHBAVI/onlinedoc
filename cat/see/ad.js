function searchlive(str) {
    //var ahb = document.getElementById('scat').value;
    var search = document.getElementById('search').value;
    document.getElementById('livesearch').style.display = "block";

  
    if (str=="") { 
        document.getElementById("livesearch").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();

        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesearch").innerHTML = this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET","ms.php?stl="+search,true);
        xmlhttp.send();
    }
}
function slive(str){
    var men = document.getElementById("men");
    if (men.value != "") {
        men.value = men.value+","+str;
    }else{
        men.value = str;
    }
    document.getElementById("livesearch").style.display = "none";
}
function lp(){
    document.getElementById("des").value = document.getElementById("des").value + '\n\n<br><center>\n<img src=pic/kp.jpg style=width:100%;max-width:700px></center>';
}

function ex(){
    document.getElementById("des").value = document.getElementById("des").value + "\n<center><p class=\"ex\">\n\n\n\n<br></p></center>";
}