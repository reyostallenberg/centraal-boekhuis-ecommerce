<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\tests;

use DateTime;
use GorHill\FineDiff\FineDiff;
use PHPUnit\Framework\TestCase;
use Reyostallenberg\CentraalBoekhuisEcommerce\Address;
use Reyostallenberg\CentraalBoekhuisEcommerce\BillingAddress;
use Reyostallenberg\CentraalBoekhuisEcommerce\Customer;
use Reyostallenberg\CentraalBoekhuisEcommerce\OpdnawFileGenerator;
use Reyostallenberg\CentraalBoekhuisEcommerce\Order;
use Reyostallenberg\CentraalBoekhuisEcommerce\Product;
use Reyostallenberg\CentraalBoekhuisEcommerce\Publisher;
use Reyostallenberg\CentraalBoekhuisEcommerce\Text;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Test the OpdnawFileGenerator class.
 *
 * @author reyo
 */
class OpdnawFileGeneratorTest extends TestCase
{
    public function testOpdnawFileGenerator()
    {
        $publisherId = 9898989;
        $publisher = new Publisher('CB', $publisherId, 'Krommestraat 70', [
            '3811 CD Amersfoort',
            'Tel. 033 - 46 50 831',
            'info@uitgeverijdeviant.nl',
            'KvK nr. 32.06.96.27',
            'Btw nr. NL999999999B01',
            'Rabobank 11.11.11.111',
            'IBAN NL99 RABO 9999 9999 99',
            'BIC RABONL2U',
        ]);
        $publisher->setFinancial('103122001', 'B');
        $publisher->setDepositTransferCardInfo('straat 70', '9999 ZZ', 'Plaats', 'Naam Webshop', 'webshop');

        $orderId = 131170838;
        $reference = 1028561;
        $paymentReference = 8000002013027101;
        $date = new DateTime('2013-01-31 17:08:38');
        $order = new Order($orderId, $date, $reference);

        $productA = new Product(9789085013400);
        $productA->setPrice(7.00);
        $order->addProduct($productA);

        $productB = new Product(9789073013820);
        $order->addProduct($productB);

        $productC = new Product(9789490013868);
        $order->addProduct($productC);

        $productD = new Product(9789050998165);
        $productD->setPrice(15.00);
        $order->addProduct($productD);

        $productE = new Product(9789013998578);
        $order->addProduct($productE);

        $textA = new Text([sprintf('Bestelnummer: %s, Factuurnummer: 20130271-1', $reference)], Text::HEADER);
        $order->addText($textA);

        $textB = new Text(['Betaalt u niet door middel van de aangehechte acceptgiro?', sprintf('Vermeld dan betalingskenmerk: %s', $paymentReference), 'Betaling binnen 14 dagen na factuurdatum.'], Text::PAYMENT_CONDITION);
        $order->addText($textB);

        $textD = new Text(['-', 'Bestelde artikelen worden niet retour genomen.', '-', 'Hartelijk dank voor uw bestelling'], Text::PAYMENT_MARKETING);
        $order->addText($textD);

        $customerAddress = new Address('straat', '6', '-a', '8888YY', 'PLAATS', null, 'T.a.v. consument', 'NL');
        $customer = new Customer(9999999, 'Naam Consument', $customerAddress);
        $order->setCustomer($customer);

        $billingAddressAddress = new Address('straat', '99', '4-hoog', '7777WW', 'PLAATS', null, 'T.a.v.Crediteurenadministratie', 'NL');
        $billingAddress = new BillingAddress(9999999, 'Naam Factuur ontvangerl', $billingAddressAddress);
        $order->setBillingAddress($billingAddress);
        $order->setPaymentReference($paymentReference);
        $order->setAddPrices(true);
        $order->setAddSeperateBill(true);
        $order->setAddDepositTransferCard(true);

        $generator = new OpdnawFileGenerator($publisher, $order);

        $styleDeleted = new OutputFormatterStyle('red');
        $styleInserted = new OutputFormatterStyle('green');
        $output = new ConsoleOutput();
        $output->getFormatter()->setStyle('del', $styleDeleted);
        $output->getFormatter()->setStyle('ins', $styleInserted);

        $output->writeln(['', '<info>Header</info>']);
        $headerExample = file_get_contents(__DIR__.'/Resources/header.opdnaw');
        $createdHeader = implode("\n", $generator->getFileHeader());
        $headerDiff = new FineDiff($headerExample, $createdHeader);
        foreach (explode("\n", $headerDiff->renderDiffToHTML()) as $row => $line) {
            $output->writeln($row.': '.$line);
        }

        $output->writeln(['', '<info>Body</info>']);
        $bodyExample = file_get_contents(__DIR__.'/Resources/body.opdnaw');
        $createdBody = implode("\n", $generator->getFileBody());
        $bodyDiff = new FineDiff($bodyExample, $createdBody);
        foreach (explode("\n", $bodyDiff->renderDiffToHTML()) as $row => $line) {
            $output->writeln($row.': '.$line);
        }

        $output->writeln(['', '<info>Freetext</info>']);
        $freeTextExample = file_get_contents(__DIR__.'/Resources/free-text.opdnaw');
        $createdFreeText = implode("\n", $generator->getFileFreeText());
        $freeTextDiff = new FineDiff($freeTextExample, $createdFreeText);
        foreach (explode("\n", $freeTextDiff->renderDiffToHTML()) as $row => $line) {
            $output->writeln($row.': '.$line);
        }

        $output->writeln(['', '<info>Footer</info>']);
        $footerExample = file_get_contents(__DIR__.'/Resources/footer.opdnaw');
        $createdFooter = implode("\n", $generator->getFileFooter());
        $footerDiff = new FineDiff($footerExample, $createdFooter);
        foreach (explode("\n", $footerDiff->renderDiffToHTML()) as $row => $line) {
            $output->writeln($row.': '.$line);
        }

        $output->writeln(['', '<info>File</info>']);
        $fileExample = $headerExample."\n".$bodyExample."\n".$freeTextExample."\n".$footerExample;
        $createdFile = implode("\n", $generator->getFileData());
        $fileDiff = new FineDiff($fileExample, $createdFile);
        foreach (explode("\n", $fileDiff->renderDiffToHTML()) as $row => $line) {
            $output->writeln($row.': '.$line);
        }

        $this->assertEquals($headerExample, $createdHeader);
        $this->assertEquals($bodyExample, $createdBody);
        $this->assertEquals($freeTextExample, $createdFreeText);
        $this->assertEquals($footerExample, $createdFooter);
        $this->assertEquals($fileExample, $createdFile);
    }
}
