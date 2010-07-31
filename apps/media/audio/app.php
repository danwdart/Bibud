<div id="audio_player_div" class="app_tiny" style='display:block;'>
<audio id="audio_musicPlayer" controls="true" autoplay="false" style="width:100%;height:25px;x-index:20;" onended="javascript:audio_next_song();">Needs HTML5 Browser</audio>
</div>

<div id="audio" class="app_large">

<!--<a href="#" onclick="hide('audio');">Close</a>
<br />-->
 <script type="text/javascript">
/*
function audio_hide() {
document.getElementById('audio_player_div').style.height="10px";
document.getElementById('audio_musicPlayer').style.display="none";
}
function audio_show() {
document.getElementById('audio_player_div').style.height="25px";
document.getElementById('audio_musicPlayer').style.display="block";
}
*/

audio_init();
var currentSongId = "None";

function index_music() {

doAjaxSynchronous("apps/media/audio/ajax.php?what=index_music"); 
}

function audio_init() {
	//index users music
	if (doAjaxSynchronous("apps/media/audio/ajax.php?anymusic") == "false") {
	  index_music();
	  }
	//populate the playlist
	doAjax("apps/media/audio/ajax.php?what=playlist", "audio_playlist"); 
	//setup the player
	var player = document.getElementById("audio_musicPlayer");
	player.addEventListener("loadedmetadata", function() {
			player.play();
	}, true);
}

function audio_showPlaylist() {
   toggle("audio_playlist");
}

function audio_play(id) {
	currentSongId = id;
	var currentSongElement = document.getElementById("audio_song_" + id);
	var currentSongHref = currentSongElement.getAttribute("data-path");
	var currentSongTitle = currentSongElement.getAttribute("data-playing");
   var player = document.getElementById("audio_musicPlayer");
   player.setAttribute("src", currentSongHref);
   player.load();
   document.getElementById("audio_currentlyPlaying").innerHTML =  currentSongTitle;
}

function audio_next_song() {
   var numSongs = doAjaxSynchronous("apps/media/audio/ajax.php?what=num_songs");
   var nextSongId = ++currentSongId;   
   
   if (nextSongId > numSongs) {
      nextSongId = 0;
   }

	audio_play(nextSongId);
}

function refresh_playlist() {
doAjax("apps/media/audio/ajax.php?what=playlist", "audio_playlist"); 
}
</script>
    

      <p id="audio_currentlyPlaying" style="font-size: 10pt;font-family: sans-serif;	text-align: center;padding-top: 5px;padding-bottom: 5px;color: white;background-color: black;">Currently Playing: None</p>
      <p id="audio_options" class="appActions" style="font-family: sans-serif; font-size: 8pt;margin:5px 0px 5px 0px;padding:0px;">
     <!-- <a id="audio_playlist_option" href="javascript:audio_showPlaylist();">Show Playlist</a> |  -->
      <b><a id="rescan_music" href="javascript:index_music();">Rescan Music</a></b>&nbsp;|&nbsp;
      <a id="refresh_playlist" href="javascript:refresh_playlist();">Refresh Playlist</a></b>&nbsp;|&nbsp;
      <a id="audio_shuffle_option" href="javascript:audio_shuffle(true);">Shuffle (off)</a> | 
      <a id="audio_repeat_option" href="javascript:audio_repeat(true);">Repeat (off)</a> 
      </p>
<table border='0' width='100%'><tr><td><b>Title</b></td><td><b>Artist</b></td><td><b>Album</b></td><td><b>Share?</b></td><tr><td></td><td></td><td></td></tr></table>
   <div id="audio_playlist" style="background-color:white;display:block;overflow:auto;min-height:1px;max-height:425px;min-width:400px;">
   </div>
</div>




