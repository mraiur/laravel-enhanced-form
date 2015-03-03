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

    protected function ariaAttributeElement($key, $value)
    {
        if (is_numeric($key)) $key = $value;

        if ( ! is_null($value)) return ( ($key=='value')?$key:"data-".$key).'="'.e($value).'"';
    }
}
