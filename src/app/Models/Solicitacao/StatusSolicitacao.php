<?php

namespace App\Models\Solicitacao;

class StatusSolicitacao
{
    const PENDENTE = 1;
    const CANCELADA = 2;
    const AGENDADA = 3;

    public static function getAll()
    {
        return [
            self::PENDENTE => 'PENDENTE',
            self::CANCELADA => 'CANCELADA',
            self::AGENDADA => 'AGENDADA',
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
