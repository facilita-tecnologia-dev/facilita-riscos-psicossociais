@props([
    'filters' => [],
])

@if($filters)
    @if(isset($filters['name']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Nome: {{ $filters['name'] }}</span>
    @endif
    @if(isset($filters['cpf']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">CPF: {{ $filters['cpf'] }}</span>
    @endif
    @if(isset($filters['department']) && count($filters['department']) > 0)
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">
            Setor:
            @foreach ($filters['department'] as $department)
                {{ $department }}
                @if(!$loop->last), @endif
            @endforeach
        </span>
    @endif
    @if(isset($filters['occupation']) && count($filters['occupation']) > 0)
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">
            Função:
            @foreach ($filters['occupation'] as $occupation)
                @if(!$loop->first), @endif
                {{ $occupation }}
            @endforeach
        </span>
    @endif
    @if(isset($filters['gender']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Sexo: {{ $filters['gender'] }}</span>
    @endif
    @if(isset($filters['work_shift']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Turno: {{ $filters['work_shift'] }}</span>
    @endif
    @if(isset($filters['marital_status']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Estado civil: {{ $filters['marital_status'] }}</span>
    @endif
    @if(isset($filters['education_level']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Grau de instrução: {{ $filters['education_level'] }}</span>
    @endif
    @if(isset($filters['age_range']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Faixa etária: {{ $filters['age_range'] }} anos</span>
    @endif
    @if(isset($filters['admission_range']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Tempo de admissão: {{ $filters['admission_range'] }} anos</span>
    @endif
    @if(isset($filters['year']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Ano de realização dos testes: {{ $filters['year'] }}</span>
    @endif
    @if(isset($filters['has_answered_psychosocial']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Testes de Riscos Psicossociais: {{ $filters['has_answered_psychosocial'] }}</span>
    @endif
    @if(isset($filters['has_answered_organizational']))
        <span class="block px-3 py-1 rounded-md bg-gray-100/50 text-xs sm:text-sm">Testes de Clima Organizacional: {{ $filters['has_answered_organizational'] }}</span>
    @endif
@endif