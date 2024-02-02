@extends('layouts.default')

@section('content')
<v-row
    align="center"
    justify="space-between"
>
  <v-col>
    <h1>Ссылки</h1>
  </v-col>
</v-row>

<form action="{{ route('links-delete') }}" method="post">
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
                Исходная ссылка
              </th>
              <th class="text-left">
                Конечная ссылка
              </th>
              <th class="text-left">
                Пользователь
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
            @foreach($links as $link)
            <tr>
              <td>{{ $link->id }}</td>
              <td>{{ $link->name }}</td>
              <td>
                <a target="_blank" href="{{ $link->initial_link }}">Перейти</a>
              </td>
              <td>
                <a target="_blank" href="{{ $link->full() }}">Перейти</a>
              </td>
              <td>{{ $link->user->name }}</td>
              <td>{{ $link->created_at }}</td>
              <td>{{ $link->updated_at }}</td>
              <td>
                @if($link->isOwned())
                  <v-row justify="end">
                      <v-btn href="/links/edit/{{ $link->id }}" link small class="mr-2">
                          <v-icon small>
                              edit
                          </v-icon>
                      </v-btn>
                      <v-btn onclick="deleteItem({{ $link->id }})" color="error" small class="mr-2">
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
        :length="{{ ceil($links->total() / $links->perPage())  }}" 
        :value="{{ $links->currentPage() }}"
        @input="onPaginate"
      />
      @if(!count($links))
        <v-container class="text-center">
          <p>Ссылок пока нет</p>  
        </v-container>
      @endif
  </v-card>
</form>

<v-row
  class="mt-3"
>
    <v-col class="d-flex justify-end" justify="end">
      <v-btn href="/links/create" link large color="primary">
          <v-icon left>add</v-icon>
          Добавить ссылку
      </v-btn>
    </v-col>
</v-row>
@endsection