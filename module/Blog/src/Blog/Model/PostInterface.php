<?php
namespace Blog\Model;

/**
 *
 * @author jeremy
 */
interface PostInterface {
    /**
     * @return int 
     */
    public function getId();
    
    /**
     * @return string 
     */
    public function getTitle();
    
    /**
     * @return string
     */
    public function getText();
}
