<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_joonet_userinfos
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
class ModJoonetUserinfostHelper {
  
	public static function getUser ( $params  ) {
	  $userDetails = array();
		try {
		  $user = isset($userid) ? JFactory::getUser($userid) : JFactory::getUser();
		  if ( $user->id ) {
  		  $profile = (array) JUserHelper::getProfile($user->id);
  		  $userDetails['juser'] = (array) $user;
  		  $userDetails['profile'] = $profile['profile'];
		  } 
		  return $userDetails;
		} catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
			return array();
		}
	}
	
}
