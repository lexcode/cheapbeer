/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function getNbJoursMois(mois, annee) {

var lgMois = new Array(31,28,31,30,31,30,31,31,30,31, 30, 31);
if((annee%4 == 0 && annee%100 != 0) || annee%400 == 0) {lgMois[1]+= 1;}
return lgMois[mois]; // 0 < mois <11
}

function uCaseF(text) {
    return text.substr(0, 1).toUpperCase() + text.substr(1);    
}

$(document).ready(function(){
    
    
    $("#inputccity").keyup(function(){
        var recherche = $(this).val() ;
      
        if(recherche.length>1){
            $.ajax({
                type : "POST",
                url : "http://localhost/cheaperBeer/users/sig",
                data : {"city":recherche},
                dataType:"json",
                success : popCity,
                
                error : function(xhr ){ 
                    
                    alert(xhr.responseText);
                    
                    $("div#result").html('Aucun resultat trouvé 2 :'+recherche+'<h2>Error !!!!: ' + xhr.statusText +'</h2>'+thrownError).show();}
            })
            return false ;
        }
        if(recherche.length<=2){
                        $("div#result").hide();
                        
                    }
                          
        
    });
       
        $("#geoloc").click(function(e){
                        // alert(0);
                           e.preventDefault() ;
                           
                           if(navigator.geolocation){
                                        function succesGeo(position){
                                           
                                        var latitude = position.coords.latitude;
                                        var longitude = position.coords.longitude;
                                        var coord = 'latitude='+latitude+'&longitude='+longitude ;
                                       
                                            $("input[name=lat]").val(latitude);
                                            $("input[name=lng]").val(longitude);
                                           
                                        $.ajax({
                                                type : "POST",
                                                url : "http://localhost/cheaperBeer/users/sig",
                                                data : coord ,
                                                dataType:"json",
                                                success : popCity })
                                        };
                                        
                                        /**
                                         * Erreur geo pour envoyer les erreurs
                                         */
                                        function erreurGeo(error){
                                            var e='';
                                            switch(error.code){
                                                case error.TIMEOUT:
                                                     e+=" !TIMEOUT! " ;
                                                break;
                                                case error.PERMISSION_DENIED:
                                                     e+=" !PERMISSION_DENIED! " ;
                                                break;
                                                case error.POSITION_UNAVAILABLE:
                                                     e+=" !POSITION_UNAVAILABLE! " ;
                                                break;
                                                case error.UNKNOW_ERROR:
                                                     e+=" !POSITION_UNAVAILABLE! " ;
                                                break;
                                            }
                                            
                                        }
                                        navigator.geolocation.getCurrentPosition(succesGeo,erreurGeo,{maximuAge:120000});
                                    
                                     
                                }else{
                                    alert('nongeo');
                                }
                                
                                return false ;
                       });
                       
                       
      $("#inputmy_type").change(function(){
                           
                           var myty = $(this).val() ;
                           
                           if(myty>0 && myty<5){
                               $("#startd2").show("fast");
                           }else{
                               $("#startd2").hide("fast");
                           }
                       });
                       
       
    $("#inputmy_type").blur(function(){
                           var myty = $(this).val() ;
                           
                           if(myty>4){
                               $("#inputdd2").val(0);
                               $("#inputdm2").val(0);
                               $("#inputdy2").val(0);
                           }
                       })
                       
                       $("#inputdd1").bind("change",function(){validDate(1);});
                       $("#inputdm1").bind("change",function(){validDate(1);});
                       $("#inputdy1").bind("change",function(){validDate(1);});
                       $("#inputdd2").bind("change",function(){validDate(2);});
                       $("#inputdm2").bind("change",function(){validDate(2);});
                       $("#inputdy2").bind("change",function(){validDate(2);});
                       
                       
                 /*      $("#inputpseudo").keyup(function(){
                        var psd = $(this).val() ;
                        var isuse = 'pseudo='+psd ;
                        console.log(psd);
                        if(psd.length>4){
                            $.ajax({
                                type : "GET",
                                url : "http://localhost/cheaperBeer/users/signup",
                                data : isuse ,
                                success : function(data){

                                if(data=='used'){

                                $("#inputpseudo").parent().parent().addClass("error");
                                $("#errorpseudo").remove();
                                $("#inputpseudo").after('<span class="help-inline" id="errorpseudo">Ce pseudo est déja utilisé </span>');
                            }else{
                                $("#inputpseudo").parent().parent().removeClass("error");
                                $("#errorpseudo").remove();
                                }
                                     }
                                });
                               
                            }});
                            
                          */  
        $("#inputpseudo").blur(function(){
                                
                                var psd = $(this).val() ;
                                
                                if(psd==''){
                                    $("#errorpseudo").remove();
                                    $("#inputpseudo").parent().parent().removeClass("error");
                                }
                                else{
                                if(psd.length<2||psd.length>19){
                                    $("#inputpseudo").parent().parent().addClass("error");
                                    $("#errorpseudo").remove();
                                    $("#inputpseudo").after('<span class="help-inline" id="errorpseudo">Nombre de caractères compris entre [2-20]</span>');
                                
                                }
                                }
                                });
                                
                                $("#inputemail").blur(function(){
                                
                                var email = $(this).val() ;
                                if(email==''){
                                    $("#erroremail").remove();
                                    $("#inputemail").parent().parent().removeClass("error");
                                }
                                else{
                                if (!(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email))){
                                    $("#inputemail").parent().parent().addClass("error");
                                    $("#erroremail").remove();
                                    $("#inputemail").after('<span class="help-inline" id="erroremail">Adresse email non valide</span>');
                                
                                }else{
                                    
                                    $.ajax({
                                type : "POST",
                                url : "http://localhost/cheaperBeer/users/sig",
                                data : {"email":email} ,
                                success : function(data){

                                if(data=='used'){

                                $("#inputemail").parent().parent().addClass("error");
                                $("#erroremail").remove();
                                $("#inputemail").after('<span class="help-inline" id="erroremail">Cet adresse email est déja utilisé </span>');
                            }
                            if(data=='notfound'){
                                $("#inputemail").parent().parent().removeClass("error");
                                $("#erroremail").remove();
                                }
                                     }
                                });
                                    //$("#inputemail").parent().parent().removeClass("error");
                                    //$("#erroremail").remove();
                                }
                                }
                                });
                                
                                
                                $("#inputpassword").blur(function(){
                                
                                var psd = $(this).val() ;
                                if(psd==''){
                                 $("#errorpassword").remove();
                                    $("#inputpassword").parent().parent().removeClass("error");
                                }
                                else{
                                if(psd.length<6||psd.length>19){
                                    $("#inputpassword").parent().parent().addClass("error");
                                    $("#errorpassword").remove();
                                    $("#inputpassword").after('<span class="help-inline" id="errorpassword">Nombre de caractères compris entre [6-20]</span>');
                                }else{
                                    $("#inputpassword").parent().parent().removeClass("error");
                                    $("#errorpassword").remove();
                                }
                                }
                                });
                                
                                $("#inputconf_password").blur(function(){
                                
                                var psd2 = $(this).val() ;
                                if(psd2==''){
                                    $("#errorconf_password").remove();
                                    $("#inputconf_password").parent().parent().removeClass("error");
                                }
                                else{
                                var cpsd = $("#inputpassword").val() ;
                                if(psd2.length<6||psd2.length>19){
                                    
                                    $(this).parent().parent().addClass("error");
                                    $("#errorconf_password").remove();
                                    $(this).after('<span class="help-inline" id="errorconf_password">Nombre de caractères compris entre [6-20]</span>');
                                }
                                
                                if((psd2.length>=6&&psd2.length<=18)&&(psd2!=cpsd)){
                                    $(this).parent().parent().addClass("error");
                                    $("#errorconf_password").remove();
                                    $(this).after('<span class="help-inline" id="errorconf_password">Mots de passe non identiques</span>');
                                }
                                
                                if((psd2.length>=6&&psd2.length<=18)&&(psd2==cpsd)){
                                    $(this).parent().parent().removeClass("error");
                                    $("#errorconf_password").remove();
                                }
                                }
                                });
        
    
                       /**
                        * Comment
                        */
                       function validDate(d) {
                           if(d==1||d==2){
                           var dd =$("#inputdd"+d).val() ;
                           var mm =$("#inputdm"+d).val() ;
                           var yy =$("#inputdy"+d).val() ;
                         
                           if(dd>0 && yy>0 && mm>0){
                            var nb= getNbJoursMois((mm-1), yy);
                            
                            if(dd>nb){
                                $("#startd"+d).addClass("error");
                                $("#errord"+d).remove();
                                $("#endd"+d).after('<span class="help-inline" id="errord'+d+'">La date de naissaince n\'est pas conforme</span>');
                            }else{
                                $("#startd"+d).removeClass("error");
                                $("#errord"+d).remove();
                                }
                           }
                           }
                           
                       };
                       
                       
                        function popCity(data){
                    
                    if(data=='notfound'){
                      
                       $("ul#reslist").children().remove();
                       $("p#resmsg").children().remove();
                       $("p#resmsg").append('<p>Aucun resultat trouvé</p>');
                       $("div#result").show();
                       $("#inputcity").val('');
                       $("#inputregion").val('');
                       $("#inputcontry").val('');
                       $("#inputidc").val('');
                    }else{
                         //alert(data);
                         $("p#resmsg").children().remove();
                         $('ul#reslist').children().remove();
                         $.each(data, function(i, obj) {
                                                         var ul = $('ul#reslist');
                                                         var li = $('<li/>');
                                                         var cny = obj.contry ;
                                                        li.attr('id', i)
                                                          .html(obj.accity+' , '+obj.region+' , '+cny.toUpperCase())
                                                          .appendTo(ul);
                                                        });
                           $("div#result").show(); 
                          }
                    $("ul#reslist li").click(data,function(event){
                                                          event.preventDefault(); //prevent synchronous loading
                                                          
                                                          var k = $(this).attr('id');
                                                          var inp =data[k].accity ;
                                                            $("input#inputccity").val(inp);
                                                            $("input[name=idc]").val(data[k].id);
                                                            $("input[name=city]").val(inp);
                                                            $("input[name=region]").val(data[k].region);
                                                            $("input[name=contry]").val(data[k].contry);
                                                            $("div#result").hide();
                                                        });
                                                        document.onclick = function(){
                                                           $("div#result").hide(); 
                                                        };
                } 
                       
 
})
