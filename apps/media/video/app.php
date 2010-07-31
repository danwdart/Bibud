<div id="video" class="app_large">

<div id="video_main" style="width:74%;float:left;padding:0.5%;">

<!--<a href="#" onclick="hide('video');">Close</a>-->
&nbsp;&nbsp;&nbsp;&nbsp;<span id="video_currentlyPlaying" style="font-size: 14pt;font-family: sans-serif;font-weight:700;text-align: center;width:100%;">Currently Playing: None</span>
<br /><hr />
<video id="video_player" controls="true" autoplay="false" style="width:100%;max-height:470px;" onended="javascript:video_next_video();">Needs HTML5 Browser</video>
<hr />
</div>

<div id="video_playlist_cont" style="width:24%;float:left;text-align:left;padding:0.5%;height:400px;">
<!--<a href="#" onclick="hide('video_playlist_cont')">Close</a>-->
<!--      <p id="video_options" class="appActions" style="font-family: sans-serif; font-size: 8pt;margin:0px;padding:0px;border-bottom:1px solid black;">
      <a id="video_shuffle_option" href="javascript:video_shuffle(true);">Shuffle (off)</a> | 
      <a id="video_repeat_option" href="javascript:video_repeat(true);">Repeat (off)</a>  #
      </p>
-->
  <div id="video_top">
Playlist:
<br />
<a id="rescan_music" href="javascript:index_video();">Reindex Video</a></b>&nbsp;|&nbsp;
<a id="refresh_playlist" href="javascript:refresh_video_playlist();">Refresh Playlist</a></b>&nbsp;

  </div>

   <div id="video_playlist" style="width:23%;padding:0.5%;border:solid 1px black;display:block;overflow:auto;height:400px;position:absolute;">
   </div>  


</div>

</div>

 <script type="text/javascript">
video_init();
var currentVideoId = "None";

// Ugh, look at this.
function index_video() {
doAjaxSynchronous("apps/media/video/ajax.php?what=index_video"); 
}
function refresh_video_playlist() {
doAjax("apps/media/video/ajax.php?what=playlist", "video_playlist"); 
}

function video_init() {
	//index users video
	index_video();
	//populate the playlist
	refresh_video_playlist();
	//setup the player
	var videoplayer = document.getElementById("video_player");
	videoplayer.addEventListener("loadedmetadata", function() {
			videoplayer.play();
	}, true);
}

function video_play(id) {
	currentVideoId = id;
	var currentVideoElement = document.getElementById("video_video_" + id);
	var currentVideoHref = currentVideoElement.getAttribute("data-path");
		currentVideoHref='scripts/embed.php?file='+currentVideoHref;
	var currentVideoTitle = currentVideoElement.getAttribute("data-title");
   var videoplayer = document.getElementById("video_player");
   videoplayer.setAttribute("src", currentVideoHref);
   videoplayer.load();
   document.getElementById("video_currentlyPlaying").innerHTML = "Currently Playing: " + currentVideoTitle;
//     doAjax("apps/media/video/ajax.php?info="+id,"video_info");
//    video_info();
}
function video_next_video() {
   var numVideos = doAjaxSynchronous("apps/media/video/ajax.php?what=num_videos");
   var nextVideoId = ++currentVideoId;   
   
   if (nextVideoId > numVideos) {
      nextVideoId = 0;
   }

	video_play(nextVideoId);
}
</script>
 
