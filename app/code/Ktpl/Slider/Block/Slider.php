<?php
namespace Ktpl\Slider\Block;
class Slider extends \Magento\Framework\View\Element\Template
{
    protected $_filterProvider;
    protected $_sliderFactory;
    protected $_sliderData;
    protected $_b;

    public function __construct(

        \Magento\Backend\Block\Template\Context $context,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Ktpl\Slider\Model\sliderFactory $sliderFactory,
        array $data = [],
        Hello $hello
    ) {
        $this->_filterProvider = $filterProvider;
        $this->_sliderFactory = $sliderFactory;
        $this->_b=$hello;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getSlideData()
    {
        if(empty($this->_sliderData))
        {
            $this->_sliderData=$this->_sliderFactory->create()->getCollection()->addFieldToFilter('is_active',1)->getData();
        }
        return $this->_sliderData;
    }

    public function getCount()
    {
        return count($this->_sliderData);
    }

    public function getBData()
    {
        return $this->_b->getMyHelloData();
    }

    public function getContentHtml($content='')
    {
        $html = $this->_filterProvider->getPageFilter()->filter($content);
        return $html;
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
