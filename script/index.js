var  $= function(id){
    return document.getElementById(id);
}
var  get_class= function(classname){
    return document.getElementsByClassName(classname);
}

/*$("btn_pin").onclick=function(event){
    event.preventDefault();
    var xhttp = new XMLHttpRequest();
    var Form_cl= this.parentElement;
    
    var data_pin_num= new FormData(Form_cl);
    xhttp.onreadystatechange = function() {

        //alert("Ready state="+this.status);
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText!="0 result"){
                var client=JSON.parse(this.responseText);                
                window.location.href = 'pages/client.html';
                console.log(client);
            }
        }
    }
    xhttp.open("POST", "php/pin.php");
    xhttp.send(data_pin_num);
}*/

function create_cards(client) {
    var xhttp = new XMLHttpRequest();
        var body_id = 'id_client=' + encodeURIComponent(client.id);
        xhttp.onreadystatechange = function() {
        //alert("Ready state="+this.status);
            if (this.readyState == 4 && this.status == 200) {
                var bills=JSON.parse(this.responseText);
                console.log(bills);
            };
        }
    xhttp.open("POST", "php/take_cards.php");
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(body_id);
}

