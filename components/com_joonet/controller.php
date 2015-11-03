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
					$view = $this->getView('posts', 'html');
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
			  // Resize
			  $this->resizeImage($destFolder);
				echo new JResponseJson(JURI::base(true) . $dest);
			}
		} catch (Exception $e) {
			echo new JResponseJson($e);
		}
	}
	
	/**
  * Resize an image and keep the proportions
  * @author Allison Beckwith <allison@planetargon.com>
  * @param string $filename
  * @param integer $max_width
  * @param integer $max_height
  * @return image
  */
  function resizeImage($filename, $max_width=800, $max_height=600) {
      
      $image = new JImage($filename);
      
      $width  = $image->getWidth();
      $height = $image->getheight();
  
      # taller
      if ($height > $max_height) {
          $width = ($max_height / $height) * $width;
          $height = $max_height;
      }
  
      # wider
      if ($width > $max_width) {
          $height = ($max_width / $width) * $height;
          $width = $max_width;
      }
        
      // Resize the image using the SCALE_INSIDE method
      $image->resize($width, $height, false, JImage::SCALE_INSIDE);
      
      // Write it to disk
      $image->toFile($filename);
      
      //return $image;
  }
	
	function settings () {
	  $user = JFactory::getUser();
	  if ( $user->id ) {
				//$input = JFactory::getApplication()->input;
				$model = $this->getModel("profile");
				$userinfos = $model->getUser();
				$view = $this->getView('settings', 'raw');
				$view->assignRef('userinfos', $userinfos);
				$view->display();
	  }
	}
	
	// Save user settings 
	function settingssave () {
	  // Check for request forgeries.
		JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

	  $user = JFactory::getUser();
	  $jinput = JFactory::getApplication()->input;
	  $result = true;
	  try {
  	  // Set the new user settings ;
  	  $user->name = $jinput->getString('name');
  	  $user->username = $jinput->getString('username');
  	  $user->email = $jinput->getString('email');
  	  if ( !empty($jinput->get('password')) ) $user->password = $jinput->getString('password');
  	  
  	  if ($user->save(true)) {
  	    
  	    // Update user's session object
        $session = JFactory::getSession();
        $session->set('user', new JUser($user->id));
  	    
        $profile = array();
        $profile['profile.phone'] = $jinput->get('phone');
        $profile['profile.address1'] = $jinput->getString('address');
        $profile['profile.city'] = $jinput->getString('city');
        $profile['profile.country'] = $jinput->getString('country');
        $profile['profile.region'] = $jinput->get('region');
        $profile['profile.aboutme'] = $jinput->getString('aboutme');
  
        $ordering = 0;
        $results = array();
        foreach ($profile  as $k=>$v) {
          $db = JFactory::getDbo();
          $query = $db->getQuery(true);
          
          // Fields to update.
          $ordering += 1;
          $fields = array(
              $db->quoteName('profile_value') . ' = ' . $db->quote($v),
              $db->quoteName('ordering') . ' = '. $ordering
          );
           
          // Conditions for which records should be updated.
          $conditions = array(
              $db->quoteName('user_id') . ' = '. $user->id, 
              $db->quoteName('profile_key') . ' = ' . $db->quote($k)
          );
          
          $query->update($db->quoteName('#__user_profiles'))->set($fields)->where($conditions);
           
          $db->setQuery($query);
           
          $result = $result && $db->execute();
        }
        
        if ( !$result  )  JError::raiseError(500, $user->getError() );
        
        return $result;
        
      } else {
        JError::raiseError(500, $user->getError() ); // Save or show error if failed
      }
	    
	  } catch (Exception $e) {
			echo new JResponseJson($e);
		}
	  
	}
	
}