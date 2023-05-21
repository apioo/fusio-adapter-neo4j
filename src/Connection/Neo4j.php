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

namespace Fusio\Adapter\Neo4j\Connection;

use Fusio\Engine\Connection\PingableInterface;
use Fusio\Engine\ConnectionAbstract;
use Fusio\Engine\ConnectionInterface;
use Fusio\Engine\Form\BuilderInterface;
use Fusio\Engine\Form\ElementFactoryInterface;
use Fusio\Engine\ParametersInterface;
use Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\ClientInterface;
use Laudis\Neo4j\Databags\SummarizedResult;

/**
 * Neo4j
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org/
 */
class Neo4j extends ConnectionAbstract implements PingableInterface
{
    public function getName(): string
    {
        return 'Neo4j';
    }

    public function getConnection(ParametersInterface $config): ClientInterface
    {
        return ClientBuilder::create()
            ->withDriver('bolt', $config->get('uri'))
            ->withDefaultDriver('bolt')
            ->build();
    }

    public function configure(BuilderInterface $builder, ElementFactoryInterface $elementFactory): void
    {
        $builder->add($elementFactory->newInput('uri', 'Url', 'url', 'URL of the connection i.e. <code>bolt://neo4j:neo4j@localhost:7687</code>'));
    }

    public function ping(mixed $connection): bool
    {
        if ($connection instanceof ClientInterface) {
            /** @var SummarizedResult $result */
            $result = $connection->run('RETURN [0, 1] AS list');
            $result->first();

            return true;
        } else {
            return false;
        }
    }
}
