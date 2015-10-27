<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Test sidebar block
 */
namespace Jk\Test\Block;

class Sidebar extends \Magento\Framework\View\Element\Template
{
    /**
     * Retrieve block title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTitle()
    {
        return __('Jk Test');
    }
}
