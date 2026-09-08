<?php

namespace Database\Seeders\BaseTests\SBHSEQuestions;

use App\Enums\Psychosocial\HSE\HSEGroup;

/**
 * Fonte única de verdade das 35 questões do formulário Sebratel
 * (chave de coleção `sb-based-on-hse`).
 *
 * - Os enunciados em pt-BR são cópia literal da coluna "SUGESTÕES SEBRATEL"
 *   do documento de referência e NÃO devem ser editados aqui.
 * - `inverted` é `false` em todas: a redação Sebratel é sempre afirmativa
 *   (frequência maior = melhor = menos risco), então a normalização no momento
 *   da resposta (HSEOption) não precisa espelhar os valores. Isso mantém o
 *   significado dos valores salvos idêntico ao do HSE padrão, permitindo que
 *   o motor de avaliação HSE seja reutilizado sem alteração.
 * - Os grupos são os mesmos `HSEGroup` do HSE padrão, o que garante o
 *   mapeamento questão -> perigo na avaliação.
 *
 * Consumido pela migration de dados (produção) e pelo SBHSECollectionSeeder
 * (ambientes novos).
 */
class SBHSEQuestions
{
    public const COLLECTION_KEY = 'sb-based-on-hse';
    public const COLLECTION_NAME = 'Riscos Psicossociais';

    /**
     * @return array<int, array{group: HSEGroup, statement: string, translations: array<string, string>}>
     */
    public static function all(): array
    {
        return array_map(
            fn (array $q) => [
                'group' => $q[0],
                'statement' => $q[1],
                'translations' => [
                    'en' => $q[2],
                    'es' => $q[3],
                    'fr' => $q[4],
                ],
            ],
            self::rows()
        );
    }

