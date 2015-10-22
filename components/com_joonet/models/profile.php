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
 
/**
 * Joonet Model
 *
 * @since  0.0.1
 */
class JoonetModelProfile extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $message;
 
	/**
	 * Get the message
         *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg()
	{
		if (!isset($this->message))
		{
			$this->message = 'Joonet Model Profile, From Model';
		}
 
		return $this->message;
	}
	
	public function getUser ( $userid = null  ) {
	  $user = isset($userid) ? JFactory::getUser($userid) : JFactory::getUser();
	  $user = (array) $user;
	  
	  $db = JFactory::getDbo();
	  $query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__joonet_user_details', 'a'))
      ->where($db->quoteName('a.user_id') . ' = '. $user['id']);
		
		$db->setQuery($query);

		try {
		  $userDetails = (array) $db->loadObjectList()[0];
		  
		  //print_r($userDetails); exit;
		  
		  return array_merge($user, $userDetails);
		} catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
			return array();
		}
	}
}
