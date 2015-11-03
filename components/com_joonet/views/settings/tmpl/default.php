<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  COM_JOONET
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//print_r($this->userinfos); exit;

?>


<div id="userinfos-tabs">

  <p class="text-success text-center system-msg"></p>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#params-basics" aria-controls="params-basics" role="tab" data-toggle="tab"><?php echo JText::_('COM_JOONET_PARAMS_TAB_BASICS') ?></a></li>
    <li role="presentation"><a href="#params-profile" aria-controls="params-profile" role="tab" data-toggle="tab"><?php echo JText::_('COM_JOONET_PARAMS_TAB_PROFILE') ?></a></li>
    <li role="presentation"><a href="#params-messages" aria-controls="params-messages" role="tab" data-toggle="tab"><?php echo JText::_('COM_JOONET_PARAMS_TAB_MESSAGES') ?></a></li>
    <li role="presentation"><a href="#params-settings" aria-controls="params-settings" role="tab" data-toggle="tab"><?php echo JText::_('COM_JOONET_PARAMS_TAB_SETTINGS') ?></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="usersetings">
    <!--<form name="usersetings" id="usersetings" method="post" enctype="multipart/form-data">-->
      <div role="tabpanel" class="tab-pane active" id="params-basics">
        <?php if ($this->userinfos['juser']) : ?>
          <div class="form-group">
            <label for="inputPhone" class="sr-only"><?php echo JText::_('COM_JOONET_USER_USERNAME') ?></label>
            <input type="text" class="form-control" name="username" id="inputUsername" value="<?php echo $this->userinfos['juser']['username'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_USERNAME') ?>" disabled>
          </div>
          <div class="form-group">
            <label for="inputPhone" class="sr-only"><?php echo JText::_('COM_JOONET_USER_NAME') ?></label>
            <input type="text" class="form-control" name="name" id="inputName" value="<?php echo $this->userinfos['juser']['name'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_NAME') ?>">
          </div>
          <div class="form-group">
            <label for="inputAddress" class="sr-only"><?php echo JText::_('COM_JOONET_USER_EMAIL') ?></label>
            <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $this->userinfos['juser']['email'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_EMAIL') ?>">
          </div>
          <div class="form-group">
            <label for="inputCity" class="sr-only"><?php echo JText::_('COM_JOONET_USER_PASSWORD') ?></label>
            <input type="password" class="form-control" name="password" id="inputPassword" value="" placeholder="<?php echo JText::_('COM_JOONET_USER_PASSWORD') ?>">
          </div>
    		<?php endif; ?>
      </div><!--basics panel -->
      <div role="tabpanel" class="tab-pane" id="params-profile">
        	<div class="form-group">
        		<?php if ($this->userinfos['profile']) : ?>
              <div class="form-group">
                <label for="inputPhone" class="sr-only"><?php echo JText::_('COM_JOONET_USER_PHONE') ?></label>
                <input type="text" class="form-control" name="phone" id="inputPhone" value="<?php echo $this->userinfos['profile']['phone'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_PHONE') ?>">
              </div>
              <div class="form-group">
                <label for="inputAddress" class="sr-only"><?php echo JText::_('COM_JOONET_USER_ADDRESS') ?></label>
                <input type="text" class="form-control" name="address" id="inputAddress" value="<?php echo $this->userinfos['profile']['address1'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_ADDRESS') ?>">
              </div>
              <div class="form-group">
                <label for="inputCity" class="sr-only"><?php echo JText::_('COM_JOONET_USER_CITY') ?></label>
                <input type="text" class="form-control" name="city" id="inputCity" value="<?php echo $this->userinfos['profile']['city'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_CITY') ?>">
              </div>
              <div class="form-group">
                <label for="inputCountry" class="sr-only"><?php echo JText::_('COM_JOONET_USER_COUNTRY') ?></label>
                <input type="text" class="form-control" name="country" id="inputCountry" value="<?php echo $this->userinfos['profile']['country'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_COUNTRY') ?>">
              </div>
              <div class="form-group">
                <label for="inputRegion" class="sr-only"><?php echo JText::_('COM_JOONET_USER_REGION') ?></label>
                <input type="text" class="form-control" name="region" id="inputRegion" value="<?php echo $this->userinfos['profile']['region'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_REGION') ?>">
              </div>
              <div class="form-group">
                <label for="inputAbout" class="sr-only"><?php echo JText::_('COM_JOONET_USER_ABOUTME') ?></label>
                <textarea class="form-control" name="aboutme" id="inputAbout" placeholder="<?php echo JText::_('COM_JOONET_USER_ABOUTME') ?>" rows="3"><?php echo $this->userinfos['profile']['aboutme'] ?></textarea>
              </div>
        		<?php endif; ?>
        	</div>
        	<hr />
      </div><!--profile panel -->
      <div role="tabpanel" class="tab-pane" id="params-messages">...</div><!--messages panel -->
      <div role="tabpanel" class="tab-pane" id="params-settings">...</div><!--settings panel -->
    <!--</form> #usersetings -->
  </div>

</div><!--#userinfos-tabs -->

<script>
	jQuery(function() {
	  
	  // Get User basics
    var $btnParams = jQuery("#btn-save-settings"),
        url = "index.php?option=com_joonet&task=settingssave&format=raw&<?php echo JSession::getFormToken() . '=1'; ?>";
	  
	  $btnParams.on("click", function(){
  	    // Loader
  	    $btnParams.button('loading');
  	    
  	    var formData = {};
  	    $('#usersetings .form-control').each(function() {
  	        formData[jQuery(this).attr("name")]= jQuery(this).val();
        });
        
        //console.log(formData);
        
        jQuery.ajax({
  				type:"post",
  				url:url,
  				data:formData,
  				success : function ( res ) {
  				  $btnParams.button('reset');
  				  jQuery("#userinfos-tabs .system-msg").html("<?php echo JText::_('COM_JOONET_SYSTEM_USER_SAVED_SUCCESS') ?>");
  				  // #params-basics
  				},
  				error : function ( error ) {
  				  $btnParams.button('reset');
  					console.log(error);
  				}
  			});
	  });
	});
</script>