# BitRail Hyvä Checkout Compatibility Module

This module provides compatibility between the BitRail payment gateway and the Hyvä Checkout for Magento 2. Below is an overview of each file included in the module:

## Directory Structure

- **src/BitRail_HyvaCheckout/Block/Checkout/Payment/Payment.php**

  - **Purpose**: This block is responsible for rendering the payment form template (`form.phtml`) in the checkout.
  - **Key Method**:
    - `getTemplate()`: Returns the path to the `form.phtml` template.

- **src/BitRail_HyvaCheckout/etc/di.xml**

  - **Purpose**: Configures dependency injection for the module.
  - **Details**:
    - Registers the `PaymentPopup` component and injects the required dependencies (`sessionCheckout` and `quoteRepository`) necessary for its operation.

- **src/BitRail_HyvaCheckout/etc/module.xml**

  - **Purpose**: Registers the module and sets load order.
  - **Details**:
    - Ensures the `BitRail_HyvaCheckout` module is loaded after `BitRail_PaymentGateway`, `Hyva_CompatModuleFallback`, and `Hyva_Checkout` for proper dependency management.

- **src/BitRail_HyvaCheckout/etc/frontend/di.xml**

  - **Purpose**: Configures dependency injection for frontend-specific components.
  - **Details**:
    - Registers the `PaymentPopup` component within the frontend scope and injects the `checkoutSession` dependency to manage the user's checkout session effectively.

- **src/BitRail_HyvaCheckout/etc/frontend/events.xml**

  - **Purpose**: Registers an event observer for the module within the Hyvä Checkout context.
  - **Details**:
    - The `hyva_config_generate_before` event triggers the `BitRail\HyvaCheckout\Observer\HyvaConfigGenerateBefore\RegisterModuleForHyvaConfig` observer. This ensures the BitRail Hyvä Checkout module is properly registered during the Hyvä Checkout configuration generation process.

- **src/BitRail_HyvaCheckout/Observer/HyvaConfigGenerateBefore/RegisterModuleForHyvaConfig.php**

  - **Purpose**: Integrates the `BitRail_HyvaCheckout` module with Hyvä Checkout by registering it during the configuration generation process.
  - **Details**:
    - This observer listens to the `hyva_config_generate_before` event.
    - It retrieves the module's path using `ComponentRegistrar`.
    - The path is added to the Hyvä Checkout configuration's extensions, ensuring proper recognition and integration of the `BitRail_HyvaCheckout` module during the Hyvä Checkout setup.

- **src/BitRail_HyvaCheckout/Setup/Patch/Data/DisableIfCheckoutModuleIsNotInstalled.php**

  - **Purpose**: Prevents the module from causing dependency issues if required modules are not installed.
  - **Details**:
    - This patch checks if the `Hyva_Checkout` module is enabled. If it is not, the `BitRail_HyvaCheckout` module is disabled to avoid potential errors. This ensures that the module only runs when all necessary dependencies are present.

- **src/BitRail_HyvaCheckout/view/frontend/templates/payment/form.phtml**

  - **Purpose**: This template renders the BitRail payment method form on the checkout page.
  - **Details**: The form leverages Alpine.js to manage the display of the BitRail payment method option and the logic to handle the payment popup via the `orderPopup` function. This function makes an API call to retrieve necessary payment details and triggers the BitRail payment popup based on the response.

- **src/BitRail_HyvaCheckout/view/frontend/layout/hyva_checkout_components.xml**

  - **Purpose**: Configures the layout for the BitRail payment method in the Hyvä Checkout.
  - **Details**: Registers the `bitrial_gateway` payment method and associates it with the `form.phtml` template to display the payment option during checkout.

- **src/BitRail_HyvaCheckout/view/frontend/web/js/view/payment/bitrail_gateway.js**

  - **Purpose**: Provides the JavaScript logic required to handle the BitRail payment gateway integration, including initializing the payment popup.
  - **Details**: Defines the global `BitRail` object and its methods for processing payments.

- **src/BitRail_HyvaCheckout/view/frontend/web/js/view/payment/bitrail_vendor.js**

  - **Purpose**: Manages the interaction with the BitRail payment gateway.
  - **Details**: This script handles initializing the BitRail payment gateway, sending AJAX requests, and managing the payment flow. It listens for messages from the payment iframe and processes them accordingly. The script provides methods for managing payment orders, creating agreements, and handling cross-origin AJAX requests.

  - **src/BitRail_HyvaCheckout/registration.php**
  - **Purpose**: Registers the BitRail Hyvä Checkout module with Magento.
  - **Details**: This file is responsible for registering the `BitRail_HyvaCheckout` module in Magento's system. It uses the `ComponentRegistrar` class to define the module name and its location within the Magento directory structure.
