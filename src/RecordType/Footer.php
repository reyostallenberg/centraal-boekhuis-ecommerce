<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType Footer.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
class Footer extends AbstractRecordType implements RecordTypeInterface
{
    /**
     * The code of this row.
     *
     * @var int
     */
    protected $code = 9;
    private $totals;
    private $reference;

    public function __construct($reference, array $totals)
    {
        $this->reference = $reference;
        $this->totals = $totals;
    }

    /**
     * Get the data for the Footer.
     *
     * @return string
     */
    public function getData()
    {
        $totals = [
            '0015' => '2', // TransactionDetails
            '0016' => '3', // TransactionParty
            '0017' => '4', // Product
            '0018' => '5', // Text
            '0019' => '6', // CustomerOperation
        ];

        $totalData = '';
        foreach ($totals as  $key => $type) {
            $total = isset($this->totals[$type]) ? $this->totals[$type] : 0;
            $totalData .= sprintf('#%s%s', $key, $total);
        }

        return sprintf('#0001%s%s#0006%s',
            $this->code,
            $totalData,
            $this->reference
        );
    }
}
