<?php
namespace Jk\Test\Controller\Adminhtml\test;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
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
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Jk_Test::test');
        $resultPage->addBreadcrumb(__('Jk'), __('Jk'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage item'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage item'));

        return $resultPage;
    }
}
?>