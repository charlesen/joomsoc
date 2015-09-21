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

JHtml::_('jquery.framework', false);
JHtml::_('bootstrap.framework');

$document = JFactory::getDocument();
//$document->addStyleSheet( $this->assetPath. '/css/toolkit.css');
//$document->addStyleSheet( $this->assetPath. '/css/application.css');
//$document->addStyleSheet( $this->assetPath. '/css/joonet.css');
$document->addScript( $this->assetPath. '/js/joonet.js' );

?>

<div class="col-md-3 aside">
	<h5 class="aside-title"><?php echo JText::_('COM_JOONET_NAVIGATOR') ?></h5>
	<ul class="list-group">
		<li class="list-group-item">
			<a href="#">
				<span class="glyphicon glyphicon-user"></span>
				<?php echo JText::_('COM_JOONET_PROFILE') ?>
			</a>
		</li>
		<li class="list-group-item">
			<a href="#">
				<span class="glyphicon glyphicon-envelope"></span>
				<?php echo JText::_('COM_JOONET_MESSAGES') ?>
				<span class="badge">1</span>
			</a>
		</li>
		<li class="list-group-item">
			<a href="#">
				<span class="glyphicon glyphicon-camera"></span>
				<?php echo JText::_('COM_JOONET_PHOTOS') ?>
				<span class="badge">0</span>
			</a>
		</li>
		<li class="list-group-item">
			<a href="#">
				<span class="glyphicon glyphicon-cog"></span>
				<?php echo JText::_('COM_JOONET_SETTINGS') ?>
			</a>
		</li>
		<li class="list-group-item">
			<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.logout&'.JSession::getFormToken(). '=1') ?>">
				<span class="glyphicon glyphicon-off"></span>
				<?php echo JText::_('COM_JOONET_LOGOUT') ?>
			</a>
		</li>
	</ul> 
</div><!--.go -->
<div class="col-md-6">
	<ul class="ca qp anx">
	  <li class="qg b aml">
	    <div class="input-group">
	        <form class="form-inline" id="form-status">
    	       <div class="input-group">
    						<label class="sr-only"><?php echo JText::_('COM_JOONET_WHATSNEW') ?></label>
    						<input type="text" class="form-control" name="content" id="whatsnew" placeholder="<?php echo JText::_('COM_JOONET_WHATSNEW') ?>" />
    						<?php echo JHtml::_('form.token'); ?>
    						<input type="hidden" name="post-photo" id="post-photo" />
    						<input type="hidden" name="post-video" id="post-video" />
    						<div class="fj">
    						  <button type="submit" class="cg fm btn btn-default btn-submit" disabled="disabled">
    							  <span><?php echo JText::_('COM_JOONET_POST_TEXT') ?></span>
    							</button>
    						</div>
    					</div>
    					<div class="input-group">
    						<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOONET_ADD_PHOTO') ?>" id="photoModalBtn">
    							<span class="glyphicon glyphicon-camera"></span>
    						</button><!--Add Photos -->
    						<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOONET_ADD_VIDEO') ?>">
    							<span class="glyphicon glyphicon-play-circle"></span>
    						</button><!--Add Video : youtube, Vimeo, Dailyvotion,... -->
    					</div>
    					<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModal"></div><!--/Photo modal -->
    					<div class="col-md-12" id="post-preview">
    						<p id="post-preview-text"></p>
    						<p id="post-preview-img"></p>
    					</div><!--/#post-preview -->
    			</form><!--./status form -->
	    </div>
	  </li>
	  <?php foreach ($this->items as $item) : ?>
		<li class="qg b aml">
			<a class="qk" href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=profile&username='.$item->username) ?>">
				<img class="qi cu" src="<?php echo $this->assetPath ?>/images/profile-default.png" />
			</a>
			<div class="qh">
				<div class="qo">
					<a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&username='.$item->username) ?>"><?php echo $item->name ?></a>
				</div>						
				<div class="post-item">
					<?php echo $item->content; ?>
					<?php if ( $item->photo ) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_joonet&view=post&postid='.$item->id) ?>">
						<img class="img-responsive" src="<?php echo $item->photo ?>" />
					</a>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul><!--What's new ? -->
</div>
<div class="col-md-3 aside">
	<h5 class="aside-title"><?php echo JText::_('COM_JOONET_SUGGESTIONS') ?></h5>
</div>

<script>
	$(document).ready(function(){
	  
	  // Input text realtime validation
	  $('#whatsnew').keyup(function(){
      //$(this).next().text($(this).val().length < 5 ? "<?php echo JText::_('COM_JOONET_SUGGESTIONS') ?>" : "");
      if ( $(this).val() !== ''  ) {
        console.log($(this).val());
        $('#form-status button[type="submit"]').removeAttr("disabled", "disabled");
      } else {
        $('#form-status button[type="submit"]').attr("disabled", "disabled");
      }
    });
	  
		// Form Status submit 
		$("#form-status").on('submit', function ( e ) {
			e.preventDefault();
			if ( $('#whatsnew').val() !== "" ) {
			    var url = "<?php echo JRoute::_('index.php?option=com_joonet&task=status&format=json&'. JSession::getFormToken() . '=1'); ?>",
			    data=$(this).serialize();
			    jQuery.ajax({
    				type:"post",
    				url:url,
    				data:data,
    				dataType:'html',
    				success : function ( res ) {
    					// Clean inputs
    					$('#whatsnew').val('');
    					$("#post-photo").val('');
    					$("#post-preview-img").html('');
    					
    					$('.item-list').prepend(res);
    					
    					// Add item in the list
    					//updateViewList ( res );
    				},
    				error : function ( error ) {
    					console.log(error);
    				}
    			});
			}
		});
		
		// Photo modal
		var photoModalLoaded = false;
		$('#photoModalBtn').on('click', function() {
			
			// Show modal
			$('#photoModal').modal();
			
			// Load partial view
			var partialUrl = "<?php echo JRoute::_('index.php?option=com_joonet&view=photo&format=raw') ?>";			
			if ( !photoModalLoaded ) {
				photoModalLoaded = true;
				$('#photoModal').load( partialUrl );
			}
		});
	});
</script>