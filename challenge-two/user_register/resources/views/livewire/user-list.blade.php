<div class="w-full p-3">
    <div class="bg-white border rounded shadow">
        <div class="border-b p-3">
            <h5 class="font-bold uppercase text-gray-600">Listagem de usuários</h5>
        </div>
        <div class="p-5">
            <div wire:loading wire:target="downgrade">
                Processando
            </div>
            <div wire:loading wire:target="upgrade">
                Processando
            </div>
            @if(count($users) > 0 )
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                            <th class="text-left text-blue-900">Nome</th>
                            <th class="text-left text-blue-900">Telefone</th>
                            <th class="text-left text-blue-900">Conta</th>
                            <th class="text-left text-blue-900">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ( $users as $user )
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->account }}</td>
                                <td>
                                    @if( $user->account == 'free')
                                        <button class="hover:text-blue-800" wire:click="upgrade('{{ $user->access_id }}')">Upgrade</button>
                                    @else
                                        <button class="hover:text-red-800" wire:click="downgrade('{{ $user->access_id }}')">Downgrade</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1>Desculpe! Nenhum usuário foi registrado.</h1>
            @endif
        </div>
    </div>
</div>
