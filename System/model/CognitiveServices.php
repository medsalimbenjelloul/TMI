<?php

require_once 'HTTP/Request2.php';

class CognitiveServices {    
    // for a random string name
    static private $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
    static private $permitted_digits = '0123456789';
    
    // Generate random string name
    private static function generate_string($input, $strength = 10) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    
    // 1. Person group 
    static public function getPersonGroup($ocpApimSubscriptionKey, $id_company) {
        //Endpoint url
        $uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';
        $personGroupId = self::generate_string(self::$permitted_chars) . self::generate_string(self::$permitted_digits)."_".$id_company;
        //Face Detect
        $request = new Http_Request2($uriBase . '/persongroups/' . $personGroupId);
        $url = $request->getUrl();
        //Headers
        $headers = array(
            // Request headers
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
        );
        $request->setHeader($headers);
        //Parameters
        $parameters = array(
            // Request parameters
            'returnFaceId' => 'true',
            'returnFaceLandmarks' => 'false',
            'returnFaceAttributes' => 'age,gender,headPose,smile,facialHair,glasses,' .
            'emotion,hair,makeup,occlusion,accessories,blur,exposure,noise');
        $url->setQueryVariables($parameters);
        //Post Method
        $request->setMethod(HTTP_Request2::METHOD_PUT);
        //Body
        $body = json_encode(array('name' => 'TmiTestName'));
        $request->setBody($body);
        //Repuesta
        try {
            $response = $request->send();
            $json = json_decode($response->getBody()); 
            
            if($json == null){
                return array("id"=>$personGroupId,"error"=>"");
            }else{
            //echo "<pre class='border rounded'>" . json_encode($json, JSON_PRETTY_PRINT) . "</pre>";
                return array("id"=>-1,"error"=>json_encode($json));
            }
        } catch (HttpException $ex) {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            return array("id"=>-2,"error"=>$ex);
        }
    }

}

?>
