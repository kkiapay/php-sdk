<?php namespace Kkiapay;

/**
 * Created by PhpStorm.
 * User: shadai.ali
 * Date: 2019-02-24
 * Time: 02:23
 *
 * THIS FILE CONTAINS ALL KKIAPAY API STATUS
 */

require dirname( __DIR__ ). '/vendor/autoload.php';

class Kkiapay{

    // Publishable Api key
    private $public_key;

    // Account Private Key
    private $private_key;

    // Account Secret
    private $secret;

    private $curl;

    private $sandbox;

    /**
     * Kkiapay constructor.
     */
    public function __construct($public_key, $private_key, $secret = null, $sandbox = false)
    {
        $this->private_key = $private_key;
        $this->public_key = $public_key;
        $this->secret = $secret;
        $this->sandbox = $sandbox;
        $this->curl = new \GuzzleHttp\Client();
    }


    public function hash($str){
        if($this->getSecret() == null) throw new \Exception("Secret key is not set");
        return urlencode(  base64_encode( hash_hmac('SHA256', $str, $this->getSecret(),TRUE)));
    }

    public function verifyTransaction($transactionId){
        $response = null;
      try{
          if ($this->sandbox) {
            $response = $this->curl->post(Constants::SANDBOX_URL. '/api/v1/transactions/status', array(
                "json" => array("transactionId" => $transactionId),
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-KEY' => $this->private_key
                ]
            ));
          } else {
            $response = $this->curl->post(Constants::BASE_URL. '/api/v1/transactions/status', array(
                "json" => array("transactionId" => $transactionId),
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-KEY' => $this->private_key
                ]
            ));
          }

          $response = $response->getBody();
      }catch (\Exception $e){

        $response = json_encode(array( "status" => STATUS::TRANSACTION_NOT_FOUND));
      }
    return json_decode((string)$response);
    }
    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }

    /**
     * @return null
     */
    public function getSecret()
    {
        return $this->secret;
    }


}