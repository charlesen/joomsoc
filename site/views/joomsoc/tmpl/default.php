<?php
/**
 * @author Charles EDOU NZE <charles At charlesen dot fr>
 * com_joomsoc
 *
 * @copyright   Copyright (C) 2015 Charles EDOU NZE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('jquery.framework');

$document = JFactory::getDocument();
$document->addStyleSheet( $this->assetPath. '/css/joomsoc.css' );
//$document->addScript( $this->assetPath. '/js/joomsoc.js' );
?>

<div class="joomsoc-wall">
	<div class="row">
		<div class="col-md-3">
			<h5><?php echo JText::_('COM_JOOMSOC_NAVIGATOR') ?></h5>
			<ul class="list-group">
				<li class="list-group-item">
					<a href="#">
						<span class="glyphicon glyphicon-user"></span>
						<?php echo JText::_('COM_JOOMSOC_MYPROFILE') ?>
					</a>
				</li>
				<li class="list-group-item">
					<a href="#">
						<span class="glyphicon glyphicon-envelope"></span>
						<?php echo JText::_('COM_JOOMSOC_MYMESSAGES') ?>
						<span class="badge">1</span>
					</a>
				</li>
				<li class="list-group-item">
					<a href="#">
						<span class="glyphicon glyphicon-camera"></span>
						<?php echo JText::_('COM_JOOMSOC_MYPHOTOS') ?>
						<span class="badge">0</span>
					</a>
				</li>
				<li class="list-group-item">
					<a href="#">
						<span class="glyphicon glyphicon-cog"></span>
						<?php echo JText::_('COM_JOOMSOC_MYSETTINGS') ?>
					</a>
				</li>
				<li class="list-group-item">
					<a href="<?php echo JRoute::_('index.php?option=com_user&task=logout&'.JSession::getFormToken(). '=1') ?>">
						<span class="glyphicon glyphicon-off"></span>
						<?php echo JText::_('COM_JOOMSOC_LOGOUT') ?>
					</a>
				</li>
			</ul> 
		</div>
		<div class="col-md-6 joomsoc-wall-status">
			
			<div class="page-header thumbnail">
				<form class="form-inline" id="form-status">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="sr-only"><?php echo JText::_('COM_JOOMSOC_WHATSNEW') ?></label>
								<input type="text" class="form-control" name="content" id="whatsnew" placeholder="<?php echo JText::_('COM_JOOMSOC_WHATSNEW') ?>" />
							</div>
							<?php echo JHtml::_('form.token'); ?>
							<input type="hidden" name="post-photo" id="post-photo" />
							<input type="hidden" name="post-video" id="post-video" />
							<button type="submit" class="btn btn-default btn-submit"><?php echo JText::_('COM_JOOMSOC_POST_TEXT') ?></button>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOOMSOC_ADD_PHOTO') ?>" id="photoModalBtn">
									<span class="glyphicon glyphicon-camera"></span>
								</button><!--Add Photos -->
								<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOOMSOC_ADD_VIDEO') ?>">
									<span class="glyphicon glyphicon-play-circle"></span>
								</button><!--Add Video : youtube, Vimeo, Dailyvotion,... -->
							</div>
							
							<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModal">
							</div><!--/Photo modal -->
							
						</div><!--Media action buttons : photos, videos,... -->
						<div class="col-md-12" id="post-preview">
							<p id="post-preview-text"></p>
							<p id="post-preview-img"></p>
						</div><!--/#post-preview -->
					</div>
					
				</form><!--./status form -->
			</div><!--What's new ? -->
			
			<div class="item-list">
				<?php foreach ($this->items as $item) : ?>
				<div class="media thumbnail">
					<div class="media-left">
						<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=profile&username='.$item->username) ?>">
							<img class="media-object img-circle img-thumbnail" src="<?php echo $this->assetPath ?>/images/profile-default.png" />
						</a>
					</div>
					<div class="media-body">
						<h5 class="media-heading">
							<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=profile&username='.$item->username) ?>"><?php echo $item->name ?></a>
						</h5>						
						<div class="post-item">
							<?php echo $item->content; ?>
							<?php if ( $item->photo ) : ?>
							<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=post&postid='.$item->id) ?>">
								<img class="img-responsive" src="<?php echo $item->photo ?>" />
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-md-3">
			<h5><?php echo JText::_('COM_JOOMSOC_SUGGESTIONS') ?></h5>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function(){
		// Form Status submit 
		jQuery("#form-status").on('submit', function ( e ) {
			var url = "<?php echo JRoute::_('index.php?option=com_joomsoc&task=status&format=json&'. JSession::getFormToken() . '=1'); ?>", data=jQuery(this).serialize();
			
			e.preventDefault();
			
			jQuery.ajax({
				type:"post",
				url:url,
				data:data,
				dataType:'html',
				success : function ( res ) {
					// Clean inputs
					jQuery('#whatsnew').val('');
					jQuery("#post-photo").val('');
					jQuery("#post-preview-img").html('');
					
					jQuery('.item-list').prepend(res);
					
					// Add item in the list
					//updateViewList ( res );
				},
				error : function ( error ) {
					console.log(error);
				}
			});
		});
		
		// Photo modal
		var photoModalLoaded = false;
		jQuery('#photoModalBtn').on('click', function() {
			
			// Show modal
			jQuery('#photoModal').modal();
			
			// Load partial view
			var partialUrl = "<?php echo JRoute::_('index.php?option=com_joomsoc&view=photo&format=raw') ?>";			
			if ( !photoModalLoaded ) {
				photoModalLoaded = true;
				jQuery('#photoModal').load( partialUrl );
			}
		});
	});
</script>