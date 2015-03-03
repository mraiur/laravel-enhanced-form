<?php namespace Mraiur\EnhancedForm;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {
    public function ariaAttributes($attributes, $exclude = [])
    {
        $html = array();

        foreach ((array) $attributes as $key => $value)
        {
            if(!in_array($key, $exclude)){
                $element = $this->ariaAttributeElement($key, $value);
                if ( ! is_null($element)){
                    $html[] = $element;
                }
            }
        }
        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    private $aria_excluded_keys = ['value', 'name', 'id', 'style', 'autofocus', 'form', 'multiple', 'required', 'size'];

    protected function ariaAttributeElement($key, $value)
    {
        if (is_numeric($key)) $key = $value;

        if ( ! is_null($value)) return ( (in_array($key, $this->aria_excluded_keys))?$key:"data-".$key).'="'.e($value).'"';
    }
}
