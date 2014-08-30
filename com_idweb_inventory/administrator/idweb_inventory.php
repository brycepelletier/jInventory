<?php
/**
 * @version     1.0.0
 * @package     com_idweb_inventory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Bryce Pelletier <bryce@idwebstudios.com> - http://www.idwebstudios.com
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_idweb_inventory')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Inventory');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
