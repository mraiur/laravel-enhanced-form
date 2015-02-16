<?php namespace Mraiur\EnhancedForm;

class FormBuilder extends \Illuminate\Html\FormBuilder {
    public function AriaSelect($name, $list = array(), $selected = null, $options = array()) {

        $selected = $this->getValueAttribute($name, $selected);

        $options['id'] = $this->getIdAttribute($name, $options);

        if ( ! isset($options['name'])) $options['name'] = $name;

        if( !isset($options['displayValue'])) $options['displayValue'] = 'name';
        if( !isset($options['submitValue'])) $options['submitValue'] = 'id';

        $html = array();

        foreach ($list as $index => $row)
        {
            $display = $row[$options['displayValue']];
            $value = $row[$options['submitValue']];

            unset( $row[$options['displayValue']], $row[$options['submitValue']]);
            $html[] = $this->getAriaOption($display, $value, $selected, $row);
        }

        $options = $this->html->attributes($options);

        $list = implode('', $html);

        return "<select{$options}>{$list}</select>";
    }

    protected function getAriaOption($display, $value, $selected, $ariaData = array())
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = array_merge( ['value' => e($value), 'selected' => $selected], $ariaData);

        return '<option'.$this->html->attributes($options).'>'.e($display).'</option>';
    }
}
