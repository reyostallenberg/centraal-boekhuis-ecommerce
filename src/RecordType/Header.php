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
    /**
     * The code of this row.
     *
     * @var int
     */
    protected $code = 0;

    /**
     * The type of message (defaults to OPDNAW).
     *
     * @var string
     */
    private $type = 'OPDNAW';

    /**
     * The version of the message (defaults to 0301).
     *
     * @var string
     */
    private $version = '0301';

    /**
     * The order date time.
     *
     * @var DateTime
     */
    private $orderDateTime;

    /**
     * The identifier of the message.
     *
     * @var string
     */
    private $identifier;

    /**
     * Should an acknowledgement be sent.
     *
     * @var bool
     */
    private $acknowledge = true;

    /**
     * Is this a debug message.
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Should the order be rejected on an error.
     *
     * @var bool
     */
    private $rejectOnError = true;

    /**
     * Create the header of the order.
     *
     * @param string   $identifier
     * @param DateTime $orderDateTime
     */
    public function __construct($identifier, DateTime $orderDateTime)
    {
        $this->identifier = $identifier;
        $this->orderDateTime = $orderDateTime;
    }

    /**
     * Get the data for the Header.
     *
     * @return string
     */
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
