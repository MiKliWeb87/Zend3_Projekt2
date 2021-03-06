<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertBackend\Form;

use Zend\Form\FormInterface;

/**
 * Interface AdvertFormInterface
 *
 * @package AdvertBackend\Form
 */
interface AdvertFormInterface extends FormInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * @param array $typeOptions
     */
    public function setTypeOptions($typeOptions);

    /**
     * @param array $holidaycenterOptions
     */
    public function setHolidaycenterOptions($holidaycenterOptions);
	
	/**
     * Switch to add mode
     */
	//public function addMode(); //NEU
	
    /**
     * Switch to edit mode
     */
    public function editMode();
	
	/**
	 * NEU Add Image file upload filter to input filter
	 */
	public function addImageFileUploadFilter(); 
}
