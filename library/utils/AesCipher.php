<?php
/**
 * gaofei08
 * AES加解密算法
 * Class Utils_AesCipher
 */
class Utils_AesCipher
{

    const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    const CIPHER_KEY_LEN = 16; //128 bits
    const KEY = 'xexplorer:check!';


    /**
     * @param $key
     *
     * @return bool|string
     */
    private static function fixKey($key)
    {

        if (strlen($key) < Utils_AesCipher::CIPHER_KEY_LEN) {
            //0 pad to len 16
            return str_pad("$key", Utils_AesCipher::CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > Utils_AesCipher::CIPHER_KEY_LEN) {
            //truncate to 16 bytes
            return substr("$key", 0, Utils_AesCipher::CIPHER_KEY_LEN);
        }
        return $key;
    }

    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * @param $iv
     * @param $data
     * @return string
     */
    public static function encrypt($iv, $data)
    {
        $encodedEncryptedData = base64_encode(
            openssl_encrypt(
                $data,
                Utils_AesCipher::OPENSSL_CIPHER_NAME,
                Utils_AesCipher::fixKey(self::KEY),
                OPENSSL_RAW_DATA,
                $iv
            )
        );
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData . ":" . $encodedIV;
        return $encryptedPayload;
    }

    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     * @param $data
     * @return string
     */
    public static function decrypt($data)
    {
        $parts = explode(':', $data); //Separate Encrypted data from iv.
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(
            base64_decode($encrypted),
            Utils_AesCipher::OPENSSL_CIPHER_NAME,
            Utils_AesCipher::fixKey(self::KEY),
            OPENSSL_RAW_DATA,
            base64_decode($iv)
        );
        return $decryptedData;
    }
}




