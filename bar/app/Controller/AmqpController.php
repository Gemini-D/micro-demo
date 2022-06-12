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

use App\Amqp\Producer\FooProducer;
use Hyperf\Amqp\Producer;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController(prefix: 'amqp')]
class AmqpController extends Controller
{
    public function index()
    {
        di()->get(Producer::class)->produce(
            new FooProducer(['id' => uniqid()])
        );

        return $this->response->success();
    }

    public function log()
    {
        di()->get(StdoutLoggerInterface::class)->info('xx');
        return $this->response->success();
    }
}
