<?php

namespace Ktpl\Testimonial\Block;

use Magento\Store\Model\Store;

class Tlist extends \Magento\Framework\View\Element\Template {

    protected $_testimonialFactory;
    protected $_testimonialSort;
    protected $_pageLimit = 2;


    public function __construct(\Magento\Backend\Block\Widget\Context $context,
     \Ktpl\Testimonial\Model\testimonialFactory $testimonialFactory, \Magento\Framework\App\Config\ScopeConfigInterface $config,
     \Ktpl\Testimonial\Model\System\Config\Source\Testimonialsort  $testimonialSort,
      array $data = []) {
        $this->_testimonialFactory = $testimonialFactory;
        $this->_config = $config;
        $this->_testimonialSort = $testimonialSort;
        parent::__construct($context, $data);

    }

     protected  function _construct()
    {
        parent::_construct();
        /** @var \Sample\News\Model\Resource\Author\Collection $authors */
        $collection = $this->_testimonialFactory->create()->getCollection()
        ->addFieldToFilter('status',1) ;
        $this->setTestimonial($collection);
    }

     public function _prepareLayout() {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager', 'testimonial.pager');
		$pager->setAvailableLimit([1 =>1, 10 => 10, 20 => 20, 50 => 50])->setLimit(1);
        $pager->setCollection($this->getTestimonial());
        $this->setChild('pager', $pager);
        $this->getTestimonial()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

     public function getCustomNav(){
          return  $collection = $this->_testimonialFactory->create()->getCollection()
        ->addFieldToFilter('status',1)->getSize();
    } 
}
