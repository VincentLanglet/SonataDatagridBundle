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

namespace Sonata\DatagridBundle\ProxyQuery;

use Sonata\DatagridBundle\Field\FieldDescriptionInterface;
use Sonata\DatagridBundle\Mapping\AssociationMappingInterface;

/**
 * Interface used by the Datagrid to build the query.
 */
interface ProxyQueryInterface
{
    /**
     * @return mixed
     */
    public function __call(string $name, array $args);

    /**
     * @return mixed
     */
    public function execute();

    public function setSortBy(?FieldDescriptionInterface $sortBy): self;

    public function getSortBy(): ?FieldDescriptionInterface;

    public function setSortOrder(?string $sortOrder): self;

    public function getSortOrder(): ?string;

    public function setFirstResult(?int $firstResult): self;

    public function getFirstResult(): ?int;

    public function setMaxResults(?int $maxResults): self;

    public function getMaxResults(): ?int;

    public function getUniqueParameterId(): int;

    /**
     * @param AssociationMappingInterface[] $associationMappings
     */
    public function entityJoin(array $associationMappings): string;
}
