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
		$userDetails = array();
		try {
		  
		  $user = isset($userid) ? JFactory::getUser($userid) : JFactory::getUser();
		  $profile = (array) JUserHelper::getProfile($user->id);
		  
		  $userDetails['juser'] = (array) $user;
		  $userDetails['profile'] = $profile['profile'];
		  
		  //print_r($userDetails); exit;
		  
		  return $userDetails;
		} catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
			return array();
		}
	}
	
	public function saveProfile ($data = null) {

    // Fields to update.
    $fields = array(
        $db->quoteName('phone') . ' = ' . $data->phone,
        $db->quoteName('address1') . ' = ' . $data->address,
        $db->quoteName('city') . ' = ' . $data->city,
        $db->quoteName('country') . ' = ' . $data->country,
        $db->quoteName('region') . ' = ' . $data->location,
        $db->quoteName('aboutme') . ' = ' . $data->bio
    );
    // Conditions for which records should be updated.
    $conditions = array(
        $db->quoteName('user_id') . ' = 42', 
        $db->quoteName('profile_key') . ' = ' . $db->quote('custom.message')
    );
    $query->update($db->quoteName('#__user_profiles'))->set($fields)->where($conditions);
    
    $db->setQuery($query);
    $result = $db->query();
    
    $result = JFactory::getDbo()->updateObject('#__user_profiles', $data, 'user_id');
	  
	}
}
