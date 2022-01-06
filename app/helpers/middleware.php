<?php

/*
*   This class responsible for handles permissions 
*   Provides the right access to the right data to the right user
*/
class MiddleWare{
    private function type($status){
        if($status === 1){
            return 1;
        }else{

        }
    }

    static function usersOnly(){
        $user = DataBase::selectOne('users', ['id' => $_SESSION['user_id']]);
        if($user['status'])
            return true;
        else
            return false;
    }
}




class Capsule {
    public function sidebar($userId){
        if($userId){
            
        }
    }
}

