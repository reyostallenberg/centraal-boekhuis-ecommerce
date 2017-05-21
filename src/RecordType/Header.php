<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

use DateTime;

/**
 * RecordType Header.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Header extends AbstractRecordType implements RecordTypeInterface
{
    protected $code = 0;
    private $type = 'OPDNAW';
    private $version = '0301';
    private $orderDateTime;
    private $identifier;
    private $acknowledge = true;
    private $debug = false;
    private $rejectOnError = true;

    public function __construct($identifier, DateTime $orderDateTime)
    {
        $this->identifier = $identifier;
        $this->orderDateTime = $orderDateTime;
    }

    public function getData()
    {
        return sprintf('#0001%s#0002%s#0003%s#0004%s#0005%s#0006%s#0007%s#0008%s#0026%s',
            $this->code,
            $this->type,
            $this->version,
            $this->orderDateTime->format('Ymd'),
            $this->orderDateTime->format('Hi'),
            $this->identifier,
            ($this->acknowledge == true) ? '1' : '0',
            ($this->debug == true) ? '1' : '0',
            ($this->rejectOnError == true) ? '1' : '0'
        );
    }
}
