<?php
/**
 * @version     1.0.0
 * @package     com_idweb_inventory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Bryce Pelletier <bryce@idwebstudios.com> - http://www.idwebstudios.com
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Inventory');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
