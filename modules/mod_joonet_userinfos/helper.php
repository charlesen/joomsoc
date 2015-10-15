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
	  //$jinput = JFactory::getApplication()->input;
	  $db    = JFactory::getDbo();
	  $user = (array) JFactory::getUser();
	  
		try {
		  if ( $user['id'] ) {
        $query = $db->getQuery(true)
        ->select('*')
        ->from($db->quoteName('#__joonet_user_details', 'a'))
        ->where($db->quoteName('a.user_id') . ' = '. $user['id']);
        
        $db->setQuery($query);
        $userDetails = (array) $db->loadObjectList()[0];
        return array_merge($user, $userDetails);
  	  }
		} catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
		}
		return array();
	}
	
}
