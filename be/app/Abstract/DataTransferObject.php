<?php

namespace App\Abstract;

use Illuminate\Support\Str;

class DataTransferObject
{
    /**
     * @param  bool $forceNulls
     *
     * @return array
     */
    public function toArray(bool $forceNulls = false): array
    {
        $ref = new \ReflectionClass($this);

        $properties = [];

        foreach ($ref->getProperties() as $property) {
            $method = 'get' . Str::ucfirst($property->getName());

            $properties[Str::snake($property->getName())] = $this->$method();
        }

        if ($forceNulls) {
            return $properties;
        }

        return array_filter($properties, static fn ($item) => $item !== null);
    }
}
