<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType InvolvedParty.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class InvolvedParty extends AbstractRecordType implements RecordTypeInterface
{
    const SENDER = 'AFZ';
    const RECEIVER = 'ONTV';

    protected $code = 1;
    private $type;
    private $identifier;
    private $name;

    public function __construct($identifier, $name, $type)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->type = $type;
    }

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
