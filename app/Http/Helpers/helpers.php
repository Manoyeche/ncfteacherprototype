<?php

function validateValue($value, $rules)
{
    //needs to be an assoc
    $assoc = ['value' => $value];

    $validator = Validator::make($assoc, [
        'value' => $rules,
    ]);

    return !$validator->fails();
}