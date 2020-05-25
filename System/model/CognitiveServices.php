<?php

require_once 'HTTP/Request2.php';
require_once 'FacesServiceDB.php';
require_once ROOT_PATH . 'config.php';

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
        if($service_type == 1 || $service_type == 4){//persongroups and train
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
        }else if($service_type == 3){//persistedFaces
                $d["json_response"] = $data["json_response"];
                $d["id_service_type"] = $service_type;
                $d["id_person"] = $data["id_person"];
                $d["id_image"] = $data["id_image"];
                $d["id_take_group_photo"] = null;
                $d["id_company"] = $data["id_company"];
                $d["last_user"]= $data["last_user"];
        }else if($service_type == 5 || $service_type == 6){//detect and identify
                $d["json_response"] = $data["json_response"];
                $d["id_service_type"] = $service_type;
                $d["id_person"] = null;
                $d["id_image"] = $data["id_image"];
                $d["id_take_group_photo"] = $data["id_take_group_photo"];
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
            self::insertResponse($data, 2);
            return array("id"=>-2,"error"=>$ex);
        }        
    }
    
    // 3. Person group members photos
    static public function getPersonGroupMemberPhoto($ocpApimSubscriptionKey, $person_group_id, $data) {
        // Photos
        $photo[0] = VIEW_PHOTOS_URL.$data["photo_1"];
        $photo[1] = VIEW_PHOTOS_URL.$data["photo_2"];
        $photo[2] = VIEW_PHOTOS_URL.$data["photo_3"];    
        //print_r($photo);        
        //Api(Face)
        $request = new Http_Request2(self::$uriBase . '/persongroups/'.$person_group_id.'/persons/'.$data["person_id"].'/persistedFaces?detectionModel=detection_01');
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
        $messages = array();
        for($i=0; $i < 3; $i++){
            //Body
            $body = json_encode(array('url' => $photo[$i]));
            $request->setBody($body);
            //Response
            try
            {
                $response = $request->send();
                //echo "<pre class='border rounded'>" . json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre><br/>";
                $json = json_decode($response->getBody());
                
                if(!isset($json->error)){                
                    $data["json_response"] = json_encode($json);
                    $data["id_image"] = $data["photo_".($i+1)];
                    self::insertResponse($data, 3);
                    $messages[$i] = array("ok"=>1,"error"=>"");
                } else{
                    $data["json_response"] = json_encode($json);
                    $data["id_image"] = $data["photo_".($i+1)];
                    self::insertResponse($data, 3);
                    $messages[$i] = array("ok"=>0,"error"=>"Error en el servicio Faces Photo, ver el log.");  
                }
            }
            catch (HttpException $ex)
            {
                //echo "<pre class='border rounded'>" . $ex . "</pre><br/>";
                $data["json_response"] = json_encode($ex);
                self::insertResponse($data, 3);
                $messages[$i] = array("ok"=>0,"error"=>$ex);                
            }
        }
        return $messages;
    }
    
    // 4. Train
    static public function getPersonGroupTrain($ocpApimSubscriptionKey, $person_group_id, $data) {   
        //Api Face
        $request = new Http_Request2(self::$uriBase . '/persongroups/'.$person_group_id.'/train');
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
        try
        {
            $response = $request->send();
            //echo "<pre class='border rounded'>" . json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
            $json = json_decode($response->getBody());
            if($json == null){
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 4);
                return array("ok"=>1,"error"=>"");                
            }else{
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 4);
                return array("ok"=>0,"error"=>"Error al ejecutar el servicio de train.");
            }
        }
        catch (HttpException $ex)
        {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            $data["json_response"] = json_encode($ex);
            self::insertResponse($data, 4);
            return array("ok"=>0,"error"=>$ex); 
        }        
    }
    
    // 5. Faces detection
    static public function getDetection($ocpApimSubscriptionKey, $data) {   
        $imageUrl = VIEW_PHOTOS_URL . $data["id_image"];

        //Api Face Detect
        $request = new Http_Request2(self::$uriBase . '/detect');
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
        $body = json_encode(array('url' =>$imageUrl));
        $request->setBody($body);
        //Response
        try
        {
            $response = $request->send();
            $json = json_decode($response->getBody());
            $elements = array();
            if(!isset($json->error)){ 
                foreach($json as $elem){
                    // Detect emotion
                    $emotion = ($elem->faceAttributes)->emotion;
                    $faceId_emotion_name = "";
                    $faceId_emotion_value = 0;
                    if(floatval($emotion->anger) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "anger";
                        $faceId_emotion_value = $emotion->anger;
                    }
                    if(floatval($emotion->contempt) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "contempt";
                        $faceId_emotion_value = $emotion->contempt;
                    }
                    if(floatval($emotion->disgust) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "disgust";
                        $faceId_emotion_value = $emotion->disgust;                        
                    }
                    if(floatval($emotion->fear) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "fear";
                        $faceId_emotion_value = $emotion->fear;                        
                    }
                    if(floatval($emotion->happiness) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "happiness";
                        $faceId_emotion_value = $emotion->happiness;                        
                    }
                    if(floatval($emotion->neutral) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "neutral";
                        $faceId_emotion_value = $emotion->neutral;                        
                    }
                    if(floatval($emotion->sadness) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "sadness";
                        $faceId_emotion_value = $emotion->sadness;                        
                    }
                    if(floatval($emotion->surprise) > floatval($faceId_emotion_value)){
                        $faceId_emotion_name = "surprise";
                        $faceId_emotion_value = $emotion->surprise;                        
                    }
                    // Final response
                    $elements[] = array("faceid"=>$elem->faceId,"emotion"=>$faceId_emotion_name,"value"=>$faceId_emotion_value);
                }
                //echo "<pre class='border rounded'>" . json_encode($array, JSON_PRETTY_PRINT) . "</pre>";
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 5);
                return array("facesids"=>$elements,"error"=>"");                   
               }else{
                    $data["json_response"] = json_encode($json);
                    self::insertResponse($data, 5);
                    return array("facesids"=>0,"error"=>"Revisar log para ver la causa del error.");                            
               }
        }
        catch (HttpException $ex)
        {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            $data["json_response"] = json_encode($ex);
            self::insertResponse($data, 5);
            return array("facesids"=>0,"error"=>$ex); 
        }
    }    
    
    // 6. Faces identify
    static public function getPersonGroupIdentify($ocpApimSubscriptionKey, $person_group_id, $data) {          
        //Api Face 
        $request = new Http_Request2(self::$uriBase . '/identify');
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
        $body = json_encode(array('personGroupId' => $person_group_id, 'faceIds' => $data["faceIds"]));
        $request->setBody($body);
        //Response
        try
        {
            $response = $request->send();
            $json = json_decode($response->getBody());    
            //echo "<pre class='border rounded'>" . json_encode($array, JSON_PRETTY_PRINT) . "</pre><br/>";
            $report = array();
            if(!isset($json->error)){ 
                foreach($json as $elem){
                    $faceid = $elem->faceId;
                    $objs = $elem->candidates;
                    foreach($objs as $obj){
                        $report[] = array("faceid"=>$faceid,"personid"=>$obj->personId, "confidence"=>$obj->confidence);
                    }
                }
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 6);
                return array("personids"=>$report,"error"=>"");
            } else{
                $data["json_response"] = json_encode($json);
                self::insertResponse($data, 6);
                return array("personids"=>0,"error"=>"Revisar log para ver la causa del error. ");
            }
        }
        catch (HttpException $ex)
        {
            //echo "<pre class='border rounded'>" . $ex . "</pre>";
            $data["json_response"] = json_encode($ex);
            self::insertResponse($data, 6);
            return array("personids"=>0,"error"=>$ex);             
        }
    }
}

?>
