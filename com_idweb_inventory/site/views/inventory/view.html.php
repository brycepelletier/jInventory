<?php
/*------------------------------------------------------------------------
# view.html.php - idWeb Inventory Component
# ------------------------------------------------------------------------
# author    iDWeb Studios
# copyright Copyright (C) 2014. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.idwebstudios.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * inventory View
 */
class InventoryViewinventory extends JViewLegacy {
    /**
     * Inventory view display method
     * @return void
     */
    function display($tpl = null) {

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }

        // Assign data to the view   
        $this->form         = $this->get('Form'); 
        $this->inventory    = $this->get('Inventory');
        $this->action       = JRoute::_('index.php?option=com_idweb_inventory&task=inventory.process');
        $this->reset        = JRoute::_('index.php?option=com_idweb_inventory&task=inventory.reset');

        //Add scripts and styles
        JHtml::stylesheet(Juri::base() . 'components/com_idweb_inventory/media/css/inventory.css', array(), false);

        // Display the view
        parent::display($tpl);
    }
}

?>