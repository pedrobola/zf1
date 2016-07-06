<?php

class Album_Form_AlbumForm extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an title element
        $this->addElement('text', 'title', array(
            'label'      => 'Title:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
            	array(
            		'validator' => 'NotEmpty',
            		'options' => array(
            			'messages' => 'Campo obrigatório'
            		)
            	)
            )
        ));
        
        // Add an artist element
        $this->addElement('text', 'artist', array(
            'label'      => 'Artist:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
            	array(
            		'validator' => 'NotEmpty',
            		'options' => array(
            			'messages' => 'Campo obrigatório'
            		)
            	)
            )
        ));

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Por favor, informe as 5 letras abaixo:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Image',
                'wordLen' => 5,
                'timeout' => 300,
            	'width' => 200,
            	'height' => 160,
            	'fontSize' => 35,
            	'dotNoiseLevel' => 3,
            	'lineNoiseLevel' => 3,
            	'imgDir' => 'captcha/',
            	'imgUrl' => '/captcha/',
            	'font' => 'fonts/vds_new.ttf',
            	'messages' => array(
            		'badCaptcha' => 'Você digitou as letras erradas'
            	)
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' 	=> true,
            'label' 	=> 'Cadastrar',
        	'class' 	=> 'btn btn-success'
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        	'errorMessages' => array(
            	'notSame' => 'Token diferente do esperado',
        		'missingToken' => 'Token não encontrado'
            )
        ));
    }
}
