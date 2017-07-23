<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType basics.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
abstract class AbstractRecordType
{
    /**
     * Get the code of the RecordType.
     *
     * @return type
     */
    public function getCode()
    {
        return $this->code;
    }
}
