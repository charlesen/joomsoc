<?php
/**
 * @author Charles EDOU NZE <charles At charlesen dot fr>
 * com_joomsoc
 *
 * @copyright   Copyright (C) 2015 Charles EDOU NZE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');


// Check if User's connected
$user = JFactory::getUser();
if ( $user->id ) {
	
	//print_r($user); exit;
	
	// Get an instance of the controller prefixed by HelloWorld
	$controller = JControllerLegacy::getInstance('JoomSoc');
	 
	// Perform the Request task
	$input = JFactory::getApplication()->input;
	$controller->execute($input->getCmd('task'));
	 
	// Redirect if set by the controller
	$controller->redirect();
} else {
	// Redirect to Login page
	$app = JFactory::getApplication();
	$return = JFactory::getURI()->toString();
	$url 	= 'index.php?option=com_users&view=login';
	$url   .= '&return='. base64_encode($return);
	$app->redirect($url, JText::_('COM_JOOMSOC_ALERTNOAUTH'));
	
	return false;
}