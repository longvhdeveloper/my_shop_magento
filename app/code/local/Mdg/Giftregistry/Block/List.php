<?php
class Mdg_Giftregistry_Block_List extends Mage_Core_Block_Template
{
    protected $collection = null;
    public function getCustomerRegistries()
    {
        if (!is_null($this->collection)) {
            return $this->collection;
        } else {
            $collection = null;
            $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
            if ($currentCustomer) {
                $collection = Mage::getModel('mdg_giftregistry/entity')->getCollection()->addFieldToFilter(
                    'customer_id',
                    $currentCustomer->getId()
                );
            }
        }
    }

    public function setCustomerRegistries($collection) {
        if (!empty($collection)) {
            $this->collection = $collection;
        }
    }
}