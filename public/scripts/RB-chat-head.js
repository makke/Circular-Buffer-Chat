/* HEADER SCRIPTS FOR RB-CHAT COLLECTED HERE */

var timer_on = 0; // A variable to know if the timer is on
var intervalTimer; // A global variable for the timer

// User pressed enter and the message will be sent
function sendMessage(str) {
    // Don't send empty string
    if (str == "") {
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
                document.getElementById("chatflow").innerHTML = this.responseText;
            }
        };
        // Let's prevent injections
        str = str.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        // We use GET for new messages
        xmlhttp.open("GET","getchat.php?c="+str,true);
        xmlhttp.send();
    }
}

// Let's update new messages from the server
function updateFlow() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chatflow").innerHTML = this.responseText;
        }
    };
    // We use POST to update messages from server
    xmlhttp.open("POST","getchat.php",true);
    xmlhttp.send();
    // Let's set a timer to regularly update possible new messages from the server
    if (!timer_on) {
        timer_on = 1;
        intervalTimer = setTimeout(function(){ timer_on = 0; updateFlow(); }, 5000);
    }
}
