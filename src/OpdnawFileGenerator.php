<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\Footer;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\Header;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\InvolvedParty;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\Product;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\RecordTypeInterface;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\Text as TextRecord;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\TransactionDetails;
use Reyostallenberg\CentraalBoekhuisEcommerce\RecordType\TransactionParty;
use RuntimeException;

/**
 * OpdnawFileGenerator.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class OpdnawFileGenerator
{
    const DEFAULT_RECEIVER_IDENTIFIER = 8894126;
    const DEFAULT_RECEIVER_NAME = 'CB';
    const DEFAULT_TRANSACTION_PARTY_NAME = 'CB';

    private $header;
    private $publisher;
    private $order;
    private $totals = [];

    public function __construct(Publisher $publisher, Order $order)
    {
        $this->publisher = $publisher;
        $this->order = $order;
    }

    // change order to most sensible, like sender first
    public function getFileHeader(Header $header = null, InvolvedParty $sender = null, InvolvedParty $receiver = null, TransactionDetails $transactionDetails = null)
    {
        if (is_null($header)) {
            $header = new Header($this->order->getIdentifier(), $this->order->getDate());
        }

        if (is_null($sender)) {
            $sender = new InvolvedParty($this->publisher->getIdentifier(), static::DEFAULT_RECEIVER_NAME, InvolvedParty::SENDER);
        }

        if (is_null($receiver)) {
            $receiver = new InvolvedParty(static::DEFAULT_RECEIVER_IDENTIFIER, static::DEFAULT_RECEIVER_NAME, InvolvedParty::RECEIVER);
        }

        if (is_null($transactionDetails)) {
            $transactionDetails = new TransactionDetails(
                $this->order->getDate(),
                $this->order->getReference(),
                $this->order->getReference(),
                $this->order->addDepositTransferCard(),
                $this->order->addPrices(),
                $this->order->getPaymentReference(),
                $this->order->addSeperateBill(),
                $this->order->getPortoCosts()
            );
        }

        $data = [
            $header->getData(),
            $sender->getData(),
            $receiver->getData(),
            $transactionDetails->getData(),
        ];

        $this->addToTotals($header);
        $this->addToTotals($sender);
        $this->addToTotals($receiver);
        $this->addToTotals($transactionDetails);

        return $data;
    }

    // change order to most sensible, like billingAddress first
    public function getFileBody(array $products = [], TransactionParty $customer = null, TransactionParty $billingAddress = null, TransactionParty $publisher = null)
    {
        if (is_null($publisher)) {
            $publisher = new TransactionParty(TransactionParty::PUBLISHER, $this->publisher, static::DEFAULT_TRANSACTION_PARTY_NAME);
        }

        if (is_null($customer)) {
            $customer = new TransactionParty(TransactionParty::CUSTOMER, $this->order->getCustomer());
        }

        if (empty($products)) {
            $products = [];
            foreach ($this->order->getProducts() as $product) {
                $products[] = new Product($product, $this->order->getReference());
            }
        }

        if (is_null($billingAddress) && !is_null($this->order->getBillingAddress())) {
            $billingAddress = new TransactionParty(TransactionParty::BILLING_ADDRESS, $this->order->getBillingAddress());
        }

        $data = [
            $publisher->getData(),
            $customer->getData(),
        ];

        $this->addToTotals($publisher);
        $this->addToTotals($customer);

        if ($billingAddress instanceof TransactionParty) {
            $data[] = $billingAddress->getData();
            $this->addToTotals($billingAddress);
        }

        foreach ($products as $product) {
            $data[] = $product->getData();
            $this->addToTotals($product);
        }

        return $data;
    }

    public function getFileFreeText($texts = null)
    {
        if (is_null($texts)) {
            $texts = $this->order->getTexts();
        }

        $textTypes = [
            Text::HEADER,
            Text::PAYMENT_CONDITION,
            Text::PAYMENT_NOTE,
            Text::PAYMENT_MARKETING,
        ];

        $data = [];
        foreach ($textTypes as $type) {
            foreach ($texts as $text) {
                if ($text->getType() == $type) {
                    foreach ($text->getTexts() as $literalText) {
                        $textRecord = new TextRecord($literalText, $type);
                        $data[] = $textRecord->getData();
                        $this->addToTotals($textRecord);
                    }
                }
            }
        }

        return $data;
    }

    public function getFileFooter()
    {
        $footer = new Footer($this->order->getIdentifier(), $this->totals);

        return [
            $footer->getData(),
        ];
    }

    public function getFileData()
    {
        $this->totals = [];

        $data = array_merge(
            $this->getFileHeader(),
            $this->getFileBody(),
            $this->getFileFreeText(),
            $this->getFileFooter()
        );

        $this->validate($data);

        return $data;
    }

    private function addToTotals(RecordTypeInterface $record)
    {
        if (!isset($this->totals[$record->getCode()])) {
            $this->totals[$record->getCode()] = 0;
        }

        ++$this->totals[$record->getCode()];
    }

    /**
     * Validate the created message.
     *
     * @throws RuntimeException
     */
    private function validate(array $data)
    {
        foreach ($data as $row) {
            $rowData = explode('#', ltrim($row, '#'));
            $rowDataParsed = [];
            foreach ($rowData as $rowFieldRaw) {
                $rowDataParsed[substr($rowFieldRaw, 0, 4)] = substr($rowFieldRaw, 4);
            }

            $validatorClass = sprintf(
                'Reyostallenberg\\CentraalBoekhuisEcommerce\\Validator\\Row%s',
                 array_shift($rowDataParsed)
            );

            $validator = new $validatorClass($rowDataParsed);
            $foundViolations = $validator->validate();

            foreach ($foundViolations as $violations) {
                if (0 !== count($violations)) {
                    foreach ($violations as $violation) {
                        throw new RuntimeException($violation->getMessage());
                    }
                }
            }
        }
    }
}
