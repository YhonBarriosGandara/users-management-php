<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidFincaDataException.php';

final class FincaId
{
    private string $value;

    public function __construct(string|int $value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('id');
        }

        $this->value = $normalizedValue;
    }

    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(16)));
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(FincaId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
