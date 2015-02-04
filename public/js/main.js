jQuery(function($) {

	//#main-slider
	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 8000
		});
	});

	$( '.centered' ).each(function( e ) {
		$(this).css('margin-top',  ($('#main-slider').height() - $(this).height())/2);
	});

	$(window).resize(function(){
		$( '.centered' ).each(function( e ) {
			$(this).css('margin-top',  ($('#main-slider').height() - $(this).height())/2);
		});
	});

	//portfolio
	/*$(window).load(function(){
		$portfolio_selectors = $('.portfolio-filter >li>a');
		if($portfolio_selectors!='undefined'){
			$portfolio = $('.portfolio-items');
			$portfolio.isotope({
				itemSelector : 'li',
				layoutMode : 'fitRows'
			});
			$portfolio_selectors.on('click', function(){
				$portfolio_selectors.removeClass('active');
				$(this).addClass('active');
				var selector = $(this).attr('data-filter');
				$portfolio.isotope({ filter: selector });
				return false;
			});
		}
	});*/

	//contact form
	var form = $('.contact-form');
	form.submit(function () {
		$this = $(this);
		$.post($(this).attr('action'), function(data) {
			$this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
		},'json');
		return false;
	});

	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});	

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});	
	
	//socialnetwork close
	$(".close-social").click(function(){
		$("#topnav").hide();
		$("body").css('padding-top', '48px');
		$(".open-me").css('display' , 'block');
	});
	
	$(".open-me").click(function(){
		$("#topnav").show();
		$("body").css('padding-top', '80px');
		$(".open-me").css('display' , 'none');
	});
	
	
	//loginpopup open and close
	$(".login").click(function(){
		$(".login_popupdiv").css('display' , 'block');
	});
	
	$(".login_btn").click(function(){
		$(".login_popupdiv").css('display' , 'none');
	});
	
	//message close
	
	
	//tooltip	
	$(function() {
		$("#price_range").slider({reversed : false});
	});
	
	//select2 autocomplete
	$(".js-example-placeholder-multiple").select2({
	placeholder: "Select SubLocation"
	});
	
	$(".js-example-placeholder-multiple-furnituretype").select2({
	placeholder: "Select Furniture Type"
	});
	
	$(".js-example-placeholder-multiple-clocation").select2({
	placeholder: "Select Commercial SubLocation"
	});
	
	$(".js-example-placeholder-multiple-cfurnituretype").select2({
	placeholder: "Select Commercial Furniture Type"
	});
	
	//select2 autocomplete
	
	
	$(function() {
	$("#image_slickbar").slider({});
	$("#image_slickbar").on("slide", function(slideEvt) {
		//$("#ex6SliderVal").text(slideEvt.value);
		//alert(slideEvt.value);
	});
	});
	
	$('#myCarousel').carousel({
	interval: 4000
});

	// handles the carousel thumbnails
	$('[id^=carousel-selector-]').click( function(){
	  var id_selector = $(this).attr("id");
	  var id = id_selector.substr(id_selector.length -1);
	  id = parseInt(id);
	  $('#myCarousel').carousel(id);
	  $('[id^=carousel-selector-]').removeClass('selected');
	  $(this).addClass('selected');
	});
	
	// when the carousel slides, auto update
	$('#myCarousel').on('slid', function (e) {
	  var id = $('.item.active').data('slide-number');
	  id = parseInt(id);
	  $('[id^=carousel-selector-]').removeClass('selected');
	  $('[id=carousel-selector-'+id+']').addClass('selected');
	});
	
	
	
	function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 300,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header,"smaller");
        } else {
            if (classie.has(header,"smaller")) {
                classie.remove(header,"smaller");
            }
        }
		});
	}
	window.onload = init();
	
	/*$(document).ready(function(){
    $(".propertyinfo .propertyformsteps").each(function(e) {
        if (e != 0)
            $(this).hide();
    });

    $("#next").click(function(){
        if ($(".propertyinfo .propertyformsteps:visible").next().length != 0)
            $(".propertyinfo .propertyformsteps:visible").next().show().prev().hide();
        else {
            $(".propertyinfo .propertyformsteps:visible").hide();
            $(".propertyinfo .propertyformsteps:first").show();
        }
        return false;
    });

    $("#prev").click(function(){
        if ($(".propertyinfo .propertyformsteps:visible").prev().length != 0)
            $(".propertyinfo .propertyformsteps:visible").prev().show().next().hide();
        else {
            $(".propertyinfo .propertyformsteps:visible").hide();
            $(".propertyinfo .propertyformsteps:last").show();
        }
        return false;
    });
	
	
	$(".cpropertyinfo .propertyformsteps").each(function(e) {
        if (e != 0)
            $(this).hide();
    });

    $("#cnext").click(function(){
        if ($(".cpropertyinfo .propertyformsteps:visible").next().length != 0)
            $(".cpropertyinfo .propertyformsteps:visible").next().show().prev().hide();
        else {
            $(".cpropertyinfo .propertyformsteps:visible").hide();
            $(".cpropertyinfo .propertyformsteps:first").show();
        }
        return false;
    });

    $("#cprev").click(function(){
        if ($(".cpropertyinfo .propertyformsteps:visible").prev().length != 0)
            $(".cpropertyinfo .propertyformsteps:visible").prev().show().next().hide();
        else {
            $(".cpropertyinfo .propertyformsteps:visible").hide();
            $(".cpropertyinfo .propertyformsteps:last").show();
        }
        return false;
    });
});*/
	
	
	$(document).ready(function() {
    $('.stepwrap a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.steps ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
         $(this).addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
		});
	});
});

						   