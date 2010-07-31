var theme = "crystal";
function init() {
document.getElementById('desktoptab').style.backgroundColor='rgb(204,204,204)';
}

function toggle(app) {
    var this_app = document.getElementById(app);
    var is_small = false;
    if (class_contains(this_app, 'app_small')) {
        is_small = true;
    }
 
    if (this_app.style.display=="block") {
hide(app);
    }
    else {
show(app);
    }
}

function show (app) {
    var this_app = document.getElementById(app);
    var is_small = false;
    if (class_contains(this_app, 'app_small')) {
        is_small = true;
    }
  this_app.style.display="block";
        if (is_small) {
            set_large_apps_width('74%'); //740px
        }
appToTop(app);
}

function hide(app) {
    var this_app = document.getElementById(app);
    var is_small = false;
    if (class_contains(this_app, 'app_small')) {
        is_small = true;
    }
 this_app.style.display="none";
        if (is_small) {
            set_large_apps_width('99%'); //940px
        }
}


 function chgcol(obj) {
elems = document.getElementsByTagName('div');
    for (var e = 0; e < elems.length; e++) {
        if (class_contains(elems[e], 'tab')) {
            elems[e].style.backgroundColor="#eeeeee";
        }
}
 obj.parentNode.style.backgroundColor='rgb(204,204,204)';
 }


 
function class_contains(elem, search) {
    var attr = elem.getAttribute('class');
    if (attr == null) {
        return false;
    }
    var classes = attr.split(' ');
    for (var c = 0; c<classes.length; c++) {
        if (classes[c].toLowerCase() == search.toLowerCase()) {
            return true;
        }
    }
    return false;
}
 
function set_large_apps_width(width) {
    elems = document.getElementsByTagName('div');
    for (var e = 0; e < elems.length; e++) {
        if (class_contains(elems[e], 'app_large')) {
            elems[e].style.width = width;
        }
    }
}

function appToTop(app) {
 elems = document.getElementsByTagName('div');
    for (var e = 0; e < elems.length; e++) {
        if (class_contains(elems[e], 'app_large') || class_contains(elems[e], 'app_small') || class_contains(elems[e], 'app_tiny')) {
            elems[e].style.zIndex = "-1";
        }
}
document.getElementById(app).style.zIndex="1";
}

function hideAll() {
elems = document.getElementsByTagName('div');
    for (var e = 0; e < elems.length; e++) {
        if (class_contains(elems[e], 'app_large') || class_contains(elems[e], 'app_small')) {
            elems[e].style.display="none";
	    set_large_apps_width('99%'); // 990px
        }
}

}



function ltrim(str) { 
	for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
	return str.substring(k, str.length);
}
function rtrim(str) {
	for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ;
	return str.substring(0,j+1);
}
function trim(str) {
	return ltrim(rtrim(str));
}
function isWhitespace(charToCheck) {
	var whitespaceChars = " \t\n\r\f";
	return (whitespaceChars.indexOf(charToCheck) != -1);
}



function wygon(uid,textarea) {
uid=new nicEditor({iconsPath : 'nicEditorIcons.gif'}).panelInstance(textarea);
}
function wygoff(uid,textarea) {
uid.removeInstance(textarea);
}
