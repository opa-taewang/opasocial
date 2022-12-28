$("#toi").click(function(e) {
    e.preventDefault();
    $("#main-wrap").toggleClass("launched");
});
if ($(window).width() < 1000) {
  	$('#main-wrap').removeClass('launched');
  	$(".mobileSearch a").click(function(e){
      e.preventDefault();
      $(".search-bar").toggleClass("toggleSearch");
 	});
} else {
  	$('#main-wrap').addClass('launched');
}