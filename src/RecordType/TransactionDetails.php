<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

use DateTime;

/**
 * RecordType TransactionDetails.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class TransactionDetails extends AbstractRecordType implements RecordTypeInterface
{
    /**
     * The code of this row.
     *
     * @var int
     */
    protected $code = 2;

    /**
     * The type of transaction.
     *
     * @var string
     */
    private $type = 'LNEIG';

    /**
     * The date of the transaction.
     *
     * @var DateTime
     */
    private $date;
    private $reference;
    private $customerReference;
    private $addPortoCosts;
    private $portoCosts;
    private $addDepositTransferCard;
    private $addPrices;
    private $paymentReference;
    private $addSeperateBill;

    public function __construct(DateTime $date, $reference = null, $customerReference = null, $addDepositTransferCard = false, $addPrices = false, $paymentReference, $addSeperateBill = false, $portoCosts = 0)
    {
        $this->date = $date;
        $this->reference = $reference;
        $this->customerReference = $customerReference;
        $this->addPortoCosts = $portoCosts > 0;
        $this->portoCosts = $portoCosts;
        $this->addDepositTransferCard = $addDepositTransferCard;
        $this->addPrices = $addPrices;
        $this->paymentReference = $paymentReference;
        $this->addSeperateBill = $addSeperateBill;
        $this->sendBillSeparate = $addSeperateBill;
    }

    /**
     * Get the data for the TransactionDetails.
     *
     * @return string
     */
    public function getData()
    {
        return sprintf('#0001%s#0400%s#0401%s%s#0404%s#0405%s#0417%s%s#0419%s#0420%s#0421%s#0427%s',
            $this->code,
            $this->type,
            $this->date->format('Ymd'),
            is_null($this->reference) ? '' : sprintf('#0403%s', $this->reference),
            $this->customerReference,
            $this->addSeperateBill ? 'J' : 'N',
            $this->addPortoCosts ? 'J' : 'N',
            $this->addPortoCosts ? sprintf('#0418%s', $this->portoCosts) : '',
            $this->addDepositTransferCard ? 'J' : 'N',
            $this->addPrices ? 'J' : 'N',
            $this->paymentReference,
            $this->sendBillSeparate ? 'J' : 'N'
        );
    }

    /**
     * Does this order need a separate bill.
     *
     * @return bool
     */
    public function needsSeparateBill()
    {
        return $this->separateBill;
    }
}
