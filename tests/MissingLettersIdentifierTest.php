<?php
declare(strict_types=1);

use App\Pangram\MissingLettersIdentifier;
use PHPUnit\Framework\TestCase;

final class MissingLettersIdentifierTest extends TestCase
{
    /**
     * @var MissingLettersIdentifier
     */
    private $identifier;

    public function setUp()
    {
        $this->identifier = new MissingLettersIdentifier;
    }
    /**
     * @dataProvider dataProvider
     * @param string $input
     * @param string $expected
     */
    public function testItShouldIdentifyMissingLetters(string $expected, string $input): void
    {
        $output = $this->identifier->identify($input);
        $this->assertEquals($expected, $output);
    }

    public function testItShouldHandleBigInput(): void
    {
        $input = file_get_contents(__DIR__ . '/fixtures/bigtext.txt');
        $output = $this->identifier->identify($input);
        $this->assertEquals('', $output);
    }

    public function dataProvider()
    {
        return [
            ['', 'A quick brown fox jumps over the lazy dog'],
            ['bjkmqz', 'A slow yellow fox crawls under the proactive dog'],
            ['cfjkpquvwxz', 'Lions, and tigers, and bears, oh my!'],
            ['abcdefghijklmnopqrstuvwxyz', ''],
            ['qxz', 'As I walked around the room, full of journalists from some of the biggest publications in the world, I felt so out of place that I hid in the bathroom until my best friend arrived'],
        ];
    }
}
