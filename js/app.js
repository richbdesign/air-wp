jQuery.noConflict();

(function($) {
$(document).ready(function () {

	var fixer = $('.callouts').css('margin-left');
    $(".transparentfixer").width(fixer);

    $(window).resize(function() {
        var fixer = $('.callouts').css('margin-left');
        $(".transparentfixer").width(fixer);
    });

    //searcher {}
    	$(".searchbox").hide();
    	$('.searchlink a').on('click', function(e) {
	    	$(".searchbox").slideToggle( "fast" );
	    	$(".searchbox input").focus();
	        e.preventDefault();
	    });

    //terminal images
    $(".pictures").hide();
    $('.viewbtn').on('click', function(e) {
    	$(".pictures").slideToggle();
    	flexsliderStart();
        e.preventDefault();
    });
    $('.closebtn').on('click', function(e) {
    	$(".pictures").slideToggle();
        e.preventDefault();
    });


    //simple tabs
    $('ul.tabs').each(function(){
		// For each set of tabs, we want to keep track of
		// which tab is active and it's associated content
		var $active, $content, $links = $(this).find('a');

		// If the location.hash matches one of the links, use that as the active tab.
		// If no match is found, use the first link as the initial active tab.
		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		$active.addClass('active');

		$content = $($active[0].hash);

		// Hide the remaining content
		$links.not($active).each(function () {
		$(this.hash).hide();
		});

		// Bind the click event handler
		$(this).on('click', 'a', function(e){
		// Make the old tab inactive.
		$active.removeClass('active');
		$content.hide();

		// Update the variables with the new link and content
		$active = $(this);
		$content = $(this.hash);

		// Make the tab active.
		$active.addClass('active');
		$content.show();

		// Prevent the anchor's default click action
		e.preventDefault();
		});
	});

	//promo slider
	$('#promoslider').bjqs({
		'animtype' : 'slide',
		'height' : 339,
		'width' : 982,
		'animspeed'	: 9000,
		'responsive' : true
	});

	//promo slider fix
	$( "ol.bjqs-markers li:first-child" ).addClass( "active-marker" );

	//flexslider
	function flexsliderStart() {
		$('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 210,
		    itemMargin: 5,
		    asNavFor: '#slider'
		});
		   
		$('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel"
	  	});
	}

	//simple accordian
	var allPanels = $('.accordion > dd').hide();
    
	$('.accordion > dt > a').click(function() {
		$this = $(this);
		$target =  $this.parent().next();

		if(!$target.hasClass('active')){
			allPanels.removeClass('active').slideUp();
			$target.addClass('active').slideDown();
		}
		return false;
	});

	//faq tabs
    $('ul.tabber').each(function(){
		// For each set of tabs, we want to keep track of
		// which tab is active and it's associated content
		var $active, $content, $links = $(this).find('a');

		// If the location.hash matches one of the links, use that as the active tab.
		// If no match is found, use the first link as the initial active tab.
		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		$active.addClass('active');

		$content = $($active[0].hash);

		// Hide the remaining content
		$links.not($active).each(function () {
		$(this.hash).hide();
		});

		// Bind the click event handler
		$(this).on('click', 'a', function(e){
		// Make the old tab inactive.
		$active.removeClass('active');
		$content.hide();

		// Update the variables with the new link and content
		$active = $(this);
		$content = $(this.hash);

		// Make the tab active.
		$active.addClass('active');
		$content.show();

		// Prevent the anchor's default click action
		e.preventDefault();
		});
	});

	//select fix
	$('select').change(function() {
		$(this).prev('span').text(
			$(this).find(':selected').html()
		);
	});

});
})(jQuery);