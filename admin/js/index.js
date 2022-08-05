var  $= function(id){
    return document.getElementById(id);
}
var  get_class= function(classname){
    return document.getElementsByClassName(classname);
}

var name_form=["pib","ipn","born","reg_date"]
//var clients=[];
var admin;
var bills;

/*-------Pages with clients-----------
_____________CLIENTS__________________*/

function take_clients(elements){

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {

        //alert("Ready state="+this.status);
        if (this.readyState == 4 && this.status == 200) {
            
            clients=JSON.parse(this.responseText);
            //console.log(clients);
            refresh_clients(clients);
        }
    }
    xhttp.open("GET", "../server/admin/take_clients.php");
    xhttp.send();
}
//take_clients();

function refresh_clients(){
    for (var i=i = 0; i < clients.length; i++) {
        const element = array[j];
        
    }
}

var menu_list = get_class("menu_item");
var tabs_list=get_class("tab");
for (var i=0; i<menu_list.length; i++){
    menu_list[i].onclick=function(){
        for (var j =0; j< menu_list.length; j++){
            menu_list[j].classList.remove("selected");
            tabs_list[j].classList.remove("active");
        }

        this.classList.add("selected");
        var j=this.getAttribute("tab");
        tabs_list[j].classList.add("active");
        
    }
}

$("b_find_clients").onclick=function(){
    var client_surname=$("client_surname").value;
    //$("list_clients").innerHTML="";
    if (client_surname!=""){
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {

            //alert("Ready state="+this.status);
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                var clients= JSON.parse(this.responseText);
                //console.log(clients);
                console.log(clients);
                show_clients(clients);
            };
        }
        xhttp.open("GET", "php/get_clients.php?client_surname="+client_surname);
        xhttp.send();
    }
    

}

function create_add_div(){
    $("add_client").innerHTML="";

    var headings=["Призвіще, ім'я, По-батькові", "ІПН","Дата народження","Дата реєстрації", "Статус"];
    var headings_name=["pib","ipn","born","reg_date","status"];
    var Heading_div=document.createElement("div");
    var client=document.createElement("form");
    client.classList.add("client");
    for (var j=0; j<headings.length; j++){ 
        var head_name=document.createElement("label");
        head_name.innerHTML=headings[j];
        Heading_div.append(head_name);
        var input_client=document.createElement("input");
        input_client.required=true;
        /*if (headings_name[j]=="born"||headings_name[j]=="reg_date"){
            input_client.setAttribute("type", "date");

            //var input_client_id=input_client;
        }
        if (headings_name[j]=="id"){
            input_client.setAttribute("type", "hidden");
            input_client.name=headings[j];
            client.append(input_client);
            //var input_client_id=input_client;
        }
        else{
            input_client.setAttribute("type", "text");
            input_client.name=headings_name[j];
            client.append(input_client);
        }*/
        switch(headings_name[j]) {
            case "born":
                input_client.setAttribute("type", "date");
                break;
            case "id":
                input_client.setAttribute("type", "hidden");
                break;
            case "reg_date":
                input_client.setAttribute("type", "date");
                break;
            default:
                input_client.setAttribute("type", "text");
               
        
              // code block
        }
        input_client.name=headings_name[j];
        client.append(input_client);

    } 
    var add_client=document.createElement("button");
    add_client.textContent="Додати";
    add_client.onclick=function(){
            var Form_cl=this.parentElement;
            var data = new FormData(Form_cl);
            /*console.log(Form_cl);
            console.log(data);*/

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            //alert("Ready state="+this.status);
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                //var clients= JSON.parse(this.responseText);
                //console.log(clients);
                //show_clients(clients);
            };
        }
        xhttp.open("POST", "php/add_client.php");
        xhttp.send(data);   
    }
    client.append(add_client);
    $("add_client").append(Heading_div);
    //client.classList.add("clients_div");
    $("add_client").append(client);
}

