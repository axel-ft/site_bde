<?php namespace Controller;

class Calendar
{
    private $MonthCal,
            $MonthsInYear,
            $DaysInWeek,
            $Year,
            $Month;

    public function __construct(int $Year, int $Month = null)
    {
        $this->Year = $Year;
        $this->Month = (is_null($Month)) ? date('n') : $Month;

        if ($this->Month > 12 || $this->Month < 1)
            throw new \Exception("Ce mois n'existe pas");

        $this->MonthsInYear = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        $this->DaysInWeek = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
        $this->GenerateMonthCalendar();
    }

    public function GetCalYear()
    {
        return $this->Year;
    }

    public function GetCalMonth()
    {
        return $this->Month;
    }

    public function GetFullMonthName(int $MonthNumber = null)
    {
        if (is_null($MonthNumber)) $MonthNumber = $this->Month;

        return $this->MonthsInYear[$MonthNumber - 1];
    }

    public function GetPreviousCalMonth()
    {
        if ($this->Month == 1) return ($this->Year - 1) . '/' . 12;
        return $this->Year . '/' . ($this->Month - 1);
    }

    public function GetNextCalMonth()
    {
        if ($this->Month == 12) return ($this->Year + 1) . '/' . 1;
        return $this->Year . '/' . ($this->Month + 1);
    }

    public function GetPreviousFullMonthName()
    {
        if ($this->Month == 1) return \end($this->MonthsInYear);
        return $this->MonthsInYear[$this->Month - 2];
    }

    public function GetNextFullMonthName()
    {
        if ($this->Month == 12) return \current($this->MonthsInYear);
        return $this->MonthsInYear[$this->Month];
    }

    public function GenerateMonthCalendar()
    {
        $Date = new \DateTime($this->Year.'-'.$this->Month.'-01');
        while ($Date->format('n') == $this->Month)
        {
            $Day = $Date->format('j');
            $DayInWeek = str_replace('0', '7', $Date->format('w'));
            $this->MonthCal[$Day] = $DayInWeek;
            $Date->add(new \DateInterval('P1D'));
        }
    }

    public function DayHasEvent(int $Day, array $Events)
    {
        foreach ($Events as $Event)
            if ($Event['begin_date']->format('d') <= $Day && $Event['end_date']->format('d') >= $Day)
                return true;

        return false;
    }

    public function GenerateOutput(array $Events = null)
    {
        $Output = '<tr>';

        foreach ($this->DaysInWeek as $DayInWeek)
            $Output .= '<th>' . \substr($DayInWeek, 0, 3) . '</th>';

        $Output .= '</tr><tr>';

        if ($this->MonthCal[1] > 1)
            $Output .= '<td colspan="' . ($this->MonthCal[1] - 1) . '"></td>';

        foreach($this->MonthCal as $Day => $DayInWeek)
        {
            $Output .= (!is_null($Events) && $this->DayHasEvent($Day, $Events)) ? '<td class="day withripple bg-primary">' . $Day . '</td>' : '<td class="day withripple">' . $Day . '</td>';

            if ($DayInWeek == 7)
                $Output.= '</tr><tr>';
        }

        if (\end($this->MonthCal) != 7)
        {
            $RemainingDays = 7 - \end($this->MonthCal);
            $Output .= '<td colspan="' . $RemainingDays . '"></td>';
        }

        $Output .= '</tr>';

        return $Output;
    }
}
