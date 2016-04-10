<?php 

namespace Mapil\Traits;
use Validator;
use Mapil\Exceptions\SafeException;

trait ValidatableModel 
{
    protected $rules = [];
    protected $messages = [];

    public static function bootValidatableModel()
    {
        static::saving(function($model){
            $model->validate();
        });
    }    

    public function validate()
    {
        $validator = Validator::make($this->attributes, $this->rules, $this->messages);
        
        if(!$validator->passes()) {
            foreach($validator->messages()->messages() as $group) {
                foreach($group as $message) {
                    throw new SafeException($message);
                }
            }
        }
    }    
}