<?php
/*
 * Hitechnix Corporation
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the 3-clause BSD license that is
 * available through the world-wide-web at this URL:
 * https://opensource.hitechnix.com/LICENSE.txt
 *
 * @author          Hitechnix Corporation
 * @copyright       Copyright (c) 2023 Hitechnix Corporation
 * @link            https://opensource.hitechnix.com
 */

// Directories to not scan
$excludeDirs = [
    'vendor/',
];

// Files to not scan
$excludeFiles = [];

// Create a new Symfony Finder instance
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude($excludeDirs)
    ->ignoreDotFiles(true)->ignoreVCS(true)
    ->filter(function (\SplFileInfo $file) use ($excludeFiles) {
        return !in_array($file->getRelativePathName(), $excludeFiles);
    });

return (new \Hitechnix\PhpCsFixer\Config())
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->withPHPUnitRules();
