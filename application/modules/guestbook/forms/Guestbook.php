<?php

class Guestbook_Form_Guestbook extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'E-mail:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
            	array(
            		'validator' => 'NotEmpty',
            		'options' => array(
            			'messages' => 'Campo obrigatório'
            		)
            	),
            	array(
                	'EmailAddress', true, array(
	                    'messages' => array(
	                    	'emailAddressInvalid' => 'E-mail inválido',
	                    	'emailAddressInvalidFormat' => "'%value%' Formato de e-mail inválido"
	                    )
	                )
                )
            )
        ));

        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label'      => 'Comentário:',
            'required'   => true,
        	'filters'    => array('StringTrim'),
            'validators' => array(
                array(
                	'validator' => 'StringLength', 
                	'options' => array(0, 20)
           		),
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
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300,
            	'messages' => array(
            		'badCaptcha' => 'Você digitou as letras erradas'
            	)
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Cadastrar',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        	'errorMessages' => array(
            	'notSame' => 'Token diferente do esperado',
        		'missingToken' => 'Token não encontrado',
            )
        ));
    }
}
