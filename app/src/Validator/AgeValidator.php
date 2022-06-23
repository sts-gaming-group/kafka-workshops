<?php

namespace App\Validator;

use StsGamingGroup\KafkaBundle\Validator\Contract\ValidatorInterface;
use StsGamingGroup\KafkaBundle\Validator\Validator;

class AgeValidator implements ValidatorInterface
{
    public function validate($data): bool
    {
        return $data['data']['age'] > 18;
    }

    public function failureReason($data): string
    {
        return 'Age is below 18';
    }

    public function type(): string
    {
        return Validator::PRE_DENORMALIZE_TYPE;
    }
}