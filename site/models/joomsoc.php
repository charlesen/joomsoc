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
 
/**
 * JoomSoc Model
 *
 * @since  0.0.1
 */
class JoomSocModelJoomSoc extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;
 
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'JoomSoc', $prefix = 'JoomSocTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
 
	/**
	 * Get the message
	 *
	 * @param   integer  $id  Greeting Id
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getMsg($id = 1)
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}
 
		if (!isset($this->messages[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
 
			// Get a TableJoomSoc instance
			$table = $this->getTable();
 
			// Load the message
			$table->load($id);
 
			// Assign the message
			$this->messages[$id] = $table->content;
		}
 
		return $this->messages[$id];
	}
	
	/**
	 * Get All wall messages
	 *
	 * @param   integer  $next  next id
	 * @param   integer  $limit fetch limit
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getItems($limit = 12, $next=null) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// fetch data
		$columns = array('a.id', 'a.user_id', 'a.content', 'a.photo', 'a.video', 'a.created_at', 'a.updated_at', 'b.name', 'b.username', 'b.email');
		$query
			//->select('*')
			->select($db->quoteName($columns))
			->from($db->quoteName('#__joomsoc', 'a'))
			->join('INNER', $db->quoteName('#__users', 'b') . ' ON (' . $db->quoteName('a.user_id') . ' = ' . $db->quoteName('b.id') . ')')
			->where($db->quoteName('a.published') . ' = 1')
			->order($db->quoteName('a.created_at'). 'DESC');
		
		$db->setQuery($query);
		
		return $db->loadObjectList();
	}
	
	/**
	 * Save new status
	 *
	 * @param   Object $data
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function saveStatus( $data ) {
		$db = JFactory::getDbo();
		$res = $db->insertObject('#__joomsoc', $data);
		if ( !$res ) {
			$this->setError( $db->getErrorMsg() );
			return false;
		}
		
		return (int)$db->insertid();
	}
	
	/**
	 * Update status
	 *
	 * @param   Object $data
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function updateStatus( $data ) {
		$db = JFactory::getDbo();
		$res = $db->updateObject('#__joomsoc', $data);
		if ( !$res ) {
			$this->setError( $db->getErrorMsg() );
			return false;
		}
		
		return (int)$db->insertid();
	}
	
	/**
	 * Delete a status
	 *
	 * @param   Object $conditions
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function delStatus( $data ) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// Conditions
		$conditions = array(
			$db->quoteName('id') . ' = '. $data['id']
		);
		
		// delete item
		$query->delete( $db->quoteName('#__joomsoc'));
		$query->where( $conditions );
		
		$db->setQuery($query);
		
		return $db->execute();
	}
	
	public function getUserDetails($id=null) {
		// If null, return current details
	}
}