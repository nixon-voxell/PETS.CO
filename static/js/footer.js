// collapsible
$(document).ready(function ()
{
  $('.collapsible').collapsible();
});

// carousel
$('.carousel.carousel-slider').carousel({
  fullWidth: true,
  indicators: true
});

var selectableCards = document.getElementsByClassName('selectable-card');

if (selectableCards != null)
{
  for (var c=0; c < selectableCards.length; c++)
  {
    element = selectableCards[c];
    element.addEventListener("mouseover", function(event)
    {
      event.target.classList.add("selectable-card-transition");
      setTimeout(() =>
      {
        event.target.classList.remove("selectable-card-transition");
      }, 400);
    });
  }
}