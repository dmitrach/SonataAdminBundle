<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Sonata\AdminBundle\Twig\BreadcrumbsRuntime;
use Sonata\AdminBundle\Twig\CanonicalizeRuntime;
use Sonata\AdminBundle\Twig\Extension\BreadcrumbsExtension;
use Sonata\AdminBundle\Twig\Extension\CanonicalizeExtension;
use Sonata\AdminBundle\Twig\Extension\GroupExtension;
use Sonata\AdminBundle\Twig\Extension\IconExtension;
use Sonata\AdminBundle\Twig\Extension\RenderElementExtension;
use Sonata\AdminBundle\Twig\Extension\SecurityExtension;
use Sonata\AdminBundle\Twig\Extension\SonataAdminExtension;
use Sonata\AdminBundle\Twig\Extension\TemplateRegistryExtension;
use Sonata\AdminBundle\Twig\Extension\XEditableExtension;
use Sonata\AdminBundle\Twig\GroupRuntime;
use Sonata\AdminBundle\Twig\IconRuntime;
use Sonata\AdminBundle\Twig\RenderElementRuntime;
use Sonata\AdminBundle\Twig\SecurityRuntime;
use Sonata\AdminBundle\Twig\SonataAdminRuntime;
use Sonata\AdminBundle\Twig\TemplateRegistryRuntime;
use Sonata\AdminBundle\Twig\XEditableRuntime;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->parameters()

        ->set('sonata.admin.twig.extension.x_editable_type_mapping', XEditableRuntime::FIELD_DESCRIPTION_MAPPING);

    $containerConfigurator->services()

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.sonata_admin_extension', SonataAdminExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.sonata_admin_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.admin.twig.extension', 'sonata.admin.twig.sonata_admin_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.sonata_admin_runtime', SonataAdminRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('sonata.admin.pool'),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.template_registry_extension', TemplateRegistryExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.template_registry_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.templates.twig.extension', 'sonata.admin.twig.template_registry_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.template_registry_runtime', TemplateRegistryRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('sonata.admin.global_template_registry'),
                service('sonata.admin.pool'),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.group_extension', GroupExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.group_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.admin.group.extension', 'sonata.admin.twig.group_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.group_runtime', GroupRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('sonata.admin.pool'),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.icon_extension', IconExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.icon_runtime'),
            ])

        ->set('sonata.admin.twig.icon_runtime', IconRuntime::class)
            ->tag('twig.runtime')

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.security_extension', SecurityExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.security_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.security.twig.extension', 'sonata.admin.twig.security_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.security_runtime', SecurityRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('security.authorization_checker'),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.canonicalize_extension', CanonicalizeExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.canonicalize_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.canonicalize.twig.extension', 'sonata.admin.twig.canonicalize_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.canonicalize_runtime', CanonicalizeRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('request_stack'),
                // TODO: Remove this argument when dropping support for `sonata-project/form-extensions` 1.x.
                service('sonata.form.twig.canonicalize_runtime')->nullOnInvalid(),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.xeditable_extension', XEditableExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.xeditable_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.xeditable.twig.extension', 'sonata.admin.twig.xeditable_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.xeditable_runtime', XEditableRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('translator'),
                '%sonata.admin.twig.extension.x_editable_type_mapping%',
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.render_element_extension', RenderElementExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.render_element_runtime'),
            ])

        // NEXT_MAJOR: Remove the alias.
        ->alias('sonata.render_element.twig.extension', 'sonata.admin.twig.render_element_extension')
        ->deprecate(
            'sonata-project/admin-bundle',
            '4.7',
            'The "%alias_id%" alias is deprecated since sonata-project/admin-bundle 4.7 and will be removed in 5.0.'
        )

        ->set('sonata.admin.twig.render_element_runtime', RenderElementRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('property_accessor'),
            ])

        // NEXT_MAJOR: Remove the `args()` call.
        ->set('sonata.admin.twig.breadcrumbs_extension', BreadcrumbsExtension::class)
            ->tag('twig.extension')
            ->args([
                service('sonata.admin.twig.breadcrumbs_runtime'),
            ])

        ->set('sonata.admin.twig.breadcrumbs_runtime', BreadcrumbsRuntime::class)
            ->tag('twig.runtime')
            ->args([
                service('sonata.admin.breadcrumbs_builder'),
            ]);
};
