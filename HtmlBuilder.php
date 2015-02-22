<?php namespace Mraiur\EnhancedForm;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {
    public function arriaAttributes($attributes)
    {
        $html = array();

        foreach ((array) $attributes as $key => $value)
        {
            $element = $this->ariaAttributeElement($key, $value);
            if ( ! is_null($element)){
                $html[] = $element;
            }
        }
        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    protected function ariaAitributeElement($key, $value)
    {
        if (is_numeric($key)) $key = $value;

        if ( ! is_null($value)) return "data-".$key.'="'.e($value).'"';
    }
}
