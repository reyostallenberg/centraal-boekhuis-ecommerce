<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType Header.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row0 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0002', '0003', '0004', '0005', '0006', '0007', '0008'];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        return [
            '0002' => [
                new Length([
                    'max' => 6,
                    'maxMessage' => $this->getStandardMaxMessage('0002', '0'),
                ]),
                new EqualTo([
                    'value' => 'OPDNAW',
                    'message' => 'The value ({{ value }}) of field #0002 in row 0 should be {{ compared_value }}',
                ]),
            ],
            '0003' => [
                new Length([
                    'max' => 6,
                    'maxMessage' => $this->getStandardMaxMessage('0003', '0'),
                ]),
                new EqualTo([
                    'value' => '0301',
                    'message' => 'The value ({{ value }}) of field #0003 in row 0 should be {{ compared_value }}',
                ]),
            ],
            '0004' => [
                new Length([
                    'max' => 8,
                    'maxMessage' => $this->getStandardMaxMessage('0004', '0'),
                ]),
                new DateTime([
                    'format' => 'Ymd',
                    'message' => 'The value ({{ value }}) of field #0004 is not a valid date',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0004', '0', 'numeric'),
                ]),
            ],
            '0005' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0005', '0'),
                ]),
                new DateTime([
                    'format' => 'Hi',
                    'message' => 'The value ({{ value }}) of field #0005 is not a valid date',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0005', '0', 'numeric'),
                ]),
            ],
            '0006' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0006', '0'),
                ]),
            ],
            '0007' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0007', '0'),
                ]),
                new Choice([
                    'choices' => ['0', '1'],
                    'message' => $this->getStandardBooleanMessage('0007', '0'),
                ]),
            ],
            '0008' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0008', '0'),
                ]),
                new Choice([
                    'choices' => ['0', '1'],
                    'message' => $this->getStandardBooleanMessage('0008', '0'),
                ]),
            ],
            '0026' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0026', '0'),
                ]),
                new Choice([
                    'choices' => ['0', '1'],
                    'message' => $this->getStandardBooleanMessage('0026', '0'),
                ]),
            ],
        ];
    }
}
