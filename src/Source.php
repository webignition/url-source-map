<?php

namespace webignition\UrlSourceMap;

class Source
{
    private $uri;
    private $mappedUri;

    public function __construct(string $uri, ?string $mappedUri = null)
    {
        $this->uri = $uri;
        $this->mappedUri = $mappedUri;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMappedUri(): ?string
    {
        return $this->mappedUri;
    }

    public function isAvailable(): bool
    {
        return !empty($this->mappedUri);
    }
}
