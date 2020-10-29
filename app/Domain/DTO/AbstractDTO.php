<?php


namespace App\Domain\DTO;


class AbstractDTO
{
    public static function populate(array $attributes): self
    {
        $dto = new self;

        foreach ($attributes as $key => $value) {
            if ($dto->has($key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }

    public function has(string $property): bool
    {
        return property_exists($this, $property);
    }

    public function filled(string $property): bool
    {
        return property_exists($this, $property)
            && $this->$property !== null;
    }
}
