<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType InvolvedParty.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class InvolvedParty extends AbstractRecordType implements RecordTypeInterface
{
    /**
     * Sender is the InvolvedParty.
     */
    const SENDER = 'AFZ';

    /**
     * Reciever is the InvolvedParty.
     */
    const RECEIVER = 'ONTV';

    /**
     * The code of this row.
     *
     * @var int
     */
    protected $code = 1;

    /**
     * The type of involved party.
     *
     * @var string
     */
    private $type;

    /**
     * The id of involved party.
     *
     * @var string
     */
    private $identifier;

    /**
     * The name of involved party.
     *
     * @var string
     */
    private $name;

    /**
     * Create an new InvolvedParty record.
     *
     * @param string $identifier
     * @param string $name
     * @param string $type
     */
    public function __construct($identifier, $name, $type)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the data for the InvolvedParty.
     *
     * @return string
     */
    public function getData()
    {
        return sprintf('#0001%s#0009%s#0010%s#0011%s',
            $this->code,
            $this->type,
            $this->identifier,
            $this->name
        );
    }
}
