<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\NodeRenderer;

use Contentful\StructuredText\Node\EntryHyperlink as NodeClass;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\RendererInterface;

class EntryHyperlink implements NodeRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(\sprintf(
                'Trying to use node renderer "%s" to render unsupported node of class "%s".',
                \get_class($this),
                \get_class($node)
            ));
        }

        return \sprintf(
            '<a href="#%s-%s">%s</a>',
            $node->getResource()->getType(),
            $node->getResource()->getId(),
            $node->getTitle()
        );
    }
}
