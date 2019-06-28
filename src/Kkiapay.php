<?php namespace Kkiapay;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\json_encode;
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
        
        $const = $this->sandbox ? Constants::SANDBOX_URL : Constants::BASE_URL;

        $response = $this->curl->post($const. '/api/v1/transactions/status', array(
            "json" => array("transactionId" => $transactionId),
            'headers' => [
                'Accept' => 'application/json',
                'X-API-KEY' => $this->public_key,
                'X-PRIVATE-KEY' => $this->private_key,
                'X-SECRET-KEY' => $this->secret
            ]
        ));

        $response = $response->getBody();
      }catch (\Exception $e){

        $response = json_encode(array( "status" => STATUS::TRANSACTION_NOT_FOUND));
      }
    return json_decode((string)$response);
    }


    public function refundTransaction($transactionId){
        $reponse = null;
      try{

        $const = $this->sandbox ? Constants::SANDBOX_URL : Constants::BASE_URL;

          $response = $this->curl->post($const. '/api/v1/transactions/revert', array(
              "json" => array("transactionId" => $transactionId),
              'headers' => [
                  'Accept'     => 'application/json',
                  'X-API-KEY'      => $this->public_key
              ]
          ));

            $reponse = $response->getBody();
            return json_decode((string)$reponse);

        }catch (RequestException $e){
            if ($e->hasResponse()) {
                $reponse = "{".$this->get_string_between(Psr7\str($e->getResponse()), "{","}")."}";

                return json_decode((string)$reponse);
            }
            $reponse = json_encode(array( "status" => STATUS::FAILED));
            return json_decode((string)$response);
        }
    }

    public function setupPayout(array $options){
        $reponse = null;
      try{

          $const = $this->sandbox ? Constants::SANDBOX_URL : Constants::BASE_URL;

          $response = $this->curl->post($const. '/merchant/payouts/schedule', array(
              "json" => $options,
              'headers' => [
                  'Accept'     => 'application/json',
                  'X-API-KEY'      => $this->public_key,
                  'X-PRIVATE-API-KEY'      => $this->private_key,
                  'X-SECRET-API-KEY'      => $this->secret,
              ]
          ));

            $reponse = $response->getBody();
            return json_decode((string)$reponse);

        }catch (RequestException $e){
            if ($e->hasResponse()) {
                $reponse = "{".$this->get_string_between(Psr7\str($e->getResponse()), "{","}")."}";
                return json_decode((string)$reponse);
            }
            $reponse = json_encode(array( "status" => STATUS::FAILED));
            return json_decode((string)$response);
        }
    }

    
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
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