<?php

/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <  Generated with Cook           (100% Vitamin) |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		1.6
* @package		ZefaniaBible
* @subpackage	Zefaniabible
* @copyright	Missionary Church of Grace
* @author		Andrei Chernyshev - www.missionarychurchofgrace.org - andrei.chernyshev1@gmail.com
* @license		GNU/GPL
*
* /!\  Joomla! is free software.
* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*
*             .oooO  Oooo.     See COPYRIGHT.php for copyright notices and details.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JPATH_ADMIN_ZEFANIABIBLE .DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'jmodel.list.php');


/**
 * Zefaniabible Component Zefaniabible Model
 *
 * @package		Joomla
 * @subpackage	Zefaniabible
 *
 */
class ZefaniabibleModelZefaniabible extends ZefaniabibleModelList
{
	var $_name_sing = 'zefaniabibleitem';



	/**
	 * Constructor
	 *
	 */
	function __construct($config = array())
	{
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'title', 'a.bible_name',
				'full_name', 'a.desc',
				'publish', 'a.publish',
				'ordering', 'a.ordering',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'publish' => 'bool'
				));



		parent::__construct($config);
		$this->_modes = array_merge($this->_modes, array('publish'));


	}




	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.


		return parent::getStoreId($id);
	}



	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();



		parent::populateState();
	}


	/**
	 * Method to build a the query string for the Zefaniabibleitem
	 *
	 * @access public
	 * @return integer
	 */
	function _buildQuery()
	{

		if (isset($this->_active['predefined']))
		switch($this->_active['predefined'])
		{
			case 'default': return $this->_buildQuery_default(); break;

		}



		$query = ' SELECT a.*'

			. $this->_buildQuerySelect()

			. ' FROM `#__zefaniabible_bible_names` AS a '

			. $this->_buildQueryJoin() . ' '

			. $this->_buildQueryWhere()


			. $this->_buildQueryOrderBy()
			. $this->_buildQueryExtra()
		;

		return $query;
	}

	function _buildQuery_default()
	{

		$query = ' SELECT a.*'

			. $this->_buildQuerySelect()

			. ' FROM `#__zefaniabible_bible_names` AS a '

			. $this->_buildQueryJoin() . ' '

			. $this->_buildQueryWhere()


			. $this->_buildQueryOrderBy()
			. $this->_buildQueryExtra()
		;

		return $query;
	}

	

	function _buildQueryWhere($where = array())
	{
		$app = JFactory::getApplication();
		$db= JFactory::getDBO();
		//$acl = ZefaniabibleHelper::getAcl();
		$mdl_acl = new ZefaniabibleHelper;
		$acl = $mdl_acl->getAcl();
		
		if (isset($this->_active['filter']) && $this->_active['filter'])
		{
			$filter_publish = $this->getState('filter.publish');
			if ($filter_publish != '')		$where[] = "a.publish = " . $db->Quote($filter_publish);


		}
		if (!$acl->get('core.edit.state')
		&& (!isset($this->_active['publish']) || $this->_active['publish'] !== false))
				$where[] = "a.publish=1";


		return parent::_buildQueryWhere($where);
	}

	function _buildQueryOrderBy($order = array(), $pre_order = 'a.ordering, a.bible_name')
	{

		return parent::_buildQueryOrderBy($order, $pre_order);
	}

	/**
	 * Method to Convert the parameter fields into objects.
	 *
	 * @access public
	 * @return void
	 */
	protected function populateParams()
	{

		parent::populateParams();
		//$acl = ZefaniabibleHelper::getAcl();
		$mdl_acl = new ZefaniabibleHelper;
		$acl = $mdl_acl->getAcl();
				
		if (!isset($this->_data))
			return;

		// Convert the parameter fields into objects.
		foreach ($this->_data as &$item)
		{

			if ($acl->get('core.edit.state')
				|| (bool)$item->publish)
				$item->params->set('access-view', true);

			if ($acl->get('core.edit'))
				$item->params->set('access-edit', true);

			if ($acl->get('core.delete'))
				$item->params->set('access-delete', true);


		}

	}

}
