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
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $this->userinfos['email'] ?>" placeholder="<?php echo $this->userinfos['email'] ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $this->userinfos['name'] ?>" placeholder="<?php echo $this->userinfos['name'] ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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