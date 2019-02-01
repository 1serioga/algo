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

    /**
     * @param string $type
     * @param int $position
     */
    public function __construct(string $type, int $position)
    {
        $this->type = $type;
        $this->position = $position;
    }

    public function move(int $speed): void
    {
        if ($this->type === self::TYPE_HEADING_LEFT) {
            $this->position -= $speed;
            return;
        }
        $this->position += $speed;
    }

    public function position(): int {
        return $this->position;
    }

    public function isInsideChamber(int $size): bool {
        return $this->position >= 0 && $this->position < $size;
    }

}