function show_clients(clients){
    $("list_clients").innerHTML="";
    var headings=["Призвіще, ім'я, По-батькові", "ІПН","Дата народження","Дата реєстрації", "Статус"];
    var Heading_div=document.createElement("div");

    for (var j=0; j<headings.length; j++){ 
        var head_name=document.createElement("label");

        head_name.innerHTML=headings[j];
        Heading_div.append(head_name);
    }
    $("list_clients").append(Heading_div);
    /*for (var i=0; i<clients.length;i++){

    }*/

    for (var i=0; i<clients.length; i++){  
        var client=document.createElement("form");
        //client.setAttribute("onsubmit", "return false");
     
        //client.setAttribute("onsubmit", "preventDefault();");
        //client.setAttribute("method", "GET");
        client.classList.add("client");
        client.setAttribute("element_id", clients[i].id);
        //client.classList.add("clients_div");
        for (let key in clients[i]) {
            if(clients[i].hasOwnProperty(key)){
                var input_client=document.createElement("input");
                if (key=="id"){
                    input_client.setAttribute("type", "hidden");
                    
                    //var input_client_id=input_client;
                }
                else{
                    input_client.setAttribute("type", "text");
                }
                input_client.value=clients[i][key];
                input_client.name=key;
                client.append(input_client);
            }
        }
        /*var info_div=document.createElement("div");
        info_div.classList.add("info_div");
        info_div.setAttribute("type", "hidden");
        info_div.setAttribute("element_id", clients[i].id);*/
        var info_btn=document.createElement("button");
        ////info_btn.setAttribute("type", "submit");
        info_btn.textContent="Info";
        info_btn.classList.add("info_btn");
        info_btn.onclick=function(event){
            event.preventDefault();
            var Form_cl=this.parentElement;
            var id_client=Form_cl.getAttribute("element_id");
            var xhttp = new XMLHttpRequest();
            var body_id = 'id_client=' + encodeURIComponent(id_client);
            xhttp.onreadystatechange = function() {
            //alert("Ready state="+this.status);
            if (this.readyState == 4 && this.status == 200) {
                
                bills=JSON.parse(this.responseText);
                console.log(bills);
                //show_bills2(id_client,this);
                //show_bills_before(bills, id_client);
                var info_div=$("info_div");
                Form_cl.after(info_div);

                for (var j=0; j<bills.length; j++){ 
                    
                    var client=document.createElement("form");
                    //client.setAttribute("onsubmit", "return false");
                
                    //client.setAttribute("onsubmit", "preventDefault();");
                    //client.setAttribute("method", "GET");
                    client.classList.add("client");
                    client.setAttribute("element_id", bills[j].id);
                    //client.classList.add("clients_div");
                    for (let key in bills[j]) {
                        if(bills[j].hasOwnProperty(key)){
                            var input_client=document.createElement("input");
                            if (key=="id"){
                                input_client.setAttribute("type", "hidden");
                                
                                //var input_client_id=input_client;
                            }
                            else{
                                input_client.setAttribute("type", "text");
                            }
                            input_client.value=bills[j][key];
                            input_client.name=key;
                            client.append(input_client);
                        }
                    }
                   
                    var info_btn=document.createElement("button");
                    info_btn.textContent="Info";
                    info_btn.classList.add("info_btn");
                    client.append(save_change_btn);
                    client.append(del_btn);
                    client.append(info_btn);


                    $("info_div").append(client);
                }

                // for in bills

            };
        }
        xhttp.open("POST", "php/get_bills.php");
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(body_id);
        }
        var del_btn=document.createElement("button");
        ////info_btn.setAttribute("type", "submit");
        del_btn.textContent="DEL";
        del_btn.classList.add("info_btn");
        del_btn.onclick=function(event){
            event.preventDefault();
            var Form_cl=this.parentElement;
            var id_client=Form_cl.getAttribute("element_id");
            var xhttp = new XMLHttpRequest();
            var body_id = 'id_client=' + encodeURIComponent(id_client);
            xhttp.onreadystatechange = function() {
            //alert("Ready state="+this.status);
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            }
            xhttp.open("POST", "php/del_client.php");
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send(body_id);
        }    


        var save_change_btn=document.createElement("input");
        save_change_btn.setAttribute("type", "submit");
        save_change_btn.value="V";
        save_change_btn.onclick=function(event){
            event.preventDefault();
            var Form_cl=this.parentElement;
            var data = new FormData(Form_cl);
            /*console.log(Form_cl);
            console.log(data);*/

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            //alert("Ready state="+this.status);
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                //var clients= JSON.parse(this.responseText);
                //console.log(clients);
                //show_clients(clients);
            };
        }
        xhttp.open("POST", "php/edit_client.php");
        xhttp.send(data);    
            
        }
        client.append(save_change_btn);
        client.append(del_btn);
        client.append(info_btn);


        $("list_clients").append(client);
        
        function show_bills_before(bills, id_client){
            show_bills(bills, id_client);
        }
    }
    //$("list_clients").append(info_div);
}

