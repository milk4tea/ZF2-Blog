<?php
namespace Blog\Model;

/**
 *
 * @author jeremy
 */
interface PostInterface {
    public function getId();
    public function setId($id);
    public function getText();
    public function setText($text);
    public function getTitle();
    public function setTitle($title);
}
