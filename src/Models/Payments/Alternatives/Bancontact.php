<?php

namespace CheckoutCom\PrestaShop\Models\Payments\Alternatives;

use Checkout\Models\Payments\BancontactSource;

class Bancontact extends Alternative
{
    /**
     * Process payment.
     *
     * @param array $params The parameters
     *
     * @return Response ( description_of_the_return_value )
     */
    public static function pay(array $params)
    {
        $billing = new \Address((int) $this->context->cart->id_address_invoice);
        $source = new BancontactSource($params['name'], \Country::getIsoById($billing->id_country), \Configuration::get('PS_SHOP_NAME'));
        $payment = static::makePayment($source);

        return static::request($payment);
    }
}
