<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reyostallenberg\CentraalBoekhuisEcommerce\Validator;

/**
 * Description of RowValidatorInterface.
 *
 * @author reyo
 */
interface RowValidatorInterface
{
    public function validate();

    public function getConstraints();

    public function getRequiredFields();

    public function getConditionalRequiredFields();
}
