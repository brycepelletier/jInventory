<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_idweb_inventory
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Inventory controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_idweb_inventory
 * @since       3.2
 */
class InventoryControllerinventory extends JControllerForm {

	public function process() {			
	  $app = JFactory::getApplication();

	  $state = $app->getUserStateFromRequest('com_idweb_inventory.basic', 'basic', array(), 'array');

	  //redirect back to display
	  $view = $this->getView('Inventory', 'html');
	  $view->setModel($this->getModel('Inventory'), true);
	  $view->display();
	}

	public function reset() {
	  $app = JFactory::getApplication();

	  $app->setUserState('com_idweb_inventory.basic', array());

	  //redirect back to display
	  $view = $this->getView('Inventory', 'html');
	  $view->setModel($this->getModel('Inventory'), true);
	  $view->display();
	}
}