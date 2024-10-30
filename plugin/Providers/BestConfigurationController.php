<?php

namespace BestConfiguration\Providers;

class BestConfigurationController
{
    public static function boot()
    {
        return new static();
    }

    public function __construct()
    {
        $options = BestConfiguration()->options->toArray();

        $methodList = [];

        foreach ($options as $key => $value) {
            if ($key !== 'version' && is_array($value)) {
                $this->recursive($key, $value, $methodList);
            }
        }

        foreach ($methodList as $methodName => $option) {
            $this->{$methodName}($option);
        }

    }

    protected function recursive($key, $value, &$stack)
    {
        foreach ($value as $option => $optionValue) {

            if (is_array($optionValue)) {
                $newKey = $key . ucfirst($option);
                $this->recursive($newKey, $optionValue, $stack);
            } else {
                $methodName = $key . $this->getMethodName($option);
                if (method_exists($this, $methodName)) {
                    $stack[ $methodName ] = $optionValue;
                }
            }
        }
    }

    protected function getMethodName($value)
    {
        $value = str_replace('_', ' ', $value);
        $value = ucwords($value);
        $value = str_replace(' ', '', $value);

        return $value;
    }

}
