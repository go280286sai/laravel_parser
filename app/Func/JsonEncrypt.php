<?php

namespace App\Func;

class JsonEncrypt
{
    protected object $data;
    protected string $key = b'Sixteen byte key'; // Ключ шифрования
    protected string $iv = b'InitializationVe'; // Вектор инициализации (IV)

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function decrypt_json($encrypted_data)
    {
        $encrypted_data = base64_decode($encrypted_data);
        $json_data = openssl_decrypt($encrypted_data, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv);
        return json_decode($json_data, true);
    }

    public function encrypt_json(): string
    {
        $json_data = json_encode($this->data);
        $encrypted_data = openssl_encrypt($json_data, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($encrypted_data);
    }
}
