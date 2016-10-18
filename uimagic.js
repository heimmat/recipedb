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
	$(".tab ul li a").click(tabChange);
	if (window.location.hash)
	{
		$("a[href='" + window.location.hash + "']").click();
	}
}

function hideMenu()
{
 	var x = document.getElementById("headernav");
    if (x.className === "topnav")
    {
        x.className += " responsive";
    }
    else
    {
        x.className = "topnav";
    }
}

//http://jsfiddle.net/syahrasi/us8uc/
function tabChange(event)
{
	event.preventDefault();
	$(this).parent().addClass("current");
	$(this).parent().siblings().removeClass("current");
	var tab = $(this).attr("href");
	window.location.hash = tab;
	$(".tabcontent").not(tab).css("display", "none");
	$(tab).fadeIn();
}
