<?php

class WebUser extends CWebUser {

    //protected $id;
    public function getRole() {
            return User::model()->find('id=:id', array(':id'=>$this->id))->role;
    }
}
?>
