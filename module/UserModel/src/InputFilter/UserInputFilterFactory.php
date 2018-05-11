<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserModel\InputFilter;

use UserModel\Config\UserConfigInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class UserInputFilterFactory
 *
 * @package UserModel\InputFilter
 */
class UserInputFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        /** @var UserConfigInterface $userConfig */
        $userConfig = $container->get(UserConfigInterface::class);

        $inputFilter = new UserInputFilter();
        $inputFilter->setStatusOptions(
            array_keys($userConfig->getStatusOptions())
        );
        $inputFilter->setRoleOptions(
            array_keys($userConfig->getRoleOptions())
        );

        return $inputFilter;
    }
}