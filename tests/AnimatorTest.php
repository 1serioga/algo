<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\LinearChamber\Animator;

final class AnimatorTest extends TestCase
{
    /**
     * @var Animator
     */
    private $animator;

    public function setUp()
    {
        $this->animator = new Animator;
    }

    /**
     * @dataProvider dataProvider
     * @param int $speed
     * @param string $init
     * @param array $expected
     */
    public function testItShouldIdentifyMissingLetters(int $speed, string $init, array $expected): void
    {
        $output = $this->animator->animate($speed, $init);
        $this->assertEquals($expected, $output);
    }

    public function dataProvider()
    {
        return [
            [2, '..R....', ['..X....', '....X..', '......X', '.......']],
            [3, 'RR..LRL', ['XX..XXX', '.X.XX..', 'X.....X', '.......']],
            [2, 'LRLR.LRLR', ['XXXX.XXXX', 'X..X.X..X', '.X.X.X.X.', '.X.....X.', '.........']],
            [10, 'RLRLRLRLRL', ['XXXXXXXXXX', '..........']],
            [1, '...', ['...']],
            [1, 'LRRL.LR.LRR.R.LRRL.', [
                'XXXX.XX.XXX.X.XXXX.',
                '..XXX..X..XX.X..XX.',
                '.X.XX.X.X..XX.XX.XX',
                'X.X.XX...X.XXXXX..X',
                '.X..XXX...X..XX.X..',
                'X..X..XX.X.XX.XX.X.',
                '..X....XX..XX..XX.X',
                '.X.....XXXX..X..XX.',
                'X.....X..XX...X..XX',
                '.....X..X.XX...X..X',
                '....X..X...XX...X..',
                '...X..X.....XX...X.',
                '..X..X.......XX...X',
                '.X..X.........XX...',
                'X..X...........XX..',
                '..X.............XX.',
                '.X...............XX',
                'X.................X',
                '...................',
                ]
            ],
        ];
    }
}
