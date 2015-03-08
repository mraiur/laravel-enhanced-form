<?php namespace Mraiur\EnhancedForm;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {
    public function ariaAttributes($attributes, $exclude = [], $ariaExclude = [])
    {
        $html = array();

        foreach ((array) $attributes as $key => $value)
        {
            if(!in_array($key, $exclude)){
                $element = $this->ariaAttributeElement($key, $value, $ariaExclude);
                if ( ! is_null($element)){
                    $html[] = $element;
                }
            }
        }
        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    private $aria_excluded_keys = ['value', 'name', 'id', 'style', 'autofocus', 'form', 'multiple', 'required', 'size'];

    protected function ariaAttributeElement($key, $value, $ariaExclude = [])
    {
        if (is_numeric($key)) $key = $value;

        if ( ! is_null($value)) return ( (in_array($key, array_merge($this->aria_excluded_keys, $ariaExclude) ))?$key:"data-".$key).'="'.e($value).'"';
    }
}
