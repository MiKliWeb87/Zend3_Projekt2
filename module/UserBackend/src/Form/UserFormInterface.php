<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserBackend\Form;

use Zend\Form\FormInterface;

/**
 * Interface UserFormInterface
 *
 * @package UserBackend\Form
 */
interface UserFormInterface extends FormInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * @param array $roleOptions
     */
    public function setRoleOptions($roleOptions);

    /**
     * Switch to edit mode
     */
    public function editMode();
}
