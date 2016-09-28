$(function() {
$( "#datepicker" ).datepicker();
});


function show(str)
{
	if(str=="")
	{
		document.getElementById("show").innerHTML="Pleaze select a name";
		return;
	}
	if(window.XMLHttpRequest)
	{
				  // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	
	}
	else
	{
				  // code for IE6, IE5
		xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("show").innerHTML=xmlhttp.responseText;
		}
	
	}
	xmlhttp.open("GET","config.php?q="+str,true);
	xmlhttp.send();

}



