<?php
namespace App\Validators;

use App\Validator;

class validateF{


    private $validate;
    public function __construct(array $data)
    {
        Validator::lang('fr');
        $this->validate = new Validator($data);        
    }
    public function validate($rule,$fields){
        $this->validate->rule($rule,$fields);
        return $this;
    }
    public function is_valide(){
        return $this->validate->validate();
        
    }
    public function errors(){
        return $this->validate->errors();
    }

}