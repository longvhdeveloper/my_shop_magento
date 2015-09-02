<?php
class Mdg_Giftregistry_IndexController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
            $this->setFlag('',self::FLAG_NO_DISPATCH, true);
        }
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function deleteAction()
    {
        try {
            $registryId = $this->getRequest()->getParam('registry_id');
            $registry = Mage::getModel('mdg_giftregistry/entity')->load($registryId);
            if ($registry) {
                $registry->delete();
                $successMessge = Mage::helper('mdg_giftregistry')->__('Gift registry has been successfully deleted');
                Mage::getSingleton('core/session')->addSuccess($successMessge);
            } else {
                throw new Exception('There was problem deleting the registry');
            }
        } catch (Mage_Core_Exception $e) {
            //set flash message
            Mage::getSingleton('core/session')->addError($e->getMessage());

            //redirect
            $this->_redirect('*/*/');
        }

        $this->_redirect('*/*/');
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function newPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('mdg_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($this->getRequest()->isPost() && !empty($data)) {
                $registry->updateRegistryData($customer, $data);
                $registry->save();
                $successMessage = Mage::helper('mdg_giftregistry')->__('Registry Successfully Created');
                //set flash message
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else {
                throw new Exception('Insufficient Data provided');
            }
        } catch (Mage_Core_Exception $e) {
            //set flag message
            Mage::getSingleton('core/session')->addError($e->getMessage());

            //redirect to current module/controller
            $this->_redirect('*/*/');
        }
        $this->_redirect('*/*/');
    }

    public function editPostAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $registry = Mage::getModel('mdg_giftregistry/entity');
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if ($this->getRequest()->isPost() && !empty($data)) {
                //check registry is exist
                $registry->load($data['registry_id']);
                if ($registry) {
                    $registry->updateRegistryData($customer, $data);
                    $registry->save();
                    $successMessage = Mage::helper('mdg_giftregistry')->__('Registry succcessfully saved');
                    //set flash message
                    Mage::getSingleton('core/session')->addSuccess($successMessage);
                } else {
                    throw new Exception('Invalid Data');
                }
            } else {
                throw new Exception('Insufficient Data provided');
            }
        } catch (Mage_Core_Exception $e) {
            //set flash message
            Mage::getSingleton('core/session')->addError($e->getMessage());

            //redirect
            $this->_redirect('*/*/');
        }
        return $this->_redirect('*/*/');
    }
}