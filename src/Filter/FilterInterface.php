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

namespace Sonata\DatagridBundle\Filter;

use Sonata\DatagridBundle\ProxyQuery\ProxyQueryInterface;

interface FilterInterface
{
    public const CONDITION_OR = 'OR';

    public const CONDITION_AND = 'AND';

    /**
     * Apply the filter to the QueryBuilder instance.
     */
    public function filter(ProxyQueryInterface $queryBuilder, string $alias, string $field, string $value): void;

    /**
     * @param mixed $query
     * @param mixed $value
     */
    public function apply($query, $value): void;

    public function getName(): ?string;

    public function getFormName(): string;

    public function getLabel(): ?string;

    public function setLabel(string $label): void;

    public function getDefaultOptions(): array;

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function getOption(string $name, $default = null);

    /**
     * @param mixed $value
     */
    public function setOption(string $name, $value): void;

    public function initialize(string $name, array $options = []): void;

    public function getFieldName(): string;

    /**
     * @return array<string, string> array of mappings
     */
    public function getParentAssociationMappings(): array;

    /**
     * @return array<string, string> field mapping
     */
    public function getFieldMapping(): array;

    /**
     * @return array<string, string>  association mapping
     */
    public function getAssociationMapping(): array;

    public function getFieldOptions(): array;

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function getFieldOption(string $name, $default = null);

    /**
     * @param mixed $value
     */
    public function setFieldOption(string $name, $value): void;

    public function getFieldType(): string;

    /**
     * Returns the main widget used to render the filter.
     */
    public function getRenderSettings(): array;

    public function isActive(): bool;

    /**
     * Set the condition to use with the left side of the query : OR or AND.
     */
    public function setCondition(string $condition): void;

    public function getCondition(): string;

    public function getTranslationDomain(): string;
}
