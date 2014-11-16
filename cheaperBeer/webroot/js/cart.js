/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var items=0;
var price=0;
var click=false;
var k=0;
//var article = new Array(30,90,50,20,60,100,70,40);
//var article_name = new Array('banner','landing page','press release','blog post','assistance 1month','logo','directory submission','assitance 3 months');
var cart = new Array();
var cart_item = new Array(0,0,0,0,0,0,0,0,0,0,0);
var cart_price = new Array(0,0,0,0,0,0,0,0,0,0,0);
var j=0;

$(document).ready(function(){
    
	$('.add-cart').click(function(){
            if(click==false){
               $('#THEcart').append('<div>YOUR CART <span id="cart_item"></span><span id="cart_price"></span></div>'); 
               click=true;
            }
            var id = $(this).attr('data-id');
            add_article(id,article_name,article);
        });
      
});

function add_article(id){
            items=items+1;
            price=price+article[id];
           /** if(cart.length===0){
                cart[0]=id;
                cart_item[id]=1;
                cart_price[id]=article[id];
                $('#THEcart').append('<div id="art_'+id+'"><p>'+cart_item[id]+' '+article_name[id]+'  '+cart_price[id]+'$   <a href="#article" title="Remove one" onclick="less_article('+id+')">-</a>    <a href="#article" title="Delete" onclick="delete_article('+id+')">X</a></p></div>');
             
                j++;
            }else{**/
                cart_item[id]=cart_item[id]+1;
                cart_price[id]=cart_price[id]+article[id];
                    if(cart_item[id]>1){
                        
                        $('#art_'+id).children().remove();
                        $('#art_'+id).append('<p><input type="hidden" name="article'+id+'" value="'+cart_item[id]+'">'+cart_item[id]+' '+article_name[id]+'  '+cart_price[id]+'$   <a href="#article" title="Remove one" onclick="less_article('+id+')"><i class="icon-minus-sign icon-2x"></i></a>    <a href="#article" title="Delete" onclick="delete_article('+id+')"><i class="icon-remove-circle icon-2x"></i></a></p>');
             
                    }else{
                $('#THEcart').append('<div id="art_'+id+'"><p><input type="hidden" name="article'+id+'" value="'+cart_item[id]+'">'+cart_item[id]+' '+article_name[id]+'  '+cart_price[id]+'$   <a href="#article" title="Remove one" onclick="less_article('+id+')"<i class="icon-minus-sign icon-2x"></i></a>    <a href="#article" title="Delete" onclick="delete_article('+id+')"><i class="icon-remove-circle icon-2x"></i></a></p></div>');
             
                }
            //}
             $('#cart_item').children().remove();
             $('#cart_item').append('<div> items: '+items+'<input type="hidden" name="nb_item" value="'+items+'"></div>');
             $('#cart_price').children().remove();
             $('#cart_price').append('<h3>'+price+' $<input type="hidden" name="price" value="'+price+'"></h3>');
             k++;
        }
        
        function delete_article(x){
            price=price-cart_price[x];
            items=items-cart_item[x];
            cart_price[x]=0;
            cart_item[x]=0;
            $('#cart_item').children().remove();
             $('#cart_item').append('<div> items: '+items+'<input type="hidden" name="nb_item" value="'+items+'"></div>');
             $('#cart_price').children().remove();
             $('#cart_price').append('<h3>'+price+' $<input type="hidden" name="price" value="'+price+'"></h3>');
             $('#art_'+x).remove();
        }
        
        function less_article(x){
            price=price-article[x];
            items=items-1;
            cart_price[x]=cart_price[x]-article[x];
            cart_item[x]=cart_item[x]-1;
            $('#cart_item').children().remove();
             $('#cart_item').append('<div> items: '+items+'<input type="hidden" name="nb_item" value="'+items+'"></div>');
             $('#cart_price').children().remove();
             $('#cart_price').append('<h3>'+price+' $<input type="hidden" name="price" value="'+price+'"></h3>');
             if(cart_item[x]>0){
              $('#art_'+x).children().remove();
             $('#art_'+x).append('<p><input type="hidden" name="article'+x+'" value="'+cart_item[x]+'">'+cart_item[x]+' '+article_name[x]+'  '+cart_price[x]+'$   <a href="#article" title="Remove one" onclick="less_article('+x+')"><i class="icon-minus-sign icon-2x"></i></a>    <a href="#article" title="Delete" onclick="delete_article('+x+')"><i class="icon-remove-circle icon-2x"></i></a></p>');
             }else {
                 $('#art_'+x).remove();
                }

             }

