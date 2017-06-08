
/*--------- Toplist  ---------*/

function records(pagenum) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("recref").innerHTML=this.responseText;
		}
	}
	var diff = document.getElementById("topdif").value
	
	xmlhttp.open("GET","html/records.php?gamedif="+diff+"&pagenum="+pagenum,true);
	xmlhttp.send();	
}				

/*--------- Chat  ---------*/

$(document).ready(function(){
    $(".chatb").click(function(){
        $("#chat").animate({
            height: 'toggle'
        });
    });
});

$(document).ready(function() {
    posting(0);
});

function posting(postref) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("chatref").innerHTML=this.responseText;
		}
	}
	if(postref == 0){
		xmlhttp.open("GET","html/chat.php?",true);
		xmlhttp.send();
		$("#posting").removeClass("disabledbutton");
		setTimeout("posting(0)", 5000);
	} 
	else{
		$("#posting").addClass("disabledbutton");
		var posttext = $('#chattext').val();
		document.getElementById("chattext").value = "";
		xmlhttp.open("GET","html/chat.php?posttext="+posttext,true);
		xmlhttp.send();
	}	
}

/*--------- Játék  ---------*/

var max = 0;
var timeoutstop = false;
var left = 0;
function gamecountdown(str){	
	
	document.getElementById("countdown").style.width = (100/max*left)/10+"%";
	document.getElementById("countdown").textContent= Math.round(left/10);
	document.title = "--- " + Math.round(left/10) + " ---";	
	if(str == 0){
		return stop;
	}
	if(left == 30){
	$("#valasz1").addClass("shake shake-constant shake-constant--hover");
	$("#valasz2").addClass("shake shake-constant shake-constant--hover");
	$("#valasz3").addClass("shake shake-constant shake-constant--hover");
	$("#valasz4").addClass("shake shake-constant shake-constant--hover");
	}
	if(left <= 0){
		alert("Times Up");
		valasz(5);
	}
	else{
		left -= 1;
		document.getElementById("countdown").style.width = 100/max*left+"%";
		document.getElementById("countdown").textContent= Math.round(left/10);
		document.title = "--- " + Math.round(left/10) + " ---";
		if(timeoutstop == false){
			setTimeout("gamecountdown()", 100);	
		}		
	}
}

function timereset(plus){	
	max = 100;
	left = max;
}


function changebi() {
    var questionimg = document.getElementById("questionimg").value;
    var jumbview = document.getElementsByClassName("jumbview");
	
	jumbview[0].style.backgroundImage = "url("+ questionimg +")";
    jumbview[1].style.backgroundImage = "url("+ questionimg +")";
}

function help(num) {
	
	$("#help1").addClass("disabledbutton");
	$("#help2").addClass("disabledbutton");
	$("#help3").addClass("disabledbutton");
	$("#help4").addClass("disabledbutton");
	
	if(num == 1){
		$("#valasz2").addClass("disabledbutton");
		$("#valasz3").addClass("disabledbutton");
		$("#valasz4").addClass("disabledbutton");
	}
	else if(num == 2){
		var help1 = Math.floor(Math.random() * 3)+2;
		var help2 = Math.floor(Math.random() * 3)+2;
		while(help1 == help2){
			var help2 = Math.floor(Math.random() * 3)+2;
		}		
		$("#valasz"+help1).addClass("disabledbutton");
		$("#valasz"+help2).addClass("disabledbutton");
	}
	else if(num == 3){
		var help1 = Math.floor(Math.random() * 3)+2;
		$("#valasz"+help1).addClass("disabledbutton");
	}
	else if(num == 4){
		max = max + 100;
		left = left + 100;
	}

	
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("muvelet").innerHTML=this.responseText;
		}
	}
	$("#help"+num).addClass("disabledbutton");
	
	xmlhttp.open("GET","html/help.php?hnum="+num,true);	
	xmlhttp.send();
}

function diff(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("csere").innerHTML=this.responseText;
		}
	}
	var point = left;
	document.title = "Impossible Quiz";
	timereset(0);
	setTimeout("gamecountdown()", 1000);
	xmlhttp.open("GET","html/game.php?q="+str,true);	
	xmlhttp.send();
	document.getElementById("modal-size").classList.remove("modal-dialog");
}

function valasznext(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("csere").innerHTML=this.responseText;
		}
	}    
	timeoutstop = false;
	document.title = "Impossible Quiz";
	var point = left*10;
	document.getElementById("modal-size").classList.remove("modal-dialog");
	timereset(0);
	xmlhttp.open("GET","html/ingameopt.php?q="+str+"&point="+point,true);
	xmlhttp.send();
}

function valasz(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("csere").innerHTML=this.responseText;
		}
	}
	
	document.title = "Impossible Quiz";
	if(str == 0 || str == 5){
		valasznext(str);
	}
	else{		
		timeoutstop = true;
		$("#valasz1").removeClass("shake shake-constant shake-constant--hover");
		$("#valasz2").removeClass("shake shake-constant shake-constant--hover");
		$("#valasz3").removeClass("shake shake-constant shake-constant--hover");
		$("#valasz4").removeClass("shake shake-constant shake-constant--hover");
		$("#help1").addClass("disabledbutton");
		$("#help2").addClass("disabledbutton");
		$("#help3").addClass("disabledbutton");
		$("#help4").addClass("disabledbutton");
		$("#valasz1").addClass("disabledbuttonw");	
		$("#valasz2").addClass("disabledbuttonw");	
		$("#valasz3").addClass("disabledbuttonw");	
		$("#valasz4").addClass("disabledbuttonw");
		
		if(str == 1){
			$("#valasz1").addClass("flashg");	
		}	
		else{
			$("#valasz1").addClass("flashg");	
			$("#valasz"+str+"").addClass("flashb");	
		}
		
		setTimeout(function() {	
			valasznext(str);
		}, 3000);
	}
	
    
	

	
	
	

}

