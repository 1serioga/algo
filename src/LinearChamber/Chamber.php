<?php
declare(strict_types=1);

namespace App\LinearChamber;

final class Chamber
{
    /** @var int */
    private $size = 0;
    /** @var array|string[] */
    private $steps = [];

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->steps[] = $this->createStep();
    }

    public function addParticle(Particle $particle)
    {
        $step = 0;
        while (true) {
            if ($step > 0) {
                $particle->move();
            }
            if (!isset($this->steps[$step])) {
                $this->steps[$step] = $this->createStep();
            }
            if (!$particle->isInsideChamber($this->size)) {
                break;
            }
            $this->steps[$step][$particle->position()] = 'X';
            $step++;
        }
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    private function createStep(): string {
        return str_repeat('.', $this->size);
    }
}
