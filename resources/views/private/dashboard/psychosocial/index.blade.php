<x-layouts.app>
    <x-structure.page-container>
        
        <x-structure.sidebar />
        
        <x-structure.main-content-container>        
            <x-structure.page-title 
                title="Riscos Psicossociais" 
                :breadcrumbs="[
                    'Riscos Psicossociais' => ''
                ]"
            />

            <div class="w-full flex flex-col gap-4">
                <div class="w-full flex flex-col md:flex-row gap-2">
                    <x-structure.message>
                        @if($participation['Geral']['percentage'] >= 75)
                            <i class="fa-solid fa-check"></i>
                            A adesão é superior à 75%, portanto os resultados devem ser considerados válidos.
                        @else
                            <i class="fa-solid fa-xmark"></i>
                            A adesão é inferior à 75%, portanto os resultados não devem ser considerados válidos.
                        @endif
                    </x-structure.message>

                    <div class="w-full md:w-fit">
                        <x-action href="{{ route('dashboard.psychosocial.risks') }}" width="full">
                            Visualizar Riscos
                        </x-action>
                    </div> 
                </div>
                
                <div class="w-full flex flex-col-reverse md:flex-row gap-4 items-start">
                    <div class="flex items-center gap-2 w-full flex-wrap">
                        <x-numbers-of-records :value="$participation['Geral']['count']" />
                        
                        <x-applied-filters :filters="$filters"/>
                    </div>

                    <x-filter-actions
                        :filters="$filters"
                        :modalFilters="['gender', 'department', 'occupation', 'work_shift', 'marital_status', 'education_level', 'age_range', 'admission_range', 'year']" 
                    />
                </div>
            </div>

            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($dashboard as $group => $risks)
                    <div class="w-full px-2 py-6 flex flex-col justify-start gap-5 items-center shadow-md rounded-md bg-gray-100/60 {{ $loop->last ? 'md:col-span-2' : '' }}">
                        <p class="text-center font-semibold truncate">{{ App\Enums\CollectionFactorTypes::from($group)->label() }}</p>
                        
                        @if(isset($risks) && $risks->isNotEmpty())
                            <div class="w-full grid {{ $loop->last ? 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4' : 'grid-cols-1 lg:grid-cols-2' }} gap-2 px-2 md:px-4">
                                @foreach ($risks as $type => $risk)
                                    <x-charts.risk-bar type="{{ $type }}" :risk="$risk" href="{{ route('dashboard.psychosocial.department', ['risk' => $type ])}}" />
                                @endforeach
                            </div>             
                        @endif
                    </div>
                @endforeach
            </div>

            @if($filters->isEmpty())
                <x-charts.bar-vertical id="psychosocial-participation" title="Participação no teste de Riscos Psicossociais" />
            @endif
            
        </x-structure.main-content-container>
    </x-structure.page-container>
</x-layouts.app>

<script>
     const participation = @json($participation);
     const dashboard = @json($dashboard)
</script>

<script src="{{ asset('js/dashboard/charts.js') }}"></script>
<script src="{{ asset('js/dashboard/psychosocial/index.js') }}"></script>