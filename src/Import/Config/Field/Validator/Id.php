<?php
namespace FMUP\Import\Config\Field\Validator;

use FMUP\Import\Config\Field\Validator;

class Id implements Validator
{
    public function validate($value)
    {
        $valueTest = (int)$value;
        return (bool)(($valueTest == $value && $valueTest > 0) || $value === 0);
    }

    public function getErrorMessage()
    {
        return "Le champ reçu n'est pas un id";
    }
}
