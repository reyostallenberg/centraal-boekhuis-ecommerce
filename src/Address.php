<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * The Address.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
class Address
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $attn;

    /**
     * @var array
     */
    private $address;

    public function __construct($street, $housenumber, $housenumberAddition = null, $postalcode, $city, $province = null, $attn = null, $country = 'NL')
    {
        $this->attn = substr($attn, 0, 55);
        $this->address = [
            'street' => substr($street, 0, 43),
            'housenumber' => (int) substr($housenumber, 0, 6),
            'housenumberAddition' => substr($housenumberAddition, 0, 10),
            'postalcode' => substr($postalcode, 0, 10),
            'city' => substr($city, 0, 40),
            'province' => substr($province, 0, 40),
            'country' => substr($country, 0, 2),
        ];
    }

    /**
     * The array representation of this object.
     *
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (!is_null($this->attn)) {
            $data['attn'] = $this->attn;
        }

        $optional = ['housenumberAddition', 'province'];
        foreach ($this->address as $key => $value) {
            if (empty($value) && in_array($key, $optional)) {
                continue;
            }
            $data[$key] = $value;
        }

        return $data;
    }
}
