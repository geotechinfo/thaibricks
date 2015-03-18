//on document load

    $(function(){
		$('[data-toggle="back"]').click(function(){window.history.go($(this).data('step'));});	  
		$('.message').delay(5000).fadeOut(); 
		//window height and scroll	
		/*
		$(window).load(function(){ // On load
			$('.leftMenuNav').css({'min-height':(($(window).height()))});
			$('.rightContentWrap').css({'min-height':(($(window).height()))});
			//$('.inner').css({'min-height':(($(window).height()) - 40)});
			
			$('.leftMenuNav').css({'max-height':(($(window).height()))});
			$('.rightContentWrap').css({'max-height':(($(window).height()))});
			//$('.inner').css({'max-height':(($(window).height()) - 40)});
			$('.inner').css('min-height', '570px' );
		});
		*/
		//left menu active class
		$('.sellermenu li').click(function(){
	        $(this).siblings().removeClass("active");
			$(this).addClass("active");
		});
	
		
		//disable link
		/*
		$('.disabledproperty a.btn-block', '.disabledproperty .addpropertyname a').click(function(e){
	        e.preventDefault();
		});
		*/
		
		
		/*propertylist character*/
		
		
    });
	


	