<?php

namespace Illuminate\Http {
    class _ide_macros
    {
        public function hasValidSignature($absolute = true)
        {
            return URL::hasValidSignature($this, $absolute);
        }

        public function validate(array $rules, ...$params)
        {
            return validator()->validate($this->all(), $rules, ...$params);
        }

        public function validateWithBag(string $errorBag, array $rules, ...$params)
        {
            try {
                return $this->validate($rules, ...$params);
            } catch (ValidationException $e) {
                $e->errorBag = $errorBag;

                throw $e;
            }
        }
    }
}
