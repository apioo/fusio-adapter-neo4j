<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2022 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Adapter\Neo4j\Tests;

use Fusio\Adapter\Mongodb\Action\MongoDeleteOne;
use Fusio\Adapter\Mongodb\Action\MongoFindAll;
use Fusio\Adapter\Mongodb\Action\MongoFindOne;
use Fusio\Adapter\Mongodb\Action\MongoInsertOne;
use Fusio\Adapter\Mongodb\Action\MongoUpdateOne;
use Fusio\Adapter\Mongodb\Connection\MongoDB;
use Fusio\Adapter\Mongodb\Generator\MongoCollection;
use Fusio\Adapter\Mqtt\Action\MqttPublish;
use Fusio\Adapter\Mqtt\Connection\Mqtt;
use Fusio\Adapter\Neo4j\Connection\Neo4j;
use Fusio\Engine\Action\Runtime;
use Fusio\Engine\ConnectorInterface;
use Fusio\Engine\Model\Connection;
use Fusio\Engine\Parameters;
use Fusio\Engine\Test\CallbackConnection;
use Fusio\Engine\Test\EngineTestCaseTrait;
use PhpMqtt\Client\MqttClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * Neo4jTestCase
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org/
 */
abstract class Neo4jTestCase extends TestCase
{
    use EngineTestCaseTrait;

    protected function configure(Runtime $runtime, Container $container): void
    {
        $container->set(Neo4j::class, new Neo4j());
    }
}
