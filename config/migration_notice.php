<?php

/*
| Passagem para o Facilita RH (RP21 da migração para o sistema novo).
|
| Cada empresa migrada entra em MIGRATION_NOTICE_COMPANIES como "id:data da virada" (ex.: "4:2026-10-20,124:2026-11-03").
| Quem é dessa empresa, ao entrar ou abrir qualquer tela, vê a passagem: o aviso de que em X dias este endereço sai do
| ar para ela e o botão para o Facilita RH (empresa) ou para o Facilita Conecta (funcionário). Passados os X dias, vai
| direto. As empresas que não estão na lista continuam usando este sistema normalmente.
*/

$companies = [];
foreach (array_filter(array_map('trim', explode(',', (string) env('MIGRATION_NOTICE_COMPANIES', '')))) as $entry) {
    [$id, $date] = array_pad(explode(':', $entry, 2), 2, null);
    if (ctype_digit((string) $id) && $date !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $companies[(int) $id] = $date;
    }
}

return [
    'companies' => $companies,
    'days' => (int) env('MIGRATION_NOTICE_DAYS', 30),
    'company_url' => env('MIGRATION_NOTICE_COMPANY_URL', 'https://facilitarh.com.br'),
    'user_url' => env('MIGRATION_NOTICE_USER_URL', 'https://conecta.facilitarh.com.br'),
];
