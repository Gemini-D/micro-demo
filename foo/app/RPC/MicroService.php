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
namespace App\RPC;

use Hyperf\RpcMultiplex\Constant;
use Hyperf\RpcServer\Annotation\RpcService;
use Micro\Lib\MicroInterface;

#[RpcService(name: 'MicroService', server: 'rpc', protocol: Constant::PROTOCOL_DEFAULT)]
class MicroService implements MicroInterface
{
    public function sayHello(): string
    {
        return 'Hello Foo';
    }
}
