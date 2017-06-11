<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

use ArrayIterator;
use ArrayObject;
use DateTime;

/**
 * Description of OrderContainer.
 *
 * @author reyo
 */
class Order
{
    private $identifier;
    private $date;
    private $reference;
    private $customer;
    private $billingAddress;
    private $paymentReference;
    private $addDepositTransferCard;
    private $addSeperateBill;
    private $addPrices;
    private $portoCosts = 0;

    /**
     * @var ArrayIterator
     */
    private $products;

    /**
     * @var ArrayObject
     */
    private $texts;

    public function __construct($identifier, DateTime $date, $reference = null)
    {
        if (is_null($reference)) {
            $reference = $identifier;
        }

        $this->identifier = $identifier;
        $this->date = $date;
        $this->reference = $reference;
        $this->products = new ArrayIterator();
        $this->texts = new ArrayObject();
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    public function addText(Text $text)
    {
        $this->texts[] = $text;

        return $this;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getTexts()
    {
        return $this->texts;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setBillingAddress(BillingAddress $billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    public function setPaymentReference($paymentReference)
    {
        $this->paymentReference = $paymentReference;

        return $this;
    }

    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    public function setAddDepositTransferCard($addDepositTransferCard)
    {
        $this->addDepositTransferCard = (bool) $addDepositTransferCard;

        return $this;
    }

    public function addDepositTransferCard()
    {
        return $this->addDepositTransferCard;
    }

    public function setAddSeperateBill($addSeperateBill)
    {
        $this->addSeperateBill = (bool) $addSeperateBill;

        return $this;
    }

    public function addSeperateBill()
    {
        return $this->addSeperateBill;
    }

    public function setAddPrices($addPrices)
    {
        $this->addPrices = (bool) $addPrices;

        return $this;
    }

    public function addPrices()
    {
        return $this->addPrices;
    }

    public function setPortoCosts($portocosts)
    {
        $this->portoCosts = $portocosts;

        return $this;
    }

    public function getPortoCosts()
    {
        return $this->portoCosts;
    }
}
