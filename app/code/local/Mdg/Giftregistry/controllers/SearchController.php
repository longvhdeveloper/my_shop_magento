<?php

class Mdg_Giftregistry_SearchController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function resultsAction()
    {
        $this->loadLayout();

        //get params serach
        $searchParams = $this->getRequest()->getParam('search_params');
        if ($searchParams) {
            $results = Mage::getModel('mdg_giftregistry/entity')->getCollection();

            if (!empty($searchParams['type'])) {
                $results->addFieldToFilter('type_id', $searchParams['type']);
            }

            if (!empty($searchParams['date'])) {
                $results->addFieldToFilter('event_date', $searchParams['date']);
            }

            if (!empty($searchParams['location'])) {
                $results->addFieldToFilter('event_location', $searchParams['location']);
            }



            $this->getLayout()->getBlock('giftregistry.results')->setCustomerRegistries($results);
        }

        $this->renderLayout();
        return $this;
    }
}