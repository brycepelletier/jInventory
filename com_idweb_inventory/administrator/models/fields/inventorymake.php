<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * InventoryMake Form Field class for the iDWeb Inventory component
 */
class JFormFieldInventoryMake extends JFormFieldList {
        /**
         * The field type.
         *
         * @var string
         */
        protected $type = 'InventoryMake';
 
        /**
         * return the list input.
         *
         * @return      JHtml.
         */
        public function getInput() {
          $app = JFactory::getApplication();
          $state = $app->getUserState('com_idweb_inventory.basic', array());
          $selected = isset($state) && !empty($state) ? $state['InventoryMake'] : $this->value;
          $options = $this->getOptions();
          return JHtmlSelect::genericlist($options, $this->name, 'class="uk-form-width-1-1" onchange="this.form.submit()"', 'value', 'text', $selected, $this->id);
        }
 
        /**
         * Method to get a list of options for a list input.
         *
         * @return  array  An array of JHtml options.
         */
        public function getOptions() {
            $inventoryModel = JModelLegacy::getInstance( 'inventory', 'InventoryModel' );
            $makes = $inventoryModel->getInventoryMakes();
            $options = array();
            if ($makes) {
                    foreach($makes as $key => $value)  {
                            $options[] = JHtml::_('select.option', $key, JText::_($value));
                    }
            }
            $options = array_merge(parent::getOptions(), $options);
            return $options;
        }
}