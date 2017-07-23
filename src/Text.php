<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * Texts.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
class Text
{
    const HEADER = 'KPR';
    const PAYMENT_NOTE = 'BOM';
    const PAYMENT_CONDITION = 'BVW';
    const PAYMENT_MARKETING = 'MRK';

    private $texts;
    private $type;

    public function __construct(array $texts, $type)
    {
        $this->texts = $texts;
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTexts()
    {
        return $this->texts;
    }
}
