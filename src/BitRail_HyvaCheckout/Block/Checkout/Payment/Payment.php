<?php

declare(strict_types=1);

namespace BitRail\HyvaCheckout\Block\Checkout\Payment;

use Magento\Framework\View\Element\Template;

class Payment extends Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getTemplate(): string
    {
        return 'BitRail_HyvaCheckout::payment/form.phtml';
    }
}