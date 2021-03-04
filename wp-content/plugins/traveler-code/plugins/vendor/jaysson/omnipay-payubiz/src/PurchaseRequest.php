<?php

namespace Omnipay\PayUBiz;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://secure.payu.in/_payment';
    protected $testEndpoint = 'https://test.payu.in/_payment';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $data = [];
        $data['key'] = $this->getParameter('key');
        $data['txnid'] = $this->getTransactionId();
        $data['amount'] = $this->getAmount();
        $data['productinfo'] = $this->getParameter('product');
        $data['firstname'] = $this->getParameter('firstName') ?: $this->getParameter('name');
        $data['hash'] = $this->getHash();
        $data['lastname'] = $this->getParameter('lastName');
        $data['email'] = $this->getParameter('email');
        $data['curl'] = $this->getCancelUrl();
        $data['furl'] = $this->getParameter('failureUrl');
        $data['surl'] = $this->getReturnUrl();
        return $data;
    }

    public function setSalt($salt)
    {
        $this->setParameter('salt', $salt);
    }

    public function setKey($merchantId)
    {
        $this->setParameter('key', $merchantId);
    }

    public function setName($name)
    {
        $this->setParameter('name', $name);
    }

    public function setProduct($productInfo)
    {
        $this->setParameter('product', $productInfo);
    }

    public function setFirstName($name)
    {
        $this->setParameter('first_name', $name);
    }

    public function setLastName($name)
    {
        $this->setParameter('last_name', $name);
    }

    public function setEmail($email)
    {
        $this->setParameter('email', $email);
    }

    public function setFailureUrl($furl)
    {
        $this->setParameter('failureUrl', $furl);
    }

    public function setUdf($index, $value)
    {
        if ($index <= 10 && $index > 0) {
            $this->setParameter('udf' . $index, $value);
        }
    }

    public function getUdf()
    {
        return array_map(function ($index) {
            return $this->getParameter('udf' . $index);
        }, range(1, 10));
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getEndPoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    private function getHash()
    {
        $values = $this->gatewayParams();
        $string = join('|', $values);
        return strtolower(hash('sha512', $string));
    }

    /**
     * @return array
     */
    private function gatewayParams()
    {
        $payUParams = array_map(function ($item) {
            return $this->getParameter($item);
        }, ['key', 'transactionId', 'amount', 'product']);
        $additional = [
            $this->getParameter('firstName') ?: $this->getParameter('name'),
            $this->getParameter('email')
        ];
        $udf = $this->getUdf();
        $values = array_merge($payUParams, $additional, $udf);
        $values[] = $this->getParameter('salt');
        return $values;
    }
}