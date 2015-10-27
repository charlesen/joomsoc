<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_joonet_userinfo
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
//JHTML::_('behavior.modal');
$config = JFactory::getConfig();
$sitename = $config->get('sitename');
?>
<?php if ( $userinfos ): ?>
  <div class="card">
    <div class="card-img-top" style="background-image:url('https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150')"></div>
    <div class="card-block text-center">
      <h4 class="card-title">
        <a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&id='.$userinfos['juser']['id']) ?>"><?php echo $userinfos['juser']['name'] ?></a>
      </h4>
      <p class="card-text"><?php echo $userinfos['profile']['aboutme'] ?></p> 
      <address>
        <strong><?php echo $userinfos['profile']['address1'] ?></strong><br>
        <?php echo $userinfos['profile']['city'] . ', ' . $userinfos['profile']['country'] ?><br>
        <abbr title="Phone">P:</abbr> <?php echo $userinfos['profile']['phone'] ?>
      </address>
    </div>
  </div>
  
  <div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group text-center" role="group">
      <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.logout&'.JSession::getFormToken(). '=1') ?>" class="btn btn-default">
      	<span class="glyphicon glyphicon-off"></span>
      	<?php echo JText::_('MOD_JOONET_LOGOUT') ?>
      </a>
    </div>
    <div class="btn-group text-center" role="group">
      <!--<a class="modal btn btn-default" href="index.php?option=com_users&view=profile&layout=edit&tmpl=component?" rel="{handler: 'iframe', size: {x: 640, y: 540}}">
        <span class="glyphicon glyphicon-user"></span>
      	<?php echo JText::_('MOD_JOONET_USER_SETTINGS') ?>
      </a>-->
      <button class="btn btn-default" id="btn-settings">
      	<span class="glyphicon glyphicon-user"></span>
      	<?php echo JText::_('MOD_JOONET_USER_SETTINGS') ?>
      </button>
    </div>
  </div>
<?php else : ?>
  <p>
    <h4>
      <?php echo JText::sprintf('MOD_JOONET_SYS_NEW_ON', $sitename); ?>
      <a class="btn btn-primary" role="button" href="<?php echo JRoute::_('index.php?option=com_users&view=registration&'.JSession::getFormToken(). '=1') ?>"><?php echo JText::_('MOD_JOONET_SUBSCRIBE'); ?></a>
    </h4>
  </p>
<?php endif; ?>

<div class="modal fade" id="userSettingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
  		<div class="modal-header">
  		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			<h4 class="modal-title text-center" id="settingsModalLabel"><?php echo JText::_('COM_JOONET_USER_SETTINGS_LABEL') ?></h4>
  		</div>
  		<div class="modal-body">
  		  <p class="text-center"><?php echo JText::_('COM_JOONET_LOADING') ?></p>
  		</div>
  		<div class="modal-footer">
  		  <div class="form-group text-center">
      		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo JText::_('COM_JOONET_ACTION_CLOSE') ?></button>
      		<button type="submit" data-loading-text="<?php echo JText::_('COM_JOONET_ACTION_SAVING') ?>" class="btn btn-primary" id="btn-save-settings"><?php echo JText::_('COM_JOONET_ACTION_SAVE') ?></button>
      	</div>
  		</div>
  	</div>
  </div>
</div>

<script>
	jQuery(function() {
    //var $btnSettings = jQuery("#btn-settings").button('loading'), 
    var $modalBody = jQuery("#userSettingsModal .modal-body");
    jQuery( "#btn-settings" ).on("click", function () {
      jQuery('#userSettingsModal').modal("show");
      var url = "<?php echo 'index.php?option=com_joonet&task=settings&format=raw&'. JSession::getFormToken() . '=1'; ?>";
      // Fetch user infos
      jQuery.ajax({
  				type:"get",
  				url:url,
  				success : function ( res ) {
  				  $modalBody.html(res);
  				},
  				error : function ( error ) {
  				  var errorMsg = "<?php echo JText::_('COM_JOONET_SYSTEM_ERROR') ?>"  
  					$modalBody.html( '<p class="text-danger">' + errorMsg + '</p>' );
  					console.log(error);
  				}
  		});
    });
	});
</script>