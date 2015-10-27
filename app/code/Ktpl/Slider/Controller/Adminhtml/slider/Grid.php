<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/10/15
 * Time: 3:55 PM
 */

namespace Ktpl\Slider\Controller\Adminhtml\Index;

class Grid extends Ktpl\Slider\Controller\Adminhtml\Index
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }



    /**
     * Slider grid action
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
