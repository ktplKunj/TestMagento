<?php
namespace Ktpl\Hello\Model\Resource\Hello;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Hello\Model\Hello', 'Ktpl\Hello\Model\Resource\Hello');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>