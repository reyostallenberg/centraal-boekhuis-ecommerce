<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * Description of Product.
 *
 * @author reyo
 */
class Product
{
    private $ean;
    private $amount;
    private $price;
    private $keepOrderUntillAllAvailable = false;
    private $allowPartialDelivery = false;

    public function __construct($ean, $amount = 1, $price = null)
    {
        $this->ean = $ean;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function setKeepOrderUntillAllAvailable($keepOrderUntillAllAvailable)
    {
        $this->keepOrderUntillAllAvailable = (bool) $keepOrderUntillAllAvailable;

        return $this;
    }

    public function setAllowPartialDelivery($allowPartialDelivery)
    {
        $this->allowPartialDelivery = (bool) $allowPartialDelivery;

        return $this;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function keepOrderUntillAllAvailable()
    {
        return $this->keepOrderUntillAllAvailable;
    }

    public function allowPartialDelivery()
    {
        return $this->allowPartialDelivery;
    }
}
