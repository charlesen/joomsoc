<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_joonet
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * JoomSoc Form Field
 *
 * @since  0.0.1
 */
class JFormFieldJoonet extends JFormFieldList
{
	/**
	** The field type
	** @var string
	**/
	protected $type = 'Hello Joonet Form Field';
	
	/**
	** Method to get stuffs from Joonet
	**/
	
	protected function getOptions() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id, user_id, content');
		$query->from('#__joonet');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();
 
		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->content);
			}
		}
 
		$options = array_merge(parent::getOptions(), $options);
 
		return $options;
	}
}