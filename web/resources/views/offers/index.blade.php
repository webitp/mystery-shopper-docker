@extends('layouts.default')

@section('content')
<v-row
    align="center"
    justify="space-between"
>
  <v-col>
    <h1>Офферы</h1>
  </v-col>
</v-row>

<form action="{{ route('offers-delete') }}" method="post">
  @csrf
  <input style="display: none" name="id" type="text">

  <v-card class="mt-6">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th style="width: 20px" class="text-left">
                #
              </th>
              <th class="text-left">
                Название
              </th>
              <th class="text-left">
                Пользователь
              </th>
              <th class="text-left">
                Категория
              </th>
              <th class="text-left">
                Награда
              </th>
              <th class="text-left">
                Ссылка
              </th>
              <th class="text-left">
                Дата создания
              </th>
              <th class="text-left">
                Дата обновления
              </th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($offers as $offer)
            <tr>
              <td>{{ $offer->id }}</td>
              <td>{{ $offer->name }}</td>
              <td>{{ $offer->user->name }}</td>
              <td>{{ $offer->category->name }}</td>
              <td>{{ $offer->reward }} ₽</td>
              <td>
                <a target="_blank" href="{{ $offer->link->full() }}">Перейти</a>
              </td>
              <td>{{ $offer->created_at }}</td>
              <td>{{ $offer->updated_at }}</td>
              <td>
                @if($offer->isOwned())
                  <v-row justify="end">
                      <v-btn href="/offers/edit/{{ $offer->id }}" link small class="mr-2">
                          <v-icon small>
                              edit
                          </v-icon>
                      </v-btn>
                      <v-btn onclick="deleteItem({{ $offer->id }})" color="error" small class="mr-2">
                          <v-icon small>
                              delete
                          </v-icon>
                      </v-btn>
                  </v-row>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </template>
      </v-simple-table>
      <v-pagination 
        :length="{{ ceil($offers->total() / $offers->perPage())  }}" 
        :value="{{ $offers->currentPage() }}"
        @input="onPaginate"
      />
      @if(!count($offers))
        <v-container class="text-center">
          <p>Офферов пока нет</p>  
        </v-container>
      @endif
  </v-card>
</form>

<v-row
  class="mt-3"
>
    <v-col class="d-flex justify-end" justify="end">
      <v-btn href="/offers/create" link large color="primary">
          <v-icon left>add</v-icon>
          Добавить оффер
      </v-btn>
    </v-col>
</v-row>
@endsection