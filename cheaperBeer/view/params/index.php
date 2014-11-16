<?php $title_for_layout = $tv['cpa_title_index'];
$roles =array(1=>$tv['u_visitor'],2=>$tv['u_member'],3=>$tv['u_premium']);

$langu=array(
'da'=>$tv['da'],
'de'=>$tv['de'],
'en'=>$tv['en'],
'fr'=>$tv['fr'],
'ko'=>$tv['ko'],
'pt'=>$tv['pt'],
'ru'=>$tv['ru'],

);
 $mtype=array(       
                            1=>$tv['w'], 
                            2=>$tv['m'],
                            3=>$tv['cpl'] ) ; 
 
 $yn=array( 0=>$tv['n'], 
            1=>$tv['y'] ) ; 

$ethnic=array(
1=>$tv['vfd_african'],
2=>$tv['vfd_african_american'], 
3=>$tv['vfd_asian'],
4=>$tv['vfd_caucasian'],
5=>$tv['vfd_european'],
6=>$tv['vfd_hispanic'],
7=>$tv['vfd_indian'],
8=>$tv['vfd_middle_eastern'],
9=>$tv['vfd_mixed'],
10=>$tv['vfd_earthling'],

  ) ;

  $hair = array(
    1=>$tv['vfd_hairblack'],
    2=>$tv['vfd_hairblond'],
    3=>$tv['vfd_hairred'],
    4=>$tv['vfd_hairbald'],
    5=>$tv['vfd_hairshaved'],
    6=>$tv['vfd_hairbrown'],
    7=>$tv['vfd_hairgrey'],
    8=>$tv['vfd_hairwhite'],
    9=>$tv['vfd_hairdyed']
    );

  $eyes = array(
    1=>$tv['vfd_eyesblack'],
    2=>$tv['vfd_eyesbrown'],
    3=>$tv['vfd_eyesblue'],
    4=>$tv['vfd_eyesgreen'],
    5=>$tv['vfd_eyesgrey'],
    6=>$tv['vfd_eyesother']
    );

  $statut = array(
    1=>$tv['vfd_statutsingle'],
    2=>$tv['vfd_statutmarried'],
    3=>$tv['vfd_statutattached'],
    4=>$tv['vfd_statutopen']
    );

 $bodytype=array(
    1=>$tv['vfd_slim'],
    2=>$tv['vfd_average'],
    3=>$tv['vfd_athletic'],
    4=>$tv['vfd_extra'],
    5=>$tv['vfd_big'],


  );
  $child = array(
    1=>$tv['vfd_none'],
    2=>$tv['vfd_one'],
    3=>$tv['vfd_two'],
    4=>$tv['vfd_more']
    ) ;

  $hertz = array(
    1=>$tv['vfd_never'],
    2=>$tv['vfd_occasionnaly'],
    3=>$tv['vfd_often']
    )  ;


    $sexorientation = array(
    1=>$tv['vfd_straight'],
    2=>$tv['vfd_openminded'],
    3=>$tv['vfd_bisexual'],
    4=>$tv['vfd_gay']
    );
    
    $living = array(
    1=>$tv['vfd_wparent'],
    2=>$tv['vfd_wroomate'],
    3=>$tv['vfd_studentres'],
    4=>$tv['vfd_wpartner'],
    5=>$tv['vfd_alone'],
    );
    
     $education = array(
    1=>$tv['vfd_school'],
    2=>$tv['vfd_somecollege'],
    3=>$tv['vfd_highschool'],
    4=>$tv['vfd_degree']
    );
     
   $income = array(
    1=>$tv['vfd_low'],
    2=>$tv['vfd_medium'],
    3=>$tv['vfd_hight'],
    4=>$tv['vfd_very_hight']
    );
   
      $type_filter =array(
       0=>$tv['vfd_none'],
       1=>$tv['blk_list_filter'],
       2=>$tv['wht_list_filter'],
   );
      
      $dist= array(); $dist[-10]= $tv['hello_world'] ;
      for($i=10;$i<=200;$i=$i+10){
          $dist[$i]=$i.' Km';
      }
    

 ?>
<?php $role=$this->Session->User('role') ;?>
<?php  ;?>
<ul class="nav nav-tabs" id="myj">
     
  <li class="active"><a href="<?php echo Router::url('params/index'); ?>" class="active"><?php echo $tv['cpa_general'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/notification'); ?>"><?php echo $tv['cpa_notification'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/privacy'); ?>"><?php echo $tv['cpa_privacy'] ;?></a></li>
            <?php  if(isset($params->role)&&($params->role==3)):?>
            <li><a href="<?php echo Router::url('params/premium'); ?>"><?php echo $tv['cpa_filter'] ;?></a></li>
            <?php endif ;?>
          <!--  <li class="well"><a href="#secu">SECURITY</a></li>
            <li class="well"><a href="#paym">PAYMENT</a></li> -->
