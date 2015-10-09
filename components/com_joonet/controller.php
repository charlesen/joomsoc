<?php
/**
 * @author Charles EDOU NZE <charles At charlesen dot fr>
 * com_joonet
 *
 * @copyright   Copyright (C) 2015 Charles EDOU NZE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Joonet Component Controller
 *
 * @since  0.0.1
 */

jimport('joomla.filesystem.file');
 
class JoonetController extends JControllerLegacy {
	
	
	// Save User status
	function status() {		
		JSession::checkToken() or jexit(JTEXT::_('JInvalid_Token'));
		try {
			$user = JFactory::getUser();
			
			if ( $user->id ) {
				$input = JFactory::getApplication()->input;
				$model = $this->getModel();
				
				// Prepare data
				$data = new stdClass();
				$data->user_id = $user->id;
				$data->created_at = date("Y-m-d H:i:s", time());
				$data->content = $input->getString('content');
				$data->photo = $input->getString('post-photo', '');
				$data->video = $input->getString('post-video', '');
				
				//print_r($data); exit;
				
				$data->id = $model->saveStatus($data);
				
				if ( $data->id ) {
					$data->user = $user;
					$data->assetPath = JURI::base(true). '/components/com_joonet/assets';
					$view = &$this->getView('status', 'html');
					$view->assignRef('item', $data);
					$view->display();
				}
			}
			
		} catch (Exception $e) {
			echo new JResponseJson($e);
		}
	}
	
	// Upload files (photo,...)
	function upload() {
		JSession::checkToken() or die('Invalid token');		
		try {
			$userId = JFactory::getUser()->id;
			$input = JFactory::getApplication()->input;
			$photo = $input->files->get('photo');
			
			// Cleans the filename
			$filename = date("d-m-Y-h-m-s", time()) . '-' .JFile::makeSafe( $photo['name'] );
			
			// Upload file
			$src = $photo['tmp_name'];
			$dest = "/components/com_joonet/assets/uploads/".$userId."/photos/".$filename;
			$destFolder = JPATH_BASE . $dest;
			if ( JFile::upload( $src, $destFolder ) ) {
				echo new JResponseJson(JURI::base(true) . $dest);
			}
		} catch (Exception $e) {
			echo new JResponseJson($e);
		}
	}
}