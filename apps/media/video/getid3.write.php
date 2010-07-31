<?php
////////////////////////////////////////////////////////////
/// getID3() by James Heinrich <getid3@silisoftware.com>  //
//       available at http://www.silisoftware.com        ///
////////////////////////////////////////////////////////////
//                                                        //
// write.php - part of getID3()                           //
// sample script for demonstrating writing ID3v1 and      //
// ID3v2 tags                                             //
// See getid3.readme.txt for more details                 //
//                                                        //
////////////////////////////////////////////////////////////

include_once('getid3.php');
include_once(GETID3_INCLUDEPATH.'getid3.putid3.php');
include_once(GETID3_INCLUDEPATH.'getid3.functions.php'); // Function library

if ($WriteID3v2TagNow) {
	echo 'starting to write tag<BR>';
	$data['id3']['id3v2']['TIT2']['encodingid'] = 0;
	$data['id3']['id3v2']['TPE1']['encodingid'] = 0;
	$data['id3']['id3v2']['TALB']['encodingid'] = 0;
	$data['id3']['id3v2']['TYER']['encodingid'] = 0;
	$data['id3']['id3v2']['TRCK']['encodingid'] = 0;
	$data['id3']['id3v2']['TCON']['encodingid'] = 0;
	$data['id3']['id3v2']['COMM'][0]['encodingid'] = 0;
	$data['id3']['id3v2']['COMM'][0]['language'] = 'eng';
	$data['id3']['id3v2']['TIT2']['data'] = $EditorTitle;
	$data['id3']['id3v2']['TPE1']['data'] = $EditorArtist;
	$data['id3']['id3v2']['TALB']['data'] = $EditorAlbum;
	$data['id3']['id3v2']['TYER']['data'] = $EditorYear;
	$data['id3']['id3v2']['TRCK']['data'] = $EditorTrack;
	$data['id3']['id3v2']['TCON']['data'] = '('.$EditorGenre.')';
	$data['id3']['id3v2']['COMM'][0]['data'] = $EditorComment;

	if ($WriteOrDelete == 'W') { // write tags
		if ($VersionToEdit1 == '1') {
			echo 'ID3v1 changes'.(WriteID3v1($EditorFilename, $EditorTitle, $EditorArtist, $EditorAlbum, $EditorYear, $EditorComment, $EditorGenre, $EditorTrack, TRUE) ? '' : ' NOT').' written successfully<BR>';
		}
		if ($VersionToEdit2 == '2') {
			echo 'ID3v2 changes'.(WriteID3v2($EditorFilename, $data, 3, 0, TRUE, 0, TRUE) ? '' : ' NOT').' written successfully<BR>';
		}
	} else { // delete tags
		if ($VersionToEdit1 == '1') {
			echo 'ID3v1 tag'.(RemoveID3v1($EditorFilename, TRUE) ? '' : ' NOT').' successfully deleted<BR>';
		}
		if ($VersionToEdit2 == '2') {
			echo 'ID3v2 tag'.(RemoveID3v2($EditorFilename, TRUE) ? '' : ' NOT').' successfully deleted<BR>';
		}
	}
}

