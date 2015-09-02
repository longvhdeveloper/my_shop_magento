<?php

class Mdg_Giftregistry_ViewController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $registryId = $this->getRequest()->getParam('registry_id');
        if (!empty($registryId)) {
            $entity= Mage::getModel('mdg_giftregistry/entity')->load($registryId);
            if ($entity) {
                //registry global entity variable
                Mage::register('loaded_registry', $entity);
                $this->loadLayout();
                $this->_initLayoutMessages('customer/session');
                $this->renderLayout();
            } else {
                $this->_forward('noroute');
            }
            return $this;
        }
    }
}