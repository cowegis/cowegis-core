<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return RectorConfig::configure()
    ->withRootFiles()
    ->withRules([
        DeclareStrictTypesRector::class,
    ])
    ->withSkip([RemoveConcatAutocastRector::class])
    ->withPreparedSets(
        deadCode: true,
        // codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        instanceOf: true,
    );
