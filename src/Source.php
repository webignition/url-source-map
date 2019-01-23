<?php

namespace webignition\UrlSourceMap;

class Source
{
    private $uri;
    private $mappedUri;
    private $type;

    public function __construct(string $uri, ?string $mappedUri = null, ?string $type = null)
    {
        $this->uri = $uri;
        $this->mappedUri = $mappedUri;
        $this->type = $type;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMappedUri(): ?string
    {
        return $this->mappedUri;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isAvailable(): bool
    {
        return !empty($this->mappedUri);
    }
}
