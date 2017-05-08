<?php

namespace Vulcan\Rivescript\Cortex\Tags;

class Topic extends Tag
{
    /**
     * @var array
     */
    protected $allowedSources = ['response'];

    /**
     * Regex expression pattern.
     *
     * @var string
     */
    protected $pattern = '/\{topic=(.+?)\}/u';

    /**
     * Parse the response.
     *
     * @param string $response
     * @param array  $data
     *
     * @return array
     */
    public function parse($source)
    {
        if (! $this->sourceAllowed()) {
            return $source;
        }

        if ($this->hasMatches($source)) {
            list($find, $topic) = $this->getMatches($source)[0];

            $source = str_replace($find, '', $source);
            synapse()->memory->shortTerm()->put('topic', $topic);
        }

        return $source;
    }
}