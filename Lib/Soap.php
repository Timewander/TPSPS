<?php

class Soap {

    public static function call($wsdl, $params, $args) {

        $username = isset($args["username"]) ? $args["username"] : "";
        $password = isset($args["password"]) ? $args["password"] : "";
        $location = isset($args["location"]) ? $args["location"] : "";
        $function = isset($args["function"]) ? $args["function"] : "";
        $client = new SoapClient($wsdl, [
            "login" => $username,
            "password" => $password,
            "cache_wsdl" => WSDL_CACHE_BOTH,
            "location" => $location,
        ]);
        try {
            $result = $client->__soapCall($function, $params);
        } catch (SoapFault $soapFault) {
            $result = $soapFault;
        }

        return json_encode($result);
    }
}