</ul>
    
<div class="row">
   
<div class="col-md-12">
  <div class="page-header">
  <h2><?php echo $tv['cpa_editgeneral'] ;?></h2>
</div>
    
    <div id="gen" class="page-header">
    <table class="table table-striped">
        <tr>
            <td><?php echo $tv['cpa_activity']; ?></td>
            <td><?php echo $roles[$params->role] ;?></td>
            <?php switch($params->role): 
               case 0: ?>
               <td><i class="icon-warning-sign"></i></td>
               <?php break; ?>
               <?php case 1: ?>
               <td><i class="icon-user"></i></td>
               <?php break; ?>
               <?php case 2:?>
               <td><i class="icon-user"></i><i class="icon-star"></i></td>
               <?php break; ?>
               
               <?php endswitch ;?>
        </tr>
        <?php  if(isset($params->role)&&($params->role==3)):?>
        <tr>
            <td>Expiration date</td>
            <td><?php echo date("F j Y, g:i a",$params->expire) ;?></td>
            <td></td>
        </tr>
        <?php endif ;?>
        <tr>
            <td><?php echo $tv['cpa_emailadress']; ?></td>
            <td><?php echo $params->email ;?></td>
            <td><a href="<?php echo Router::url('params/emailedit'); ?>"><i class="icon-pencil"></i></a></td>
        </tr>
        <tr>
            <td><?php echo $tv['cpa_password']; ?></td>
            <td>******</td>
            <td><a href="<?php echo Router::url('params/password'); ?>"><i class="icon-pencil"></i></a></td>
        </tr>
        <tr>
            <td><?php echo $tv['cpa_language']; ?></td>
            <td><?php echo $tv[$params->lang] ;?></td>
            <td><a href="<?php echo Router::url('params/language'); ?>"><i class="icon-pencil"></i></a></td>
        </tr>
  
    </table>
    </div>    
   <!-- div.page-header>table.(table table-striped)>(tr>(td*))* -->
    
   <div class="page-header" id="not">
       <table class="table table-striped">
           <tr>
               <td><?php echo $tv['cpa_newmessage']; ?></td>
               <td></td>
               <?php if($params->noti_msg==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_newvisite']; ?></td>
               <td></td>
               <?php if($params->noti_visit==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_like']; ?></td>
               <td></td>
               <?php if($params->noti_favorite==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_mutualattraction']; ?></td>
               <td></td>
               <?php if($params->noti_mut_attrac==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_friendrequest']; ?></td>
               <td></td>
               <?php if($params->noti_ask_friend==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_friendaccept']; ?></td>
               <td></td>
               <?php if($params->noti_friend_accepted==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_recommended']; ?></td>
               <td></td>
               <?php if($params->noti_recommended==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_invitation']; ?></td>
               <td></td>
               <?php if($params->noti_invit==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           
           <tr>
               <td><?php echo $tv['cpa_publication']; ?></td>
               <td></td>
               <?php if($params->noti_publi_gep==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_atttunenews']; ?></td>
               <td></td>
               <?php if($params->noti_important==1): ?>
               <td><i class="icon-ok"></i></td>
               <?php else: ?>
               <td><i class="icon-remove"></i></td>
               <?php endif ;?>
           </tr>
       </table>
   </div>

   <div class="page-header" id="conf">
       <table class="table table-striped">
           <tr>
               <td><?php echo $tv['cpa_view_me']; ?></td>
               <td></td>
               <?php switch($params->prof_view): 
               case 0: ?>
               <td><i class="icon-warning-sign"></i></td>
               <?php break; ?>
               <?php case 1: ?>
               <td><i class="icon-user"></i></td>
               <?php break; ?>
               <?php case 2:?>
               <td><i class="icon-user"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php case 3:?>
               <td><i class="icon-user"></i><i class="icon-star"></i></td>
               <?php break; ?>
               <?php case 4:?>
               <td><i class="icon-user"></i><i class="icon-star"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php endswitch ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_message_me']; ?></td>
               <td></td>
               <?php switch($params->prof_msg): 
               case 0: ?>
               <td><i class="icon-warning-sign"></i></td>
               <?php break; ?>
               <?php case 1: ?>
               <td><i class="icon-user"></i></td>
               <?php break; ?>
               <?php case 2:?>
               <td><i class="icon-user"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php case 3:?>
               <td><i class="icon-user"></i><i class="icon-star"></i></td>
               <?php break; ?>
               <?php case 4:?>
               <td><i class="icon-user"></i><i class="icon-star"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php endswitch ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_comment_me']; ?></td>
               <td></td>
               <?php switch($params->prof_comm): 
               case 0: ?>
               <td><i class="icon-warning-sign"></i></td>
               <?php break; ?>
               <?php case 1: ?>
               <td><i class="icon-user"></i></td>
               <?php break; ?>
               <?php case 2:?>
               <td><i class="icon-user"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php case 3:?>
               <td><i class="icon-user"></i><i class="icon-star"></i></td>
               <?php break; ?>
               <?php case 4:?>
               <td><i class="icon-user"></i><i class="icon-star"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php endswitch ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_cam_me']; ?></td>
               <td></td>
               <?php switch($params->prof_cam): 
               case 0: ?>
               <td><i class="icon-warning-sign"></i></td>
               <?php break; ?>
               <?php case 1: ?>
               <td><i class="icon-user"></i></td>
               <?php break; ?>
               <?php case 2:?>
               <td><i class="icon-user"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php case 3:?>
               <td><i class="icon-user"></i><i class="icon-star"></i></td>
               <?php break; ?>
               <?php case 4:?>
               <td><i class="icon-user"></i><i class="icon-star"></i><i class="icon-ok-sign"></i></td>
               <?php break; ?>
               <?php endswitch ;?>
           </tr>
           <tr>
               <td><?php echo $tv['cpa_filter']; ?></td>
               <td></td>
               <td><i class="icon-ban-circle"></i></td>
           </tr>
       </table>
   </div>
   
   <?php if($params->role==3): ?>
   <?php 
   $fil=array('filter_type' , 'filter_role', 'filter_my_type','filter_explicit','filter_ads', 'filter_hidden', 'filter_nb_show',
                                     'filter_contry', 'filter_region', 'filter_department', 'filter_city' ,  'filter_distance', 'filter_min_old',
                                      
                                      'filter_max_old', 'filter_link_type', 'filter_ambiance', 'filter_relationship_statut', 'filter_orientation', 'filter_living',
                                      'filter_body_type', 'filter_hair_color', 'filter_eye_color', 'filter_ethnic', 'filter_children', 'filter_smoking', 'filter_drinking',
                                     'filter_education', 'filter_income', 'filter_languages' );
   ;?>
   
   <div id="not" class="page-header">
       <table class="table table-striped">


<tr>
<td><?php echo $tv['cpa_filter_nb_show']; ?></td>
<td><?php echo $params->filter_nb_show ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_hidden']; ?></td>
<td><?php echo $yn[$params->filter_hidden] ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_ads']; ?></td>
<td><?php echo $yn[$params->filter_ads] ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_explicit']; ?></td>
<td><?php echo $yn[$params->filter_explicit] ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_type']; ?></td>
<td><?php echo $type_filter[$params->filter_type] ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_distance']; ?></td>
<td><?php echo $dist[$params->filter_distance] ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_min_old']; ?></td>
<td><?php echo $params->filter_min_old ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_max_old']; ?></td>
<td><?php echo $params->filter_max_old ;?></td>
</tr>



<tr>
<td><?php echo $tv['cpa_filter_role']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_role);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$roles[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_link_type']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
 $pp=explode(',',$params-> filter_my_type);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$mtype[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>


<tr>
<td><?php echo $tv['cpa_filter_relationship_statut']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_relationship_statut);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$statut[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_orientation']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_orientation);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$sexorientation[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_living']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_living);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$living[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_body_type']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_body_type);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$bodytype[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_hair_color']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_hair_color);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$hair[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_eye_color']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_eye_color);

if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$eyes[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_ethnic']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_ethnic);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$ethnic[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_children']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_children);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$child[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_smoking']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_smoking);

if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$hertz[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}

?>
<td><?php  echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_drinking']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_drinking);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$hertz[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}
?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_education']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_education);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$education[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}

?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_income']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_income);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$income[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}

?>
<td><?php echo $ppam2 ;?></td>
</tr>

<tr>
<td><?php echo $tv['cpa_filter_languages']; ?></td>
<?php
$pp=array();
$ppam=array();
$ppam2=array();
$pp=explode(',',$params->filter_languages);
if(isset($pp)&&!empty($pp)){
foreach($pp as $k=>$v)
{
if(isset($v)&&!empty($v)){
  $ppam[]=$langu[$v];  
}
}
$ppam2=implode(', ',$ppam); 
}

?>
<td><?php echo $ppam2 ;?></td>
</tr>

       </table>
   </div>
 
   
   <?php endif ;?>
 
   

</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('nav li a').click(function(){
        $('nav li a').removeClass('active');
        $(this).addClass('active');
        var id=$(this).attr('href');
        scrollTo(id);
        return false ;
        
    });
    /**
     * scro
     */
    function scrollTo(target) {
        if($(target).length>=1){
            height=$(target).offset().top;
        }
        $('html,body').animate({scrollTop:height},1000);
        return false ;
    }
    })

</script>
