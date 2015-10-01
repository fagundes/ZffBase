<?php

return array(
    'router' => array(
        'router_class' => 'Zff\Base\Mvc\Router\ControllerRouteStack',
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'zff-base'         => __DIR__ . '/../view',
        ),
        'template_map' => array(
            //configura alguns partials/elements muito usados
            'element/message'    => __DIR__ . '/../view/base/element/message.phtml',
            'element/breadcrumb' => __DIR__ . '/../view/base/element/breadcrumb.phtml',
            'element/paginator' => __DIR__ . '/../view/base/element/paginator.phtml',
        ),
    ),
);
