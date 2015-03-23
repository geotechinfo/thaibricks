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
		var time = ($(window).scrollTop())*.75;
		//alert($(window).scrollTop()/10);
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, time,'easeInOutQuint');
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
		$("#sale_price_range").slider({reversed : false});
		$("#rent_price_range").slider({reversed : false});
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
	if($('header').length){
		window.onload = init();
	}
	
	
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

// By Antaroop
$(function(){
	/* Date */
	$(document).ready(function(){
	  $(".addNewBtn").click( function(){
	    //alert(12);
	    $('.newForms').clone().removeClass("newForms").addClass("theNewForm").insertAfter(".repeatNewHolder > .row:last").find($("input")).val("");

	    //$('.theNewForm:last');

	    $('.datetimepicker1').datetimepicker();
	  });
	      $(function () {
	          $('.datetimepicker1').datetimepicker({
					format: 'DD/MM/YYYY'
			  });
	      });
	});

	/* Vendor Toggle */
	/*$(document).ready(function(){
	  $("#vandor").removeAttr('checked');
	})
	$(function(){
		$(".vendorShow").click(function(){
		  $(".vendorToggle").slideDown();
		});
		$(".vendorHide").click(function(){
		  $(".vendorToggle").slideUp();
		});

		$('#vandor').click(function(){
		    if (this.checked) {
		        $('.vandorName').fadeIn();
		    } else {
		        $('.vandorName').fadeOut();          
		    }
		});
	});*/
	
	/* Tenancy dropview */
	$(".viewTenantbtn").click(function(){
		//$(".tenDetails").not(this).slideUp();
		$(this).closest(".tenantRow").siblings(".tenantRow").find(".tenDetails").slideUp();
		$(this).closest(".tenantRow").find(".tenDetails").slideToggle();
	});
});

<!-- For tenancy transaction add -->
$(function(){
	$("#selectTransactionHead").change(function(){
		var label = $("#selectTransactionHead option:selected").parent().attr('label');
		if(label == "Cash Out"){
			$(".vendorToggle").slideDown();
		}else{
			$(".vendorToggle").slideUp();
		}
	});
	
	$('#vandor').click(function(){
		if (this.checked) {
			$('.vandorName').fadeIn();
		} else {
			$('.vandorName').fadeOut();          
		}
	});
	
	$(".selectDrop li a").click(function(){
		var selText = $(this).text();
		$(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caretHolder"><span class="caret"></span></span>');
	});
});

// Go Top Top
$(function(){
	//$(".goToTopBtn").addClass("hide");
	$(window).scroll(function(){
		if($(window).scrollTop() > 200){
			$(".goToTopBtn").addClass("showToTopBtn");
		} else {
			$(".goToTopBtn").removeClass("showToTopBtn");
		}
	});
});

// Hide Login Section When Clicked Elsewhere
$(function(){
	$(document).click(function(e) {
		if (!$(e.target).is('.socialnav-collapse *')) {
			$(".login_popupdiv").hide();
		}
	});
})

$(function(){
	$('[data-toggle="search"]').bind('keyup blur change',function(){
		var selector = $(this).data('target');
        var selector = $(this).data('target');
        var norecordcss = $(this).data('norecord');
        var ths = $(this);
        var v = ths.val();
        if(v.length==0){
           $(selector).show()
        }else{
            
            //alert($('td:contains('+v+')').length)
            var totlen = $(selector).length;
            var count = 0;
            $(selector).each(function(){                
                //if($(this).find(':contains('+v+')').length){
                if($(this).text().search(new RegExp(v, "i")) > 0){    
                    $(this).show();
                }else{
                    count++;
                    $(this).hide();
                }                
            });

            if(totlen==count){
                $(norecordcss).show();
            }else{
                $(norecordcss).hide();
            }
        }
    });
    $('[data-toggle="scrollTo"]').bind('click',function(){
    	var selector = $(this).data('target');
    	var time = ($(window).scrollTop());
    	$('html, body').animate({
			scrollTop: $(selector).offset().top-100
		}, time,'easeInOutQuint');
    });
})