<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

use Reyostallenberg\CentraalBoekhuisEcommerce\Product as OrderProduct;

/**
 * RecordType Product.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Product extends AbstractRecordType implements RecordTypeInterface
{
    protected $code = 4;

    private $product;

    /**
     * The reference to the product.
     *
     * @var array
     */
    private $reference;

    public function __construct(OrderProduct $product, $reference)
    {
        $this->product = $product;
        $this->reference = $reference;
    }

    /**
     * Get the data for the Product.
     *
     * @return string
     */
    public function getData()
    {
        $data = sprintf('#0001%s#0200%s#0430%s#0434%s#0435%s#0440%s',
            $this->code,
            $this->product->getEan(),
            $this->product->getAmount(),
            $this->product->keepOrderUntillAllAvailable() ? 'J' : 'N',
            $this->product->allowPartialDelivery() ? 'J' : 'N',
            $this->reference
        );

        if ($this->product->getPrice()) {
            $data .= '#0915'.number_format($this->product->getPrice(), 2, '.', '');
        }

        return $data;
    }
}
