<?php namespace Mraiur\EnhancedForm;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {
    public function ariaAttributes($attributes, $ariaPrefix = [], $exclude = [])
    {
        $html = array();

        foreach ((array) $attributes as $key => $value)
        {
            if(!in_array($key, $exclude)){
                $element = $this->ariaAttributeElement($key, $value, $ariaPrefix);
                if ( ! is_null($element)){
                    $html[] = $element;
                }
            }
        }
        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    protected function ariaAttributeElement($key, $value, $ariaPrefix = [])
    {
        if (is_numeric($key)) $key = $value;

        if ( ! is_null($value)) {
                if(array_key_exists($key, $ariaPrefix)){
                    return 'data-'.$key.'="'.e($value).'"';
                } else {
                    return $key.'="'.e($value).'"';
                }
        }
    }
}
