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
class InventoryModelinventory extends JModelItem {
    /**
     * @var array inventory
     */
    protected $inventory;

    /**
     * @var array types
     */
    protected $types = array('MOTO' => array('A','C'), 'HYBR' => array('FC', 'HYBRID'), 'FTHW' => array('FW'), 'TOYH' => array('FWTH', 'TH'), 'TRAV' => array('TT'), 'USED' => '0'); //just set it to all

    /**
     * @var array years
     */
    protected $years;

    /**
     * @var array makes
     */
    protected $makes;

    /**
     * @var array models
     */
    protected $models;

    /**
     * Get the Inventory from the XML
     * @return an array of objects
     */
    public function getFullInventory() {        
        if(!isset($this->inventory) || empty($this->inventory)){
            $this->inventory = array();
            $xml = JFactory::getXML(JPATH_COMPONENT_ADMINISTRATOR.'/media/files/inventory.xml', true);
            if($xml){
                foreach($xml->uvs as $uvs){
                    $uvs->images = array();
                    for ($index=1; $index < 40; $index+=1){
                        $imageName = 'image';
                        if ($index > 1) {
                            $imageName .= (string)$index;
                        }
                        $image = trim($uvs->{$imageName});
                        if (isset($image) && !empty($image) ){
                            $uvs->images[] = $image;
                        }
                    }
                    $this->inventory[] = $uvs;
                }
            } else {
                JFactory::getApplication()->enqueueMessage(JText::_('XML file could not be parsed.'), 'error');  
            }
        }
        return $this->inventory;
    }

     public function getInventory(){
        $state = JFactory::getApplication()->getUserStateFromRequest('com_idweb_inventory.basic', 'basic', array(), 'array');
        $type = $year = $make = $model = '0';
        unset($stockId);
        $inventory = array();

        if (isset($state) && !empty($state) && count($state) > 0) {
            $type = $state['InventoryType'];
            $year = $state['InventoryYear'];
            $make = $state['InventoryMake'];
            $model = $state['InventoryModel'];
            $stockId = $state['InventorySearch'];
        }

        if (!isset($this->inventory) || empty($this->inventory)) {
            if(!isset($this->inventory) || empty($this->inventory)){
                $this->inventory = $this->getFullInventory();
            }
            foreach ($this->inventory as $item) {
                $typeMatch = $yearMatch = $makeMatch = $modelMatch = true;
                if($stockId != null && !empty($stockId)){
                    if( strcasecmp($stockId, strval($item->numb)) == 0) {
                        $inventory[] = $item;
                        break;
                    }
                } else {
                    if(strcasecmp($type, 'USED') == 0) {
                        if (strcasecmp($item->new, 'USED') !== 0) {
                            $typeMatch = false;
                        }
                    } else {
                        if($type !== '0' && !in_array($item->class, $this->types[$type])) {
                            $typeMatch = false;
                        }
                    }
                    if($year !== '0' && strcasecmp($year, $item->year) !== 0) {
                        $yearMatch = false;
                    }
                    if($make !== '0' && strcasecmp($make, $item->make) !== 0) {
                        $makeMatch = false;
                    }
                    if($model !== '0' && strcasecmp($model, $item->model) !== 0) {
                        $modelMatch = false;
                    }
                    if($typeMatch && $yearMatch && $makeMatch && $modelMatch){
                        $inventory[] = $item;                    
                    }
                }
            }
        }
        return $inventory;
    }

    public function getInventoryTypes() {
        return $this->types;
    }
    
    public function getInventoryYears() {
        if(!isset($this->years) || empty($this->years)){
            if(!isset($this->inventory) || empty($this->inventory)){
                $this->inventory = $this->getFullInventory();
            }
            $this->years = array();
            foreach($this->inventory as $uvs){
                unset($year);
                $year = trim($uvs->year);
                if(isset($year) && !empty($year)):
                    $this->years[(string)$year] = $year;                
                endif;
            }
            asort($this->years);
        }
        return $this->years;
    }

    public function getInventoryMakes() {
        if(!isset($this->makes) || empty($this->makes)){
            if(!isset($this->inventory) || empty($this->inventory)){
                $this->inventory = $this->getFullInventory();
            }
            $this->makes = array();
            foreach($this->inventory as $uvs){
                unset($make);
                $make = trim($uvs->make);
                if(isset($make) && !empty($make)):
                    $this->makes[(string)$make] = $make;                
                endif;
            }
            ksort($this->makes);
        }
        return $this->makes;
    }

    public function getInventoryModels() {
        if(!isset($this->models) || empty($this->models)){
            if(!isset($this->inventory) || empty($this->inventory)){
                $this->inventory = $this->getFullInventory();
            }
            $this->models = array();
            foreach($this->inventory as $uvs){
                unset($model);
                $model = trim($uvs->model);
                if(isset($model) && !empty($model)):
                    $this->models[(string)$model] = $model;                
                endif;
            }
            ksort($this->models);
        }
        return $this->models;
    }

    public function getForm($data = array(), $loadData = true) {
        jimport('joomla.form.form');
        $app = JFactory::getApplication();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        JForm::addFieldPath(JPATH_COMPONENT . '/models/fields');
        $form = JForm::getInstance('inventory_form', JPATH_COMPONENT_ADMINISTRATOR . '/models/forms/inventory_form.xml', array('load_data' => $loadData));
        if ($form == false) {
            $this->setError($form->getMessage());
            return false;
        }
        $data = $this->loadFormData();
        if (!empty($data)) {
            $form->bind($data);
        }
        return $form;
    }
    
    protected function loadFormData() {
        $data = JFactory::getApplication()->getUserStateFromRequest('com_idweb_inventory.basic', 'basic', array(), 'array');
        return $data;
    }

}