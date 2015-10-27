<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/20/15
 * Time: 6:51 PM
 */
namespace Ktpl\Test\Model\Config;
class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     * @throws \InvalidArgumentException
     */
    public function convert($source)
    {
        $output = [];
        /** @var $optionNode \DOMNode */
        foreach ($source->getElementsByTagName('mynode') as $node) {
            $output[] = $node->textContent;
        }
        return $output;
    }
}