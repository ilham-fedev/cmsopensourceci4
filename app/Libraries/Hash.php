<?php namespace App\Libraries;

class Hash
{
    /**
     * Create function
     *
     * @param String $password
     * @return String
     */
    static function create(String $password): String
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * Validate function
     *
     * @param String $password
     * @param String $hashed
     * @return Boolean
     */
    static function validate(String $password, String $hashed)
    {
        return password_verify($password, $hashed);
    }
}