<?php

namespace Kfirba\Formats\JewishDate;

use Kfirba\Formats\Format;
use Kfirba\Support\HebrewNumerology;

class HebrewFull extends Format
{
    /**
     * Lookup table for hebrew days.
     *
     * @var array
     */
    const dayLookup = [
        '',
        'א',
        'ב',
        'ג',
        'ד',
        'ה',
        'ו',
        'ז',
        'ח',
        'ט',
        'י',
        'י"א',
        'י"ב',
        'י"ג',
        'י"ד',
        'ט"ו',
        'ט"ז',
        'י"ז',
        'י"ח',
        'י"ט',
        'כ',
        'כ"א',
        'כ"ב',
        'כ"ג',
        'כ"ד',
        'כ"ה',
        'כ"ו',
        'כ"ז',
        'כ"ח',
        'כ"ט',
        'ל',
    ];

    /**
     * Lookup table for hebrew months.
     *
     * @var array
     */
    const monthLookup = [
        '',
        'תשרי',
        'חשון',
        'כסלו',
        'טבת',
        'שבט',
        'אדר א',
        ['אדר', 'אדר ב'],
        'ניסן',
        'אייר',
        'סיון',
        'תמוז',
        'אב',
        'אלול',
    ];

    /**
     * The HebrewNumerology instance.
     *
     * @var HebrewNumerology
     */
    protected $numerology;

    /**
     * HebrewFull constructor.
     *
     * @param  array  $date
     */
    public function __construct(array $date)
    {
        parent::__construct($date);

        $this->numerology = new HebrewNumerology;
    }

    /**
     * Handle the parse request.
     *
     * @return array
     */
    public function format()
    {
        $day = self::dayLookup[$this->date[1]];
        $month = self::monthLookup[$this->date[0]];

        if (is_array($month)) {
            $month = isJewishLeapYear($this->date[2]) ? $month[1] : $month[0];
        }

        $year = $this->numerology->toHebrewYear($this->date[2]);

        return [$day, $month, $year];
    }
}
