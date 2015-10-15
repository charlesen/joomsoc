<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_joonet_userinfo
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$config = JFactory::getConfig();
$sitename = $config->get('sitename');
?>
<?php if ( $userinfos ): ?>
  <div class="card">
    <img class="card-img-top img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150" alt="Card image cap">
    <div class="card-block text-center">
      <h4 class="card-title">
        <a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&id='.$userinfos['user_id']) ?>"><?php echo $userinfos['name'] ?></a>
      </h4>
      <p class="card-text"><?php echo $userinfos['bio'] ?></p> 
      <address>
        <strong><?php echo $userinfos['address'] ?></strong><br>
        <?php echo $userinfos['city'] . ', ' . $userinfos['country'] ?><br>
        <abbr title="Phone">P:</abbr> <?php echo $userinfos['phone'] ?>
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
  		  
  		</div>
  		<div class="modal-footer"></div>
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
  					console.log(error);
  				}
  		});
    });
	});
</script>