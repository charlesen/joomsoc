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
  <div class="card-block">
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

<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.logout&'.JSession::getFormToken(). '=1') ?>" class="button button-default">
		<span class="glyphicon glyphicon-off"></span>
		<?php echo JText::_('COM_JOONET_LOGOUT') ?>
	</a>