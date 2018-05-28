<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Form;

/**
 * Class UserLoginForm
 *
 * @package UserFrontend\Form
 */
class UserLoginForm extends AbstractUserForm
    implements UserLoginFormInterface
{
    /**
     * Init form
     */
    public function init()
    {
        $this->setName('user_login_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->addCsrfElement();
        $this->addEmailElement();
        $this->addPasswordElement();
        $this->addSubmitElement(
            'login_user', 'user_frontend_action_login'
        );

        $this->setValidationGroup(array_keys($this->getElements()));
    }
}
