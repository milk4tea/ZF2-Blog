<?php
namespace Blog\Model;

/**
 * Description of Post
 *
 * @author jeremy
 */
class Post implements PostInterface {
    protected $id;
    protected $title;
    protected $text;

    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

}
