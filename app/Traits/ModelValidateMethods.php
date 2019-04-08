<?php namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ModelValidateMethods
{
    public function isValid($validator)
    {
        return ($validator->fails()) ? false : true;
    }

    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error)
                $errors[$error] = $error;

            $info =  implode('</br>', $errors);
            return response($info)->setStatusCode(400);
        } else {
            $this->fill($data);
            if ($this->save())
                return response()
                    ->json(['message' => $this->success_message])
                    ->setStatusCode(200);
        }
    }
}