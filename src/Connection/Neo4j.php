<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2016 Christoph Kappestein <christoph.kappestein@gmail.com>
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

use Fusio\Engine\ConnectionInterface;
use Fusio\Engine\Form\BuilderInterface;
use Fusio\Engine\Form\ElementFactoryInterface;
use Fusio\Engine\ParametersInterface;
use GraphAware\Neo4j\Client\ClientBuilder;

/**
 * Neo4j
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class Neo4j implements ConnectionInterface
{
    public function getName()
    {
        return 'Neo4j';
    }

    /**
     * @param \Fusio\Engine\ParametersInterface $config
     * @return \GraphAware\Neo4j\Client\ClientInterface
     */
    public function getConnection(ParametersInterface $config)
    {
        return ClientBuilder::create()
            ->addConnection('default', $config->get('uri'))
            ->build();
    }

    public function configure(BuilderInterface $builder, ElementFactoryInterface $elementFactory)
    {
        $builder->add($elementFactory->newInput('uri', 'URI', 'text', 'URI of the connection i.e. <code>http://neo4j:password@localhost:7474</code>'));
    }
}
