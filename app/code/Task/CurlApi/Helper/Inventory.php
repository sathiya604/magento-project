<?php
namespace Task\CurlApi\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Inventory extends AbstractHelper
{
    public function makeACurlRequest()
    {
        $username = 'admin';
        $password = 'Sarojini@123';
        $tokenUrl = 'http://magento-dev.com/rest/V1/integration/admin/token';
        $ch = curl_init();
        $data = ["username" => $username, "password" => $password];
        $data_string = json_encode($data);

        $ch = curl_init($tokenUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
               'Content-Type: application/json',
               'Content-Length: ' . strlen($data_string)]
        );
        $token = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if ($httpcode['http_code'] == 400) {
            return 'Token: Kindly check the parameters';
        } elseif ($httpcode['http_code'] == 401) {
            return 'Token: Credentials are Incorrect';
        } elseif ($httpcode['http_code'] == 403) {
            return 'Token: Forbidden';
        } elseif ($httpcode['http_code'] == 404) {
            return 'Token: URL Not Found';
        } elseif ($httpcode['http_code'] == 405) {
            return 'Token: Sorry! Not Allowed';
        } elseif ($httpcode['http_code'] == 406) {
            return 'Token: Sorry! Not Acceptable';
        } elseif ($httpcode['http_code'] == 500) {
            return 'Token: Internal Error! Contact Admin';
        }

        $ch = curl_init("http://magento-dev.com/rest/arabia/V1/customconfig/config");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer " . json_decode($token)]);
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if ($httpcode['http_code'] == 400) {
            return 'Kindly check the parameters';
        } elseif ($httpcode['http_code'] == 401) {
            return 'Credentials are Missing';
        } elseif ($httpcode['http_code'] == 403) {
            return 'Forbidden';
        } elseif ($httpcode['http_code'] == 404) {
            return 'URL Not Found';
        } elseif ($httpcode['http_code'] == 405) {
            return 'Sorry! Not Allowed';
        } elseif ($httpcode['http_code'] == 406) {
            return 'Sorry! Not Acceptable';
        } elseif ($httpcode['http_code'] == 500) {
            return 'Internal Error! Contact Admin';
        } else {
            return $result;
        }
    }
}
