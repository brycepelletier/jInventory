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
class InventoryViewdetails extends JViewLegacy {
    /**
     * Inventory view display method
     * @return void
     */
    function display($tpl = null) {
        // Check for errors.
        if (count($errors = $this->get('Errors'))) 
        {
                JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
                return false;
        }

        // Assign data to the view 
        $this->uvs = $this->get('InventoryItem');
        $this->goBack = JRoute::_('index.php?option=com_idweb_inventory');

        //Add scripts and styles
        JHtml::script(Juri::base() . 'components/com_idweb_inventory/media/js/jquery.ad-gallery.js', true);
        JHtml::script(Juri::base() . 'components/com_idweb_inventory/media/js/jquery.fancybox.js', true);

        JHtml::stylesheet(Juri::base() . 'components/com_idweb_inventory/media/css/jquery.ad-gallery.css', array(), false);
        JHtml::stylesheet(Juri::base() . 'components/com_idweb_inventory/media/css/jquery.fancybox.css', array(), false);
        JHtml::stylesheet(Juri::base() . 'components/com_idweb_inventory/media/css/inventory.css', array(), false);

        // Display the view
        parent::display($tpl);
    }
}

?>