<?php namespace Innaco\Repositories;
use Innaco\Entities\User;

class UserRepo extends BaseRepo {

    public function getModel()
    {
        return new user();
    }

    public function newUser()
    {
        $user = new user();
        return $user;
    }

    public static function getBinaryData($size = 170, $input_name)
    {
        return Image::make(static::getPathFromInput($input_name))->fit($size)->encode();
    }

    public function updateSign($id, $input_name = "sign")
    {
        $model = $this->find($id);
        $model->update([
            "sign" => static::getBinaryData('170', $input_name)
        ]);
    }

}