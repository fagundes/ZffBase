<?php

namespace Zff\Base;

return [
    'router'          => [
        'router_class' => Mvc\Router\ControllerRouteStack::class,
    ],
    'view_manager'    => [
        'template_path_stack' => [
            'zff-base' => __DIR__ . '/../view',
        ],
        'template_map'        => [
            //configura alguns partials/elements muito usados
            'element/message'    => __DIR__ . '/../view/base/element/message.phtml',
            'element/breadcrumb' => __DIR__ . '/../view/base/element/breadcrumb.phtml',
            'element/paginator'  => __DIR__ . '/../view/base/element/paginator.phtml',
        ],
    ],
    'form_elements'   => [
        'invokables' => [
            'bstext'     => Form\Element\BsText::class,
            'bstextarea' => Form\Element\BsTextarea::class,
            'bsfile'     => Form\Element\BsFile::class,
            'bscheckbox' => Form\Element\BsCheckbox::class,
            'bsradio'    => Form\Element\BsRadio::class,
        ],
    ],
    'view_helpers'    => [
        'invokables' => [
            //form helpers
            'formactionbutton'       => Form\View\Helper\FormActionButton::class,
            'formmulticheckboxsplit' => Form\View\Helper\FormMultiCheckboxSplit::class,
            'formradiosplit'         => Form\View\Helper\FormRadioSplit::class,
            //escaper helpers
            'noescape'               => View\Helper\Escaper\NoEscape::class,
            //other helpers
            'getroute'               => View\Helper\GetRoute::class,
            'link'                   => View\Helper\Link::class,
            'paginatorlink'          => View\Helper\PaginatorLink::class,
            'postlink'               => View\Helper\PostLink::class,
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            Form\FormAbstractFactory::class,
            Form\InputFilterAbstractFactory::class,
            Service\ServiceAbstractFactory::class
        ],
    ],
];
