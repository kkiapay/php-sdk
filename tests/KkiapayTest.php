<?php

namespace Kkiapay;




use PHPUnit\Framework\TestCase;










final class KkiapayTest extends TestCase
{

    public function testStatusIfApiKeyIsInvalid(): void
    {
        $public_key = "xxxxxxxxxxxxxxxxxxxxxxxxxx";
        $private_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxx";
        $secret = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
        $kkiapay = new Kkiapay($public_key, $private_key, $secret);

        $response = $kkiapay->verifyTransaction("oldnbsc");
        

        $this->assertEquals(
            $response->statusCode,
            401
        );

        $this->assertEquals(
            $response->reason,
            "Invalid API KEY"
        );

        $this->assertEquals(
            $response->status,
            4003
        );
    }


    public function testCheckResponseIfTransactionNotFound()
    {


        $client = $this->createMock(\GuzzleHttp\Client::class);

        

        $response = new \stdClass();
        $response->statusCode = 404;
        $response->status = "TRANSACTION_NOT_FOUND";

        $client->method('post')->willReturn($response);

        $kkiapay = new Kkiapay("", "", "");

        $kkiapay->setHttpClient($client);

        $response = $kkiapay->verifyTransaction("xxxxx");



        $this->assertSame("TRANSACTION_NOT_FOUND", $response->status);
    }
}
