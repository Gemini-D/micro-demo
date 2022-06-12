<?php

declare(strict_types=1);

namespace Micro\Lib\Listener;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Framework\Event\BootApplication;
use Hyperf\Utils\Codec\Json;
use Micro\Lib\MicroInterface;
use Micro\Lib\ROCVersionInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class InitRPCListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            BootApplication::class,
        ];
    }

    public function process(object $event): void
    {
        $interfaces = [
            MicroInterface::class,
            ROCVersionInterface::class,
        ];

        $consumers = [];
        foreach ($interfaces as $interface) {
            $consumers[] = $this->getDefaultService($interface);
        }

        di()->get(ConfigInterface::class)->set('services', [
            'consumers' => $consumers
        ]);
    }

    protected function getDefaultService(string $interface): array
    {
        return [
            'name' => $interface::NAME,
            'service' => $interface,
            'id' => $interface,
            'protocol' => \Hyperf\RpcMultiplex\Constant::PROTOCOL_DEFAULT,
            'load_balancer' => 'random',
            'nodes' => [
                ['host' => $interface::HOST, 'port' => $interface::PORT],
            ],
            'options' => [
                'connect_timeout' => 5.0,
                'recv_timeout' => 5.0,
                'settings' => [
                    // 包体最大值，若小于 Server 返回的数据大小，则会抛出异常，故尽量控制包体大小
                    'package_max_length' => 1024 * 1024 * 2,
                ],
                // 重试次数，默认值为 2
                'retry_count' => 2,
                // 重试间隔，毫秒
                'retry_interval' => 100,
                // 多路复用客户端数量
                'client_count' => 4,
                // 心跳间隔 非 numeric 表示不开启心跳
                'heartbeat' => 30,
            ],
        ];
    }
}
