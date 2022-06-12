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

interface MicroInterface
{
    const NAME = 'MicroService';
    const HOST = 'foo';
    const PORT = 9503;

    public function sayHello(): string;
}
