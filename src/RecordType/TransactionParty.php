<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType TransactionParty.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class TransactionParty extends AbstractRecordType implements RecordTypeInterface
{
    const PUBLISHER = 'AFN';
    const CUSTOMER = 'ONTV';
    const BILLING_ADDRESS = 'OFA';

    protected $code = 3;
    private $type;
    private $identifier;
    private $name;
    const TEMPLATES = [
        'CB' => [
            '0135' => 'publisher_iban',
            '0139' => 'publisher_bic',
            '0136' => 'publisher_bank_type',
            '0141' => 'text_1',
            '0142' => 'text_2',
            '0143' => 'text_3',
            '0144' => 'text_4',
            '0145' => 'text_5',
            '0146' => 'text_6',
            '0147' => 'text_7',
            '0148' => 'text_8',
            '0149' => 'text_9',
            '0150' => 'deposit_transfer_card_name',
            '0151' => 'deposit_transfer_card_shortname',
            '0152' => 'deposit_transfer_card_address',
            '0153' => 'deposit_transfer_card_postalcode',
            '0154' => 'deposit_transfer_card_city',
        ],
        'OWN' => [
            '0013' => 'name',
            '0014' => 'attn',
            '0121' => 'street',
            '0122' => 'housenumber',
            '0123' => 'housenumberAddition',
            '0124' => 'postalcode',
            '0125' => 'city',
            '0126' => 'province',
            '0127' => 'country',
        ],
    ];

    public function __construct($type, $data, $name = 'OWN')
    {
        $this->type = $type;
        $this->data = $data;
        $this->name = $name;
        $this->identifier = $data->getIdentifier();
    }

    public function getData()
    {
        $row = sprintf('#0001%s#0009%s#0010%s#0011%s',
            $this->code,
            $this->type,
            $this->identifier,
            $this->name
        );

        $data = $this->data->toArray();
        $templates = static::TEMPLATES;
        foreach ($templates[$this->name] as $fieldIdentifier => $fieldName) {
            if (isset($data[$fieldName])) {
                $row .= sprintf('#%s%s', $fieldIdentifier, $data[$fieldName]);
            }
        }

        return $row;
    }
}
