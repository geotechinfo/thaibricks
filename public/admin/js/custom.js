$(document).ready(function(){
/*--Top Navigation--*/
if($('#session').length){$('#session').daterangepicker();}

$('[data-toggle="search"]').bind('keyup blur change',function(){

		var selector = $(this).data('target');
        var ths = $(this);
        var v = ths.val();
        if(v.length==0){
           $(selector).show()
        }else{
            
            //alert($('td:contains('+v+')').length)
            
            $(selector).each(function(){                
                //if($(this).find(':contains('+v+')').length){
                if($(this).text().search(new RegExp(v, "i")) > 0){    
                    $(this).show();
                }else{
                    $(this).hide();
                }
                
            });
            
        }
    });	

$('[data-toggle="filter"]').bind('click',function(){

	var selector = $(this).data('target');
	var prop_name = $(this).data('prop_name');
	var prop_value = $(this).data('prop_value');
    var ths = $(this);
    //alert(selector+'['+prop_name+'="'+prop_value+'"]');
    $(selector).hide();
    if(prop_value!=''){
    	//alert('ok')
    	$(selector+'['+prop_name+'="'+prop_value+'"]').show();	
    }else{
    	$(selector).show();
    }
    
        
});	
}); 