<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\AssetHyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class AssetHyperlink implements NodeRendererInterface
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
            '<a href="#%s-%s" title="%s">%s</a>',
            $node->getResource()->getType(),
            $node->getResource()->getId(),
            $node->getTitle(),
            $renderer->renderCollection($node->getContent())
        );
    }
}
