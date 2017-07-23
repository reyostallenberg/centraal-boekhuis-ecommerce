<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * Interface for RecordType.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
interface RecordTypeInterface
{
    /**
     * Get the code for the row.
     *
     * @return int
     */
    public function getCode();

    /**
     * Get the data for the RecordType.
     *
     * @return string
     */
    public function getData();
}
