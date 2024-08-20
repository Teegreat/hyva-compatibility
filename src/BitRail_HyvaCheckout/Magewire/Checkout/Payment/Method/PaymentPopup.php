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

    public function triggerPayment(): void
    {
        // Call the GetInfo controller to retrieve payment info
        $quote = $this->sessionCheckout->getQuote();

        // Prepare the AJAX request to call the GetInfo controller
        $url = $this->getUrl('bitrail/order/getinfo');
        $nonceCode = 'your_nonce_code'; // Replace with your actual nonce code logic

        $response = $this->sendAjaxRequest($url, ['nonceCode' => $nonceCode]);

        if ($response['success']) {
            // Trigger the BitRail payment pop-up window using the retrieved information
            echo "<script>
                window.open('{$response['data']['paymentUrl']}', '_blank', 'width=800,height=600');
                </script>";
        } else {
            // Handle errors
            $this->dispatchErrorMessage($response['data']['message']);
        }
    }

    private function sendAjaxRequest(string $url, array $params): array
    {
        // You could use cURL or other methods to send an AJAX request here
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    private function dispatchErrorMessage(string $message): void
    {
        // Handle and display error messages in the Hyvä checkout
        echo "<script>alert('Error: {$message}');</script>";
    }
}