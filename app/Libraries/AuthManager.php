<?php namespace App\Libraries;

use App\Libraries\Hash;

class AuthManager
{
    /**
     * Set variable
     *
     * @var [type]
     */
    private $request;
    private $username = 'username';
    private $password = 'password';
    private $modelClass = \App\Models\Users::class;

    /**
     * Undocumented function
     */
    function __construct()
    {
        $this->request = \Config\Services::request();
    }

    /**
     * Property function
     *
     * @param array $setProperty
     * @property mixed $username
     * @property mixed $password
     * @property mixed $classes
     * @return void
     */
    function property(array $setProperty)
    {
        /**
         * if exist username alt
         */
        if(array_key_exists('username', $setProperty))
        {
            $this->username = $setProperty['username'];
        }
        /**
         * if exist password alt
         */
        if(array_key_exists('password', $setProperty))
        {
            $this->password = $setProperty['password'];
        }
        /**
         * if exist password alt
         */
        if(array_key_exists('classes', $setProperty))
        {
            $this->modelClass= $setProperty['classes'];
        }
    }
    /**
     * validate function
     *
     * @return void
     */
    function validate($directUsername = null, $directPassword = null)
    {
        $inputUsername = ($directUsername === null) ? $this->request->getVar('username') : $directUsername;

        $users = new $this->modelClass;
        $has   = $users
                ->where($this->username,$inputUsername)
                ->first();

        if(!$has)
        {
            return false;
        }

        $inputPassword = ($directPassword === null) ? $this->request->getVar('password') : $directPassword;
        $fieldPassword = $this->password;

        if(Hash::validate($inputPassword, $has->$fieldPassword))
        {
            return $has;
        }
        
        return false;
    }

    function test()
    {
        return $this->request;
    }
}