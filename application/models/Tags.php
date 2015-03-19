<?php
// no need for update tag its only a word 
class Application_Model_Tags extends Zend_Db_Table_Abstract {

    protected $_name = 'Tags';

    function insertTag($data) {
        $row = $this->createRow();
        $row->name = $data['name'];

        return $row->save();
    }

    function deleteTag($where) {
        return $this->delete('id=' . $where);
    }

    function selectAllTags() {
        return $this->fetchAll()->toArray();
    }

    function selectTag($where) {
        return $this->fetchAll('id='.$where)->toArray();
    }

}