<?php

namespace Claroline\CoreBundle\Controller;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class ResourcePropertiesController__JMSInjector
{
    public static function inject($container) {
        $instance = new \Claroline\CoreBundle\Controller\ResourcePropertiesController($container->get('claroline.form.factory', 1), $container->get('security.context', 1), $container->get('claroline.manager.resource_manager', 1), $container->get('request', 1), $container->get('claroline.event.event_dispatcher', 1));
        return $instance;
    }
}
