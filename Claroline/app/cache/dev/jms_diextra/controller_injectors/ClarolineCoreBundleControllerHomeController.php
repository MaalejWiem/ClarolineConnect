<?php

namespace Claroline\CoreBundle\Controller;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class HomeController__JMSInjector
{
    public static function inject($container) {
        require_once '/home/jenkins/jobs/Release/workspace/app/cache/dev/jms_diextra/proxies/Claroline-CoreBundle-Controller-HomeController.php';
        $a = new \JMS\AopBundle\Aop\InterceptorLoader($container, array('Claroline\\CoreBundle\\Controller\\HomeController' => array('typesAction' => array(0 => 'security.access.method_interceptor'), 'createAction' => array(0 => 'security.access.method_interceptor'), 'updateAction' => array(0 => 'security.access.method_interceptor'), 'reorderAction' => array(0 => 'security.access.method_interceptor'), 'deleteAction' => array(0 => 'security.access.method_interceptor'), 'createTypeAction' => array(0 => 'security.access.method_interceptor'), 'deletetypeAction' => array(0 => 'security.access.method_interceptor'), 'contentToRegionAction' => array(0 => 'security.access.method_interceptor'))));
        $instance = new \EnhancedProxybafd91b3_a232afb78673de2599888a2e581d6374bc48073b\__CG__\Claroline\CoreBundle\Controller\HomeController($container->get('claroline.manager.home_manager', 1), $container->get('request', 1), $container->get('security.context', 1), $container->get('templating', 1), $container->get('claroline.common.home_service', 1));
        $instance->__CGInterception__setLoader($a);
        return $instance;
    }
}
