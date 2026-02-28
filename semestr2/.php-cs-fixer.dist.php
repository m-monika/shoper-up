<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()->in(__DIR__ . '/app');

return (new Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_extra_blank_lines' => true,
        'strict_param' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
        'declare_strict_types' => true,
        'align_multiline_comment' => true,
        'binary_operator_spaces' => ['default' => 'single_space'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'phpdoc_align' => true,
    ])
    ->setFinder($finder)
    ->setLineEnding("\n");