<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * The customer.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
class Customer
{
    private $identifier;
    private $name;
    private $address;

    public function __construct($identifier, $name, Address $address)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->address = $address;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function toArray()
    {
        $data = $this->address->toArray();
        $data['name'] = $this->name;

        return $data;
    }
}
