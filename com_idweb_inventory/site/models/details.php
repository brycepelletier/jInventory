<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
jimport('joomla.factory');
jimport('joomla.utilities.xmlelement');
 
/**
 * Inventory Model
 */
class InventoryModeldetails extends JModelItem {
	/**
	* @var obj item
	*/
    protected $item;

	public function getInventoryItem(){
        $inventoryModel = JModelLegacy::getInstance( 'inventory', 'InventoryModel' );
        $inventory = $inventoryModel->getFullInventory();
        $itemId = JFactory::getApplication()->input->get('itemId', '', 'filter');
        foreach ($inventory as $item) {
        	if(strcasecmp($itemId, $item->numb) == 0){
        		$this->item = $item;
        		break;
        	}
        }
        return $this->item;
	}
}