<?php
namespace Ktpl\Testimonial\Model\System\Config\Source;

class Testimonialmode implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'list', 'label' => __('List')],
            ['value' => 'grid', 'label' => __('Grid')],
        ];
    }
}
