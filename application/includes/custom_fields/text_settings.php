<?php include('settings_header.php'); ?>

<script type="text/javascript">

if(typeof mw.custom_fields.text === 'undefined'){
    mw.custom_fields.text = {}
    mw.custom_fields.text._globalinput = mwd.createElement('input');
    mw.custom_fields.text._globalinput.type = 'text';
    mw.custom_fields.text._globalarea = mwd.createElement('textarea');
}

$(document).ready(function(){
  mw.$("#mw-custom-fields-text-switch").commuter(function(){
    var curr = mwd.querySelector('#mw-custom-fields-text-holder input');
    mw.tools.copyAttributes(curr, mw.custom_fields.text._globalarea, ['type']);
    curr.parentNode.replaceChild(mw.custom_fields.text._globalarea, curr);
  }, function(){
     var curr = mwd.querySelector('#mw-custom-fields-text-holder textarea');
     mw.tools.copyAttributes(curr, mw.custom_fields.text._globalinput, ['type']);
     curr.parentNode.replaceChild(mw.custom_fields.text._globalinput, curr);
  });
});


</script>
<style>
    #mw-custom-fields-text-holder textarea{
      resize:none;
    }

</style>
 <div class="custom-field-col-left">
               

  <label class="mw-ui-label" for="input_field_label<?php print $rand; ?>">
    <?php _e('Define Title'); ?>
  </label>

    <input type="text" onkeyup="" class="mw-ui-field" value="<?php print ($data['custom_field_name']) ?>" name="custom_field_name" id="input_field_label<?php print $rand; ?>">

    <div class="vSpace"></div>

    <label class="mw-ui-check"><input type="checkbox"  class="mw-custom-field-option" name="options[as_text_area]"  <?php if(isset($data['options']) == true and isset($data['options']["as_text_area"]) == true): ?> checked="checked" <?php endif; ?> value="1" id="mw-custom-fields-text-switch"><span></span><span><?php _e("Use as Text Area"); ?></span></label>
    <div class="vSpace"></div>
    <label class="mw-ui-check"><input type="checkbox"  class="mw-custom-field-option" name="options[required]"  <?php if(isset($data['options']) == true and isset($data['options']["required"]) == true): ?> checked="checked" <?php endif; ?> value="1"><span></span><span><?php _e("Required"); ?>?</span></label>

    

</div>



   <div class="custom-field-col-right">
    <div class="mw-custom-field-group">
      <label class="mw-ui-label" for="custom_field_value<?php print $rand; ?>"><?php _e("Default Value"); ?></label>
        <div id="mw-custom-fields-text-holder">
            <input type="text" class="mw-ui-field" name="custom_field_value"  value="<?php print ($data['custom_field_value']) ?>"  />
        </div>
    </div>

    <?php print $savebtn; ?>
    </div>

    <?php include('settings_footer.php'); ?>
