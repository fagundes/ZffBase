<?php
namespace Zff\Base\Util;

/**
 * Crypt
 * Encripta e Decripta dados utilizando md5 e opcionalmente base64.
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Util
 */
class Crypt {

    public static function encrypt($data, $key, $base64 = true) {
        $hash    = mhash(MHASH_MD5, $key);
        $crypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $hash, $data, MCRYPT_MODE_ECB);

        return $base64 ? base64_encode($crypted) : $crypted;
    }

    public static function decrypt($data, $key, $base64 = true) {
        $hash = mhash(MHASH_MD5, $key);
        $data = $base64 ? base64_decode($data) : $data;

        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $hash, $data, MCRYPT_MODE_ECB));
    }

}
