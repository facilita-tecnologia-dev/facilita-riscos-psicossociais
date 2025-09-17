<?php

namespace App\Enums;

enum CollectionFactorTypes: string
{
    // Psychosocial Risks
    case WORK_ORGANIZATION = 'work-organization';
    case MANAGEMENT_STYLE = 'management-style';
    case INTERPERSONAL_RELATIONS = 'interpersonal-relations';
    case WORK_CONTENT = 'work-content';
    case EMPLOYMENT_CONDITIONS = 'employment-conditions';
    case WORK_RELATED_DISORDERS = 'work-related-disorders';

    // Organizational Climate
    case WORK_CONDITIONS = 'work-conditions';
    case WORK_SOCIAL_RELATIONS = 'work-social-relations';
    case MOTIVATION_VALUES_AND_PURPOSES = 'motivation-values-and-purposes';
    case DEVELOPMENT_CARREER_RECOGNITION = 'development-carreer-recognition';
    case COMMUNICATION_AND_INFORMATION = 'communication-and-information';
    case ENGAGEMENT_AND_PRIDE = 'engagement-and-pride';

    public function label(): string
    {
        return match ($this) {
            // Psychosocial Risks
            self::WORK_ORGANIZATION => 'Organização do Trabalho',
            self::MANAGEMENT_STYLE => 'Estilos de Gestão',
            self::INTERPERSONAL_RELATIONS => 'Relações Interpessoais e Sofrimento',
            self::WORK_CONTENT => 'Conteúdo e Significado do Trabalho',
            self::EMPLOYMENT_CONDITIONS => 'Condições de Emprego',
            self::WORK_RELATED_DISORDERS => 'Distúrbios Relacionados ao Trabalho',
            
            // Organizational Climate
            self::WORK_CONDITIONS => 'Condições e Organização do Trabalho',
            self::WORK_SOCIAL_RELATIONS => 'Liderança e Relações Interpessoais',
            self::MOTIVATION_VALUES_AND_PURPOSES => 'Motivação e Valorização',
            self::DEVELOPMENT_CARREER_RECOGNITION => 'Remuneração e Carreira',
            self::COMMUNICATION_AND_INFORMATION => 'Comunicação',
            self::ENGAGEMENT_AND_PRIDE => 'Engajamento e Participação',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}