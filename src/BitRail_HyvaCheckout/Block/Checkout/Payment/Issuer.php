<?php

declare(strict_types=1);

namespace BitRail\HyvaCheckout\Block\Checkout\Payment;

use Magento\Framework\View\Element\Template;

class Issuer extends Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getTemplate(): string
    {
        return 'BitRail_HyvaCheckout::component/payment/method/issuer/bitrail.phtml';
    }
}