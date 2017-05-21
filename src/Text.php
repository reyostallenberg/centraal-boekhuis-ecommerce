<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reyostallenberg\CentraalBoekhuisEcommerce;

/**
 * Description of Text.
 *
 * @author reyo
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
