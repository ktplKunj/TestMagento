<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/20/15
 * Time: 6:58 PM
 */
/**
 * Product controller.
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Ktpl\Test\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute() {
        $testConfig = $this->_objectManager->get('Ktpl\Test\Model\Config\ConfigInterface');
        $myNodeInfo = $testConfig->getMyNodeInfo();
        if (is_array($myNodeInfo)) {
            foreach($myNodeInfo as $str) {
                $this->getResponse()->appendBody($str . "<BR>");
            }
        }
    }
}