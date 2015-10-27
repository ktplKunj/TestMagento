<?php
namespace Ktpl\Slider\Model\Resource;

class Slider extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('slider', 'slider_id');
    }
}
?>