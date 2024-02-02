@extends('layouts.default')

@section('content')
<v-row
    align="center"
    justify="space-between"
>
  <v-col>
    <h1>Пользователи</h1>
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
            Имя
          </th>
          <th class="text-left">
            E-mail
          </th>
          <th class="text-left">
            Уровень доступа
          </th>
          <th class="text-left">
            Дата создания
          </th>
          <th class="text-left">
            Дата обновления
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->access }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </template>
  </v-simple-table>
  <v-pagination 
    :length="{{ ceil($users->total() / $users->perPage())  }}" 
    :value="{{ $users->currentPage() }}"
    @input="onPaginate"
  />
  @if(!count($users))
    <v-container class="text-center">
      <p>Пользователей пока нет</p>  
    </v-container>
  @endif
</v-card>

@endsection