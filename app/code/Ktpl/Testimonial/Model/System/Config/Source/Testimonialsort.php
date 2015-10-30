<?php
namespace Ktpl\Testimonial\Model\System\Config\Source;

class Testimonialsort implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'firstname', 'label' => __('First Name')],
            ['value' => 'lastname', 'label' => __('Last Name')],
        ];
    }
}
