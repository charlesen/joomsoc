<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_joonet_userinfo
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="card">
  <img class="card-img-top img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150" alt="Card image cap">
  <div class="card-block text-center">
    <h4 class="card-title">
      <a href="<?php echo JRoute::_('index.php?option=com_joonet&view=profile&username='.$userinfos->username) ?>"><?php echo $userinfos->name ?></a>
    </h4>
    <p class="card-text"><?php echo $userinfos->bio ?></p> 
    <address>
      <strong><?php echo $userinfos->address ?></strong><br>
      <?php echo $userinfos->city . ', ' . $userinfos->country ?><br>
      <abbr title="Phone">P:</abbr> <?php echo $userinfos->phone ?>
    </address>
  </div>
</div>

<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group text-center" role="group">
    <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.logout&'.JSession::getFormToken(). '=1') ?>" class="button button-default">
    	<span class="glyphicon glyphicon-off"></span>
    	<?php echo JText::_('COM_JOONET_LOGOUT') ?>
    </a>
  </div>
  <div class="btn-group text-center" role="group">
    <a href="<?php echo JRoute::_('/index.php?option=com_joonet&task=settings&format=json&'. JSession::getFormToken() . '=1'); ?>" class="button button-default" data-toggle="modal" data-target="#userSettingsModal">
    	<span class="glyphicon glyphicon-user"></span>
    	<?php echo JText::_('COM_JOONET_USER_SETTINGS') ?>
    </a>
  </div>
</div>