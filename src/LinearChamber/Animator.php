<?php
declare(strict_types=1);

namespace App\LinearChamber;

final class Animator {

    public function animate(int $speed, string $init): array
    {
        $steps = [];
        $size = strlen($init);
        $particles = $this->getParticles($init);
        $steps[] = $this->createStep($size, $particles);
        while (!empty($particles)) {
            foreach ($particles as $key => $particle) {
                $particle->move($speed);
                if (!$particle->isInsideChamber($size)) {
                    unset($particles[$key]);
                }
            }
            $steps[] = $this->createStep($size, $particles);
        }
        return $steps;
    }

    /**
     * @param string $init
     * @return array|Particle[]
     */
    private function getParticles(string $init): array
    {
        $particles = [];
        $locations = str_split($init);
        foreach ($locations as $position => $type) {
            if ($type !== Particle::TYPE_HEADING_RIGHT && $type !== Particle::TYPE_HEADING_LEFT) {
                continue;
            }
            $particles[] = new Particle($type, $position);
        }
        return $particles;
    }

    /**
     * @param int $size
     * @param array|Particle[] $particles
     * @return string
     */
    private function createStep(int $size, array $particles): string {
        $step = array_fill(0, $size, '.');
        foreach ($particles as $key => $particle) {
            if ($particle->isInsideChamber($size)) {
                $step[$particle->position()] = 'X';
            }
        }
        return implode('', $step);
    }

}
