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
<div class="media">
	<div class="media-left">
		<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=profile&username='.$this->item->user->username) ?>">
			<img class="media-object img-circle img-thumbnail" src="<?php echo $this->item->assetPath ?>/images/profile-default.png" />
		</a>
	</div>
	<div class="media-body">
		<h5 class="media-heading">
			<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=profile&username='.$this->item->user->username) ?>"><?php echo $this->item->user->name ?></a>
		</h5>						
		<div class="post-item">
			<?php echo $this->item->content; ?>
			<?php if ( $this->item->photo ) : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_joomsoc&view=post&postid='.$this->item->id) ?>">
				<img class="img-responsive" src="<?php echo $this->item->photo?>" />
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>