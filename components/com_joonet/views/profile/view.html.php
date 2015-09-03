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
 
/**
 * HTML View class for the JoomSoc Component
 *
 * @since  0.0.1
 */
class JoonetViewProfile extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = 'JoomSoc Profile';
		
		$user = JFactory::getUser();
		
		if ( !$user->get('guest') ) {
			// Display the view
			parent::display($tpl);
		} else {
			$app = JFactory::getApplication();
			$return_url = JFactory::getURI();
			$url = JRoute::_('index.php?option=com_users&view=login&return='.base64_encode($return_url->toString()));
			$app->redirect($url, JText::_('COM_JOONET_ALERTNOAUTH'));
		}
	}
	
	/**
	** Post new message
	** @see index.php?option=com_joomsoc&task=edit
	**/
	function edit($id)
	{
		
	}
	
	/**
	** Post new message
	** @see index.php?option=com_joomsoc&task=post
	**/
	function post($id)
	{
		
	}
}