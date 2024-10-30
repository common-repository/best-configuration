<?php

namespace BestConfiguration\WPBones\Html;

class Html
{
    protected static $htmlTags = [
    'a'        => '\BestConfiguration\WPBones\Html\HtmlTagA',
    'button'   => '\BestConfiguration\WPBones\Html\HtmlTagButton',
    'checkbox' => '\BestConfiguration\WPBones\Html\HtmlTagCheckbox',
    'datetime' => '\BestConfiguration\WPBones\Html\HtmlTagDatetime',
    'fieldset' => '\BestConfiguration\WPBones\Html\HtmlTagFieldSet',
    'form'     => '\BestConfiguration\WPBones\Html\HtmlTagForm',
    'input'    => '\BestConfiguration\WPBones\Html\HtmlTagInput',
    'label'    => '\BestConfiguration\WPBones\Html\HtmlTagLabel',
    'optgroup' => '\BestConfiguration\WPBones\Html\HtmlTagOptGroup',
    'option'   => '\BestConfiguration\WPBones\Html\HtmlTagOption',
    'select'   => '\BestConfiguration\WPBones\Html\HtmlTagSelect',
    'textarea' => '\BestConfiguration\WPBones\Html\HtmlTagTextArea',
  ];

    public static function __callStatic($name, $arguments)
    {
        if (in_array($name, array_keys(self::$htmlTags))) {
            $args = (isset($arguments[ 0 ]) && ! is_null($arguments[ 0 ])) ? $arguments[ 0 ] : [];

            return new self::$htmlTags[ $name ]($args);
        }
    }
}
