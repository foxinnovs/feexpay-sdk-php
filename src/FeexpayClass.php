<?php

declare(strict_types=1);

namespace Feexpay\FeexpayPhp;

class FeexpayClass
{
    /**
     * Create a new Skeleton Instance
     */

    public function __construct(string $id, string $token, string $callback_url, string $mode)
    {
        // constructor body
        $this->id = $id;
        $this->token = $token;
        $this->callback_url = $callback_url;
        $this->mode = $mode;

    }

    public function getIdAndMarchanName()
    {
        try {
            $curl = curl_init("https://api.feexpay.me/api/shop/$this->id/get_shop");
            curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'certificats/IXRCERT.crt');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $responseCurl = curl_exec($curl);
            $responseData = json_decode($responseCurl);
            curl_close($curl);
            return $responseData;
        } catch (\Throwable $th) {
            echo "Id Request not send";
        }


    }
    public function paiementLocal(float $amount, string $phoneNumber, string $operatorName, string $fullname, string $email)
    {
        function curl_post($url, array $post = null, array $options = array())
        {

            $defaults = array(

                CURLOPT_POST => 1,

                CURLOPT_HEADER => 0,

                CURLOPT_URL => $url,

                CURLOPT_FRESH_CONNECT => 1,

                CURLOPT_RETURNTRANSFER => 1,

                CURLOPT_FORBID_REUSE => 1,

                CURLOPT_TIMEOUT => 4,

                CURLOPT_POSTFIELDS => http_build_query($post),
                CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'certificats/IXRCERT.crt',

            );

            $ch = curl_init();

            curl_setopt_array($ch, ($options + $defaults));

            if (!$result = curl_exec($ch)) {

                trigger_error(curl_error($ch));

            }

            curl_close($ch);

            return $result;

        }

        $responseIdGet = $this->getIdAndMarchanName();
        $nameMarchandExist = isset($responseIdGet->name);
        if ($nameMarchandExist == true) {

            try {
                $post = array("phoneNumber" => $phoneNumber, "amount" => $amount, "reseau" => $operatorName, "token" => $this->token, "shop" => $this->id, "first_name" => $fullname, "email" => $email);
                $responseCurlPostPaiement = curl_post("https://api.feexpay.me/api/transactions/requesttopay/integration", $post);
                $responseCurlPostPaiementData = json_decode($responseCurlPostPaiement);

                if ($responseCurlPostPaiementData->status == "FAILED") {
                    echo "Le numéro entré est incorrecte";
                } else {
                    return $responseCurlPostPaiementData->reference;
                }

            } catch (\Throwable $th) {
                echo "Request Not Send";
            }

        } else {
            return false;
        }

    }

    public function getPaiementStatus($paiementRef)
    {

        try {
            $curlGetPaiementWithReference = curl_init("https://api.feexpay.me/api/transactions/getrequesttopay/integration/$paiementRef");
            curl_setopt($curlGetPaiementWithReference, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'certificats/IXRCERT.crt');
            curl_setopt($curlGetPaiementWithReference, CURLOPT_RETURNTRANSFER, true);
            $responseCurlStatus = curl_exec($curlGetPaiementWithReference);
            $statusData = json_decode($responseCurlStatus);
            curl_close($curlGetPaiementWithReference);
            $payer = $statusData->payer;
            $responseSendArray = array("amount"=>$statusData->amount,"clientNum"=>$payer->partyId,"status"=>$statusData->status);

            return $responseSendArray;
        } catch (\Throwable $th) {
            echo "Get Status Request Not Send";
        }

    }

}