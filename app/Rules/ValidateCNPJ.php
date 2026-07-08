<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateCNPJ implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * Suporta tanto o CNPJ numérico tradicional quanto o novo formato
     * alfanumérico da Receita Federal (Instrução Normativa RFB nº 2.229/2024):
     * os 12 primeiros caracteres (raiz + ordem) podem ser letras maiúsculas
     * ou números, e os 2 dígitos verificadores continuam sempre numéricos.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = strtoupper((string) $value);

        if (! preg_match('/^[A-Z0-9]{2}\.[A-Z0-9]{3}\.[A-Z0-9]{3}\/[A-Z0-9]{4}-\d{2}$/', $value)) {
            $fail('O CNPJ deve estar no formato 00.000.000/0000-00.');

            return;
        }

        $cnpj = preg_replace('/[.\/\-]/', '', $value);

        if (strlen($cnpj) !== 14) {
            $fail('O CNPJ informado é inválido.');

            return;
        }

        if (preg_match('/^(.)\1*$/', $cnpj)) {
            $fail('O CNPJ informado é inválido.');

            return;
        }

        // Conforme o Anexo XV da IN RFB nº 2.119/2022: cada caractere (dígito
        // ou letra maiúscula) vira seu valor ASCII menos 48 antes de aplicar
        // os pesos. Para dígitos isso resulta no próprio valor numérico.
        $calcDigit = function (string $cnpjPart, array $weights): int {
            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += (ord($cnpjPart[$index]) - 48) * $weight;
            }
            $remainder = $sum % 11;

            return ($remainder < 2) ? 0 : 11 - $remainder;
        };

        $weightsFirst = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $firstDigit = $calcDigit(substr($cnpj, 0, 12), $weightsFirst);

        if ((int) $cnpj[12] !== $firstDigit) {
            $fail('O CNPJ informado é inválido.');

            return;
        }

        $weightsSecond = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $secondDigit = $calcDigit(substr($cnpj, 0, 13), $weightsSecond);

        if ((int) $cnpj[13] !== $secondDigit) {
            $fail('O CNPJ informado é inválido.');

            return;
        }
    }
}
