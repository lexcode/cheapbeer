/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function showAdvancedSearch(id)
{   var target='div#field_main'+id+'';
    $(target).toggle('fast');      } 
    

function showQ(sel)
    {
     $(sel).toggle('fast'); 
    }
    
function naiveReverse(string)
    {
     return string.split('').reverse().join('');
     }
    

                   
$(document).ready(function(){
   
   
    $(".ttips").tooltip();
    
    var alert = $('#alert'); 
	if(alert.length > 0){
		alert.hide().slideDown(500);
		alert.find('.close').click(function(e){
			e.preventDefault();
			alert.slideUp();
		})
	}
    
    $(".main_column").click(function(event) {
        var the_id = $(this).attr('id');
        event.preventDefault();
        showAdvancedSearch(the_id);
       
    });
    
    
    
    
        $("label.control-label").click(function(event) {
        var te = $(this).attr("id");
        var sel = 'div#'+te+'-options';
        event.preventDefault();
        showQ(sel);
       
    });
        
        });

    
 
                

