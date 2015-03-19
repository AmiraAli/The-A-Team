<?php

class Application_Model_Users extends Zend_Db_Table_Abstract
{
    protected $_name = "Users";
    
    
    function addUser($data){
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'] ;
        $row->image = $data['image'];
        $row->active = $data['active'];
        $row->type = $data['type'] ;
        $row->gender = $data['gender'];
        $row->country = $data['country'] ;
        $row->facebookid = $data['facebookid'] ;
        return $row->save();
    }
    
    function listUsers(){
        
        return $this->fetchAll()->toArray();
    }
   
    function getUserById($id){
        return $this->find($id)->toArray();
    }
    
    function getUserByType($type){
        $select =$this->select()->where('type = ?', $type);
        return $this->fetchAll($select)->toArray();
    }
    
   
    function editUser($data){
        if(!empty($data['password']))
            $data['password']=md5($data['password']);
        else
            unset ($data['password']);
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
   function editUserBy($where,$data){
       return $this->update($data, 'id=' . $where);
   }
    function deleteUser($id){
        return $this->delete("id=$id");
    }
    
    
    
    

}

