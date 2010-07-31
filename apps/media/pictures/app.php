<div id="pictures" class="app_large">
<script type="text/javascript">
doAjax("apps/media/pictures/ajax.php?showpics&size=100","pics");
var size=100;
function pictures_reload(size) {
doAjax('apps/media/pictures/ajax.php?showpics&size='+size,'pics');
}
function pictures_bigger() {
size+=20;
if (size>=200) {size=200;}
pictures_reload(size);
}
function pictures_smaller() {
size-=20;
if (size<=20) {size=20;}
pictures_reload(size);
}
function showImg(id) {
document.getElementById("bigpic").src=document.getElementById(id).src;
document.getElementById("pics").style.opacity="0.2";
document.getElementById("bigpicdiv").style.display="block";
}
function closeImg() {
document.getElementById("pics").style.opacity="1";
document.getElementById("bigpicdiv").style.display="none";

}
</script>
<!--
  <a href="#" onclick="hide('pictures');">Close</a>

<input type="button" value="Bigger" onclick="pictures_bigger();"/>
<input type="button" value="Smaller" onclick="pictures_smaller();"/>
-->
  <h1 style="text-align:center;">Photo Gallery</h1>
  <a href="#" onclick="pictures_reload(100);">Refresh Pictures</a>
  <div style="width:100%;text-align:center;">
    <div id="pics" style="overflow:auto;margin:0 auto;width:75%;background-color:#666666;"></div>
    <div id="bigpicdiv" style="position:absolute;top:40px;left:12.5%;display:none;margin:auto;width:75%;overflow:auto;height:450px;text-align:center;">
      <p style="position:absolute;top:0px;left:0px;font-size:12pt;"><a href="#" onclick="closeImg();">Close</a></p>
      <br />
      <img id="bigpic" name="bigpic" style="max-height:90%;max-width:90%;margin:auto;" />
    </div>
  </div>


</div>
