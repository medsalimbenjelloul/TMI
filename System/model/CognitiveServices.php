<?php

require_once 'HTTP/Request2.php';
require_once 'FacesServiceDB.php';

class CognitiveServices {    
    // for a random string name
    static private $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
    static private $permitted_digits = '0123456789';
    static private $uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';
    
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
    
    // Insert the response into database
    private static function insertResponse($data, $service_type=1) {
        $faces = new FacesServiceDB();
        if($service_type == 1){//persongroups
                $d["json_response"] = $data["json_response"];
                $d["id_service_type"] = $service_type;
                $d["id_person"] = null;
                $d["id_image"] = null;
                $d["id_take_group_photo"] = null;
                $d["id_company"] = $data["id_company"];
                $d["last_user"]= $data["last_user"];
        }else if($service_type == 2){//persons
                $d["json_response"] = $data["json_response"];
                $d["id_service_type"] = $service_type;
                $d["id_person"] = $data["id_person"];
                $d["id_image"] = null;
                $d["id_take_group_photo"] = null;
                $d["id_company"] = $data["id_company"];
                $d["last_user"]= $data["last_user"];
        }
        return $faces->insertData($d);
    }
    
    // 1. Person group 
    static public function getPersonGroup($ocpApimSubscriptionKey, $data) {//$id_company
        //Endpoint url
        $personGroupId = self::generate_string(self::$permitted_chars) . self::generate_string(self::$permitted_digits)."_".$data["id_company"];
        //Face Detect
        $request = new Http_Request2(self::$uriBase . '/persongroups/' . $personGroupId);
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
        //Response
        try {
            $response = $request->send();
            $json = json_decode($response->getBody()); 
            
            if($json == null){
                $data["json_response"] = json_encode($personGroupId);
                self::insertResponse($data, 1);
                return array("id"=>$personGroupId,"error"=>"");
            }else{
            //echo "<pre class='border rounded'>" . json_encode($json, JSON_PRETTY_PRINT) . "</pre>";
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 1);
                return array("id"=>-1,"error"=>json_encode($json));
            }
        } catch (HttpException $ex) {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            $data["json_response"] = json_encode($ex);
            self::insertResponse($data, 1);
            return array("id"=>-2,"error"=>$ex);
        }
    }

    // 2. Person group members
    static public function getPersonGroupMember($ocpApimSubscriptionKey, $person_group_id, $data) {
        // Name person
        $name = $data["username"]."_".$data["id_person"];        
        //API (Face Detect)
        $request = new Http_Request2(self::$uriBase . '/persongroups/'.$person_group_id.'/persons');
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
        $request->setMethod(HTTP_Request2::METHOD_POST);
        //Body
        $body = json_encode(array('name' => $name));
        $request->setBody($body);
        //Response
        try
        {
            $response = $request->send();
            $json = json_decode($response->getBody());
            $person = $json->personId;
            //echo "<pre class='border rounded'>" . json_encode($json, JSON_PRETTY_PRINT) . "</pre>";
            $data["json_response"] = json_encode($json);
            self::insertResponse($data, 2);
            return array("id"=>$person,"error"=>"");
        }
        catch (HttpException $ex)
        {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            $data["json_response"] = json_encode($ex);
            self::insertResponse($data, 1);
            return array("id"=>-2,"error"=>$ex);
        }        
    }
}

?>
