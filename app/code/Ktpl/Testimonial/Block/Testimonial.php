<?php

namespace Ktpl\Testimonial\Block;

use Magento\Store\Model\Store;

class Testimonial extends \Magento\Framework\View\Element\Template {

    protected $_testimonialFactory;

    public function _prepareLayout() {
        $this->pageConfig->getTitle()->set(__('Testimonial'));
        return parent::_prepareLayout();
    }

    public function __construct(\Magento\Backend\Block\Widget\Context $context,
        \Ktpl\Testimonial\Model\testimonialFactory $testimonialFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []) {
        $this->_testimonialFactory = $testimonialFactory;
        $this->_config = $config;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCollection() {
        $collection = $this->_testimonialFactory->create()->getCollection()->addFieldToFilter('status',1);
        return $collection;
    }

 public function getFormAction() {
      $baseurl=  $this->_config->getValue(Store::XML_PATH_UNSECURE_BASE_URL, 'default');
      return    $baseurl.'testimonial/index/save';
   }

   public function getCurrencyData(){
          $currencyData['code']=$this->_storeManager->getStore()->getCurrentCurrencyCode();
          $currencyData['rate']=$this->_storeManager->getStore()->getCurrentCurrencyRate();
        return  $currencyData; // $this->_storeManager->getStore()->getCurrentCurrencyCode();
   }



}
