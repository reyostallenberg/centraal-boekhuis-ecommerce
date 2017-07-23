<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * The Publisher.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
class Publisher
{
    private $identifier;
    private $name;
    private $financial;
    private $depositTransferCardInfo;

    public function __construct($name, $identifier, $text = null, array $additionalTexts = [])
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->texts = [substr($text, 0, 39)];
        if (is_null($text)) {
            $this->texts = [substr($name, 0, 39)];
        }
        foreach (array_slice($additionalTexts, 0, 9) as $additionalText) {
            $this->texts[] = substr($additionalText, 0, 39);
        }
    }

    public function setFinancial($IBAN, $BIC = 'B')
    {
        if (strlen($BIC) == 1) {
            $this->financial = array_filter([
                'publisher_iban' => substr($IBAN, 0, 18),
                'publisher_bank_type' => substr($BIC, 0, 1),
            ]);
        } else {
            $this->financial = array_filter([
                'publisher_iban' => substr($IBAN, 0, 18),
                'publisher_bic' => substr($BIC, 0, 11),
            ]);
        }
    }

    public function setDepositTransferCardInfo($address, $postalcode, $city, $name = null, $shortName = null)
    {
        if (is_null($name)) {
            $name = $this->name;
        }
        if (is_null($shortName)) {
            $shortName = $name;
        }

        $this->depositTransferCardInfo = [
            'name' => substr($name, 0, 55),
            'shortname' => substr($shortName, 0, 23),
            'address' => substr($address, 0, 22),
            'postalcode' => substr($postalcode, 0, 7),
            'city' => substr($city, 0, 23),
        ];
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getName()
    {
        return $this->name;
    }

    public function toArray()
    {
        $data = [];

        foreach ($this->depositTransferCardInfo as $key => $value) {
            $data['deposit_transfer_card_'.$key] = $value;
        }
        foreach ($this->financial as $key => $value) {
            $data[$key] = $value;
        }
        foreach ($this->texts as $index => $value) {
            $data['text_'.($index + 1)] = $value;
        }

        return $data;
    }
}
