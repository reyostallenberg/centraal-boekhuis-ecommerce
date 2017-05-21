<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType basics.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
abstract class AbstractRecordType
{
    public function getCode()
    {
        return $this->code;
    }
}
