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
<ul class="posts-list">
  <li class="post post-list-header">
    <div class="form-group">
        <form id="form-status">
            <div class="row">
              <div class="col-xs-12">
                <div class="input-group">
      						<label class="sr-only"><?php echo JText::_('COM_JOONET_WHATSNEW') ?></label>
      						<textarea class="form-control" name="content" id="whatsnew" placeholder="<?php echo JText::_('COM_JOONET_WHATSNEW') ?>"></textarea>
      						<?php echo JHtml::_('form.token'); ?>
      						<input type="hidden" name="post-photo" id="post-photo" />
      						<input type="hidden" name="post-video" id="post-video" />
      						<div class="input-group-btn">
      						  <button type="submit" class="cg fm btn btn-default btn-submit" disabled="disabled">
      							  <span><?php echo JText::_('COM_JOONET_POST_TEXT') ?></span>
      							</button>
      						</div>
      					</div><!-- /.input-group -->
              </div><!-- /.col-xs-12 -->
              <div class="col-xs-12">
                <div class="input-group">
      						<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOONET_ADD_PHOTO') ?>" id="photoModalBtn">
      							<span class="glyphicon glyphicon-camera"></span>
      						</button><!--Add Photos -->
      						<button type="button" class="btn btn-default" aria-label="<?php echo JText::_('COM_JOONET_ADD_VIDEO') ?>">
      							<span class="glyphicon glyphicon-play-circle"></span>
      						</button><!--Add Video : youtube, Vimeo, Dailyvotion,... -->
      					</div><!-- /.input-group -->
              </div><!-- /.col-xs-12 -->
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
	<li class="post">
	  <div class="media">
	    <div class="media-left">
  	    <a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&id='.$item->user_id) ?>">
    			<img class="media-object img-circle img-thumbnail" src="<?php echo $this->assetPath ?>/images/profile-default.png" />
    		</a>
  	  </div><!--/.media-left -->
  		<div class="media-body">
  			<h5 class="media-heading">
  				<a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&id='.$item->user_id) ?>"><?php echo $item->name ?></a>
  			</h5>						
  			<div class="post-item">
  				<?php echo $item->content; ?>
  				<?php if ( $item->photo ) : ?>
  				<a href="<?php echo JRoute::_('index.php?option=com_joonet&view=posts&postid='.$item->id) ?>">
  					<img class="img-responsive" src="<?php echo $item->photo ?>" />
  				</a>
  				<?php endif; ?>
  			</div>
  		</div><!--/.media-body -->
	  </div><!--/.media -->
	</li>
	<?php endforeach; ?>
</ul><!--What's new ? -->
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
			    var url = "<?php echo '/index.php?option=com_joonet&task=status&format=json&'. JSession::getFormToken() . '=1'; ?>",
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
    					
    					// Add item in the list
    					$('.post-list-header').after( '<li class="post">' + res + '</li>');
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
			var partialUrl = "<?php echo JURI::root( true ) ?>index.php?option=com_joonet&view=photo&format=raw";			
			if ( !photoModalLoaded ) {
				photoModalLoaded = true;
				$('#photoModal').load( partialUrl );
			}
		});
	});
</script>