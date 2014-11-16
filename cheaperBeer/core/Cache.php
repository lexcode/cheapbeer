<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Cache {
    
    public $duration;
    public $dirname ;
    public $buffer ;
    
    
    public function __construct($dirname , $duration)
    {
        //echo $dirname ;
        $this->dirname=$dirname ;
        $this->duration=$duration ;
    }
    public function write($filename , $content){
        return file_put_contents($this->dirname.'/'.$filename,$content) ;
    }
    
    public function read($filename){
        
        $file= $this->dirname.'/'.$filename;
        if(!file_exists($file)){
            return false ;
        }
        $life =(time()- filemtime($file))/60;
        if($life>$this->duration){
            return false ;
        }
        return file_get_contents($file);
    }
    public function delete($filename){
        $file= $this->dirname.'/'.$filename;
        if(file_exists($file)){
            unlink($file);
        }
    }
    
    public function clear(){
        $files=glob($this->dirname.'/*');
        foreach( $files as $file){
            unlink($file);
        }
    }
    
    
    public function inc($file, $cachename = null){
        if(!$cachename){
            $cachename = basename($file);
        }
        $filename= basename($file);
        if($content = $this->read($cachename)){
            echo $content ;
            return true ;
        }
        ob_start();
        require $file;
        $content = ob_get_clean();
        $this->write($cachename, $content);
        echo $content;
        return true ;
    }
    
    
    public function start($cachename){
        if($content = $this->read($cachename)){
          echo $content;
          $this->buffer = false ;
          return true ;
        }
        ob_start();
        $this->buffer = $cachename;
    }
    
    
    public function end(){
        if(!$this->buffer){
            return false;
        }
        $content = ob_get_clean();
        echo $content ;
        $this->write($this->buffer,$content);
    }
    
        public function in($cachename){
         $file= $this->dirname.'/'.$cachename;
        if(file_exists($file)){
                $life =(time()- filemtime($file))/60;
                if($life>$this->duration){
                    return false ;
                }
                else
                {
                    return true ;
                }
            }
            else
            {
                return false ;
            }
        
    }
}