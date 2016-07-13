<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Blog\Model\Post;

/**
 * Description of PostFieldset
 *
 * @author jeremy
 */
class PostFieldset extends Fieldset {
    
    public function __construct($name = null, $options = array()) {
        
        parent::__construct($name, $options);
        
        $this->setObject(new Post());
        
        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'text',
            'options' => array(
                'label' => 'The Text'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Blog Title'
            )
        ));
        
    }


}