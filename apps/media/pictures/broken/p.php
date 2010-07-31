<div id="pictures" class="app_large" style="background-color:#333333;">

<script type="text/javascript">

var speed=1;
var degrees=0;
var deginc=0.00;
var radius=200;
var friction=0.02;
var fastest=2.00;

redo();
init();

function posImg(img,degrees,rad) {
sinvalue=Math.sin(degrees*(Math.PI/180));
cosvalue=Math.cos(degrees*(Math.PI/180));
heightr=100;
//+Math.floor(50*sinvalue);
document.getElementById(img).style.height=heightr;
document.getElementById(img).style.width=heightr;
document.getElementById(img).style.top=Math.floor(288+radius*sinvalue)-(heightr/2)+"px";
document.getElementById(img).style.left=Math.floor(500+1.5*radius*cosvalue)-(heightr/2)+"px";
}

function init() {
//Don't do the sums if we're not spinning
if (deginc != 0) {
for (i=1;i<=total;i++) {
posImg("r"+i,Math.floor(degrees+(i/total)*360),radius);
}
//Don't get too fast!
if (deginc > fastest) {
deginc = fastest;
}
if (deginc < -(fastest)) {
deginc = -(fastest);
}
//And slow down!
if (deginc >0) {
deginc-=friction;
}
if (deginc < 0)  {
deginc +=friction;
}
degrees+=deginc;
//Don't overflow
if (degrees >=360) {degrees=0;}
timer = setTimeout("init();",speed);
}
} 


function goright() {
deginc=fastest;
}

function goleft() {
deginc=-(fastest);
}

function redo() {
doAjax("apps/media/pictures/ajax.php?showpics","pics");
total=doAjaxSynchronous("apps/media/pictures/ajax.php?numpics");
}

function showImg(idx) {
document.getElementById('bigpic').src=document.getElementById(idx).src;
}

</script>
<a href="#" onclick="hide('pictures');">Close</a>
<input type="button" onclick="redo();init();" value="Go!" />
<br />
<input type="button" onclick="goright();" value="Right!" />
<input type="button" onclick="goleft();" value="Left!" />

<div id="pics"></div>
<img id="bigpic" name="bigpic" style="position:absolute;top:188px;left:400px;max-height:200px;max-width:200px;" />
</div>
