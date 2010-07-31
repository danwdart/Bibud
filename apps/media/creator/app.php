<div id="creator" class="app_large">
<input type="button" value="draw!" onclick="initcanvas();">
<canvas id="canvas" style="width:1000px;height:500px;" >Your browser isn't capable of using HTML5!</canvas>

<script type="text/javascript">

window.addEventListener('load', function () {
  var canvas, context;
  function initcanvas () {
    canvas = document.getElementById('canvas');
    if (!canvas) {
      alert('Error: I cannot find the canvas element!');
      return;
    }
    if (!canvas.getContext) {
      alert('Error: no canvas.getContext!');
      return;
    }
    context = canvas.getContext('2d');
    if (!context) {
      alert('Error: failed to getContext!');
      return;
    }
    canvas.addEventListener('mousemove', ev_mousemove, false);
  }
  var started = false;
    var x, y;

  function ev_mousemove (ev) {
    var x, y;
    if (ev.layerX || ev.layerX == 0) { // Firefox
      x = ev.layerX;
      y = ev.layerY;
    } else if (ev.offsetX || ev.offsetX == 0) { // Opera
      x = ev.offsetX;
      y = ev.offsetY;
    }
    if (!started) {
      context.beginPath();
      context.moveTo(x, y);
      started = true;
    } else {
      context.lineTo(x, y);
      context.stroke();
    }
  }

  initcanvas();
}, false); 



function drawcircle(evt) {
circle (evt.clientX,evt.clientY,5);
}


function circle(x,y,r) {
  ctx.beginPath();
  ctx.arc(x, y, r, 0, Math.PI*2, true);
  ctx.closePath();
  ctx.fill();
}

function rect(x,y,w,h) {
  ctx.beginPath();
  ctx.rect(x,y,w,h);
  ctx.closePath();
  ctx.fill();
}

function clear() {
  ctx.clearRect(0, 0, WIDTH, HEIGHT);
}

function roundedRect(ctx,x,y,width,height,radius){  
  ctx.beginPath();  
  ctx.moveTo(x,y+radius);  
  ctx.lineTo(x,y+height-radius);  
  ctx.quadraticCurveTo(x,y+height,x+radius,y+height);  
  ctx.lineTo(x+width-radius,y+height);  
  ctx.quadraticCurveTo(x+width,y+height,x+width,y+height-radius);  
  ctx.lineTo(x+width,y+radius);  
  ctx.quadraticCurveTo(x+width,y,x+width-radius,y);  
  ctx.lineTo(x+radius,y);  
  ctx.quadraticCurveTo(x,y,x,y+radius);  
  ctx.stroke();  
}

function paint() {
 canvas = document.getElementById('creator_pic');
if (canvas.getContext){  
    var ctx = canvas.getContext('2d');
ctx.fillRect(event.clientX,event.clientY,5,5);
}
}
 
function draw(){  
 
  if (canvas.getContext){  
    var ctx = canvas.getContext('2d');
  
/*
https://developer.mozilla.org/en/Canvas_tutorial
Commands:
 ctx.fillStyle = "rgba(0, 0, 200, 0.5)";
fillRect(x,y,width,height) : Draws a filled rectangle
strokeRect(x,y,width,height) : Draws a rectangular outline
clearRect(x,y,width,height) : Clears the specified area and makes it fully transparent
moveTo(x, y)
lineTo(x,y)
ctx.arc(75,75,50,0,Math.PI*2,true); // Outer circle  
arc(x, y, radius, startAngle, endAngle, anticlockwise)
beginPath()
closePath()
stroke()
fill()

quadraticCurveTo(cp1x, cp1y, x, y) // BROKEN in Firefox 1.5 (see work around below)
bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y)

Mouse position: event.clientX? event.clientY?
*/  

ctx.fillStyle = "rgba(0, 0, 200, 0.5)";
    ctx.fillRect(25,25,100,100);  
  }  
}  
</script>
</div>
