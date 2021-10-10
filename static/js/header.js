// get page file name (should match nav bar link ids)
var path = window.location.pathname;
var page = path.split("/").pop().split(".")[0];

var link = document.getElementById(page);
if (link != null) link.classList.add("orange-text");