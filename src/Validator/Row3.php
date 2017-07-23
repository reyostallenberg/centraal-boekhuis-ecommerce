<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType TransactionParty.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row3 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        if ($this->data['0009'] == 'AFN') {
            return ['0009', '0010', '0011', '0141'];
        } elseif ($this->data['0009'] == 'ONTV' || $this->data['0009'] == 'OFA') {
            return ['0009', '0010', '0011', '0013', '0121', '0122', '0124', '0125'];
        }

        return [];
    }

    /**
     * Get the required fields for this row when value in other field.
     *
     * @return array
     */
    public function getConditionalRequiredFields()
    {
        if ($this->data['0009'] == 'AFN') {
            return [
                '0135' => [
                    '0419' => 'J',
                ],
                '0139' => [
                    '0419' => 'J',
                ],
                '0150' => [
                    '0419' => 'J',
                ],
                '0151' => [
                    '0419' => 'J',
                ],
                '0152' => [
                    '0419' => 'J',
                ],
                '0153' => [
                    '0419' => 'J',
                ],
                '0154' => [
                    '0419' => 'J',
                ],
            ];
        } elseif ($this->data['0009'] == 'ONTV' || $this->data['0009'] == 'OFA') {
            return [
                '0135' => [
                    '0419' => 'J',
                ],
                '0139' => [
                    '0419' => 'J',
                ],
            ];
        }

        return [];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        $constraints = [
            '0009' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0009', '3'),
                ]),
                new Choice([
                    'choices' => ['AFN', 'ONTV', 'OFA'],
                    'message' => $this->getStandardChoicesMessage('0009', '3'),
                ]),
            ],
            '0010' => [
                new Length([
                    'max' => 7,
                    'maxMessage' => $this->getStandardMaxMessage('0010', '3'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0010', '3', 'numeric'),
                ]),
            ],
            '0012' => [
                new Length([
                    'max' => 2,
                    'maxMessage' => $this->getStandardMaxMessage('0012', '3'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0012', '3', 'numeric'),
                ]),
            ],
            '0013' => [
                new Length([
                    'max' => 55,
                    'maxMessage' => $this->getStandardMaxMessage('0013', '3'),
                ]),
            ],
            '0014' => [
                new Length([
                    'max' => 55,
                    'maxMessage' => $this->getStandardMaxMessage('0014', '3'),
                ]),
            ],
            '0121' => [
                new Length([
                    'max' => 43,
                    'maxMessage' => $this->getStandardMaxMessage('0121', '3'),
                ]),
            ],
            '0122' => [
                new Length([
                    'max' => 6,
                    'maxMessage' => $this->getStandardMaxMessage('0122', '3'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0122', '3', 'numeric'),
                ]),
            ],
            '0123' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0123', '3'),
                ]),
            ],
            '0124' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0124', '3'),
                ]),
            ],
            '0125' => [
                new Length([
                    'max' => 40,
                    'maxMessage' => $this->getStandardMaxMessage('0125', '3'),
                ]),
            ],
            '0126' => [
                new Length([
                    'max' => 40,
                    'maxMessage' => $this->getStandardMaxMessage('0126', '3'),
                ]),
            ],
            '0127' => [
                new Length([
                    'max' => 2,
                    'maxMessage' => $this->getStandardMaxMessage('0127', '3'),
                ]),
            ],
            '0135' => [
                new Length([
                    'max' => 18,
                    'maxMessage' => $this->getStandardMaxMessage('0135', '3'),
                ]),
            ],
            '0137' => [
                new Length([
                    'max' => 24,
                    'maxMessage' => $this->getStandardMaxMessage('0137', '3'),
                ]),
            ],
            '0139' => [
                new Length([
                    'max' => 11,
                    'maxMessage' => $this->getStandardMaxMessage('0139', '3'),
                ]),
            ],
            '0150' => [
                new Length([
                    'max' => 55,
                    'maxMessage' => $this->getStandardMaxMessage('0150', '3'),
                ]),
            ],
            '0151' => [
                new Length([
                    'max' => 23,
                    'maxMessage' => $this->getStandardMaxMessage('0151', '3'),
                ]),
            ],
            '0152' => [
                new Length([
                    'max' => 22,
                    'maxMessage' => $this->getStandardMaxMessage('0152', '3'),
                ]),
            ],
            '0153' => [
                new Length([
                    'max' => 7,
                    'maxMessage' => $this->getStandardMaxMessage('0153', '3'),
                ]),
            ],
            '0154' => [
                new Length([
                    'max' => 23,
                    'maxMessage' => $this->getStandardMaxMessage('0154', '3'),
                ]),
            ],
        ];
        foreach (['0141', '0142', '0143', '0144', '0145', '0146', '0147', '0148', '0149'] as $field) {
            $constraints[$field] = [
                new Length([
                    'max' => 39,
                    'maxMessage' => $this->getStandardMaxMessage($field, '3'),
                ]),
            ];
        }

        if ($this->data['0009'] == 'AFN') {
            $constraints['0011'] = [
                new Length([
                    'max' => 2,
                    'maxMessage' => $this->getStandardMaxMessage('0011', '3'),
                ]),
                new EqualTo([
                    'value' => 'CB',
                    'message' => 'The value ({{ value }}) of field #0011 in row 3 should be {{ compared_value }}',
                ]),
            ];
        } elseif ($this->data['0009'] == 'ONTV' || $this->data['0009'] == 'OFA') {
            $constraints['0011'] = [
                new Length([
                    'max' => 3,
                    'maxMessage' => $this->getStandardMaxMessage('0011', '3'),
                ]),
                new EqualTo([
                    'value' => 'OWN',
                    'message' => 'The value ({{ value }}) of field #0011 in row 3 should be {{ compared_value }}',
                ]),
            ];
        }

        return $constraints;
    }
}
