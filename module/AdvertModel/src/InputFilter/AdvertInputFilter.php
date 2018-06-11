<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\InputFilter;

use TravelloFilter\Filter\StringHtmlPurify;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Class AdvertInputFilter
 *
 * @package AdvertModel\InputFilter
 */
class AdvertInputFilter extends InputFilter
    implements AdvertInputFilterInterface
{
    /**
     * @var array
     */
    private $statusOptions;

    /**
     * @var array
     */
    private $typeOptions;

    /**
     * @var array
     */
    private $holidaycenterOptions;

    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions)
    {
        $this->statusOptions = $statusOptions;
    }

    /**
     * @param array $typeOptions
     */
    public function setTypeOptions($typeOptions)
    {
        $this->typeOptions = $typeOptions;
    }

    /**
     * @param array $holidaycenterOptions
     */
    public function setHolidaycenterOptions($holidaycenterOptions)
    {
        $this->holidaycenterOptions = $holidaycenterOptions;
    }

    /**
     * Init input filter
     */
    public function init()
    {
        $this->add(
            [
                'name'       => 'status',
                'required'   => true,
                'filters'    => [],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_status_missing',
                        ],
                    ],
                    [
                        'name'    => InArray::class,
                        'options' => [
                            'haystack' => $this->statusOptions,
                            'message'  => 'advert_model_message_status_invalid',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'type',
                'required'   => true,
                'filters'    => [],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_type_missing',
                        ],
                    ],
                    [
                        'name'    => InArray::class,
                        'options' => [
                            'haystack' => $this->typeOptions,
                            'message'  => 'advert_model_message_type_invalid',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'holidaycenter',
                'required'   => true,
                'filters'    => [],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_holidaycenter_missing',
                        ],
                    ],
                    [
                        'name'    => InArray::class,
                        'options' => [
                            'haystack' => $this->holidaycenterOptions,
                            'message'  => 'advert_model_message_holidaycenter_invalid',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'title',
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_title_missing',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 3,
                            'max'      => 64,
                            'message'  => 'advert_model_message_title_invalid',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'text',
                'required'   => true,
                'filters'    => [
                    ['name' => StringTrim::class],
                    ['name' => StringHtmlPurify::class],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_text_missing',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 200,
                            'message'  => 'advert_model_message_text_invalid',
                        ],
                    ],
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'location',
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'                   => NotEmpty::class,
                        'break_chain_on_failure' => true,
                        'options'                => [
                            'message' => 'advert_model_message_location_missing',
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => 3,
                            'max'      => 64,
                            'message'  => 'advert_model_message_location_invalid',
                        ],
                    ],
                ],
            ]
        );
    }
}
