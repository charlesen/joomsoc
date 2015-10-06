<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_users_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_joonet_userinfos
 *
 * @package     Joomla.Site
 * @subpackage  mod_joonet_userinfos
 *
 * @since       1.6
 */
class ModJoonetUserinfostHelper
{
	/**
	 * Get users sorted by activation date
	 * 
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 * 
	 * @return  array  The array of users
	 * 
	 * @since   1.6
	 */
	public static function getUserInfos($params) {
	  $db    = JFactory::getDbo();
	  $user = JFactory::getUser();
	  
	  //print_r($user);exit;
	  //$columns = array('a.id', 'a.name', 'a.username', 'a.email', 'a.registerDate', 'b.id', 'b.user_id', 'b.video', 'b.content', 'b.photo', 'b.video', 'b.created_at', 'b.updated_at');
	  //$columns = array('a.id', 'a.user_id', 'a.content', 'a.photo', 'a.video', 'a.created_at', 'a.updated_at', 'b.name', 'b.username', 'b.email');
		$query = $db->getQuery(true)
			->select('*')
			//->select($db->quoteName(array('a.*', 'b.*')))
			//->select($db->quoteName($columns))
			->from($db->quoteName('#__users', 'a'))
      ->join('INNER', $db->quoteName('#__joonet_user_details', 'b') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.user_id') . ')');
      //->where($db->quoteName('a.published') . ' = 1');
				//->join('LEFT', '#__usergroups AS ug ON ug.id = m.group_id')
				//->where('ug.id in (' . implode(',', $groups) . ')')
				//->where('ug.id <> 1');

    //$db->setQuery($query, 0, $params->get('shownumber'));
		$db->setQuery($query);

    //print_r($db->loadObjectList()); exit;
    
		try {
			return (array) $db->loadObjectList();
		}
		catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');

			return array();
		}
	}
		
		// fetch data
		/**
		$query
			//->select('*')
			->select($db->quoteName($columns))
			->from($db->quoteName('#__joonet', 'a'))
			->join('INNER', $db->quoteName('#__users', 'b') . ' ON (' . $db->quoteName('a.user_id') . ' = ' . $db->quoteName('b.id') . ')')
			->where($db->quoteName('a.published') . ' = 1')
			->order($db->quoteName('a.id'). 'DESC');
		
		$db->setQuery($query);
		
		//print_r($db->loadObjectList());
		
		return $db->loadObjectList();
		**/
	
}
