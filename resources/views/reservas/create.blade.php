<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('reservas.store') }}" method="POST">
                    @csrf
                    
                    <!-- Partida -->
                    <div class="mt-4">
                        <x-label for="partida" :value="__('Partida')" />
                        <x-input id="partida" class="block mt-1 w-full" type="text" name="partida" :value="old('partida')" required autofocus />
                    </div>

                    <!-- Destino -->
                    <div class="mt-4">
                        <x-label for="destino" :value="__('Destino')" />
                        <x-input id="destino" class="block mt-1 w-full" type="text" name="destino" :value="old('destino')" required />
                    </div>

                    <!-- Data de Ida -->
                    <div class="mt-4">
                        <x-label for="data_ida" :value="__('Data de Ida')" />
                        <x-input id="data_ida" class="block mt-1 w-full" type="date" name="data_ida" :value="old('data_ida')" required />
                    </div>

                    <!-- Data de Regresso -->
                    <div class="mt-4">
                        <x-label for="data_regresso" :value="__('Data de Regresso')" />
                        <x-input id="data_regresso" class="block mt-1 w-full" type="date" name="data_regresso" :value="old('data_regresso')" required />
                    </div>

                    <!-- Número de Passageiros -->
                    <div class="mt-4">
                        <x-label for="num_passageiros" :value="__('Número de Passageiros')" />
                        <x-input id="num_passageiros" class="block mt-1 w-full" type="number" name="num_passageiros" :value="old('num_passageiros')" required />
                    </div>

                    <!-- Nome do Responsável -->
                    <div class="mt-4">
                        <x-label for="nome_responsavel" :value="__('Nome do Responsável')" />
                        <x-input id="nome_responsavel" class="block mt-1 w-full" type="text" name="nome_responsavel" :value="old('nome_responsavel')" required />
                    </div>

                    <!-- Contato do Responsável -->
                    <div class="mt-4">
                        <x-label for="contato_responsavel" :value="__('Contato do Responsável')" />
                        <x-input id="contato_responsavel" class="block mt-1 w-full" type="text" name="contato_responsavel" :value="old('contato_responsavel')" required />
                    </div>

                    <!-- Dados do Amadeus (opcionalmente escondido do usuário final) -->
                    <div class="mt-4">
                        <x-label for="amadeus_data" :value="__('Dados do Amadeus')" />
                        <x-input id="amadeus_data" class="block mt-1 w-full" type="text" name="amadeus_data" :value="old('amadeus_data')" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Criar Reserva') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
