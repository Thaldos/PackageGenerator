<?php

namespace WsdlToPhp\PackageGenerator\File\Validation;

/**
 * Class FractionDigitsRule
 * @link https://www.w3.org/TR/xmlschema-2/#rf-fractionDigits
 * Validation Rule: fractionDigits Valid
 * A value in a ·value space· is facet-valid with respect to ·fractionDigits· if:
 * - 1 that value is expressible as i × 10^-n where i and n are integers and 0 <= n <= {value}.
 */
class FractionDigitsRule extends AbstractRule
{

    /**
     * @return string
     */
    public function name()
    {
        return 'fractionDigits';
    }

    /**
     * @param string $parameterName
     * @param mixed $value
     * @param bool $itemType
     * @return string
     */
    public function testConditions($parameterName, $value, $itemType = false)
    {
        return sprintf(($itemType ? '' : '!is_null($%1$s) && ') . 'strlen(substr($%1$s, strpos($%1$s, \'.\') + 1)) > %2$d', $parameterName, $value);
    }

    /**
     * @param string $parameterName
     * @param mixed $value
     * @param bool $itemType
     * @return string
     */
    public function exceptionMessageOnTestFailure($parameterName, $value, $itemType = false)
    {
        return sprintf('sprintf(\'Invalid value %%s, the value must at most contain %1$d fraction digits, %%d given\', var_export($%2$s, true), strlen(substr($%2$s, strpos($%2$s, \'.\') + 1)))', $value, $parameterName);
    }
}
