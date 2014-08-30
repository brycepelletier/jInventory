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

        $this->addToolbar();
        // Display the view
        parent::display($tpl);
    }

    function addToolbar(){
        JFactory::getApplication()->input->set('hidemainmenu', false);

        $user       = JFactory::getUser();
        $userId     = $user->get('id');
        $isNew      = ($this->item->id == 0);
        $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

        JToolbarHelper::title(JText::_("COM_IDWEB_INVENTORY_CONFIGURATION"));

    }
}

?>