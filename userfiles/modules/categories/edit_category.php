<?php
$form_rand_id  = uniqid();
if(!isset($params["data-category-id"])){
	$params["data-category-id"] = CATEGORY_ID;
}

$data = get_category_by_id($params["data-category-id"]);

if($data == false or empty($data )){
    include('_empty_category_data.php');
}




?>
<script  type="text/javascript">

mw.require('forms.js');

</script>
<script  type="text/javascript">
 function set_category_parent_<?php print $form_rand_id ?>(){

	 $sel = mw.$('#edit_category_set_par_<?php print $form_rand_id ?> input:checked').parents('li').first();

	 is_cat = $sel.attr("data-category-id");
	 is_page = $sel.attr("data-page-id");
	    mw.log( $sel);
	 if(is_cat != undefined){
    	 mw.$('#rel_id_<?php print $form_rand_id ?>').val(0);
    	    mw.$('#parent_id_<?php print $form_rand_id ?>').val(is_cat);
    	 }
		 if(is_page != undefined){
		    mw.$('#rel_id_<?php print $form_rand_id ?>').val(is_page);
		    mw.$('#parent_id_<?php print $form_rand_id ?>').val(0);
         }

 }


  function onload_set_parent_<?php print $form_rand_id ?>(){
	   var tti = mw.$('#rel_id_<?php print $form_rand_id ?>').val();

		 var par_cat   = mw.$('#parent_id_<?php print $form_rand_id ?>').val();
		// mw.log(par_cat);
		 if(par_cat != undefined && parseFloat(par_cat) > 0 ){
		    var tree =  mwd.getElementById('edit_category_set_par_<?php print $form_rand_id ?>');
            var li =  tree.querySelector('li[data-category-id="'+par_cat+'"]');
            var radio = li.querySelector('input[type="radio"]');
            radio.checked = true;

		 }  else  if(tti != undefined && parseFloat(tti) > 0 ){
                   var tree =  mwd.getElementById('edit_category_set_par_<?php print $form_rand_id ?>');
            var li =  tree.querySelector('li[data-page-id="'+tti+'"]');
            var radio = li.querySelector('input[type="radio"]');
            radio.checked = true;

                }

  }

  save_cat = function(){

    if(mwd.querySelector('.mw-ui-category-selector input:checked') !== null){
       $(document.forms['admin_edit_category_form_<?php print $form_rand_id ?>']).submit();
    }

    else{
      Alert('<?php _e("Please choose Page or Category"); ?>.');
    }

  }


$(document).ready(function(){
	//
	 <?php if(intval($data['id']) == 0): ?>
	// onload_set_parent_<?php print $form_rand_id ?>();
	// set_category_parent_<?php print $form_rand_id ?>()
	 <?php endif; ?>
	  mw.$('#edit_category_set_par_<?php print $form_rand_id ?> input').change(function() {
  	     set_category_parent_<?php print $form_rand_id ?>();
      });





	 mw.$('#admin_edit_category_form_<?php print $form_rand_id ?>').submit(function() {

 // set_category_parent_<?php print $form_rand_id ?>();
 mw.form.post(mw.$('#admin_edit_category_form_<?php print $form_rand_id ?>') , '<?php print site_url('api/save_category') ?>', function(){
	 mw.reload_module('[data-type="categories"]');
     mw.$('[data-type="pages"]').removeClass("activated");
	  mw.reload_module('[data-type="pages"]', function(){
	    mw.treeRenderer.appendUI('[data-type="pages"]');
        mw.tools.tree.recall(mwd.querySelector("#pages_tree_toolbar").parentNode);
	  });
	  <?php if(intval($data['id']) == 0): ?>
	 	mw.url.windowHashParam("new_content", "true");
	 	mw.url.windowHashParam("action", "editcategory:" + this);
     <?php endif; ?>
	 });

    return false;
 });
});
</script>
<?php if(intval($data['id']) == 0){
	  if(isset($params['selected-category-id']) and intval($params['selected-category-id']) != 0){
		  $data['parent_id'] = intval($params['selected-category-id']);
	  } elseif(isset($params['page-id'])){
		  $data['rel_id'] = intval($params['page-id']);
	  }

  }

  ?>
