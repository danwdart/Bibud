<?php
////////////////////////////////////////////////////
// GetURLImageSize( $URLData ) determines the
// dimensions of local file/remote URL/pic-data-string pictures.
// returns array with ( $width,$height,$type )
//
// Thanks to: Oyvind Hallsteinsen aka Gosub / ELq - gosub@elq.org
// for the original size determining code
//
// PHP Hack by Filipe Laborde-Basto Oct 21/2000
// FREELY DISTRIBUTABLE -- use at your sole discretion! :) Enjoy.
// (Not to be sold in commercial packages though, keep it free!)
// Feel free to contact me at fil@rezox.com (http://www.rezox.com)
//
// Revised 7 Apr 2002 by Fil Laborde. Now multi-functional:
// can read dimensions from URL, file, or string
// Idea for getting dimensions from strings by
// James Heinrich <james@jamesheinrich.com>
//
// Reformatted somewhat by James Heinrich for inclusion in
// getID3() <getid3@silisoftware.com>
////////////////////////////////////////////////////

define('GIF_SIG', chr(0x47).chr(0x49).chr(0x46));
define('JPG_SIG', chr(0xFF).chr(0xD8).chr(0xFF));
define('PNG_SIG', chr(0x89).chr(0x50).chr(0x4E).chr(0x47).chr(0x0D).chr(0x0A).chr(0x1A).chr(0x0A));
define('JPG_SOF', chr(0xC0)); // Start Of Frame N 1100xxxx -- higher 4 bits are SOF, lower 4 are frame #
define('JPG_EOI', chr(0xD9)); // End Of Image (end of datastream)
define('JPG_SOS', chr(0xDA)); // Start Of Scan - image data start
define('RD_BUF', 512);        // amount of data to initially read


function GetURLImageSize($URLData) {
	// initialize variables
	$Width   = 0;
	$Height  = 0;
	$Type    = 0;
	$imgPos  = 0;
	$imgData = '';

	if (((strlen($URLData) < 200) && is_file($URLData)) || (substr(strtolower($URLData), 0, 7) == 'http://')) {
		// if a filename or URL
		if ($fp = @fopen($URLData, 'rb')) {
			$imgData = fread($fp, RD_BUF);
		} else {
			return FALSE;
		}
	} else { // is a data-string
		$imgData = $URLData;
	}
	if ($imgData) {
		if (substr($imgData, 0, 3) == GIF_SIG) {
			$dim = unpack('v2dim', substr($imgData, 6, 4));
			$Width  = $dim['dim1'];
			$Height = $dim['dim2'];
			$Type = 1;
		} else if (substr($imgData, 0, 8) == PNG_SIG) {
			$dim = unpack('N2dim', substr($imgData, 16, 8));
			$Width  = $dim['dim1'];
			$Height = $dim['dim2'];
			$Type = 3;
		} else if (substr($imgData, 0, 3) == JPG_SIG) {
			$imgPos = 2;
			$Type = 2;
			while ($imgPos < strlen($imgData)) { // Scan through JPG Chunk
				$imgPos = strpos($imgData, 0xFF, $imgPos) + 1; // synchronize to the marker 0xFF
				while ($imgData{$imgPos++} == chr(0xFF)) {
					// find first non-0xFF character
				}
				$ChunkType = $imgData{$imgPos++};

				// find dimensions of block
				if (($ChunkType & chr(0xF0)) == JPG_SOF) {
					// Grab width/height from SOF segment (these are acceptable chunk types)
					$dim = unpack('n2dim', substr($imgData, $imgPos + 3, 4));
					$Height = $dim['dim1'];
					$Width  = $dim['dim2'];
echo "JPG: found: ".PrintHexBytes(substr($imgData, $imgPos + 3, 4))." breaking<BR>";
					break; // found it, exit loop
				} else if (($ChunkType == JPG_EOI) || ($ChunkType == JPG_SOS)) {
					// End loop in case we find one of these markers
					return FALSE;
echo "JPG: EOI/SOS breaking<BR>";
				} else {
					// Another type of chunk -- skip it!
					$ChunkSize = (ord($imgData{$imgPos++}) << 8) + ord($imgData{$imgPos++}) - 2;
					if (isset($fp) && (strlen($imgData) < ($ChunkSize + $imgPos + 16))) {
						// if the skip is more than what we've read in, read more
						// if file/URL && next chunk not in memory, go read it
						$imgData .= fread($fp, $ChunkSize + (2 * RD_BUF));
					}
					$imgPos += $ChunkSize;
				} //endif check marker type
			} //endif loop through JPG chunks
		} //endif chk for valid file types
		if (isset($fp)) {
			fclose($fp);
		} // close file
	}
	return array($Width, $Height, $Type);
} // end function
?>