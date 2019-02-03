<?php
declare(strict_types=1);

namespace App\LinearChamber;

final class Particle {

    const TYPE_HEADING_LEFT = 'L';
    const TYPE_HEADING_RIGHT = 'R';

    /** @var string */
    private $type;
    /** @var int */
    private $position;
    /** @var int */
    private $speed;

    /**
     * @param string $type
     * @param int $position
     * @param int $speed
     */
    public function __construct(string $type, int $position, int $speed)
    {
        $this->type = $type;
        $this->position = $position;
        $this->speed = $speed;
    }

    public function move(): void
    {
        if ($this->type === self::TYPE_HEADING_LEFT) {
            $this->position -= $this->speed;
            return;
        }
        $this->position += $this->speed;
    }

    public function position(): int {
        return $this->position;
    }

    public function isInsideChamber(int $size): bool {
        return $this->position >= 0 && $this->position < $size;
    }

}
