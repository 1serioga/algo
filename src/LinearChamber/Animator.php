<?php
declare(strict_types=1);

namespace App\LinearChamber;

final class Animator {

    const PARTITION_SIZE = 50;

    /**
     * @param int $speed
     * @param string $init
     * @return array
     */
    public function animate(int $speed, string $init): array
    {
        $size = strlen($init);
        $chamber = new Chamber($size);
        $partitionsNumber = (int) ceil($size / self::PARTITION_SIZE);
        for ($i = 0; $i < $partitionsNumber; $i++) {
            $partition = substr($init, $i * self::PARTITION_SIZE, self::PARTITION_SIZE);
            $locations = str_split($partition);
            foreach ($locations as $position => $type) {
                if ($type !== Particle::TYPE_HEADING_RIGHT && $type !== Particle::TYPE_HEADING_LEFT) {
                    continue;
                }
                $chamber->addParticle(
                    new Particle($type, ($i*self::PARTITION_SIZE + $position), $speed)
                );
            }
        }
        return $chamber->getSteps();
    }
}
