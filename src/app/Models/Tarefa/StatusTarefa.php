<?php

namespace App\Models\Tarefa;

class StatusTarefa
{
    const A_FAZER = 1;
    const FAZENDO = 2;
    const CONCLUIDA = 3;

    public static function getAll()
    {
        return [
            self::A_FAZER => 'A FAZER',
            self::FAZENDO => 'FAZENDO',
            self::CONCLUIDA => 'CONCLUIDA',
        ];
    }

    public static function get(int $status)
    {
        if (isset(self::getAll()[$status])) {

            return self::getAll()[$status];
        }

        return '';
    }
}
