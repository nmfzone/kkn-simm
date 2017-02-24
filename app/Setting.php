<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Lists of the kadus.
     *
     * @return Collection
     */
    public static function listsKadus()
    {
        return collect([
            'Kadus 1',
            'Kadus 2',
            'Kadus 3',
        ]);
    }

    /**
     * Get the RT.
     *
     * @return Collection
     */
    public static function getRT()
    {
        return collect(static::buildNumber(6));
    }

    /**
     * Get the RW.
     *
     * @return Collection
     */
    public static function getRW()
    {
        return collect(static::buildNumber(6));
    }

    /**
     * Get the partition.
     *
     * @param  string  $position
     * @return Collection
     */
    public static function getPartition($position = null)
    {
        if (is_null($position) || $position == 'Administrator') {
            $rw = null;
        } else {
            $rw = explode(' ', $position)[2];
        }

        $balita = Resident::balita()->with('hometown', 'job', 'education');
        $anak = Resident::anakAnak()->with('hometown', 'job', 'education');
        $remaja = Resident::remaja()->with('hometown', 'job', 'education');
        $produktif = Resident::produktif()->with('hometown', 'job', 'education');
        $lansia = Resident::lansia()->with('hometown', 'job', 'education');

        return collect([
            [
                'Balita',
                is_null($rw) ? $balita->get() : $balita->RW($rw)->get(),
            ],
            [
                'Anak-Anak',
                is_null($rw) ? $anak->get() : $anak->RW($rw)->get(),
            ],
            [
                'Remaja',
                is_null($rw) ? $remaja->get() : $remaja->RW($rw)->get(),
            ],
            [
                'Produktif',
                is_null($rw) ? $produktif->get() : $produktif->RW($rw)->get(),
            ],
            [
                'Lansia',
                is_null($rw) ? $lansia->get() : $lansia->RW($rw)->get(),
            ],
        ]);
    }

    /**
     * Get the gender.
     *
     * @return Collection
     */
    public static function getGender()
    {
        return collect([
            [
                'alias' => 'L',
                'name' => 'Laki-Laki',
            ],
            [
                'alias' => 'P',
                'name' => 'Perempuan',
            ],
        ]);
    }

    /**
     * Get the position.
     *
     * @return Collection
     */
    public static function getPosition()
    {
        return collect([
            [
                'Administrator',
            ],
            [
                'Ketua RW 01',
                'Kadus 1',
            ],
            [
                'Ketua RW 02',
                'Kadus 1',
            ],
            [
                'Ketua RW 03',
                'Kadus 2',
            ],
            [
                'Ketua RW 04',
                'Kadus 2',
            ],
            [
                'Ketua RW 05',
                'Kadus 3',
            ],
            [
                'Ketua RW 06',
                'Kadus 3',
            ],
        ]);
    }

    /**
     * Get the selection.
     *
     * @return Collection
     */
    public static function getSelection()
    {
        return collect([
            [
                'id' => '1',
                'name' => 'Ya',
            ],
            [
                'id' => '0',
                'name' => 'Tidak',
            ],
        ]);
    }

    /**
     * Get the kadus by rw.
     *
     * @param  string  $rw
     * @return string
     */
    public static function getKadus($rw = null)
    {
        if (is_null($rw)) return static::listsKadus();

        return static::getPosition()->filter(function($value, $key) use ($rw) {
            return str_contains($value[0], $rw);
        })->pluck(1);
    }

    /**
     * Get the kadus by rw.
     *
     * @param  string  $rw
     * @return string
     */
    public static function getKadusByPosition($position)
    {
        if ($position === 'Administrator') {
            return static::listsKadus();
        }

        return static::getKadus(explode(' ', $position)[2]);
    }

    /**
     * Build number.
     *
     * @param  integer  $end
     * @param  char  $char
     * @param  integer  $start
     * @return array
     */
    private static function buildNumber($end, $char = '0', $start = 1)
    {
        $result = [];

        for($i=$start; $i <= $end; $i++) {
            $result[$i] = str_pad($i, 2, $char, STR_PAD_LEFT);
        }

        return $result;
    }
}
