<?php

namespace App\Enums\PROART;

enum PROARTGroup: string
{
    case WORK_ORGANIZATION = 'work-organization';
    case MANAGEMENT_STYLE = 'management-style';
    case INTERPERSONAL_RELATIONS = 'interpersonal-relations';
    case WORK_CONTENT = 'work-content';
    case WORK_RELATED_DISORDERS = 'work-related-disorders';

    public function label(): string
    {
        return match ($this) {
            self::WORK_ORGANIZATION => 'Organização do Trabalho',
            self::MANAGEMENT_STYLE => 'Estilos de Gestão',
            self::INTERPERSONAL_RELATIONS => 'Relações Interpessoais e Sofrimento',
            self::WORK_CONTENT => 'Conteúdo e Significado do Trabalho',
            self::WORK_RELATED_DISORDERS => 'Distúrbios Relacionados ao Trabalho',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}