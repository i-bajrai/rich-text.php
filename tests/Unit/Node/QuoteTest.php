<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Quote;
use Contentful\Tests\RichText\TestCase;

class QuoteTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('quote', Quote::getType());
        $nodes = $this->createNodes(5);
        $node = new Quote($nodes);

        $this->assertSame('block', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
