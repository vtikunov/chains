<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\Basic\PsrAutoloadingFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAddMissingParamAnnotationFixer;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireYodaComparisonSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\ReferenceUsedNamesOnlySniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(PsrAutoloadingFixer::class);
    $services->set(RequireYodaComparisonSniff::class);
    $services->set(ReferenceUsedNamesOnlySniff::class)
        ->property('allowFullyQualifiedGlobalClasses', true)
        ->property('allowFullyQualifiedGlobalFunctions', true)
        ->property('allowFullyQualifiedGlobalConstants', true);
    $services->set(FullyQualifiedStrictTypesFixer::class);
    $services->set(GlobalNamespaceImportFixer::class)
        ->call('configure', [['import_classes' => false, 'import_constants' => false, 'import_functions' => false]]);
    $services->set(NoLeadingImportSlashFixer::class);
    $services->set(PhpdocAddMissingParamAnnotationFixer::class)
        ->call('configure', [['only_untyped' => false]]);
    $services->set(IsNullFixer::class);
    $services->set(MbStrFunctionsFixer::class);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SETS, [SetList::SYMFONY, SetList::NAMESPACES, SetList::DOCBLOCK, SetList::PSR_12]);
    $parameters->set(Option::PATHS, ['src', 'test']);
    $parameters->set(
        Option::SKIP,
        [
            PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer::class => '~',
            PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer::class => '~',
            PhpCsFixer\Fixer\FunctionNotation\SingleLineThrowFixer::class => '~',
            PhpCsFixer\Fixer\Operator\ConcatSpaceFixer::class => '~',
        ]
    );
};
