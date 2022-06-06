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
namespace App\Controller;

use Micro\Lib\MicroInterface;
use Micro\Lib\ROCVersionInterface;

class IndexController extends Controller
{
    public function index()
    {
        $callbacks = [];
        for ($i = 0; $i < 10000; ++$i) {
            $callbacks[] = static function () {
                // di()->get(MicroInterface::class)->sayHello();
                di()->get(ROCVersionInterface::class)->sayHello();
            };
        }

        $ms = microtime(true);
        parallel($callbacks, 100);

        var_dump(microtime(true) - $ms);

        return $this->response->success('Hello Bar');
    }

    public function foo()
    {
        return $this->response->success(
            'RET: ' . di()->get(MicroInterface::class)->sayHello()
        );
    }

    public function roc()
    {
        return $this->response->success(
            'RET: ' . di()->get(ROCVersionInterface::class)->sayHello()
        );
    }
}
