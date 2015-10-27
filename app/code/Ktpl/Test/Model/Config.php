<?php
namespace Ktpl\Test\Model;
class Config extends \Magento\Framework\Config\Data implements \Ktpl\Test\Model\Config\ConfigInterface
{
    public function __construct(
        \Ktpl\Test\Model\Config\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        $cacheId = 'ktpl_test_config'
    ) {
        parent::__construct($reader, $cache, $cacheId);
    }
    public function getMyNodeInfo() {
        return $this->get();
    }
}?>