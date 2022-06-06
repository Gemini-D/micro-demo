<?php

declare(strict_types=1);

namespace App\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\RpcServer\Event\AfterPathRegister;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class RPCPathRegisterListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            AfterPathRegister::class
        ];
    }

    public function process(object $event): void
    {
        var_dump($event);
    }
}
