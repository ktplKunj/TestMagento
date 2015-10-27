<?php
namespace Ktpl\Slider\Model\Resource\Slider;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Slider\Model\Slider', 'Ktpl\Slider\Model\Resource\Slider');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>