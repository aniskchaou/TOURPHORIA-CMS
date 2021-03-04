<?php

namespace Omnipay\PayUBiz;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'PayUBiz';
    }

    public function setKey($key)
    {
        $this->setParameter('key', $key);
    }

    public function setSalt($salt)
    {
        $this->setParameter('salt', $salt);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PayUBiz\PurchaseRequest', $parameters);
    }

    public function getDefaultParameters()
    {
        return [
            'salt' => '',
            'key' => ''
        ];
    }
}