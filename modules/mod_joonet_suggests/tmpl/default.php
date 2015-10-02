<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_users_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<h3 class="aside-title"><?php echo JText::_('COM_JOONET_SUGGESTIONS') ?></h3>
<?php if (!empty($names)) : ?>
	<ul class="latestusers<?php echo $moduleclass_sfx ?>" >
	<?php foreach ($names as $name) : ?>
		<li>
			<?php echo $name->username; ?>
		</li>
	<?php endforeach;  ?>
	</ul>
<?php endif; ?>