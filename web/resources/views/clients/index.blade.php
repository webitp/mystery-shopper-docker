@extends('layouts.default')

@section('content')
<v-row
    align="center"
    justify="space-between"
>
  <v-col>
    <h1>Клиенты</h1>
  </v-col>
</v-row>

<v-card class="mt-6">
<v-simple-table>
    <template v-slot:default>
    <thead>
        <tr>
            <th style="width: 20px" class="text-left">
                #
            </th>
            <th class="text-left">
                Telegram ID
            </th>
            <th class="text-left">
                Имя пользователя
            </th>
            <th class="text-left">
                Ссылка
            </th>
            <th class="text-left">
                Уровень
            </th>
            <th class="text-left">
                Статус
            </th>
            <th class="text-left">
                Дата регистрации
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->tid }}</td>
            <td>{{ $client->username }}</td>
            <td>
                <a href="https://t.me/{{ $client->username }}" target="_blank">t.me/{{ $client->username }}</a>
            </td>
            <td>{{ $client->level }}</td>
            <td>@if($client->activeOffer) <span style="color: {{ $client->activeOffer->status()['color'] }}">{{ $client->activeOffer->status()['text'] }}</span> @else Оффер не выбран @endif</td>
            <td>{{ $client->created_at }}</td>
            <td style="width: 20px">
                <v-btn href="/clients/{{ $client->id }}" link small class="mr-2">
                    <v-icon small>
                        edit
                    </v-icon>
                </v-btn>
            </td>
        </tr>
        @endforeach
    </tbody>
    </template>
</v-simple-table>
<v-pagination 
    :length="{{ ceil($clients->total() / $clients->perPage())  }}" 
    :value="{{ $clients->currentPage() }}"
    @input="onPaginate"
/>
@if(!count($clients))
    <v-container class="text-center">
    <p>Клиентов пока нет</p>  
    </v-container>
@endif
</v-card>
@endsection