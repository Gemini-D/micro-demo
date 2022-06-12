<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Micro\Lib;

interface ROCVersionInterface
{
    const NAME = 'ROCVersionService';
    const HOST = 'roc';
    const PORT = 9501;

    public function getVersion(): string;

    public function sayHello(): string;
}
