<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */


return [
    'status_options' => [
        'new'      => 'user_model_option_status_new',
        'approved' => 'user_model_option_status_approved',
        'blocked'  => 'user_model_option_status_blocked',
    ],
    'role_options'   => [
        'travelcenter' => 'user_model_option_role_travelcenter',
        'admin'   => 'user_model_option_role_admin',
    ],
];
