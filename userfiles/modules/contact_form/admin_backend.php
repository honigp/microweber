<div id="mw_edit_pages_content" style="width: auto">
  <div id="mw_index_contact_form">
    <div id="mw_edit_page_left" class="mw-content-sidebar" style="width: 224px;">
      <?php $mw_notif =  (url_param('mw_notif'));
if( $mw_notif != false){
 $mw_notif = read_notification( $mw_notif);

}

mark_notifications_as_read('contact_form');


  ?>
      <?php if(isarr($mw_notif) and isset($mw_notif['rel_id'])): ?>
      <script type="text/javascript">

$(document).ready(function(){

     window.location= "<?php print $config['url']; ?>/load_list:<?php print $mw_notif['rel_id']; ?>";

});

</script>

      <?php else :  ?>
      <?php endif; ?>
      <?php

mark_notifications_as_read('contact_form');


$load_list = 'default';
if((url_param('load_list') != false)){
    $load_list = url_param('load_list');
}


   ?>
      <?php
$templates = '';
$load_templates = false;
if((url_param('templates') != false)){
    $templates = url_param('templates');
	if($templates == 'browse' or $templates == 'add_new'){
		$load_list = false;
		$load_templates = $templates;
	}
}

?>
      <div class="mw-admin-sidebar">
        <?php $info = module_info($config['module']);  ?>
        <?php module_ico_title($info['module']); ?>
        <div class="mw-admin-side-nav side-nav-max">
          <div class="vSpace"></div>
          <ul>
            <li><a   <?php if($load_list == 'default'){ ?> class="active" <?php } ?> href="<?php print $config['url']; ?>/load_list:default" >Default list</a></li>
            <?php $data = get_form_lists('module_name=contact_form'); ?>
            <?php if(isarr($data )): ?>
            <?php foreach($data  as $item): ?>
            <li><a <?php if($load_list == $item['id']){ ?> class="active" <?php } ?> href="<?php print $config['url']; ?>/load_list:<?php print $item['id']; ?>"><?php print $item['title']; ?></a></li>
            <?php endforeach ; ?>
            <?php endif; ?>
          </ul>
          <div class="vSpace"></div>
        </div>
        <h2><?php _e("Templates"); ?></h2>
        <a href="<?php print $config['url']; ?>/templates:browse" class="<?php if($templates == 'browse'){ ?> active <?php }?> mw-ui-btn mw-ui-btn-hover">My templates</a> <a href="<?php print $config['url']; ?>/templates:add_new" class="<?php if($templates == 'add_new'){ ?> active <?php }?>mw-ui-btn mw-ui-btn-green"><?php _e("Get more templates"); ?></a>
      </div>
    </div>
    <div class="mw-content-container" >
    <div style="padding: 20px;">
      <?php




 if($load_list): ?>
      <script type="text/javascript">




mw.on.hashParam('search', function(){


  var field = mwd.getElementById('forms_data_keyword');

  if(!field.focused){ field.value = this; }

  if(this  != ''){
    $('#forms_data_module').attr('keyword',this);
  } else {
    $('#forms_data_module').removeAttr('keyword' );
  }

  $('#forms_data_module').removeAttr('export_to_excel');


 mw.reload_module('#forms_data_module', function(){
    mw.$("#forms_data_keyword").removeClass('loading');
 });


});




$(document).ready(function(){
	 $("#form_field_title").click(function() {
		mw.tools.liveEdit(this, false,  function(){
			var new_title =  this
			 mw.forms_data_manager.rename_form_list('<?php print $load_list ?>',new_title );
		 });


	});

});



 </script>
      <module type="forms/list_toolbar"  load_list="<?php print $load_list ?>"   />
      <div class="vSpace"></div>
      <module type="forms/list" load_list="<?php print $load_list ?>"  for_module="<?php print $config["the_module"] ?>" id="forms_data_module" />
      <?php if(strtolower(trim($load_list)) != 'default'): ?>
      <span class="mw-ui-delete right" onclick="mw.forms_data_manager.delete_list('<?php print addslashes($load_list); ?>');"><?php _e("Delete list"); ?></span>
      <?php endif; ?>
      <?php endif; ?>
      <?php if($load_templates == true): ?>
      <module type="admin/templates/browse" for="<?php print $config["the_module"] ?>"  />
      <?php else : ?>
      <?php endif; ?>
    </div>
    </div>
  </div>
</div>
