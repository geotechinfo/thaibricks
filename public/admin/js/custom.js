$(document).ready(function(){
/*--Top Navigation--*/
if($('#session').length){$('#session').daterangepicker();}

$('[data-toggle="search"]').bind('keyup blur change',function(e){
        //alert(e.which);
        //if (e.which == 13) {e.preventDefault();return false;}
		var selector = $(this).data('target');
        var norecordcss = $(this).data('norecord');
        var ths = $(this);
        var v = ths.val();
        if(v==''){
           $(selector).show();
           $(selector).closest('table').show();
           $(selector).closest('.cls_table').show();
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
                $(selector).closest('table').hide(); 
                $(selector).hide();              
                $(norecordcss).show();
            }else{
                $(selector).closest('table').show();
                $(selector).closest('.cls_table').show();
                //$(selector).show();
                $(norecordcss).hide();
            }
        }
        
});	

$('[data-toggle="filter"]').bind('click',function(){

	var selector = $(this).data('target');
	var prop_name = $(this).data('prop_name');
	var prop_value = $(this).data('prop_value');
     var norecordcss = $(this).data('norecord');
    var ths = $(this);
    //alert(selector+'['+prop_name+'="'+prop_value+'"]');
    $(selector).hide();
    if(prop_value!=''){
         $(selector).closest('table').show()
    	$(selector+'['+prop_name+'="'+prop_value+'"]').show();	
        
        if($(selector+':visible').length == 0){
            $(selector).closest('table').hide()
            $(norecordcss).show();
        }else{
            $(selector).closest('table').show()
            $(norecordcss).hide();
        }
    }else{
        $(selector).closest('table').show()
    	$(selector).show();
    }
    
        
});	
}); 