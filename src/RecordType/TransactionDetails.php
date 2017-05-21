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
    protected $code = 2;
    private $type = 'LNEIG';
    private $date;
    private $reference;
    private $customerReference;
    private $addPortoCosts;
    private $addDepositTransferCard;
    private $addPrices;
    private $paymentReference;
    private $addSeperateBill;

    public function __construct(DateTime $date, $reference = null, $customerReference = null, $addDepositTransferCard = false, $addPrices = false, $paymentReference, $addSeperateBill = false)
    {
        $this->date = $date;
        $this->reference = $reference;
        $this->customerReference = $customerReference;
        $this->addPortoCosts = false;
        $this->addDepositTransferCard = $addDepositTransferCard;
        $this->addPrices = $addPrices;
        $this->paymentReference = $paymentReference;
        $this->addSeperateBill = $addSeperateBill;
        $this->sendBillSeparate = $addSeperateBill;
    }

    public function getData()
    {
        return sprintf('#0001%s#0400%s#0401%s%s#0404%s#0405%s#0417%s#0419%s#0420%s#0421%s#0427%s',
            $this->code,
            $this->type,
            $this->date->format('Ymd'),
            is_null($this->reference) ? '' : sprintf('#0403%s', $this->reference),
            $this->customerReference,
            $this->addSeperateBill ? 'J' : 'N',
            $this->addPortoCosts ? 'J' : 'N',
            $this->addDepositTransferCard ? 'J' : 'N',
            $this->addPrices ? 'J' : 'N',
            $this->paymentReference,
            $this->sendBillSeparate ? 'J' : 'N'
        );
    }

    public function needsSeparateBill()
    {
        return $this->separateBill;
    }
}
