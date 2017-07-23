<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType CustomerOperation.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row6 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0477', '0478'];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        return [
            '0477' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0477', '6'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0477', '6', 'numeric'),
                ]),
            ],
            '0478' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0478', '6'),
                ]),
                new EqualTo([
                    'value' => '1',
                    'message' => 'The value ({{ value }}) of field #0478 in row 6 should be {{ compared_value }}',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0478', '6', 'numeric'),
                ]),
            ],
        ];
    }
}
