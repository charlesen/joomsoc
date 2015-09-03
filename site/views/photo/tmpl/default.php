<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_joomsoc
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><?php echo JText::_('COM_JOOMSOC_ADD_PHOTO') ?></h4>
		</div>
		<div class="modal-body">
			<form name="upload" id="fileuploader" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="file" name="photo" id="photo" />
					<?php echo JHtml::_('form.token'); ?>
				</div>
				<hr />
				<div class="form-group text-center">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo JText::_('COM_JOOMSOC_ACTION_CLOSE') ?></button>
					<button type="submit" class="btn btn-primary" id="btn-upload"><?php echo JText::_('COM_JOOMSOC_ACTION_ADD') ?></button>
				</div>
			</form>
		</div>
		<div class="modal-footer"></div>
	</div>
</div>

<script>
	jQuery(function() {
		jQuery('#fileuploader').on('submit', function( e ) {
			e.preventDefault();
			
			console.log('click on btn-upload !');
			
			console.log();
			
			var url = "<?php echo JRoute::_('index.php?option=com_joomsoc&task=upload&format=json&'. JSession::getFormToken() . '=1'); ?>",
				formData = new FormData( jQuery(this)[0] );
			
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
					// Close modal
					jQuery('#photoModal').modal('hide');
					
					jQuery("#post-photo").val( res.data );
					jQuery("#post-preview-img").html( jQuery('<img />').attr("src", res.data ));
				},
				error : function ( error ) {
					console.log(error);
				}
			});
			
			return false;
		});
	});
</script>