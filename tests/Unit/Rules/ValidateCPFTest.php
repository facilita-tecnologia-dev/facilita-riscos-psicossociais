<?php

use App\Rules\ValidateCPF;

function cpfFails(string $value): bool
{
    $failed = false;
    (new ValidateCPF())->validate('cpf', $value, function () use (&$failed) {
        $failed = true;
    });
    return $failed;
}

function cpfPasses(string $value): bool
{
    return ! cpfFails($value);
}

describe('format validation', function () {
    it('rejects CPF without formatting', function () {
        expect(cpfFails('12345678909'))->toBeTrue();
    });

    it('rejects CPF with wrong separator pattern', function () {
        expect(cpfFails('123-456-789/09'))->toBeTrue();
    });

    it('rejects empty string', function () {
        expect(cpfFails(''))->toBeTrue();
    });

    it('accepts correctly formatted CPF', function () {
        expect(cpfPasses('123.456.789-09'))->toBeTrue();
    });
});

describe('digit sequence validation', function () {
    it('rejects all-same-digit CPF (000.000.000-00)', function () {
        expect(cpfFails('000.000.000-00'))->toBeTrue();
    });

    it('rejects 111.111.111-11', function () {
        expect(cpfFails('111.111.111-11'))->toBeTrue();
    });

    it('rejects 999.999.999-99', function () {
        expect(cpfFails('999.999.999-99'))->toBeTrue();
    });
});

describe('checksum validation', function () {
    it('rejects CPF with wrong check digits', function () {
        expect(cpfFails('123.456.789-00'))->toBeTrue();
        expect(cpfFails('245.765.987-01'))->toBeTrue();
    });

    it('passes CPF with correct check digits (123.456.789-09)', function () {
        expect(cpfPasses('123.456.789-09'))->toBeTrue();
    });

    it('passes CPF 529.982.247-25', function () {
        expect(cpfPasses('529.982.247-25'))->toBeTrue();
    });

    it('passes CPF 222.333.444-05', function () {
        expect(cpfPasses('222.333.444-05'))->toBeTrue();
    });

    it('passes CPF 871.657.970-41', function () {
        expect(cpfPasses('871.657.970-41'))->toBeTrue();
    });
});
