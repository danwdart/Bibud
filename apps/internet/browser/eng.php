<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_GET['url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, TRUE);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "source=bibud&status=".$_GET['status']);
curl_setopt($ch, CURLOPT_USERAGENT, "Bibud a4");
// curl_setopt($ch, CURLOPT_USERPWD, $_GET['user'].":".$_GET['pass']);
// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
$output = curl_exec($ch);
$contenttype=curl_getinfo($ch,CURLINFO_CONTENT_TYPE);
curl_close($ch);     
$base="";
$e=explode("/",$_GET['url']);
for ($a=0;$a<=count($e)-2;$a++) {
$base.= $e[$a]."/";
}
if ($base=="http://") {
$base .= $e[2]."/";
}
$base=preg_replace("[^://]","/",$base);

header("Content-type: ".$contenttype);
// Hahaa, nice! Pity the first ones replace Javascripts.
// $output=preg_replace("/ src=\"/i"," src=\"http://www.wpclipart.com/famous/Che_Guevara_01.png\" arg=\"",$output);
// $output=preg_replace("/ src='/i"," src='http://www.wpclipart.com/famous/Che_Guevara_01.png' arg='",$output);
// $output=preg_replace("/ url\('/i"," url('http://www.wpclipart.com/famous/Che_Guevara_01.png'); arg='",$output);


$output=preg_replace("/src=\w/i","src=http://bibud.com/apps/internet/browser/eng.php?url=",$output);
 $output=preg_replace("/href=\w/i","href=http://bibud.com/apps/internet/browser/eng.php?url=",$output);
 $output=preg_replace("/action=\w/i","action=http://bibud.com/apps/internet/browser/eng.php?url=",$output);

 $output=preg_replace('/src="/i','src="http://bibud.com/apps/internet/browser/eng.php?url=',$output);
 $output=preg_replace('/href="/i','href="http://bibud.com/apps/internet/browser/eng.php?url=',$output);
 $output=preg_replace('/action="/i','action="http://bibud.com/apps/internet/browser/eng.php?url=',$output);

 $output=preg_replace("/src='/i","src='http://bibud.com/apps/internet/browser/eng.php?url=",$output);
 $output=preg_replace("/href='/i","href='http://bibud.com/apps/internet/browser/eng.php?url=",$output);
 $output=preg_replace("/action='/i","action='http://bibud.com/apps/internet/browser/eng.php?url=",$output);



 $output=preg_replace("/url=/","url=".$base,$output);
 $output=str_replace($base."http://","http://",$output);
$output=str_replace($base."\"http://","http://",$output);
$output=str_replace($base."\"",$base,$output);


echo $output;
?>
