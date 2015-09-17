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
 * HTML View class for the Joonet Component
 *
 * @since  0.0.1
 */
class JoonetViewJoonet extends JViewLegacy
{
	/**
	 * Display the J view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		$user = JFactory::getUser();
		//print_r($user);
		if ( !$user->get('guest') ) {
			
			// Assets (images,...)
			$this->assetPath = JURI::base(true). '/components/com_joonet/assets';
			
			// Assign data to the view
			$this->items = $this->get('items');
			
			//print_r($this->items); exit;
	 
			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
				JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
				return false;
			}
	 
			// Display the view
			parent::display($tpl);
		} else {
			$app = JFactory::getApplication();
			$return_url = JFactory::getURI();
			$url = JRoute::_('index.php?option=com_users&view=login&return='.base64_encode($return_url->toString()));
			$app->redirect($url, JText::_('COM_JOONET_ALERTNOAUTH'));
		}
	}
}