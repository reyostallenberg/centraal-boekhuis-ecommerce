<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\RecordType;

/**
 * RecordType Text.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Text extends AbstractRecordType implements RecordTypeInterface
{
    protected $code = 5;
    private $text;
    private $type;

    public function __construct($text, $type)
    {
        $this->text = $text;
        $this->type = $type;
    }

    public function getData()
    {
        return sprintf('#0001%s#0475%s#0476%s',
            $this->code,
            $this->type,
            $this->text
        );
    }
}
