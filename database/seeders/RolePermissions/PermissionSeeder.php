<?php

namespace Database\Seeders\RolePermissions;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::insert([
            [
                'name' => 'Responder Campanhas',
                'key_name' => 'answer_tests',
                'description' => 'Habilita o usuário a responder campanhas de testes.',
            ],
            [
                'name' => 'Ver Dashboard de Riscos Psicossociais',
                'key_name' => 'psychosocial_dashboard_view',
                'description' => 'Habilita o usuário para ver as telas do Dashboard de Riscos Psicossociais.',
            ],
            [
                'name' => 'Editar Medidas de Controle',
                'key_name' => 'control_action_edit',
                'description' => 'Habilita o usuário para ver editar as Medidas de Controle de Riscos Psicossociais.',
            ],
            [
                'name' => 'Editar Indicadores/Dados de Desempenho',
                'key_name' => 'indicator_edit',
                'description' => 'Habilita o usuário para ver editar os Indicadores de de Riscos Psicossociais.',
            ],

            [
                'name' => 'Ver Dashboard de Clima Organizacional',
                'key_name' => 'organizational_dashboard_view',
                'description' => 'Habilita o usuário para ver as telas do Dashboard de Clima Organizacional.',
            ],
            [
                'name' => 'Customizar formulários de Pesquisa de Clima',
                'key_name' => 'organizational_custom_collection_edit',
                'description' => 'Habilita o usuário para editar os formulários de Pesquisa de Clima Organizacional.',
            ],
            [
                'name' => 'Ver Lista de Feedbacks de Clima Organizacional',
                'key_name' => 'feedbacks_index',
                'description' => 'Habilita o usuário para ver a Lista de Feedbacks de Clima Organizacional.',
            ],

            [
                'name' => 'Criar campanhas',
                'key_name' => 'campaign_create',
                'description' => 'Habilita o usuário para criar campanhas para a empresa.',
            ],
            [
                'name' => 'Editar campanhas',
                'key_name' => 'campaign_edit',
                'description' => 'Habilita o usuário para editar as campanhas da empresa.',
            ],
            [
                'name' => 'Ver lista de campanhas',
                'key_name' => 'campaign_index',
                'description' => 'Habilita o usuário para ver as campanhas da empresa.',
            ],



            [
                'name' => 'Criar/Importar colaboradores',
                'key_name' => 'user_create',
                'description' => 'Habilita o usuário para criar ou importar colaboradores.',
            ],
            [
                'name' => 'Ver lista de colaboradores',
                'key_name' => 'user_index',
                'description' => 'Habilita o usuário para ver a lista de colaboradores.',
            ],
            [
                'name' => 'Editar perfil dos colaboradores',
                'key_name' => 'user_edit',
                'description' => 'Habilita o usuário para editar o perfil dos colaboradores.',
            ],


            [
                'name' => 'Ver perfil da empresa',
                'key_name' => 'company_show',
                'description' => 'Habilita o usuário para ver o perfil da empresa.',
            ],
            [
                'name' => 'Editar perfil da empresa',
                'key_name' => 'company_edit',
                'description' => 'Habilita o usuário para editar o perfil da empresa.',
            ],

          
            [
                'name' => 'Ver documentação do sistema',
                'key_name' => 'documentation_show',
                'description' => 'Habilita o usuário para ver a documentação do sistema.',
            ],
        ]);

        $this->call(RolePermissionSeeder::class);
    }
}
