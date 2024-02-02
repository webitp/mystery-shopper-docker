@extends('layouts.default')

@section('content')
<v-row
    align="center"
    justify="space-between"
>
  <v-col>
    <h1>Категории</h1>
  </v-col>
</v-row>

<form action="{{ route('categories-delete') }}" method="post">
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
              Дата создания
            </th>
            <th class="text-left">
              Дата обновления
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->user->name }}</td>
              <td>{{ $category->created_at }}</td>
              <td>{{ $category->updated_at }}</td>
              <td>
                @if($category->isOwned())
                <v-row justify="end">
                  <v-btn href="/categories/edit/{{ $category->id }}" link small class="mr-2">
                    <v-icon small>
                      edit
                    </v-icon>
                  </v-btn>
                  <v-btn onclick="deleteItem({{ $category->id }})" color="error" small class="mr-2">
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
      :length="{{ ceil($categories->total() / $categories->perPage())  }}" 
      :value="{{ $categories->currentPage() }}"
      @input="onPaginate"
    />
    @if(!count($categories))
      <v-container class="text-center">
        <p>Категорий пока нет</p>  
      </v-container>
    @endif
  </v-card>
</form>

@if($canCreate)
<v-row
  class="mt-3"
>
    <v-col class="d-flex justify-end" justify="end">
      <v-btn href="/categories/create" link large color="primary">
          <v-icon left>add</v-icon>
          Добавить категорию
      </v-btn>
    </v-col>
</v-row>
@endif
@endsection