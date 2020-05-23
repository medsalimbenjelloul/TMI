<?php
require_once 'Assistance.php';
require_once 'lib/database/DB.php';

class AssistanceDB extends DB{
    
    //Methods
    public function getDataBy( $param = array(), $by = 1 ){ // 1=session, 2=user
        $data=array();
        try{
            $sql = "SELECT 	a.id_event, a.id_session, a.id_company, a.id_user, a.id_role, a.detail, 
                                a.group_photo_1, a.group_photo_2, a.group_photo_3, 
                                a.emotion_1, a.emotion_2, a.emotion_3, 
                                a.previus_assistance_status_1, a.previus_assistance_status_2, a.previus_assistance_status_3, 
                                a.final_assistance_status, a.last_update, a.last_user, a.was_deleted,
                                i1.name as image_name1, i1.path as image_path1,
                                i2.name as image_name2, i2.path as image_path2,
                                i3.name as image_name3, i3.path as image_path3,
                                et1.name as emotion_name1, et2.name as emotion_name2, et3.name as emotion_name3,
                                as1.name as status1, as2.name as status2, as3.name as status3, asf.name as final_status
                    FROM 	assistance a
                                left join take_group_photo tgp1 on a.group_photo_1 = tgp1.id_take_group_photo and tgp1.was_deleted = 0
                                left join take_group_photo tgp2 on a.group_photo_2 = tgp2.id_take_group_photo and tgp2.was_deleted = 0
                                left join take_group_photo tgp3 on a.group_photo_3 = tgp3.id_take_group_photo and tgp3.was_deleted = 0
                                left join image i1 on tgp1.id_image = i1.id_image and i1.was_deleted = 0
                                left join image i2 on tgp2.id_image = i2.id_image and i2.was_deleted = 0
                                left join image i3 on tgp3.id_image = i3.id_image and i3.was_deleted = 0
                                left join assistance_status as1 on a.previus_assistance_status_1 = as1.id_assistance_status and as1.was_deleted = 0
                                left join assistance_status as2 on a.previus_assistance_status_2 = as2.id_assistance_status and as2.was_deleted = 0
                                left join assistance_status as3 on a.previus_assistance_status_3 = as3.id_assistance_status and as3.was_deleted = 0
                                left join emotion_type et1 on a.emotion_1 = et1.id_emotion_type and et1.was_deleted = 0
                                left join emotion_type et2 on a.emotion_2 = et2.id_emotion_type and et2.was_deleted = 0
                                left join emotion_type et3 on a.emotion_3 = et3.id_emotion_type and et3.was_deleted = 0
                                left join assistance_status asf on a.final_assistance_status = asf.id_assistance_status and asf.was_deleted = 0
                    WHERE	a.was_deleted = 0 
                                and a.id_event = :id_event
                                and a.id_company = :id_company
                                and a.id_session = :id_session                                
                                ";
            if($by==2){
                $sql = $sql . "and a.id_user = :id_user";
            }
            
            $result = $this->executeSelect($sql, $param );            
            foreach($result as $row){
                $data[] = new Company($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    public function searchData( $param ){        
        try{
            $sql = "SELECT 	a.id_event, a.id_session, a.id_company, a.id_user, a.id_role, a.detail, 
                                a.group_photo_1, a.group_photo_2, a.group_photo_3, 
                                a.emotion_1, a.emotion_2, a.emotion_3, 
                                a.previus_assistance_status_1, a.previus_assistance_status_2, a.previus_assistance_status_3, 
                                a.final_assistance_status, a.last_update, a.last_user, a.was_deleted,
                                i1.name as image_name1, i1.path as image_path1,
                                i2.name as image_name2, i2.path as image_path2,
                                i3.name as image_name3, i3.path as image_path3,
                                et1.name as emotion_name1, et2.name as emotion_name2, et3.name as emotion_name3,
                                as1.name as status1, as2.name as status2, as3.name as status3, asf.name as final_status
                    FROM 	assistance a
                                left join take_group_photo tgp1 on a.group_photo_1 = tgp1.id_take_group_photo and tgp1.was_deleted = 0
                                left join take_group_photo tgp2 on a.group_photo_2 = tgp2.id_take_group_photo and tgp2.was_deleted = 0
                                left join take_group_photo tgp3 on a.group_photo_3 = tgp3.id_take_group_photo and tgp3.was_deleted = 0
                                left join image i1 on tgp1.id_image = i1.id_image and i1.was_deleted = 0
                                left join image i2 on tgp2.id_image = i2.id_image and i2.was_deleted = 0
                                left join image i3 on tgp3.id_image = i3.id_image and i3.was_deleted = 0
                                left join assistance_status as1 on a.previus_assistance_status_1 = as1.id_assistance_status and as1.was_deleted = 0
                                left join assistance_status as2 on a.previus_assistance_status_2 = as2.id_assistance_status and as2.was_deleted = 0
                                left join assistance_status as3 on a.previus_assistance_status_3 = as3.id_assistance_status and as3.was_deleted = 0
                                left join emotion_type et1 on a.emotion_1 = et1.id_emotion_type and et1.was_deleted = 0
                                left join emotion_type et2 on a.emotion_2 = et2.id_emotion_type and et2.was_deleted = 0
                                left join emotion_type et3 on a.emotion_3 = et3.id_emotion_type and et3.was_deleted = 0
                                left join assistance_status asf on a.final_assistance_status = asf.id_assistance_status and asf.was_deleted = 0
                    WHERE	a.was_deleted = 0 
                                and a.id_event = :id_event
                                and a.id_session = :id_session
                                and a.id_company = :id_company
                                and a.id_user = :id_user
                                and a.id_role = :id_role";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Assistance($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO assistance(id_event, id_session, id_company, id_user, id_role, detail, 
                    group_photo_1, group_photo_2, group_photo_3, emotion_1, emotion_2, emotion_3, 
                    previus_assistance_status_1, previus_assistance_status_2, previus_assistance_status_3, 
                    final_assistance_status, last_update, last_user, was_deleted)
                VALUES(:id_event, :id_session, :id_company, :id_user, :id_role, :detail, 
                    :group_photo_1, :group_photo_2, :group_photo_3, :emotion_1, :emotion_2, :emotion_3, 
                    :previus_assistance_status_1, :previus_assistance_status_2, :previus_assistance_status_3, 
                    :final_assistance_status, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE assistance
                SET detail = :detail, 
                    group_photo_1 = :group_photo_1, group_photo_2 = :group_photo_2, 
                    group_photo_3 = :group_photo_3, emotion_1 = :emotion_1, emotion_2 = :emotion_2, emotion_3 = :emotion_3, 
                    previus_assistance_status_1 = :previus_assistance_status_1, 
                    previus_assistance_status_2 = :previus_assistance_status_2, 
                    previus_assistance_status_3 = :previus_assistance_status_3, 
                    final_assistance_status = :final_assistance_status, 
                    last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE   id_event = :id_event
                        and id_session = :id_session
                        and id_company = :id_company
                        and id_user = :id_user
                        and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  assistance
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_event = :id_event
                        and id_session = :id_session
                        and id_company = :id_company
                        and id_user = :id_user
                        and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
        
}
?>