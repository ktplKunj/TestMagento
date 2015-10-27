<?php
namespace Ktpl\Slider\Model;

class Slider extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Slider\Model\Resource\Slider');
    }
}
?>