<?php
namespace Ktpl\Hello\Model\Resource;

class Hello extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('hello', 'hello_id');
    }
}
?>