<?php

    namespace Helpers\Credit;

    use Exception;

    class CreditFactory
    {
        protected static $bureaus = [
            "tu" => TransUnion::class,
            "xpn" => Experian::class,
            "efx" => Equifax::class
        ];

        public static function find(CreditData $credit) : CreditOperation {
            $bureau = $credit->getBureau();

            if(!array_key_exists(strtolower($bureau), static::$bureaus)) {
                throw new Exception("Invalid Credit Bureau {$bureau}, must be one of ".implode(", ", ['EFX, TU, XPN']));
            }

            return new static::$bureaus[$bureau]($credit);
        }
    }
