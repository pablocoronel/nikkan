<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class Shipnow extends Model
{
    public $user;
    public $password;
    public $cacert;
    public $token;

    public function __construct($user, $password, $cacert) {
        $this->user = $user;
        $this->password = $password;
        $this->cacert = public_path() . $cacert;
        $this->token = "";
    }

    public function login() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.shipnow.com.ar/users/authentication",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_CAINFO => $this->cacert,
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic ".base64_encode($this->user.':'.$this->password),
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception($err);
        } else {
            $this->token = $response['token'];
        }
    }

// ************************
    public function createProduct($prod)
    {
        if($this->token != "") {
            $curl = curl_init();

            $productos= json_encode($prod, JSON_HEX_AMP);

            // var_dump($productos);
            // exit();

            curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.shipnow.com.ar/products",
                // CURLOPT_URL => "https://api-staging.shipnow.com.ar/products", // API DE PRUEBA
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $productos,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POST => true,
                CURLOPT_CAINFO => $this->cacert,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Token token=".$this->token,
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $mandar= curl_exec($curl);
            $response = json_decode($mandar, true);
        
            // var_dump($response);
            // exit();
        
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                throw new Exception($err);
            } else {
                return $response;
            }
        } else {
            throw new Exception("Token no especificado");
        }
    }
// **************************

    public function createOrder($order) {

        if($this->token != "") {
            $curl = curl_init();

            $pedidos= json_encode($order, JSON_HEX_AMP);
            // var_dump($pedidos);
            // exit();

            curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.shipnow.com.ar/orders",
                // CURLOPT_URL => "https://api-staging.shipnow.com.ar/orders", // API DE PRUEBA
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $pedidos,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POST => true,
                CURLOPT_CAINFO => $this->cacert,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Token token=".$this->token,
                    "cache-control: no-cache",
                "content-type: application/json"
                ),
            ));

            $mandar= curl_exec($curl);
            $response = json_decode($mandar, true);
        
            // var_dump($response);
            // exit();
        
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                throw new Exception($err);
            } else {
                return $response;
            }
        } else {
            throw new Exception("Token no especificado");
        }
    }

    // *******************
    public function codigoPostal($cp)
    {
        if($this->token != "") {
            $curl = curl_init();


            $codigoPostal= json_encode($cp, JSON_HEX_AMP);

            // var_dump($codigoPostal);
            // exit();

            curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.shipnow.com.ar/shipping_services",
                // CURLOPT_URL => "https://api-staging.shipnow.com.ar/shipping_services", // API DE PRUEBA
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $codigoPostal,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POST => true,
                CURLOPT_CAINFO => $this->cacert,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Token token=".$this->token,
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $mandar= curl_exec($curl);
            $response = json_decode($mandar, true);
        
            // var_dump($response);
            // exit();
        
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                throw new Exception($err);
            } else {
                return $response;
            }
        } else {
            throw new Exception("Token no especificado");
        }
    }
}
