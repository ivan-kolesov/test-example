<?php

namespace Kernel;

use Kernel\Models\ModelBase;

class Validator
{
    /**
     * @param ModelBase $model
     * @param array $rules
     * @return array
     */
    public static function validate(ModelBase $model, array $rules = [])
    {
        $errors = [];

        if (empty($rules)) {
            $rules = $model->getValidatorRules();
        }

        foreach ($rules as $key => $rule) {
            $errorsRule = self::validateValue($model, $model->$key, $rule);
            if (!empty($errorsRule)) {
                foreach ($errorsRule as $errorRule) {
                    $errors[] = $key . '.' . $errorRule;
                }
            }
        }

        return $errors;
    }

    /**
     * @param ModelBase $model
     * @param $value
     * @param $rule
     * @return array
     */
    private static function validateValue(ModelBase $model, $value, $rule)
    {
        $errors = [];

        $ruleSegments = explode('|', $rule);
        foreach ($ruleSegments as $ruleSegment) {
            $isValid = true;

            $ruleSegmentParts = explode(':', $ruleSegment);
            $ruleSegmentKey = $ruleSegmentParts[0];
            $ruleSegmentValue = 2 === count($ruleSegmentParts) ? $ruleSegmentParts[1] : null;

            switch ($ruleSegmentKey) {
                case 'required':
                    $isValid = self::isNonEmpty($value);
                    break;
                case 'email':
                    $isValid = self::isEmail($value);
                    break;
                case 'confirmed':
                    $isValid = self::isPasswordsEquals($value, $model->$ruleSegmentValue);
                    break;
                case 'mimes':
                    $isValid = self::isExtensionValid($value, $ruleSegmentValue);
                    break;
            }

            if (!$isValid) {
                $errors[] = $ruleSegmentKey;
            }
        }

        return $errors;
    }

    /**
     * @param $value
     * @return bool
     */
    private static function isNonEmpty($value)
    {
        return !empty($value);
    }

    /**
     * @param $value
     * @return bool
     */
    private static function isEmail($value)
    {
        return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $value
     * @param $valueMatch
     * @return bool
     */
    private static function isPasswordsEquals($value, $valueMatch)
    {
        return strval($value) === strval($valueMatch);
    }

    /**
     * @param UploadedFile|null $file
     * @param $allowedExtensions
     * @return bool
     */
    private static function isExtensionValid(UploadedFile $file = null, $allowedExtensions)
    {
        if ($file instanceof UploadedFile) {
            return in_array($file->getExtension(), explode(',', $allowedExtensions));
        }

        return true;
    }
}