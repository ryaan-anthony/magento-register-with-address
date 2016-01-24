<?php

class Ryaan_RegisterAddress_Model_Observer
{
    /**
     * @var Ryaan_RegisterAddress_Helper_Config
     */
    protected $config;

    /**
     * Initialize the class
     * @param array
     */
    public function __construct(array $args = [])
    {
        list($this->config) = $this->checkTypes(
            $this->nullCoalesce($args, 'config', Mage::helper('registeraddress/config'))
        );
    }

    /**
     * Return the value at field in array if it exists. Otherwise, use the
     * default value.
     * @param  array
     * @param  string|int
     * @param  mixed
     * @return mixed
     */
    protected function nullCoalesce(array $arr, $field, $default)
    {
        return isset($arr[$field]) ? $arr[$field] : $default;
    }

    /**
     * Validate constructor parameters.
     * @param Ryaan_RegisterAddress_Helper_Config
     * @return array
     */
    protected function checkTypes(
        Ryaan_RegisterAddress_Helper_Config $config
    ) {
        return func_get_args();
    }

    /**
     * @param Varien_Event_Observer
     */
    public function registerWithAddress(Varien_Event_Observer $observer)
    {
        if ($this->config->isAddressRequired()) {

            $event = $observer->getEvent();

            /** @var Mage_Core_Model_Layout $layout */
            $layout = $event->getLayout();

            /** @var Mage_Core_Controller_Varien_Action $controllerAction */
            $controllerAction = $event->getAction();

            if ($controllerAction->getFullActionName() == 'customer_account_create') {

                $this->showAddressFields($layout);
            }

        }
    }

    /**
     * @param Mage_Core_Model_Layout
     */
    protected function showAddressFields(Mage_Core_Model_Layout $layout)
    {
        $registerForm = $layout->getBlock('customer_form_register');

        if($registerForm instanceof Mage_Core_Block_Abstract) {

            $registerForm->setShowAddressFields(true);

        }
    }

}
