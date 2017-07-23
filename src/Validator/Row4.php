<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Isbn;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType Product.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row4 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0200', '0430'];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        return [
            '0200' => [
                new Isbn([
                    'message' => 'The value {{ value }} is neither a valid ISBN-10 nor a valid ISBN-13 in field 0200 on row 4',
                ]),
            ],
            '0430' => [
                new Length([
                    'max' => 3,
                    'maxMessage' => $this->getStandardMaxMessage('0430', '4'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0430', '4', 'numeric'),
                ]),
            ],
            '0431' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0431', '4'),
                ]),
                new Choice([
                    'choices' => ['DIO', 'AANB'],
                    'message' => $this->getStandardChoicesMessage('0431', '4'),
                ]),
            ],
            '0433' => [
                new Length([
                    'max' => 4,
                    'maxMessage' => $this->getStandardMaxMessage('0433', '4'),
                ]),
            ],
            '0434' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0434', '4'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0434', '4'),
                ]),
            ],
            '0435' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0435', '4'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0435', '4'),
                ]),
            ],
            '0438' => [
                new Length([
                    'max' => 1,
                    'maxMessage' => $this->getStandardMaxMessage('0438', '4'),
                ]),
                new Choice([
                    'choices' => ['J', 'N'],
                    'message' => $this->getStandardChoicesMessage('0438', '4'),
                ]),
            ],
            '0440' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0440', '4'),
                ]),
            ],
            '0441' => [
                new Length([
                    'max' => 10,
                    'maxMessage' => $this->getStandardMaxMessage('0441', '4'),
                ]),
            ],
            '0915' => [
                new Length([
                    'max' => 9,
                    'maxMessage' => $this->getStandardMaxMessage('0915', '4'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage('0915', '4', 'numeric'),
                ]),
            ],
        ];
    }
}
