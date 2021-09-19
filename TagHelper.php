<?php
class TagHalper
{
    private $attrs;
    public function open($name, $attrs = [])
    {
        $this->attrs = $attrs;
        $attrsSt = $this->getAttrStr($this->attrs);
        return "<$name $attrsSt>";
    }
    public function close($name)
    {

        return "</$name>";
    }

    public function show($name, $text)
    {
        return $this->open($name, $this->attrs) . $text . $this->close($name);
    }

    public function getAttrStr($attrs)
    {
        if (!empty($attrs)) {
            $result = '';
            foreach ($attrs as $name => $value) {
                if ($value === true) {
                    $result .= "$name";
                } else {
                    $result .= "$name =\"$value\"";
                }
            }
        } else {
            $result = '';
        }
        return $result;
    }
}
class FormHelper extends TagHalper
{
    public function openForm($attrs = [])
    {
        return  $this->open('form', $attrs);
    }
    public function closeForm()
    {
        return $this->close('form');
    }
    public function input($attrs = [])
    {
        if (isset($attrs['name'])) {
            $name = $attrs['name'];
            if (isset($_REQUEST[$name])) {
                $attrs['value'] = $_REQUEST[$name];
            }
        }
        return $this->open('input', $attrs);
    }
    public function password($attrs = [])
    {
        $attrs['type'] = 'password';
        return $this->open('input', $attrs);
    }
    public function hidden($attrs = [])
    {
        $attrs['type'] = 'hidden';
        return $this->open('input', $attrs);
    }
    public function submit($attrs = [])
    {
        $attrs['type'] = 'submit';
        return $this->open('input', $attrs);
    }
    public function checkbox($attrs = [])
    {
        $attrs['type'] = 'checkbox';
        $attrs['value'] = 1;
        if (isset($attrs['name'])) {
            $name = $attrs['name'];
            if (isset($_REQUEST[$name]) and $_REQUEST[$name] == 1) {
                $attrs['checked'] = true;
            }
            $hidden = $this->hidden(['name' => $name, 'value' => '0']);
        } else {
            $hidden = '';
        }
        return $hidden . $this->open('input', $attrs);
    }
    public function textarea($attrs = [])
    {
        if (isset($attrs['name'])) {
            $name = $attrs['name'];
            if (isset($_REQUEST[$name])) {
                $value = $_REQUEST[$name];
                $attrs['value'] = $value;
                return $this->open('textarea', $attrs) . $value . $this->close('textarea');
            }
        }
        return $this->open('textarea', $attrs) . $this->close('textarea');
    }
    public function select($attrs = [], $attrs1 = [])
    {
        if (isset($attrs['name'])) {
            $name = $attrs['name'];
            if (isset($_REQUEST[$name])) {
                $attrs['value'] = $_REQUEST[$name];
            }
        }
        $result = $this->open('select', $attrs);
        foreach ($attrs1 as  $value) {

            $result .=  $this->open('option', $value['attrs']) . $value['text'];
        }
        return   $result . $this->close('option');
    }
}
