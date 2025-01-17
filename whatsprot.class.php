<?php

class WhatsProt
{
    // Class properties and methods

    public function codeRequest($method = "sms", $countryCode = null, $languageCode = null)
    {
        // Generate the request parameters
        $params = array(
            "cc" => $this->countryCode,
            "in" => $this->phoneNumber,
            "to" => $this->phoneNumber,
            "lg" => $languageCode ? $languageCode : $this->languageCode,
            "lc" => $countryCode ? $countryCode : $this->countryCode,
            "method" => $method,
            "mcc" => $this->mcc,
            "mnc" => $this->mnc,
            "token" => $this->generateToken(),
            "id" => $this->identity
        );

        // Send the request
        $response = $this->sendRequest("code", $params);

        // Handle the response
        return $this->handleResponse($response);
    }

    public function codeRegister($code)
    {
        // Generate the request parameters
        $params = array(
            "cc" => $this->countryCode,
            "in" => $this->phoneNumber,
            "to" => $this->phoneNumber,
            "lg" => $this->languageCode,
            "lc" => $this->countryCode,
            "code" => $code,
            "id" => $this->identity
        );

        // Send the request
        $response = $this->sendRequest("register", $params);

        // Handle the response
        return $this->handleResponse($response);
    }

    private function sendRequest($endpoint, $params)
    {
        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $response = curl_exec($ch);

        // Close cURL
        curl_close($ch);

        // Return the response
        return $response;
    }

    private function handleResponse($response)
    {
        // Decode the response
        $result = json_decode($response);

        // Check for errors
        if (isset($result->status) && $result->status == "fail") {
            throw new Exception("Error: " . $result->reason);
        }

        // Return the result
        return $result;
    }

    private function generateToken()
    {
        // Generate a token based on the phone number and identity
        return md5($this->phoneNumber . $this->identity);
    }
}
?>
