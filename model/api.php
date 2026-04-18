<?php
require __DIR__ . "/../settings.php";
global $api_key;
// API KEY HERE, .env prefered
$api_key = "";
/*
    Coinmarketcap API class
*/
class Api
{
    public $url;
    function call($url)
    {
        global $api_key;
        // Initialize curl
        $ch = curl_init();
        // Settings
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Access-Control-Allow-Origin: *",
                "Access-Control-Allow-Methods: GET, OPTIONS",
                "Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With",
                "Accepts: application/json",
                "Content-Type: application/json",
                "X-CMC_PRO_API_KEY: $api_key"
            ]
        ]);
        // Data from the API
        $response = curl_exec($ch);
        // Handle errors
        if ($response === false) {
            http_response_code(500);
            echo json_encode(["error" => curl_error($ch)]);
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        // Return API data in associated array format
        return (json_decode($response, true));
    }
    // Get price for a single currency
    function get_price($id)
    {
        global $CMC_quote_latest;
        $api_full_url = $CMC_quote_latest . "?id=" . $id . "";
        return $this->call($api_full_url);
    }
    // Get top 100 listing
    function get_listing_latest()
    {
        global $CMC_listing_latest;
        $api_full_url = $CMC_listing_latest;
        return $this->call($api_full_url);
    }
    // Get global metrics
    function get_metrics() {
        global $CMC_metrics;
        $api_full_url = $CMC_metrics;
        return $this->call($api_full_url);
    }
}

global $api;
// The API instance
$api = new Api();
