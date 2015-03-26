<?php

class Application_Model_Users extends Zend_Db_Table_Abstract {

    protected $_name = "Users";

    function addUser($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        $row->image = $data['image'];
        $row->active = $data['active'];
        $row->type = $data['type'];
        $row->gender = $data['gender'];
        $row->country = $data['country'];
        $row->facebookid =NULL;
//        $row->twitterid =NULL;
        
        
        
        return $row->save();
    }
    function addUserByFacebook($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        $row->image = $data['image'];
        $row->active = $data['active'];
        $row->type = $data['type'];
        $row->gender = $data['gender'];
        $row->country = $data['country'];
        $row->facebookid =$data['facebookid'];
//        $row->googleid =NULL;
//        $row->twitterid =NULL;
        
        
        return $row->save();
    }
    function addUserByGoogle($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        $row->image = $data['image'];
        $row->active = $data['active'];
        $row->type = $data['type'];
        $row->gender = $data['gender'];
        $row->country = $data['country'];
//        $row->googleid =$data['googleid'];
        $row->facebookid =NULL;
//        $row->twitterid =NULL;
        
        
        return $row->save();
    }
    function addUserByTwitter($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        $row->image = $data['image'];
        $row->active = $data['active'];
        $row->type = $data['type'];
        $row->gender = $data['gender'];
        $row->country = $data['country'];
//        $row->twitterid =$data['twitterid'];
//        $row->googleid =NULL;
        $row->facebookid =NULL;
        
        
        return $row->save();
    }

    function listUsers() {

        return $this->fetchAll()->toArray();
    }

    function getUserById($id) {
        return $this->find($id)->toArray();
    }

    function getUserByType($type) {
        $select = $this->select()->where('type = ?', $type);
        return $this->fetchAll($select)->toArray();
    }

    
    function getUserByEmail($email){
        $select =$this->select()->where('email = ?', $email);
        return $this->fetchAll($select)->toArray();
    }
    
    function getUserByFacebookId($fbid){
        $select =$this->select()->where('facebookid = ?', $fbid);
        return $this->fetchAll($select)->toArray();
    }
    function getUserByname($name){
        $select =$this->select()->where('name = ?', $name);
        return $this->fetchAll($select)->toArray();
    }
   
    


    function editUser($data) {
        if (!empty($data['password'])){
            $data['password'] = md5($data['password']);
        }else{
             unset($data['password']);
        }
         ///////////////////////
        if (!empty($data['facebookid'])){
            $data['facebookid'] = md5($data['facebookid']);
        }else{
             unset($data['facebookid']);
        }
//         if (!empty($data['googleid'])){
//            $data['googleid'] = md5($data['googleid']);
//         }
//        }else{
//             unset($data['googleid']);
//        }
//         if (!empty($data['twitterid'])){
//            $data['twitterid'] = md5($data['twitterid']);
//        }else{
//             unset($data['twitterid']);
//        }
        //////////////////////////////////
        if (!empty($data['email'])){
            $data['email'] = $data['email'];
        }else{
             unset($data['email']);
        }
        
        if (!empty($data['image'])) {
            $data['image'] = $data['image'];
        } else {
            unset($data['image']);
        }
        
        
        
        $this->update($data, "id=" . $data['id']);

        return $this->fetchAll()->toArray();
    }
//function ahmededit($data){
//    $mydata=  $this->fetchAll()->toArray();
//    
//    if($mydata['email']!==$data['email']){
//        $newdata['email']=$data['email'];
//    }
    
    
//}
    
    function editUserBy($where, $data) {
        return $this->update($data, 'id=' . $where);
    }

    function deleteUser($id) {
        return $this->delete("id=$id");
    }

}
