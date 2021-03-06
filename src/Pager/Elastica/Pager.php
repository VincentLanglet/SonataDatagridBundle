<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\DatagridBundle\Pager\Elastica;

use Elastica\QueryBuilder;
use Sonata\DatagridBundle\Pager\BasePager;
use Sonata\DatagridBundle\Pager\PagerInterface;
use Sonata\DatagridBundle\ProxyQuery\Elastica\ProxyQuery;
use Sonata\DatagridBundle\ProxyQuery\ProxyQueryInterface;

/**
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
final class Pager extends BasePager
{
    public function computeNbResult(): int
    {
        $countQuery = clone $this->getQuery();
        $countQuery->execute();

        return $countQuery->getResults()->getTotalHits();
    }

    public function getResults(): ?array
    {
        return $this->getQuery()->execute();
    }

    public function init(): void
    {
        $this->resetIterator();

        $query = $this->getQuery();

        \assert($query instanceof ProxyQueryInterface);

        $query->setMaxResults($this->getMaxPerPage());

        $this->setNbResults($this->computeNbResult());

        if (\count($this->getParameters()) > 0) {
            $query->setParameters($this->getParameters());
        }

        if (0 === $this->getPage() || 0 === $this->getMaxPerPage() || 0 === $this->getNbResults()) {
            $this->setLastPage(0);
        } else {
            $offset = ($this->getPage() - 1) * $this->getMaxPerPage();

            $this->setLastPage((int) ceil($this->getNbResults() / $this->getMaxPerPage()));

            $query->setFirstResult($offset);
            $query->setMaxResults($this->getMaxPerPage());
        }
    }

    /**
     * Builds a pager for a given query builder.
     */
    public static function create(QueryBuilder $builder, int $limit, int $page): PagerInterface
    {
        $pager = new self($limit);
        $pager->setQuery(new ProxyQuery($builder));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }
}