<?php  //d($params);?>

<form class="add-edit-page-post" id="admin_edit_category_form_<?php print $form_rand_id ?>" name="admin_edit_category_form_<?php print $form_rand_id ?>" autocomplete="Off">
  <input name="id" type="hidden" value="<?php print ($data['id'])?>" />
  <input name="table" type="hidden" value="categories" />
  <input name="rel" type="hidden" value="<?php print ($data['rel'])?>" />
  <input name="rel_id" type="hidden" value="<?php print ($data['rel_id'])?>" id="rel_id_<?php print $form_rand_id ?>"  />
  <input name="data_type" type="hidden" value="<?php print ($data['data_type'])?>" />

  <div class="mw-ui-field-holder">



<?php if($data['id'] == 0 and isset($data['parent_id'] ) and $data['parent_id'] >0): ?>
    <span class="mw-title-field-label mw-title-field-label-subcat"></span>

    <input  class="mw-ui-field mw-title-field" name="title" type="text" value="<?php _e("Sub-category Name"); ?>" />
<?php else: ?>

<?php if(isset($data['parent_id'] ) and $data['parent_id'] >0): ?>
    <span class="mw-title-field-label mw-title-field-label-subcat"></span>

<?php else: ?>
   <span class="mw-title-field-label mw-title-field-label-category"></span>
<?php endif; ?>
    <input  class="mw-ui-field mw-title-field" name="title" type="text" value="<?php print ($data['title'])?>" />
<?php endif; ?>


  </div>
  <div class="mw-ui-field-holder">
    <label class="mw-ui-label">
      <?php _e("Parent"); ?>
    </label>
    <?php
      $is_shop = '';
    if (isset($params['is_shop'])) {
    	//$is_shop = '&is_shop=' . $params['is_shop'];
    }



       ?>
    <input name="parent_id" type="hidden" value="<?php print ($data['parent_id'])?>" id="parent_id_<?php print $form_rand_id ?>" />
    <div class="mw-ui mw-ui-category-selector mw-tree mw-tree-selector" style="display: block" id="edit_category_set_par_<?php print $form_rand_id ?>">
      <module  type="categories/selector"   categories_active_ids="<?php print (intval($data['parent_id']))?>" active_ids="<?php print ($data['rel_id'])?>" <?php print $is_shop ?> input-name="temp_<?php print $form_rand_id ?>" input-name-categories='temp_<?php print $form_rand_id ?>' input-type-categories="radio"   />
    </div>
  </div>
  <script type="text/javascript">
    $(mwd).ready(function(){
        mw.treeRenderer.appendUI('#edit_category_set_par_<?php print $form_rand_id ?>');
        mw.tools.tree.openAll(mwd.getElementById('edit_category_set_par_<?php print $form_rand_id ?>'));
    });
  </script>
  <div class="mw-ui-field-holder">
    <label class="mw-ui-label">
      <?php _e("Description"); ?>
    </label>
    <textarea style="width: 600px;height: 50px;" class="mw-ui-field" name="description"><?php print ($data['description'])?></textarea>
  </div>
  <input name="position"  type="hidden" value="<?php print ($data['position'])?>" />
  <input type="submit" class="semi hidden" name="save" />
<microweber module="custom_fields" view="admin" for="categories" id="<?php print ($data['id'])?>" />
<div class="post-save-bottom">
  <input type="submit" name="save" class="semi_hidden"  value="<?php _e("Save"); ?>" />
  <div class="vSpace"></div>
  <span style="min-width: 66px;" onclick="save_cat();" class="mw-ui-btn mw-ui-btn-medium mw-ui-btn-green">
  <?php _e("Save"); ?>
  </span> </div>

  </form>

