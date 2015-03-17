<?php

class Application_Model_Materials extends Zend_Db_Table_Abstract {

    protected $_name = 'Materials';

    function insertMaterial($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->downloadable = $data['downloadable'];
        $row->path = $data['path'];
        $row->no_downloads = $data['no_downloads'];
        $row->Type_Id = $data['Type_Id'];
        $row->Course_Id = $data['Course_Id'];

        return $row->save();
    }

    function deleteMaterialById($where) {
        return $this->delete('id=' . $where);
    }
    function deleteMaterialByName($where) {
        return $this->delete("name= '$where'");
    }

    function updateMaterial($where, $data) {
        return $this->update($data, 'id=' . $where);
    }
    

    function selectAllMatreials() {
        return $this->fetchAll()->toArray();
    }

    function selectMaterialById($where) {
        return $this->fetchAll('id=' . $where)->toArray();
    }
     function selectMaterialByName($where) {
        return $this->fetchAll("name= '$where'")->toArray();
    }

}
