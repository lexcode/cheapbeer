
<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])): ;?>
<a href="<?php echo Router::url($this->previous()); ?>" class="btn"><i class="icon-user"></i><?php echo $tv['g_profile'] ;?></a>
<?php endif ;?>

<div class="page-header">
	<h1><?php echo $tv['add_pics'] ;?></h1>
</div>
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','file'=>'ok','action'=>'medias/add_pics/'.$albm),true, 'DoN@tienne') ;?>

	<?php echo $this->Form->input('file','',array('type'=>'file_multiple')); ?>
	
	<div class="actions">
        <input type="submit" value="<?php echo $tv['g_send'] ;?>" class="btn primary">
	</div>
</form>