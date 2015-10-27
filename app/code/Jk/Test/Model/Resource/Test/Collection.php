<?php
namespace Jk\Test\Model\Resource\Test;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Jk\Test\Model\Test', 'Jk\Test\Model\Resource\Test');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>