    /**
     * @return array<int, array{0: HSEGroup, 1: string, 2: string, 3: string, 4: string}>
     */
    private static function rows(): array
    {
        return [
            // ---- Mudança ----
            [
                HSEGroup::CHANGE,
                'Tenho oportunidade de conversar com minha liderança sobre mudanças que impactam meu trabalho.',
                'I have the opportunity to talk with my leadership about changes that affect my work.',
                'Tengo la oportunidad de conversar con mi liderazgo sobre los cambios que afectan mi trabajo.',
                "J'ai la possibilité d'échanger avec ma hiérarchie au sujet des changements qui affectent mon travail.",
            ],
            [
                HSEGroup::CHANGE,
                'A equipe tem oportunidade de contribuir quando são planejadas mudanças que impactam seu trabalho.',
                'The team has the opportunity to contribute when changes that affect their work are being planned.',
                'El equipo tiene la oportunidad de contribuir cuando se planifican cambios que afectan su trabajo.',
                "L'équipe a la possibilité de contribuer lorsque des changements affectant son travail sont planifiés.",
            ],
            [
                HSEGroup::CHANGE,
                'Recebo orientações claras sobre como as novas mudanças vão impactar meu dia a dia?',
                'I receive clear guidance on how new changes will affect my day-to-day work.',
                'Recibo orientaciones claras sobre cómo los nuevos cambios afectarán mi día a día.',
                'Je reçois des orientations claires sur la façon dont les nouveaux changements vont affecter mon quotidien.',
            ],

            // ---- Controle ----
            [
                HSEGroup::CONTROL,
                'Consigo fazer pequenas pausas ao longo do dia quando sinto necessidade?',
                'I am able to take short breaks during the day when I feel the need to.',
                'Puedo tomar pequeñas pausas a lo largo del día cuando siento la necesidad.',
                "Je peux faire de courtes pauses au cours de la journée lorsque j'en ressens le besoin.",
            ],
            [
                HSEGroup::CONTROL,
                'Tenho autonomia para organizar o ritmo do meu trabalho, considerando as demandas da função.',
                'I have the autonomy to organize my work pace, taking the demands of the role into account.',
                'Tengo autonomía para organizar el ritmo de mi trabajo, considerando las exigencias del puesto.',
                "J'ai l'autonomie nécessaire pour organiser mon rythme de travail, en tenant compte des exigences du poste.",
            ],
            [
                HSEGroup::CONTROL,
                'Tenho autonomia para definir a melhor forma de executar minhas atividades, dentro das orientações da função.',
                'I have the autonomy to define the best way to carry out my activities, within the guidelines of the role.',
                'Tengo autonomía para definir la mejor forma de ejecutar mis actividades, dentro de las orientaciones del puesto.',
                "J'ai l'autonomie nécessaire pour définir la meilleure façon d'exécuter mes activités, dans le cadre des directives du poste.",
            ],
            [
                HSEGroup::CONTROL,
                'Tenho clareza sobre minhas responsabilidades e espaço para organizar minhas prioridades de trabalho.',
                'I am clear about my responsibilities and have room to organize my work priorities.',
                'Tengo claridad sobre mis responsabilidades y espacio para organizar mis prioridades de trabajo.',
                "J'ai une vision claire de mes responsabilités et de la marge pour organiser mes priorités de travail.",
            ],
            [
                HSEGroup::CONTROL,
                'Tenho autonomia adequada para tomar decisões relacionadas à execução do meu trabalho.',
                'I have adequate autonomy to make decisions related to carrying out my work.',
                'Tengo la autonomía adecuada para tomar decisiones relacionadas con la ejecución de mi trabajo.',
                "J'ai une autonomie suffisante pour prendre les décisions liées à l'exécution de mon travail.",
            ],
            [
                HSEGroup::CONTROL,
                'Quando a atividade permite, existe flexibilidade na organização do horário de trabalho.',
                'When the activity allows, there is flexibility in organizing working hours.',
                'Cuando la actividad lo permite, existe flexibilidad en la organización del horario de trabajo.',
                "Lorsque l'activité le permet, il existe une flexibilité dans l'organisation des horaires de travail.",
            ],

            // ---- Demandas ----
            [
                HSEGroup::DEMANDS,
                'As diferentes demandas que recebo no trabalho são compatíveis entre si.',
                'The different demands I receive at work are compatible with each other.',
                'Las diferentes exigencias que recibo en el trabajo son compatibles entre sí.',
                'Les différentes demandes que je reçois au travail sont compatibles entre elles.',
            ],
            [
                HSEGroup::DEMANDS,
                'Os prazos estabelecidos são adequados para a realização das minhas atividades.',
                'The deadlines set are adequate for completing my activities.',
                'Los plazos establecidos son adecuados para la realización de mis actividades.',
                'Les délais fixés sont adaptés à la réalisation de mes activités.',
            ],
            [
                HSEGroup::DEMANDS,
                'O volume de trabalho é adequado ao tempo disponível para realizá-lo.',
                'The workload is adequate for the time available to complete it.',
                'El volumen de trabajo es adecuado al tiempo disponible para realizarlo.',
                'La charge de travail est adaptée au temps disponible pour la réaliser.',
            ],
            [
                HSEGroup::DEMANDS,
                'Consigo realizar minhas principais responsabilidades dentro do tempo disponível.',
                'I am able to carry out my main responsibilities within the time available.',
                'Puedo realizar mis principales responsabilidades dentro del tiempo disponible.',
                'Je parviens à assumer mes principales responsabilités dans le temps disponible.',
            ],
            [
                HSEGroup::DEMANDS,
                'Consigo realizar as pausas necessárias durante minha jornada de trabalho.',
                'I am able to take the necessary breaks during my working day.',
                'Puedo tomar las pausas necesarias durante mi jornada de trabajo.',
                'Je parviens à prendre les pauses nécessaires pendant ma journée de travail.',
            ],
            [
                HSEGroup::DEMANDS,
                'A jornada de trabalho permite realizar minhas atividades sem períodos excessivamente prolongados de trabalho.',
                'The working day allows me to carry out my activities without excessively long periods of work.',
                'La jornada de trabajo permite realizar mis actividades sin períodos excesivamente prolongados de trabajo.',
                'La journée de travail permet de réaliser mes activités sans périodes de travail excessivement longues.',
            ],
            [
                HSEGroup::DEMANDS,
                'O ritmo exigido permite que eu realize meu trabalho de forma adequada.',
                'The required pace allows me to carry out my work properly.',
                'El ritmo exigido me permite realizar mi trabajo de forma adecuada.',
                'Le rythme exigé me permet de réaliser mon travail de façon adéquate.',
            ],
            [
                HSEGroup::DEMANDS,
                'As condições de trabalho permitem realizar as pausas previstas.',
                'Working conditions allow me to take the scheduled breaks.',
                'Las condiciones de trabajo permiten realizar las pausas previstas.',
                'Les conditions de travail permettent de prendre les pauses prévues.',
            ],

            // ---- Relacionamentos ----
            [
                HSEGroup::RELATIONSHIPS,
                'Sou tratado com respeito nas relações de trabalho.',
                'I am treated with respect in working relationships.',
                'Recibo un trato respetuoso en las relaciones de trabajo.',
                'Je suis traité avec respect dans les relations de travail.',
            ],
            [
                HSEGroup::RELATIONSHIPS,
                'As relações entre os colegas favorecem um ambiente de trabalho respeitoso e colaborativo.',
                'Relationships among colleagues foster a respectful and collaborative work environment.',
                'Las relaciones entre los compañeros favorecen un ambiente de trabajo respetuoso y colaborativo.',
                'Les relations entre collègues favorisent un environnement de travail respectueux et collaboratif.',
            ],
            [
                HSEGroup::RELATIONSHIPS,
                'Sente-se confortável com a forma como é tratado(a) por colegas e lideranças no dia a dia?',
                'I feel comfortable with the way I am treated by colleagues and leadership on a daily basis.',
                'Me siento cómodo(a) con la forma en que me tratan los compañeros y los líderes en el día a día.',
                'Je me sens à l\'aise avec la façon dont je suis traité par mes collègues et ma hiérarchie au quotidien.',
            ],
            [
                HSEGroup::RELATIONSHIPS,
                'De maneira geral, mantenho relações de trabalho saudáveis com as pessoas com quem trabalho.',
                'In general, I maintain healthy working relationships with the people I work with.',
                'En general, mantengo relaciones de trabajo saludables con las personas con las que trabajo.',
                "De manière générale, j'entretiens des relations de travail saines avec les personnes avec qui je travaille.",
            ],

            // ---- Papel ----
            [
                HSEGroup::ROLE,
                'Tenho clareza sobre o que a empresa espera das minhas entregas no dia a dia?',
                'I am clear about what the company expects from my deliverables on a daily basis.',
                'Tengo claridad sobre lo que la empresa espera de mis entregas en el día a día.',
                "J'ai une vision claire de ce que l'entreprise attend de mes livrables au quotidien.",
            ],
            [
                HSEGroup::ROLE,
                'Recebo as orientações e informações necessárias para realizar bem meu trabalho.',
                'I receive the guidance and information I need to do my work well.',
                'Recibo las orientaciones y la información necesarias para realizar bien mi trabajo.',
                'Je reçois les orientations et les informations nécessaires pour bien faire mon travail.',
            ],
            [
                HSEGroup::ROLE,
                'Tenho clareza sobre minhas responsabilidades no trabalho.',
                'I am clear about my responsibilities at work.',
                'Tengo claridad sobre mis responsabilidades en el trabajo.',
                "J'ai une vision claire de mes responsabilités au travail.",
            ],
            [
                HSEGroup::ROLE,
                'Tenho clareza de quais sao os principais objetivos e metas da minha equipe?',
                'I am clear about the main objectives and goals of my team.',
                'Tengo claridad sobre cuáles son los principales objetivos y metas de mi equipo.',
                "J'ai une vision claire des principaux objectifs et cibles de mon équipe.",
            ],
            [
                HSEGroup::ROLE,
                'Consigo perceber como o meu trabalho contribui para os resultados gerais da empresa?',
                "I can see how my work contributes to the company's overall results.",
                'Percibo cómo mi trabajo contribuye a los resultados generales de la empresa.',
                'Je perçois comment mon travail contribue aux résultats globaux de l\'entreprise.',
            ],

            // ---- Suporte ----
            [
                HSEGroup::SUPPORT,
                'Posso contar com o apoio dos meus colegas quando preciso de ajuda no trabalho.',
                'I can count on the support of my colleagues when I need help at work.',
                'Puedo contar con el apoyo de mis compañeros cuando necesito ayuda en el trabajo.',
                "Je peux compter sur le soutien de mes collègues lorsque j'ai besoin d'aide au travail.",
            ],
            [
                HSEGroup::SUPPORT,
                'Recebo feedbacks construtivos sobre as tarefas e entregas que realizo?',
                'I receive constructive feedback on the tasks and deliverables I complete.',
                'Recibo retroalimentación constructiva sobre las tareas y entregas que realizo.',
                'Je reçois des retours constructifs sur les tâches et les livrables que je réalise.',
            ],
            [
                HSEGroup::SUPPORT,
                'Sinto abertura da minha liderança direta para me ajudar a resolver imprevistos do trabalho?',
                'I feel my direct leadership is open to helping me resolve unexpected issues at work.',
                'Percibo apertura de mi liderazgo directo para ayudarme a resolver imprevistos en el trabajo.',
                'Je perçois de l\'ouverture de la part de ma hiérarchie directe pour m\'aider à résoudre les imprévus du travail.',
            ],
            [
                HSEGroup::SUPPORT,
                'Sinto abertura para conversar com meus colegas sobre dificuldades relacionadas ao trabalho.',
                'I feel free to talk with my colleagues about difficulties related to work.',
                'Siento apertura para conversar con mis compañeros sobre dificultades relacionadas con el trabajo.',
                'Je me sens libre d\'échanger avec mes collègues au sujet des difficultés liées au travail.',
            ],
            [
                HSEGroup::SUPPORT,
                'Minhas ideias e minha presença são respeitadas pelos meus colegas?',
                'My ideas and my presence are respected by my colleagues.',
                'Mis ideas y mi presencia son respetadas por mis compañeros.',
                'Mes idées et ma présence sont respectées par mes collègues.',
            ],
            [
                HSEGroup::SUPPORT,
                'Tenho espaço e segurança para conversar com minha liderança sobre eventuais insatisfações?',
                'I have the space and safety to talk with my leadership about any dissatisfaction.',
                'Tengo espacio y seguridad para conversar con mi liderazgo sobre eventuales insatisfacciones.',
                "J'ai l'espace et la sécurité nécessaires pour parler avec ma hiérarchie d'éventuelles insatisfactions.",
            ],
            [
                HSEGroup::SUPPORT,
                'Encontro abertura junto aos meus colegas para compartilhar dificuldades do trabalho quando preciso?',
                'I find openness among my colleagues to share work difficulties when I need to.',
                'Encuentro apertura entre mis compañeros para compartir dificultades del trabajo cuando lo necesito.',
                "Je trouve de l'ouverture auprès de mes collègues pour partager les difficultés du travail lorsque j'en ai besoin.",
            ],
            [
                HSEGroup::SUPPORT,
                'Recebo suporte adequado quando enfrento tarefas mais exigentes ou desgastantes?',
                'I receive adequate support when I face more demanding or draining tasks.',
                'Recibo apoyo adecuado cuando enfrento tareas más exigentes o desgastantes.',
                'Je reçois un soutien adéquat lorsque je fais face à des tâches plus exigeantes ou éprouvantes.',
            ],
            [
                HSEGroup::SUPPORT,
                'A forma de atuar da minha liderança direta me inspira e me motiva no dia a dia?',
                'The way my direct leadership acts inspires and motivates me day to day.',
                'La forma de actuar de mi liderazgo directo me inspira y me motiva en el día a día.',
                "La façon d'agir de ma hiérarchie directe m'inspire et me motive au quotidien.",
            ],
        ];
    }
}