function show_bills2(id_client){
    var info_div=$("info_div");
    var par_form=this.parentElement;
    alert(par_form);
}

function show_bills(bills,id_client){
    var info_div_list=get_class("info_div");
    for (var i=0; i<info_div_list.length;i++){

        //console.log(info_div_list[i]);
        //info_div_list[i].getAttribute("element_id")
        if (info_div_list[i].getAttribute("element_id")==id_client){
            info_div_list[i].innerHTML="";
            //element_div_info[i++].innerHTML=
            info_div_list[i].removeAttribute("type", "hidden");
            for (var num_i=0; num_i<bills.length; num_i++){
                //console.log(bills[j].bill);
                //info_div_list[i].innerHTML=bills[j].bill;
                var headings=["ID", "ID клієнта","Дата створення клієнта","Рахунок", "Баланс", "Валюта"];
                var Heading_div=document.createElement("div");

                for (var num=0; num<headings.length; num++){ 
                    var head_name=document.createElement("label");
                    head_name.innerHTML=headings[num];
                    Heading_div.append(head_name);
                }
                info_div_list[i].append(Heading_div);


               
                var client=document.createElement("form");
                //client.setAttribute("onsubmit", "return false");
            
                //client.setAttribute("onsubmit", "preventDefault();");
                //client.setAttribute("method", "GET");
                client.classList.add("client");
                client.setAttribute("element_id", bills[num_i].id);
                //client.classList.add("clients_div");
                for (let key in bills[num_i]) {
                    if(bills[num_i].hasOwnProperty(key)){
                        var input_client=document.createElement("input");
                        if (key=="id"){
                            input_client.setAttribute("type", "hidden");
                            
                            //var input_client_id=input_client;
                        }
                        else{
                            input_client.setAttribute("type", "text");
                        }
                        input_client.value=bills[num_i][key];
                        input_client.name=key;
                        client.append(input_client);
                    }
                }
                var info_div=document.createElement("div");
                info_div.classList.add("info_div");
                info_div.setAttribute("type", "hidden");
                info_div.setAttribute("element_id", bills[num_i].id);
                var info_btn=document.createElement("button");
                ////info_btn.setAttribute("type", "submit");
                info_btn.textContent="Info";
                info_btn.classList.add("info_btn");
                info_btn.onclick=function(event){
                    event.preventDefault();
                    var Form_cl=this.parentElement;
                    var id_client=Form_cl.getAttribute("element_id");
                    var xhttp = new XMLHttpRequest();
                    var body_id = 'id_client=' + encodeURIComponent(id_client);
                    xhttp.onreadystatechange = function() {
                    //alert("Ready state="+this.status);
                        if (this.readyState == 4 && this.status == 200) {
                            var bills=JSON.parse(this.responseText);
                            show_bills(bills, id_client);

                        };
                    }
                    xhttp.open("POST", "php/get_bills.php");
                    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhttp.send(body_id);
                }
                
                var save_change_btn=document.createElement("input");
                save_change_btn.setAttribute("type", "submit");
                save_change_btn.value="V";
                save_change_btn.onclick=function(event){
                    event.preventDefault();
                    var Form_cl=this.parentElement;
                    var data = new FormData(Form_cl);
                    /*console.log(Form_cl);
                    console.log(data);*/

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                    //alert("Ready state="+this.status);
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            //var clients= JSON.parse(this.responseText);
                            //console.log(clients);
                            //show_clients(clients);
                        };
                    }
                    xhttp.open("POST", "php/edit_client.php");
                    xhttp.send(data);    
                    
                }
                
                info_div_list[i].append(client);
                info_div_list[i].append(info_div);
            }
        }
    }
}

create_add_div();



