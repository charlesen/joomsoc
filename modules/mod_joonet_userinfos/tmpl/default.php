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