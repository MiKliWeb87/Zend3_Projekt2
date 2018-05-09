<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Form;

use Zend\Form\FormInterface;

/**
 * Interface TravelCenterFormInterface
 *
 * @package TravelCenterBackend\Form
 */
interface TravelCenterFormInterface extends FormInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * Switch to add mode
     */
    public function addMode();

    /**
     * Switch to edit mode
     */
    public function editMode();

    /**
     * Add logo file upload filter to input filter
     */
    public function addLogoFileUploadFilter();
}
