<div id="blog" class="app_large">
<!--<a href="#" onclick="document.getElementById('blog').style.display='none';">Close</a>-->
<a href="#" onclick="document.getElementById('blog_new').style.display='block';">New Post</a>
&nbsp;&nbsp;
<a href="#" onclick="refreshpage();">Refresh</a>
&nbsp;&nbsp;
<!--
Posts per page:
<select id="postsperpage" onchange="refreshpage();">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<a href="#" onclick="previouspage();">&lt;- Previous Page</a>
&nbsp;&nbsp;
<a href="#" onclick="nextpage();">Next Page -&gt;</a>
-->
<script type="text/javascript">
<!--
refreshpage();
var blogNic;
bkLib.onDomLoaded(function() {blogNic=new nicEditor({iconsPath : 'scripts/nicEditorIcons.gif'}).panelInstance('blog_text'); });
function wygonblog() {
blogNic=new nicEditor({iconsPath : 'scripts/nicEditorIcons.gif'}).panelInstance("blog_text");
}
function wygoffblog() {
blogNic.removeInstance("blog_text");
}

function hidesender_blog() {
document.blog_new_form.reset();
hide ('blog_new');
refreshpage();
}

function refreshpage() {
doAjax("apps/internet/blog/getPosts.php","blog_posts");
}
function blogDeletePost(id) {
doAjaxFunc("apps/internet/blog/deletePost.php?id="+id,"refreshpage();");
}

function blog_submit() {
hide ('blog_new');
wygoffblog();
doAjaxFunc('apps/internet/blog/submit.php?title='+document.blog_new_form.blog_title.value+'&text='+document.blog_new_form.blog_text.value,"hidesender_blog();");
wygonblog();
}



// -->
</script>


  <div id="blog_posts" style="position:absolute;width:49%;top:20px;left:5px;overflow:auto;height:500px;">
  </div>
<div id="blog_new" style="display:none;position:absolute;width:50%;left:50%;top:25px;">
<h1>New Post</h1>
<form name="blog_new_form">
<p>Title: <input type="text" id="blog_title" name="blog_title" /></p>
<p>Text: <textarea name="blog_text" id="blog_text" style="width:400px;height:300px;"></textarea>
<br /><input type="button" onclick="blog_submit();" value="Post">
<input type="button" onclick="hidesender_blog();" value="Discard" />
<div id="blogsentisok"></div>
</form>
</div>



</div>
