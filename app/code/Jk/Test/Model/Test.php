<?php
namespace Jk\Test\Model;

class Test extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Jk\Test\Model\Resource\Test');
    }
}
?>