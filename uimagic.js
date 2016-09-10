$(document).ready(documentInit);


function setActiveClass()
{
	var currentPage = location.href;
	var allA = document.getElementsByTagName('a');
	for(var i = 0, len = allA.length; i < len; i++) {
	    if(allA[i].href == currentPage) {
	         allA[i].className = "active";
	    }
	}
}

function documentInit()
{
	setActiveClass();
}

