<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Paypal\Model\Payflow\Service\Response\Handler;

use Magento\Framework\Object;
use Magento\Payment\Model\InfoInterface;
use Magento\Paypal\Model\Info;

class CreditCardValidationHandler implements HandlerInterface
{
    /**
     * @var array
     */
    private $fieldsToHandle = [
        Info::PAYPAL_CVV2MATCH,
        Info::PAYPAL_AVSZIP,
        Info::PAYPAL_AVSADDR,
        Info::PAYPAL_IAVS
    ];

    /**
     * @var Info
     */
    private $paypalInfoManager;

    /**
     * @param Info $paypalInfoManager
     */
    public function __construct(Info $paypalInfoManager)
    {
        $this->paypalInfoManager = $paypalInfoManager;
    }

    /**
     * {inheritdoc}
     */
    public function handle(InfoInterface $payment, Object $response)
    {
        $importObject = [];
        foreach ($this->fieldsToHandle as $field) {
            if ($response->getData($field)) {
                $importObject[$field] = $response->getData($field);
            }
        }

        $this->paypalInfoManager->importToPayment($importObject, $payment);
    }
}
