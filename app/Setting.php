<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Get the dukuh.
     *
     * @return Collection
     */
    public static function getDukuh()
    {
        return collect([
            'Sidowayah',
            'Padasan',
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
     * @return Collection
     */
    public static function getPartition($position = null)
    {
        if ($position == 'Administrator') {
            $dukuh = null;
        } else {
            $dukuh = explode(' ', $position)[0];
        }

        $balita = Resident::balita()->with('hometown', 'job', 'education');
        $anak = Resident::anakAnak()->with('hometown', 'job', 'education');
        $remaja = Resident::remaja()->with('hometown', 'job', 'education');
        $produktif = Resident::produktif()->with('hometown', 'job', 'education');

        return collect([
            [
                'Balita',
                is_null($dukuh) ? $balita->get() : $balita->dukuh($dukuh)->get(),
            ],
            [
                'Anak-Anak',
                is_null($dukuh) ? $anak->get() : $anak->dukuh($dukuh)->get(),
            ],
            [
                'Remaja',
                is_null($dukuh) ? $remaja->get() : $remaja->dukuh($dukuh)->get(),
            ],
            [
                'Produktif',
                is_null($dukuh) ? $produktif->get() : $produktif->dukuh($dukuh)->get(),
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
                'Sidowayah',
            ],
            [
                'Ketua RW 02',
                'Sidowayah',
            ],
            [
                'Ketua RW 03',
                'Padasan',
            ],
            [
                'Ketua RW 04',
                'Padasan',
            ],
            [
                'Ketua RW 05',
                'Padasan',
            ],
            [
                'Ketua RW 06',
                'Padasan',
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
     * Build number.
     *
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