echo '<A HREF="'.$PHP_SELF.'">Start Over</A><BR>';
echo '<TABLE BORDER="0"><FORM ACTION="'.$PHP_SELF.'" METHOD="POST">';
echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><B>Sample ID3v2 editor</B></TD></TR>';
echo '<TR><TD ALIGN="RIGHT"><B>Filename</B></TD><TD><INPUT TYPE="TEXT" SIZE="20" NAME="EditorFilename" VALUE="'.FixTextFields($EditorFilename).'"></TD></TR>';
if ($EditorFilename) {
	if (file_exists($EditorFilename)) {
		$OldMP3fileInfo = GetAllMP3info($EditorFilename);
		$EditorTitle  = $OldMP3fileInfo['id3']['id3v2']['title'];
		$EditorArtist = $OldMP3fileInfo['id3']['id3v2']['artist'];
		$EditorAlbum  = $OldMP3fileInfo['id3']['id3v2']['album'];
		$EditorYear   = $OldMP3fileInfo['id3']['id3v2']['year'];
		$EditorTrack  = $OldMP3fileInfo['id3']['id3v2']['track'];
		if ($OldMP3fileInfo['id3']['id3v2']['genrelist']['genreid'][0]) {
			$EditorGenre = $OldMP3fileInfo['id3']['id3v2']['genrelist']['genreid'][0];
		} else {
			$EditorGenre = 255;
		}
		$EditorComment = $OldMP3fileInfo['id3']['id3v2']['comment'];
		echo '<TR><TD ALIGN="RIGHT"><B>Title</B></TD><TD><INPUT TYPE="TEXT" SIZE="40" NAME="EditorTitle" VALUE="'.FixTextFields($EditorTitle).'"></TD></TR>';
		echo '<TR><TD ALIGN="RIGHT"><B>Artist</B></TD><TD><INPUT TYPE="TEXT" SIZE="40" NAME="EditorArtist" VALUE="'.FixTextFields($EditorArtist).'"></TD></TR>';
		echo '<TR><TD ALIGN="RIGHT"><B>Album</B></TD><TD><INPUT TYPE="TEXT" SIZE="40" NAME="EditorAlbum" VALUE="'.FixTextFields($EditorAlbum).'"></TD></TR>';
		echo '<TR><TD ALIGN="RIGHT"><B>Year</B></TD><TD><INPUT TYPE="TEXT" SIZE="4" NAME="EditorYear" VALUE="'.FixTextFields($EditorYear).'"></TD></TR>';
		echo '<TR><TD ALIGN="RIGHT"><B>Track</B></TD><TD><INPUT TYPE="TEXT" SIZE="2" NAME="EditorTrack" VALUE="'.FixTextFields($EditorTrack).'"></TD></TR>';
		echo '<TR><TD ALIGN="RIGHT"><B>Genre</B></TD><TD><SELECT NAME="EditorGenre">';
		for ($i=0;$i<=147;$i++) {
			echo '<OPTION VALUE="'.$i.'"';
			if ($EditorGenre == $i) {
				echo ' SELECTED';
			}
			echo '>'.LookupGenre($i).'</OPTION>';
		}
		$i = 255;
		echo '<OPTION VALUE="'.$i.'"'.(($EditorGenre == $i) ? ' SELECTED' : '').'>'.LookupGenre($i).'</OPTION>';
		echo '</TD></TR><TR><TD ALIGN="RIGHT"><B>Comment</B></TD><TD><INPUT TYPE="TEXT" SIZE="40" NAME="EditorComment" VALUE="'.$EditorComment.'"></TD></TR>';
		echo '<INPUT TYPE="HIDDEN" NAME="WriteID3v2TagNow" VALUE="1">';
		echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><INPUT TYPE="RADIO" NAME="WriteOrDelete" VALUE="W" CHECKED> Write <INPUT TYPE="RADIO" NAME="WriteOrDelete" VALUE="D"> Delete</TD></TR>';
		echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><INPUT TYPE="CHECKBOX" NAME="VersionToEdit1" VALUE="1"> ID3v1 <INPUT TYPE="CHECKBOX" NAME="VersionToEdit2" VALUE="2" CHECKED> ID3v2</TD></TR>';
		echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><INPUT TYPE="SUBMIT" VALUE="Save Changes"></TD></TR>';
	} else {
		echo '<TR><TD ALIGN="RIGHT"><B>Error</B></TD><TD>'.FixTextFields($EditorFilename).' does not exist</TD></TR>';
		echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><INPUT TYPE="SUBMIT" VALUE="Find File"></TD></TR>';
	}
} else {
	echo '<TR><TD ALIGN="CENTER" COLSPAN="2"><INPUT TYPE="SUBMIT" VALUE="Find File"></TD></TR>';
}
echo '</FORM></TABLE>';

?>