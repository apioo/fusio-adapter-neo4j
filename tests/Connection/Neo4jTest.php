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

namespace Fusio\Adapter\Neo4j\Tests\Connection;

use Fusio\Adapter\Neo4j\Connection\Neo4j;
use Fusio\Adapter\Neo4j\Tests\Neo4jTestCase;
use Fusio\Engine\Form\Builder;
use Fusio\Engine\Form\Container;
use Fusio\Engine\Form\Element\Input;
use Fusio\Engine\Parameters;
use Laudis\Neo4j\Contracts\ClientInterface;

/**
 * Neo4jTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    https://www.fusio-project.org/
 */
class Neo4jTest extends Neo4jTestCase
{
    public function testGetConnection()
    {
        $connectionFactory = $this->getConnectionFactory()->factory(Neo4j::class);

        $config = new Parameters([
            'uri' => 'bolt://localhost:7687',
        ]);

        $connection = $connectionFactory->getConnection($config);

        $this->assertInstanceOf(ClientInterface::class, $connection);
    }

    public function testConfigure()
    {
        $connection = $this->getConnectionFactory()->factory(Neo4j::class);
        $builder    = new Builder();
        $factory    = $this->getFormElementFactory();

        $connection->configure($builder, $factory);

        $this->assertInstanceOf(Container::class, $builder->getForm());

        $elements = $builder->getForm()->getElements();
        $this->assertEquals(1, count($elements));
        $this->assertInstanceOf(Input::class, $elements[0]);
    }

    public function testPing()
    {
        /** @var Neo4j $connectionFactory */
        $connectionFactory = $this->getConnectionFactory()->factory(Neo4j::class);

        $config = new Parameters([
            'uri' => 'bolt://localhost:7687',
        ]);

        $connection = $connectionFactory->getConnection($config);

        $this->assertTrue($connectionFactory->ping($connection));
    }
}
