<?php

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

/**
 * The base functionality of a validater for a row in the OPDNAW message.
 *
 * @author Reyo Stallenberg <reyostallenberg@gmail.com>
 */
abstract class AbstractRowValidator
{
    /**
     * The data in the row.
     *
     * @var array
     */
    protected $data = [];

    /**
     * The constraints for the row.
     *
     * @var type
     */
    protected $constraints = [];

    /**
     * Create a new row validator.
     *
     * @param type $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Validate the row.
     *
     * @return array
     */
    public function validate()
    {
        $constraints = $this->getConstraints();
        $requiredFields = $this->getRequiredFields();
        foreach ($requiredFields as $requiredField) {
            $this->addRequiredField($requiredField, $constraints);
        }
        $conditionalRequiredFields = $this->getConditionalRequiredFields();
        foreach ($conditionalRequiredFields as $requiredField => $test) {
            foreach ($test as $otherFieldKey => $otherFieldValue) {
                if (isset($this->data[$otherFieldKey]) && ($this->data[$otherFieldKey] == $otherFieldValue || (is_array($otherFieldValue) && in_array($this->data[$otherFieldKey], $otherFieldValue)))) {
                    $this->addRequiredField($requiredField, $constraints, $otherFieldKey, $otherFieldValue);
                } elseif (isset($this->data[$otherFieldKey]) && $this->data[$otherFieldKey] != $otherFieldValue) {
                    $this->addForbiddenField($requiredField, $constraints, $otherFieldKey, $otherFieldValue);
                }
            }
        }

        $validator = Validation::createValidator();
        $foundViolations = [];

        foreach ($this->data as $key => $value) {
            if (isset($constraints[$key])) {
                $violations = $validator->validate(
                    $value,
                    $constraints[$key]
                );

                if (0 !== count($violations)) {
                    $foundViolations[$key] = $violations;
                }
            }
        }

        return $foundViolations;
    }

    /**
     * Add a requirement on a field.
     *
     * @param string      $requiredField
     * @param array       $constraints
     * @param string|null $otherFieldKey
     * @param string      $otherFieldValue
     */
    private function addRequiredField($requiredField, &$constraints, $otherFieldKey = null, $otherFieldValue = '')
    {
        if (isset($constraints[$requiredField]) === false) {
            $constraints[$requiredField] = [];
        }
        if (isset($this->data[$requiredField]) === false) {
            $this->data[$requiredField] = '';
        }

        array_unshift(
            $constraints[$requiredField],
            new NotBlank([
                'message' => sprintf(
                    'The field %s in row %s should not be blank%s',
                    $requiredField,
                    substr(
                        get_class($this),
                        strlen('Reyostallenberg\CentraalBoekhuisEcommerce\Validator\Row')
                    ),
                    ((is_null($otherFieldKey) || is_array($otherFieldValue) ? '' : sprintf(' when %s has value %s', $otherFieldKey, $otherFieldValue)))
                ),
            ])
        );
    }

    /**
     * Add a forbidment on a field.
     *
     * @param string      $requiredField
     * @param array       $constraints
     * @param string|null $otherFieldKey
     * @param string      $otherFieldValue
     */
    private function addForbiddenField($requiredField, &$constraints, $otherFieldKey = null, $otherFieldValue = '')
    {
        if (isset($constraints[$requiredField]) === false) {
            $constraints[$requiredField] = [];
        }
        if (isset($this->data[$requiredField]) === false) {
            $this->data[$requiredField] = '';
        }

        array_unshift(
            $constraints[$requiredField],
            new Blank([
                'message' => sprintf(
                    'The field %s in row %s should be blank%s',
                    $requiredField,
                    substr(
                        get_class($this),
                        strlen('Reyostallenberg\CentraalBoekhuisEcommerce\Validator\Row')
                    ),
                    ((is_null($otherFieldKey) ? '' : sprintf(' when %s has value %s', $otherFieldKey, $otherFieldValue)))
                ),
            ])
        );
    }

    /**
     * Get the required fields.
     *
     * @return array
     */
    public function getRequiredFields()
    {
        return [
        ];
    }

    /**
     * Get the required fields for this row when value in other field.
     *
     * @return array
     */
    public function getConditionalRequiredFields()
    {
        return [
        ];
    }

    /**
     * Get the standard message to show for when max exceeds.
     *
     * @param string $fieldName
     * @param string $row
     *
     * @return string
     */
    protected function getStandardMaxMessage($fieldName, $row)
    {
        return sprintf('The value ({{ value }}) of field #%s in row %s is too long. Max allowed is {{ limit }}.', $fieldName, $row);
    }

    /**
     * Get the standard message to show for when the field is not a boolean.
     *
     * @param string $fieldName
     * @param string $row
     *
     * @return string
     */
    protected function getStandardBooleanMessage($fieldName, $row)
    {
        return sprintf('The value ({{ value }}) of field #%s in row %s is not as expected 0 or 1.', $fieldName, $row);
    }

    /**
     * Get the standard message to show for when choices don't meet expectation.
     *
     * @param string $fieldName
     * @param string $row
     *
     * @return string
     */
    protected function getStandardChoicesMessage($fieldName, $row)
    {
        return sprintf('The value ({{ value }}) of field #%s in row %s is not one of the possible choices.', $fieldName, $row);
    }

    /**
     * Get the standard message to show for when type doesn't meet expectation.
     *
     * @param string $fieldName
     * @param string $row
     * @param string $type
     *
     * @return string
     */
    protected function getStandardTypeMessage($fieldName, $row, $type)
    {
        return sprintf('The value ({{ value }}) of field #%s in row %s is not of the type %s.', $fieldName, $row, $type);
    }
}
