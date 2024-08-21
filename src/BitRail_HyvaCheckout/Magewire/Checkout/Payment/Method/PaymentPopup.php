<?php

namespace BitRail\HyvaCheckout\Magewire\Checkout\Payment\Method;

use Magento\Checkout\Model\Session as SessionCheckout;
use Magento\Quote\Api\CartRepositoryInterface;
use Magewirephp\Magewire\Component\Form;

class PaymentPopup extends Form
{
    private SessionCheckout $sessionCheckout;
    private CartRepositoryInterface $quoteRepository;

    public function __construct(
        SessionCheckout $sessionCheckout,
        CartRepositoryInterface $quoteRepository
    ) {
        $this->sessionCheckout = $sessionCheckout;
        $this->quoteRepository = $quoteRepository;
    }

    public function mount(): void
    {
        // Initialize any required data here
    }

    private function generateNonceCode($quote): string
    {
        // Replace with your actual nonce code generation logic
        return md5('your_secret_nonce_code_logic_here');
    }
}