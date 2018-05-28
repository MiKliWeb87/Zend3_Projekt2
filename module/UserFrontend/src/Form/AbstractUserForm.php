<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class AbstractUserForm
 *
 * @package UserFrontend\Form
 */
abstract class AbstractUserForm extends Form
{
    /**
     * Add new csrf element
     */
    protected function addCsrfElement()
    {
        $this->add(
            [
                'type' => Csrf::class,
                'name' => 'csrf',
            ]
        );
    }

    /**
     * Add new email element
     */
    protected function addEmailElement()
    {
        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'email',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'user_frontend_label_email',
                ],
            ]
        );
    }

    /**
     * Add new password element
     */
    protected function addPasswordElement()
    {
        $this->add(
            [
                'type'       => Password::class,
                'name'       => 'password',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'user_frontend_label_password',
                ],
            ]
        );
    }

    /**
     * Add new submit element
     *
     * @param $submitName
     * @param $submitText
     */
    protected function addSubmitElement($submitName, $submitText)
    {
        $this->add(
            [
                'type'       => Submit::class,
                'name'       => $submitName,
                'options'    => [],
                'attributes' => [
                    'id'    => $submitName,
                    'class' => 'btn btn-primary',
                    'value' => $submitText,
                ],
            ]
        );
    }
}
