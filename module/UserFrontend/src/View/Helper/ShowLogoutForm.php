<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\View\Helper;

/**
 * Class ShowLogoutForm
 *
 * @package UserFrontend\View\Helper
 */
class ShowLogoutForm extends AbstractShowForm
{
    /**
     * Output the logout form
     *
     * @param string $formClass
     *
     * @return
     */
    public function __invoke($formClass = 'form-horizontal')
    {
        return $this->getView()->bootstrapForm(
            $this->getUserForm(), [], $formClass
        );
    }
}
