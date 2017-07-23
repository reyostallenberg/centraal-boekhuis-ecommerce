<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\TypeValidator;

/**
 * Validator for RecordType TransactionDetails.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row2 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0400', '0401', '0404', '0417', '0419', '0420'];
    }

    /**
     * Get the required fields for this row when value in other field.
     *
     * @return array
     */
    public function getConditionalRequiredFields()
    {
        return [
            '0412' => [
                '0411' => 'L',
            ],
            '0413' => [
                '0411' => 'L',
            ],
            '0418' => [
                '0417' => 'J',
            ],
            '0421' => [
                '0419' => 'J',
            ],
        ];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        return [
            '0400' => [
                new Length([
                    'max' => 6,
                    'maxMessage' => $this->getStandardMaxMessage('0400', '2'),
                ]),
                new EqualTo([
                    'value' => 'LNEIG',
                    'message' => 'The value ({{ value }}) of field #0400 in row 2 should be {{ compared_value }}',
                ]),
            ],
            '0401' => [
                new Length([
                    'max' => 8,
                    'maxMessage' => $this->getStandardMaxMessage('0401', '2'),
                ]),
                new DateTime([
                    'format' => 'Ymd',
                    'message' => 'The value ({{ value }}) of field #0401 is not a valid date',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0401', '1', 'numeric'),
                ]),
            ],
            '0403' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0403', '2'),
                ]),
            ],
            '0404' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0404', '2'),
                ]),
            ],
            '0405' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0405', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0405', '2'),
                ]),
                new Callback(function ($value, $context) {
                    if ($value == 'J' && $this->data['0420'] != 'J') {
                       $context->buildViolation('The value of field 0405 in row 2 can only be J when the value of field 0420 is also J')->addViolation();
                    }
                }),
            ],
            '0411' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0411', '2'),
                ]),
                new Choice([
                    'choices' => ['D', 'N', 'L'],
                    'message' => $this->getStandardChoicesMessage('0411', '2'),
                ]),
            ],
            '0412' => [
                new Length([
                    'max' => 8,
                    'maxMessage' => $this->getStandardMaxMessage('0412', '2'),
                ]),
                new DateTime([
                    'format' => 'Ymd',
                    'message' => 'The value ({{ value }}) of field #0412 is not a valid date',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0412', '2', 'numeric'),
                ]),
            ],
            '0413' => [
                new Length([
                    'max' => 8,
                    'maxMessage' => $this->getStandardMaxMessage('0413', '2'),
                ]),
                new DateTime([
                    'format' => 'Ymd',
                    'message' => 'The value ({{ value }}) of field #0413 is not a valid date',
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0413', '2', 'numeric'),
                ]),
            ],
            '0417' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0417', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0417', '2'),
                ]),
            ],
            '0418' => [
                new Callback(function ($value, $context) {
                    if ($value != '') {
                        $validator = new TypeValidator();
                        $validator->initialize($context);
                        $validator->validate(
                            $value,
                            new Type([
                                'type' => 'numeric',
                                'message' => $this->getStandardTypeMessage('0413', '2', 'numeric'),
                            ])
                        );
                    }
                }),
            ],
            '0419' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0419', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0419', '2'),
                ]),
            ],
            '0420' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0420', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0420', '2'),
                ]),
            ],
            '0421' => [
                new Length([
                    'max' => 16,
                    'maxMessage' => $this->getStandardMaxMessage('0421', '2'),
                ]),
            ],
            '0426' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0426', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0426', '2'),
                ]),
            ],
            '0427' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0427', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0427', '2'),
                ]),
            ],
            '0115' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0115', '2'),
                ]),
                new Callback(function ($value, $context) {
                    if ($value !== strtoupper($value)) {
                        $context->buildViolation('The value of field 0115 in row 2 must be all uppercase')->addViolation();
                    }
                }),
            ],
            '0479' => [
                new Length([
                    'max' => 5,
                    'maxMessage' => $this->getStandardMaxMessage('0479', '2'),
                ]),
                new Choice([
                    'choices' => ['CBBEL', 'DPBEL'],
                    'message' => $this->getStandardChoicesMessage('0479', '2'),
                ]),
            ],
            '0480' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0480', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0480', '2'),
                ]),
            ],
            '0481' => [
                new Callback(function ($value, $context) {
                    if ($value != '') {
                        $validator = new TypeValidator();
                        $validator->initialize($context);
                        $validator->validate(
                            $value,
                            new Type([
                                'type' => 'numeric',
                                'message' => $this->getStandardTypeMessage('0481', '2', 'numeric'),
                            ])
                        );
                    }
                }),
            ],
            '0482' => [
                new Length([
                    'max' => 66,
                    'maxMessage' => $this->getStandardMaxMessage('0482', '2'),
                ]),
            ],
            '0483' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0483', '2'),
                ]),
            ],
            '0540' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0540', '2'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0540', '2'),
                ]),
            ],
        ];
    }
}
