<?php
namespace GoodSystem\TestPackage;
/**
 * Created by PhpStorm.
 * User: moses
 * Date: 15/10/17
 * Time: 4:59 PM
 */
//namespace Models\Mossey\Mpesa;
/**
 * Class Mpesa
 * @package Mossey\Mpesa
 */
class Mpesa
{// Do I implement this as a service. 2020 Jul 27
//Implement as a package and use a service provider.
    /**
     * @return mixed
     */
    public static function generateToken(){
        $consumer_key=env("consumer_key");
        $consumer_secret=env("consumer_secret");
        if(!isset($consumer_key)||!isset($consumer_secret)){
            die("please declare the consumer key and consumer secret as defined in the documentation");
        }
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($consumer_key.':'.$consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = curl_exec($curl);
        return json_decode($curl_response)->access_token;
    }
    /**
     * @param $CommandID
     * @param $Initiator
     * @param $SecurityCredential
     * @param $TransactionID
     * @param $Amount
     * @param $ReceiverParty
     * @param $RecieverIdentifierType
     * @param $ResultURL
     * @param $QueueTimeOutURL
     * @param $Remarks
     * @param $Occasion
     */
    public static function reversal($CommandID, $Initiator, $SecurityCredential, $TransactionID, $Amount, $ReceiverParty, $RecieverIdentifierType, $ResultURL, $QueueTimeOutURL, $Remarks, $Occasion){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
        $token=self::generateToken();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken())); //setting custom header
        $curl_post_data = array(
            'CommandID' => $CommandID,
            'Initiator' => $Initiator,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'TransactionID' => $TransactionID,
            'Amount' => $Amount,
            'ReceiverParty' => $ReceiverParty,
            'RecieverIdentifierType' => $RecieverIdentifierType,
            'ResultURL' => $ResultURL,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'Remarks' => $Remarks,
            'Occasion' => $Occasion
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return json_decode($curl_response);
    }
    /**
     * @param $ShortCode
     * @param $CommandID
     * @param $Amount
     * @param $Msisdn
     * @param $BillRefNumber
     * @return mixed
     */
    public  static  function  b2c( $ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber ){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken()));
        $curl_post_data = array(
            'ShortCode' => $ShortCode,
            'CommandID' => $CommandID,
            'Amount' => $Amount,
            'Msisdn' => $Msisdn,
            'BillRefNumber' => $BillRefNumber
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
    /**
     * @param $CommandID
     * @param $Initiator
     * @param $SecurityCredential
     * @param $PartyA
     * @param $IdentifierType
     * @param $Remarks
     * @param $QueueTimeOutURL
     * @param $ResultURL
     */
    //The static functions should not be executed out of this class.
    public static function accountBalance($CommandID, $Initiator, $SecurityCredential, $PartyA, $IdentifierType, $Remarks, $QueueTimeOutURL, $ResultURL){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken())); //setting custom header
        $curl_post_data = array(
            'CommandID' => $CommandID,
            'Initiator' => $Initiator,
            'SecurityCredential' => $SecurityCredential,
           // 'CommandID' => $CommandID,
            'PartyA' => $PartyA,
            'IdentifierType' => $IdentifierType,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL//result url data json decoded is the best output for this function
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
    /**
     * @param $Initiator
     * @param $SecurityCredential
     * @param $CommandID
     * @param $TransactionID
     * @param $PartyA
     * @param $IdentifierType
     * @param $ResultURL
     * @param $QueueTimeOutURL
     * @param $Remarks
     * @param $Occasion
     */
    public function transactionStatus($Initiator, $SecurityCredential, $CommandID, $TransactionID, $PartyA, $IdentifierType, $ResultURL, $QueueTimeOutURL, $Remarks, $Occasion){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken())); //setting custom header
        $curl_post_data = array(
            'Initiator' => $Initiator,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'TransactionID' => $TransactionID,
            'PartyA' => $PartyA,
            'IdentifierType' => $IdentifierType,
            'ResultURL' => $ResultURL,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'Remarks' => $Remarks,
            'Occasion' => $Occasion
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
    /**
     * @param $Initiator
     * @param $SecurityCredential
     * @param $Amount
     * @param $PartyA
     * @param $PartyB
     * @param $Remarks
     * @param $QueueTimeOutURL
     * @param $ResultURL
     * @param $AccountReference
     * @param $commandID
     * @param $SenderIdentifierType
     * @param $RecieverIdentifierType
     * @return mixed
     */
    public function b2b($Initiator, $SecurityCredential, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $AccountReference, $commandID, $SenderIdentifierType, $RecieverIdentifierType){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken())); //setting custom header
        $curl_post_data = array(
            'Initiator' => $Initiator,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $commandID,
            'SenderIdentifierType' => $SenderIdentifierType,
            'RecieverIdentifierType' => $RecieverIdentifierType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'AccountReference' => $AccountReference,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
    /**
     * @param $BusinessShortCode
     * @param $LipaNaMpesaPasskey
     * @param $TransactionType
     * @param $Amount
     * @param $PartyA
     * @param $PartyB
     * @param $PhoneNumber
     * @param $CallBackURL
     * @param $AccountReference
     * @param $TransactionDesc
     * @param $Remark
     */
     ///use Illuminate\Support\Arr;
      //
      //$array = [
      //    ['developer' => ['id' => 1, 'name' => 'Taylor']],
      //    ['developer' => ['id' => 2, 'name' => 'Abigail']],
      //];
      //
      //$names = Arr::pluck($array, 'developer.name');
    public function STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remark){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $timestamp='20'.date("ymdhis");// have a date service implemented 2020 July 27
        $password=base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken()));
        $curl_post_data = array(
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' => $PhoneNumber,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionType,
            'Remark'=> $Remark
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response=curl_exec($curl);
        return $curl_response;
    }
    /**
     * @param $checkoutRequestID
     * @param $businessShortCode
     * @param $password
     * @param $timestamp
     * @return mixed
     */
    public static function STKPushQuery($checkoutRequestID, $businessShortCode, $password, $timestamp){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.self::generateToken())); //setting custom header
        $curl_post_data = array(
            'BusinessShortCode' => $businessShortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'CheckoutRequestID' => $checkoutRequestID
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
    /**
     * @return string
     */
    public function confirm(){// Better to have the result from the urls rather than
        //hard coding.
        $resultArray=[
            "ResultDesc"=>"Confirmation Service request accepted successfully",
            "ResultCode"=>"0"
        ];
        header('Content-Type: application/json');
        echo json_encode($resultArray);
    }
    public function validate(){
        $resultArray=[
            "ResultDesc"=>"Confirmation Service request accepted successfully",
            "ResultCode"=>"0"
        ];
        header('Content-Type: application/json');
        echo json_encode($resultArray);
    }
    /**
     * @return string
     */
    public function decline(){
        $resultArray=[
            "ResultDesc"=>"Confirmation Service request declined",
            "ResultCode"=>"1"
        ];
        header('Content-Type: application/json');
        echo json_encode($resultArray);
    }
}