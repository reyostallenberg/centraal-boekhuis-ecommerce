<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Validator for RecordType Text.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row5 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return [];
    }

    /**
     * Get the required fields for this row when value in other field.
     *
     * @return array
     */
    public function getConditionalRequiredFields()
    {
        return [
            '0476' => [
                '0475' => ['KPR', 'BOM', 'BVW', 'MRK'],
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
        $lengths = [
            'KPR' => 92,
            'BOM' => 37,
            'BVW' => 152,
            'MRK' => 92,
        ];

        $constraints = [
            '0475' => [
                new Length([
                    'max' => 3,
                    'maxMessage' => $this->getStandardMaxMessage('0475', '5'),
                ]),
                new Choice([
                    'choices' => ['KPR', 'BOM', 'BVW', 'MRK'],
                    'message' => $this->getStandardChoicesMessage('0475', '5'),
                ]),
            ],
        ];

        $length = $lengths[$this->data['0475']];

        $constraints['0476'] = [
            new Length([
                'max' => $length,
                'maxMessage' => $this->getStandardMaxMessage('0476', '5'),
            ]),
        ];

        return $constraints;
    }
}
