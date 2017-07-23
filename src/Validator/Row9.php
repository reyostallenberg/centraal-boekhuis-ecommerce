<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Validator for RecordType Footer.
 *
 * @author Reyo  Stallenberg <reyostallenberg@gmail.com>
 */
class Row9 extends AbstractRowValidator implements RowValidatorInterface
{
    /**
     * Get the required fields for this row.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return ['0015', '0016', '0017', '0018', '0019', '0006'];
    }

    /**
     * Get the constraints for this row.
     *
     * @return array
     */
    public function getConstraints()
    {
        $constraints = [];

        foreach (['0015', '0016', '0017', '0018', '0019'] as $field) {
            $constraints[$field] = [
                new Length([
                    'max' => 6,
                    'maxMessage' => $this->getStandardMaxMessage($field, '7'),
                ]),
                new Type([
                    'type' => 'numeric',
                    'message' => $this->getStandardTypeMessage($field, '7', 'numeric'),
                ]),
            ];
        }

        $constraints['0006'] = [
            new Length([
                'max' => 10,
                'maxMessage' => $this->getStandardMaxMessage('0006', '7'),
            ]),
        ];

        return $constraints;
    }
}
