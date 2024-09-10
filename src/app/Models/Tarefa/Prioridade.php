<?php

namespace App\Models\Tarefa;

class Prioridade
{
    const ALTA = 1;
    const BAIXA = 2;
    const MEDIA = 3;

    public static function getAll()
    {
        return [
            self::ALTA => "Alta",
            self::BAIXA => "Baixa",
            self::MEDIA => "Media",
        ];
    }


    public static function getCor($prioridade)
    {
        switch ($prioridade) {
            case self::ALTA:
                return 'red';
            case self::MEDIA:
                return 'purple';
            case self::BAIXA:
                return 'blue';
            default:
                return 'platinum';
        }
    }
}
