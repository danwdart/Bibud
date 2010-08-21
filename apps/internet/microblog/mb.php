<?php
// Give it some SSL, man.
function setFacebookStatus($status, $login_email, $login_pass, $debug=false) {
	    //CURL stuff
	    //This executes the login procedure
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?m&amp;next=http%3A%2F%2Fm.facebook.com%2Fhome.php');
	    curl_setopt($ch, CURLOPT_POSTFIELDS, 'email=' . urlencode($login_email) . '&pass=' . urlencode($login_pass) . '&login=' . urlencode("Log in"));
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
		curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    //make sure you put a popular web browser here (signature for your web browser can be retrieved with 'echo $_SERVER['HTTP_USER_AGENT'];'
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; U; Linux x86_64; en-GB; rv:1.9.2.8) Gecko/20100723 Ubuntu/10.04 (lucid) Firefox/3.6.8");
	    curl_exec($ch);
	 
	    //This executes the status update
	    curl_setopt($ch, CURLOPT_POST, 0);
	    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
	    $page = curl_exec($ch);
	 
	    //echo htmlspecialchars($page);
	 
		curl_setopt($ch, CURLOPT_POST, 1);
	    //this gets the post_form_id value
	    preg_match("/input type=\"hidden\" name=\"post_form_id\" value=\"(.*?)\"/", $page, $form_id);
	    preg_match("/input type=\"hidden\" name=\"fb_dtsg\" value=\"(.*?)\"/", $page, $fb_dtsg);
	    preg_match("/input type=\"hidden\" name=\"charset_test\" value=\"(.*?)\"/", $page, $charset_test);
	    preg_match("/input type=\"submit\" class=\"button\" name=\"update\" value=\"(.*?)\"/", $page, $update);
	 
	    //we'll also need the exact name of the form processor page
	    //preg_match("/form action=\"(.*?)\"/", $page, $form_num);
	    //sometimes doesn't work so we search the correct form action to use
	    //since there could be more than one form in the page.
	    preg_match_all("#<form([^>]*)>(.*)</form>#Ui", $page, $form_ar);
	    for($i=0;$i<count($form_ar[0]);$i++)
	        if(stristr($form_ar[0][$i],"post_form_id")) preg_match("/form action=\"(.*?)\"/", $page, $form_num);   
	 
	    $strpost = 'post_form_id=' . $form_id[1] . '&status=' . urlencode($status) . '&update=' . urlencode($update[1]) . '&charset_test=' . urlencode($charset_test[1]) . '&fb_dtsg=' . urlencode($fb_dtsg[1]);
	    if($debug) {
	        echo "Parameters sent: ".$strpost."<hr>";
	    }
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strpost );
	 
	    //set url to form processor page
	    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com' . $form_num[1]);
	    curl_exec($ch);
	 
	    if ($debug) {
	        //show information regarding the request
	        print_r(curl_getinfo($ch));
	        echo curl_errno($ch) . '-' . curl_error($ch);
        echo "FB OK";
	    }
	    //close the connection
	    curl_close($ch);
	}


$ch = curl_init();
if ($_GET['service']=="facebook") {
	setFacebookStatus($_GET['status'], $_GET['email'], $_GET['pass'], false);
}
else {
if ($_GET['service']=="identica") {
curl_setopt($ch, CURLOPT_URL, "http://identi.ca/api/statuses/update.xml");
}
elseif ($_GET['service']=="twitter") {
curl_setopt($ch, CURLOPT_URL, "http://twitter.com/statuses/update.xml");
}
else {
curl_setopt($ch, CURLOPT_URL, "http://".$_GET['service']."/statuses/update.xml");
}
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, "source=bibud&status=".$_GET['status']);
curl_setopt($ch, CURLOPT_USERAGENT, "Bibud a6");
curl_setopt($ch, CURLOPT_USERPWD, $_GET['user'].":".$_GET['pass']);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
$output = curl_exec($ch);
curl_close($ch);     
echo $output;
}
?>
