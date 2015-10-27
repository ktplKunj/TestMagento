<?php
namespace Jk\Test\Model\Resource;

class Test extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('test', 'test_id');
    }
}
?>