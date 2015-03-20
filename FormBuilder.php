<?php namespace Mraiur\EnhancedForm;

class FormBuilder extends \Illuminate\Html\FormBuilder {

    private function ariaKeysToDisplay($options){
        $ariaAttributes = [];

        if( isset($options['aria']) ){
            $ariaAttributes = array_fill_keys( explode(',', $options['aria']), null);
        }
        return $ariaAttributes;
    }
    
    public function Aria($options = [], $data = [])
    {
        $name = $options['name'];
        $valueKey = (isset($options['value'])?$options['value']:'value');
        $excludeOptions = ['aria'];
        $ariaExclude = ['type'];
            
        if(!isset($options['type'])){
            $options['type'] = 'hidden';
        }

        if(isset($data[$valueKey])){
            $options['value'] = $data[$valueKey];
        }

        $ariaAttributes = $this->ariaKeysToDisplay($options);
        $displayData = array_intersect_key($data, $ariaAttributes);

        return '<input'.$this->html->AriaAttributes($options+$displayData, $ariaAttributes, ['aria']).'>';
    }

    public function AriaSelect($name, $list = array(), $selected = null, $options = array()) {
        

        $selected = $this->getValueAttribute($name, $selected);

        $options['id'] = $this->getIdAttribute($name, $options);
        $directAttr = [];
        $ariaPrefix = [];

        if ( ! isset($options['name'])) $options['name'] = $name;

        $optionValueField = 'id';
        $optionDisplayField = 'title';
        $optionAriaPrefix = [];

        if(isset($options['option'])) {
            if(isset($options['option']['displayField'])) {
                $optionDisplayField = $options['option']['displayField'];
            }

            if(isset($options['option']['valueField'])) {
                $optionValueField = $options['option']['valueField'];
            }

            if(isset($options['option']['aria'])) {
                $optionAriaPrefix = $this->ariaKeysToDisplay($options['option']);
            }
        }

        if(isset($options['aria'])){
            $ariaPrefix = $this->ariaKeysToDisplay($options);
        }
        
        $html = array();

        foreach ($list as $index => $row)
        {
            $display = $row[$optionDisplayField];
            $value = $row[$optionValueField];

            $ariaRow = array_intersect_key($row, $optionAriaPrefix);
            $html[] = $this->getAriaOption($display, $value, $selected, $ariaRow);
        }

        $options = $this->html->AriaAttributes($options, $ariaPrefix, ['aria', 'option']);


        $list = implode('', $html);

        return "<select{$options}>{$list}</select>";
    }

    protected function getAriaOption($display, $value, $selected, $ariaData = array())
    {
        $selected = $this->getSelectedValue($value, $selected);
        $options = array_merge( ['value' => e($value), 'selected' => $selected], $ariaData);

        return '<option'.$this->html->AriaAttributes($options, [], ['selected']).'>'.e($display).'</option>';
    }
}
