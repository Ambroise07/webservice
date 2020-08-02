<?php
namespace App\Helpers;

use App\Database;
use App\Models\Entreprises;
use PDO;

class ApiKey{
    /**
     * Function using to generate random user_token for account activation .
     *
     *
     * @param int $length
     *
     * @return string token
    **/
    public static function generate(int $length): string
    {
        $keys = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

        return substr(str_shuffle(str_repeat($keys, $length)), 0, $length);
    }
    public static function validity(Database $db,string $key){
        $query =  'SELECT id, api_active FROM entreprises WHERE api_key = :api_key';
        /** @var Entreprises */
        $apiKey = $db->select($query,false,[':api_key'=>$key],PDO::FETCH_CLASS,Entreprises::class);
        if($apiKey === false){
            return 'Votre clee d\'authentification  n\'est pas valide';
        }
        if($apiKey->getApi_active() === 0){
            return 'Votre clee d\'authentification n\'est pas active';
        }
        return $apiKey->getId();
    }
}