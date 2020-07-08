<?php

/*
// https://stackoverflow.com/questions/325806/best-way-to-obtain-a-lock-in-php

CLASS Lock
Description
==================================================================
This is a pseudo implementation of mutex since php does not have
any thread synchronization objects
This class uses flock() as a base to provide locking functionality.
Lock will be released in following cases
1 - user calls unlock
2 - when this lock object gets deleted
3 - when request or script ends
==================================================================
Usage:

//get the lock
$Locker = new \Locker\Lock("mylock");

//lock
if(!$Locker->lock())
    error("Locking failed");
//--
//Do your work here
//--

//unlock
$Locker->unlock();
===================================================================
*/

namespace Locker;

class Lock{
    protected $key   = null;  //user given value
    protected $file  = null;  //resource to lock
    protected $own   = FALSE; //have we locked resource

    public function __construct($key){
        $this->key = $key;

        $this->file = fopen(dirname(__FILE__).'/../locks/'.$key.'.pid', 'w+');
    }


    public function __destruct(){
        if($this->own == TRUE)
            $this->unlock();
    }

    public function lock(){
        if($this->isLocked()){
            error_log("ExclusiveLock::acquire_lock FAILED to acquire lock [".$this->key."]");
            return FALSE;
        }

        ftruncate($this->file, 0);
        fwrite($this->file, $this->createToken());
        fflush($this->file);

        $this->own = TRUE;
        return TRUE;
    }

    public function unlock(){
        if($this->own == TRUE){
            if(!flock($this->file, LOCK_UN)){
                error_log("ExclusiveLock::lock FAILED to release lock [".$this->key."]");
                return FALSE;
            }

            ftruncate($this->file, 0);
            fwrite($this->file, "");
            fflush($this->file);

            $this->own = FALSE;
        }else{
            error_log("ExclusiveLock::unlock called on [$key] but its not acquired by caller");
        }

        return TRUE;
    }

    public function isLocked(){
        if(!flock($this->file, LOCK_EX | LOCK_NB)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    protected function createToken() {
        return getmypid() .':'. (microtime(true)*10000) .':'. mt_rand(1, 9999);
    }
}