<?php
declare(strict_types=1);

namespace App\Pangram;

final class MissingLettersIdentifier {

    const PARTITION_SIZE = 50;
    const ALPHABET = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
    ];

    public function identify(string $input): string
    {
        $missingLetters = self::ALPHABET;
        $partitionsNumber = ceil(strlen($input) / self::PARTITION_SIZE);
        for ($i = 0; $i < $partitionsNumber; $i++) {
            $partition = substr($input, $i * self::PARTITION_SIZE, self::PARTITION_SIZE);
            $partition = strtolower($partition);
            $partition = str_split($partition);
            $partition = array_unique($partition);
            $missingLetters = array_diff($missingLetters, $partition);
            if (empty($missingLetters)) {
                return '';
            }
        }
        return implode('', $missingLetters);
    }
}
