<?php

namespace webignition\UrlSourceMap;

class SourceMap implements \ArrayAccess, \Iterator, \Countable
{
    private $sources = [];

    /**
     * @param Source[] $sources
     */
    public function __construct(array $sources = [])
    {
        foreach ($sources as $source) {
            if ($source instanceof Source) {
                $this[$source->getUri()] = $source;
            }
        }
    }

    public function getByUri(string $uri): ?Source
    {
        return $this->offsetGet($uri);
    }

    public function getByMappedUri(string $localUri): ?Source
    {
        foreach ($this as $source) {
            if ($source->isAvailable() && $localUri === $source->getMappedUri()) {
                return $source;
            }
        }

        return null;
    }

    public function byType(string $type): SourceMap
    {
        $filteredSources = [];

        foreach ($this as $source) {
            if ($type === $source->getType()) {
                $filteredSources[] = $source;
            }
        }

        return new SourceMap($filteredSources);
    }

    public function offsetExists($offset): bool
    {
        if (!is_string($offset)) {
            return false;
        }

        return isset($this->sources[$offset]);
    }

    public function offsetGet($offset): ?Source
    {
        return $this->sources[$offset] ?? null;
    }

    /**
     * @param string $offset
     * @param Source $value
     */
    public function offsetSet($offset, $value)
    {
        if (!is_string($offset)) {
            throw new \InvalidArgumentException('array key must be a string');
        }

        if (!$value instanceof Source) {
            throw new \InvalidArgumentException('array value must be a Source instance');
        }

        $this->sources[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->sources[$offset]);
    }

    public function current(): Source
    {
        return current($this->sources);
    }

    public function next()
    {
        next($this->sources);
    }

    public function key(): ?string
    {
        return key($this->sources);
    }

    public function valid(): bool
    {
        return isset($this->sources[$this->key()]);
    }

    public function rewind()
    {
        reset($this->sources);
    }

    public function count(): int
    {
        return count($this->sources);
    }
}
