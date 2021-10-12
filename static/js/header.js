// get page file name (should match nav bar link ids)
var path = window.location.pathname;
var page = path.split("/").pop().split(".")[0];

var links = document.getElementsByClassName(page);
if (links[0] != null) links[0].classList.add("glow-gradient-box");