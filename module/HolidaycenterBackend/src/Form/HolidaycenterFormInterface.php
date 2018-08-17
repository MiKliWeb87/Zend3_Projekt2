<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Form;

use Zend\Form\FormInterface;

/**
 * Interface HolidaycenterFormInterface
 *
 * @package HolidaycenterBackend\Form
 */
interface HolidaycenterFormInterface extends FormInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * Switch to add mode
     */
    public function addMode(); //übernehmen?

    /**
     * Switch to edit mode
     */
    public function editMode();

    /**
     * Add logo file upload filter to input filter
     */
    public function addLogoFileUploadFilter();
}
