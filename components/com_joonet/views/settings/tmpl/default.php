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

?>

<form name="usersetings" id="usersetings" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<?php if ($this->userinfos) : ?>
		  <div class="form-group">
        <label for="inputEmail" class="sr-only"><?php echo JText::_('COM_JOONET_USER_EMAIL') ?></label>
        <input type="email" class="form-control" id="inputEmail" value="<?php echo $this->userinfos['email'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_EMAIL') ?>">
      </div>
      <div class="form-group">
        <label for="inputUsername" class="sr-only"><?php echo JText::_('COM_JOONET_USER_NAME') ?></label>
        <input type="text" class="form-control" id="inputUsername" value="<?php echo $this->userinfos['name'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_NAME') ?>">
      </div>
      <div class="form-group">
        <label for="inputPhone" class="sr-only"><?php echo JText::_('COM_JOONET_USER_PHONE') ?></label>
        <input type="text" class="form-control" id="inputPhone" value="<?php echo $this->userinfos['phone'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_PHONE') ?>">
      </div>
      <div class="form-group">
        <label for="inputAddress" class="sr-only"><?php echo JText::_('COM_JOONET_USER_ADDRESS') ?></label>
        <input type="text" class="form-control" id="inputAddress" value="<?php echo $this->userinfos['address'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_ADDRESS') ?>">
      </div>
      <div class="form-group">
        <label for="inputCity" class="sr-only"><?php echo JText::_('COM_JOONET_USER_CITY') ?></label>
        <input type="text" class="form-control" id="inputCity" value="<?php echo $this->userinfos['city'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_CITY') ?>">
      </div>
      <div class="form-group">
        <label for="inputCountry" class="sr-only"><?php echo JText::_('COM_JOONET_USER_COUNTRY') ?></label>
        <input type="text" class="form-control" id="inputCountry" value="<?php echo $this->userinfos['country'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_COUNTRY') ?>">
      </div>
      <div class="form-group">
        <label for="inputLocation" class="sr-only"><?php echo JText::_('COM_JOONET_USER_LOCATION') ?></label>
        <input type="text" class="form-control" id="inputLocation" value="<?php echo $this->userinfos['location'] ?>" placeholder="<?php echo JText::_('COM_JOONET_USER_LOCATION') ?>">
      </div>
      <div class="form-group">
        <label for="inputBio" class="sr-only"><?php echo JText::_('COM_JOONET_USER_BIO') ?></label>
        <textarea class="form-control" id="inputBio" placeholder="<?php echo JText::_('COM_JOONET_USER_BIO') ?>" rows="3"><?php echo $this->userinfos['bio'] ?></textarea>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="sr-only"><?php echo JText::_('COM_JOONET_USER_PASSWORD') ?></label>
        <input type="password" class="form-control" id="inputPassword" placeholder="<?php echo JText::_('COM_JOONET_USER_PASSWORD') ?>">
      </div>
		<?php endif; ?>
	</div>
	<hr />
	<div class="form-group text-center">
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo JText::_('COM_JOONET_ACTION_CLOSE') ?></button>
		<button type="submit" data-loading-text="<?php echo JText::_('COM_JOONET_ACTION_SAVING') ?>" class="btn btn-primary" id="btn-upload"><?php echo JText::_('COM_JOONET_ACTION_SAVE') ?></button>
	</div>
</form>

<script>
	jQuery(function() {
	  
    var $btnUpload = jQuery("#btn-upload").button('loading'), 
    url = "<?php echo JRoute::_('index.php?option=com_joonet&task=upload&format=json&'. JSession::getFormToken() . '=1'); ?>";
	  
	  jQuery.ajax({
				type:"post",
				url:url,
				xhr : function () {
					return jQuery.ajaxSettings.xhr();
				},
				data:formData,
				cache:false,
				contentType:false,
				processData:false,
				success : function ( res ) {
				  // Btn upload reset
				  $btnUpload.button('reset')
				  
					// Close modal
					jQuery('#photoModal').modal('hide');
					
					jQuery("#post-photo").val( res.data );
					jQuery("#post-preview-img").html( jQuery('<img />').attr("src", res.data ));
				},
				error : function ( error ) {
					console.log(error);
				}
			});
	});
</script>