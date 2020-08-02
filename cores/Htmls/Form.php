<?php
namespace App\Htmls;
class Form
{
    private $data;
    private  $errors;
    public function __construct($data, array $errors)
    {
        $this->data =$data;
        $this->errors = $errors;
    }
    /**
     * get hmtl input
     *
     * @param string $name
     * @param string $placeholder
     * @param string $type
     * @return string
     */
    public function input($name,string $placeholder,$type = 'text'):string{
        $inputClass = 'form-control';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        $value = null;
        if($type != 'password'){$value = $this->getValue($name);}
        return <<<HTML
            <input type="{$type}" id="{$name}" value="{$value}" name="{$name}" class="{$inputClass} mb-2" placeholder="{$placeholder}" required >
            {$errorMessage}
        HTML;
    }
    public function checkbox(string $name ,$label):string{
        $inputClass = '';
        $attribut ='';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        if($this->getValue($name)=== "on"){
            $attribut .= 'checked';
        }
        //come back
        return <<<HTML
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input {$inputClass}" type="checkbox" id="{$name}" required $attribut name="{$name}">
                <label class="custom-control-label" for="{$name}"> $label </label>
                {$errorMessage}
            </div>
        HTML;
    }

    private function getValue(string $name) {
        if(is_array($this->data)){
            return htmlentities($this->data[$name] ?? null) ;
        }
        $dynamiqueName = 'get'.ucfirst($name);
        return $this->data->$dynamiqueName;
    }
}
