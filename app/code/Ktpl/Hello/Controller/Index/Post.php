<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/29/15
 * Time: 7:02 PM
 */
namespace Ktpl\Hello\Controller\Index;

class Post extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }
        $model = $this->_objectManager->create('Ktpl\Hello\Model\Hello');
        $model->setData($post);
        try {
            $model->save();
            $this->messageManager->addSuccess(__('The item has been saved.'));
            $this->_redirect('*/*/hellolist');
            return;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the item.'));
        }
        $this->_redirect('*/*/');
        return;

    }
}
