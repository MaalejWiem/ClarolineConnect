<?php

namespace Claroline\CoreBundle\Controller;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class ResourceRightsController__JMSInjector
{
    public static function inject($container) {
        $instance = new \Claroline\CoreBundle\Controller\ResourceRightsController($container->get('claroline.manager.rights_manager', 1), $container->get('claroline.manager.mask_manager', 1), $container->get('request', 1), $container->get('security.context', 1), $container->get('claroline.manager.workspace_tag_manager', 1), $container->get('templating', 1), $container->get('claroline.manager.role_manager', 1), $container->get('claroline.persistence.object_manager', 1));
        return $instance;
    }
}
