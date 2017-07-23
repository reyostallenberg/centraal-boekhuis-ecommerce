<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType InvolvedParty.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row1 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0009', '0010', '0011'];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        return [
            '0009' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0009', '1'),
                ]),
                new Choice([
                    'choices' => ['AFZ', 'ONTV'],
                    'message' => $this->getStandardChoicesMessage('0009', '1'),
                ]),
            ],
            '0010' => [
                new Length([
                    'max' => 7,
                    'maxMessage' => $this->getStandardMaxMessage('0010', '1'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0010', '1', 'numeric'),
                ]),
            ],
            '0011' => [
                new Length([
                    'max' => 2,
                    'maxMessage' => $this->getStandardMaxMessage('0011', '1'),
                ]),
                new EqualTo([
                    'value' => 'CB',
                    'message' => 'The value ({{ value }}) of field #0011 in row 1 should be {{ compared_value }}',
                ]),
            ],
        ];
    }
}
