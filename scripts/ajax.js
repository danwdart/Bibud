 
function doAjax(address,id) 
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  alert("Your browser is WAY too old!");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
  document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("GET",address,true);
xmlhttp.send(null);
}

 
function doAjaxFunc(address,func) 
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  alert("Your browser is WAY too old!");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
  eval(func);
  }
}
xmlhttp.open("GET",address,true);
xmlhttp.send(null);
}

function doAjaxSynchronous(address) {
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", address, false);
   xmlhttp.send(null);
   return xmlhttp.responseText;
}

function doAjaxReturn(address) 
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  alert("Your browser is WAY too old!");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
return xmlhttp.responseText;
  }
}
xmlhttp.open("GET",address,true);
xmlhttp.send(null);
}


function doAjaxAndFunc(address,id,func) 
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  alert("Your browser is WAY too old!");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
  document.getElementById(id).innerHTML=xmlhttp.responseText;
  eval(func);
  }
}
xmlhttp.open("GET",address,true);
xmlhttp.send(null);
}
