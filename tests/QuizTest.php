<?php

use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    public function testScoreCalculation()
    {
        $correct = [
            1 => 'C',
            2 => 'B',
            3 => 'D',
            4 => 'A',
        ];


        $user = [
            1 => 'C',
            2 => 'B',
            3 => 'X',  // i will put in one wrong answer just for the sake of test
            4 => 'A',
        ];

        $score = 0;
        foreach ($correct as $qid => $ans) {
            if (isset($user[$qid]) && $user[$qid] === $ans) {
                $score++;
            }
        }

        $this->assertEquals(3, $score);
    }
}
