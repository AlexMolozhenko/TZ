<?php


namespace Validators;


class TaskValidator
{
    /**
     * validate id
     * @param $id
     * @return bool|string
     */
    static public function isValidId($id)
    {
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT))       {
          return 'ID is required and should be an integer.';
        }
        return true;
    }

    /**
     * validate title
     * @param $title
     * @return bool|string
     */
    static public function isValidTitle($title)
    {
        if (empty($title) || !is_string($title)) {
         return 'Title is required and should be a string.';
        }
        return true;
    }

    /**
     * validate description
     * @param $description
     * @return bool|string
     */
    static public function isValidDescription($description){
        if (empty($description) || !is_string($description)) {
            return'Description is required and should be a string.';
        }
        return true;
    }

    /**
     * Validate data
     * @param array $data
     * @return mixed
     */
   static public function validate(array $data):mixed {

        $errors = [];
         foreach ($data as $key=>$value){
             switch ($key) {
                 case 'id':
                     $result =  self::isValidId($value);
                     if($result!==true){
                         $errors[]=$result;
                     }
                     break;
                 case 'title':
                     $result =  self::isValidTitle($value);
                     if($result!==true){
                         $errors[]=$result;
                     }
                     break;
                 case 'description':
                     $result =  self::isValidDescription($value);
                     if($result!==true){
                         $errors[]=$result;
                     }
                     break;
             }
         }
         if(!empty($errors)){
             return $errors;
         }else{
             return true;
         }
    }
}