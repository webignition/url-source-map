<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\UrlSourceMap\Tests;

use webignition\UrlSourceMap\Source;

class SourceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(string $uri, ?string $mappedUri, ?string $type)
    {
        $source = new Source($uri, $mappedUri, $type);

        $this->assertEquals($uri, $source->getUri());
        $this->assertEquals($mappedUri, $source->getMappedUri());
        $this->assertEquals($type, $source->getType());
    }

    public function createDataProvider(): array
    {
        return [
            'uri only' => [
                'uri' => 'http://example.com/',
                'mappedUri' => null,
                'type' => null,
            ],
            'uri, mappedUri only' => [
                'uri' => 'http://example.com/',
                'mappedUri' => 'file:/tmp/source.html',
                'type' => null,
            ],
            'uri, type only' => [
                'uri' => 'http://example.com/',
                'mappedUri' => null,
                'type' => 'resource',
            ],
            'uri, mappedUri, type' => [
                'uri' => 'http://example.com/style.css',
                'mappedUri' => 'file:/tmp/style.css',
                'type' => 'import',
            ],
        ];
    }
}
