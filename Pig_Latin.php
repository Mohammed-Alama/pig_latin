<?php

class Pig_Latin
{

    protected $word;
    private $vowels = ['a', 'e', 'i', 'o', 'u'];
    private $yay = 'yay';
    private $ay = 'ay';

    public function __construct($word)
    {
        $this->word = $word;
        $this->check($this->word);
    }

    /**
     * @param $word
     * @return array
     */
    protected function getArrLatinWord($word)
    {
        $latin_word = str_split($word);
        return $latin_word;
    }

    /**
     * Get First Letter of Word
     *
     * @param array $latin_word
     * @return array
     */
    protected function getArrFirstLetterOfLatinWord(array $latin_word)
    {
        $first_element = array_slice($latin_word, 0, 1);
        return $first_element;
    }

    /**
     * Check if First Letter is in array $vowels
     *
     * @param $word
     * @return bool
     */
    protected function isFirstInVowels($word)
    {
        $latin_word = $this->getArrLatinWord($word);
        $first_element = $this->getArrFirstLetterOfLatinWord($latin_word);
        return in_array($first_element[0], $this->vowels);
    }

    /**
     * Determine first phase of word is Consonant or Cluster
     *
     * @param $word
     * @return string
     */
    protected function isFirstIsConsonantOrCluster($word)
    {
        $latin_word = $this->getArrLatinWord($word);
        if (count($this->getArrLatinWord($word)) > 2) {

            if (!in_array($latin_word[0], $this->vowels) && !in_array($latin_word[1], $this->vowels) && in_array($latin_word[2], $this->vowels)) {
                return 'Cluster';

            } elseif (!in_array($latin_word[0], $this->vowels) && in_array($latin_word[1], $this->vowels)) {
                return 'Consonant';
            }
        }
        return false;

    }

    /**
     * Determine first letter is Y or not
     *
     * @param $word
     * @return string
     */
    protected function isFirstY($word)
    {
        $latin_word = $this->getArrLatinWord($word);
        $first_element = array_slice($latin_word, 0, 1);
        if (strtolower($first_element[0]) == 'y') {
            return true;
        }
        return false;
    }

    /**
     * Determine word is contains Y or not
     *
     * @param $word
     * @return boolean;
     */
    protected function isContainsY($word)
    {
        $latin_word = $this->getArrLatinWord($word);

        if (count($this->getArrLatinWord($word)) == 2 && $latin_word[1] == 'y') {
            $suffix = $latin_word[0] . 'ay';
            array_shift($latin_word);
            $latin_word = implode('', $latin_word);
            return print_r($latin_word . '-' . $suffix);
        }

        if (!in_array($latin_word[0], $this->vowels) && !in_array($latin_word[1], $this->vowels)) {
            if (in_array($latin_word[2], $this->vowels) || $latin_word[2] === 'y') {
                return true;
            }
        }
        return false;
    }


    /**
     * Print Latin Word
     *
     * @param $word
     * @param $suffix
     * @return mixed
     */
    public function PrintLatin($word, $suffix)
    {
        if ($this->isFirstInVowels($word)) {
            return print_r($word . '-' . $suffix);
        }
        $latin_word = $this->getArrLatinWord($word);
        array_shift($latin_word);
        $latin_word = implode('', $latin_word);
        return print_r($latin_word . '-' . $suffix);
    }

    /**
     *
     *
     * @param $latin_word
     * @return string
     */
    protected function PrintLatinContainsClusterOrY($latin_word)
    {
        $suffix = '-' . $latin_word[0] . $latin_word[1] . $this->ay;
        unset($latin_word[0]);
        unset($latin_word[1]);
        $latin_word = implode('', array_values($latin_word));
        return print_r($latin_word . $suffix);
    }

    /**
     * @param $word
     * @return bool|mixed|string
     */
    public function PrintLatinContainsConsonantOrCluster($word)
    {
        if ($this->isFirstIsConsonantOrCluster($word) == 'Cluster') {

            return $this->PrintLatinContainsClusterOrY($this->getArrLatinWord($word));

        } elseif ($this->isFirstIsConsonantOrCluster($word) == 'Consonant') {
            $latin_word = $this->getArrLatinWord($word);
            $suffix = $latin_word [0] . 'ay';
            array_shift($latin_word);
            $latin_word = implode('', $latin_word);
            return print_r($latin_word . '-' . $suffix);

        }
        return false;
    }


    /**
     * Make Some Checks on Given Word to convert it to Latin
     *
     * @param $word
     * @return string
     */
    public function check($word)
    {
        if ($this->isFirstInVowels($word)) {

            return $this->PrintLatin($word, $this->yay);

        } elseif ($this->isFirstIsConsonantOrCluster($word) == 'Cluster' || $this->isFirstIsConsonantOrCluster($word) == 'Consonant') {

            return $this->PrintLatinContainsConsonantOrCluster($word);

        } elseif ($this->isFirstY($word)) {

            return $this->PrintLatin($word, $this->getArrLatinWord($word)[0] . $this->ay);

        } elseif ($this->isContainsY($word)) {
            if (count($this->getArrLatinWord($word)) == 2 && $this->getArrLatinWord($word)[1] == 'y') {
                return true;
            }

            return $this->PrintLatinContainsClusterOrY($this->getArrLatinWord($word));

        }

        return print_r('This is Not a Word');

    }


}


$words = [
    'banana',
    'hello',
    'switch',
    'glove',
    'fruit',
    'smoothie',
    'egg',
    'ultimate',
    'i',
    'yellow',
    'my',
    'rhythm'
];

foreach ($words as $word) {

    $pig_latin = new Pig_Latin($word);
    echo '_______';
}
