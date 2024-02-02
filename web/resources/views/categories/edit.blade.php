@extends('layouts.default')

@section('content')
<v-container>
    <v-row
        align="center"
        justify="space-between"
    >
        <h1>Изменить категорию</h1>
        <v-btn
          class="ma-2"
          color="darken-2"
          href="/links"
          link
        >
          <v-icon
            left
          >
            mdi-arrow-left
          </v-icon>Back
        </v-btn>
    </v-row>
</v-container>

@if(isset($edited))
<v-alert
  type="success"
  class="mt-4"
>
    Вы успешно изменили категорию!
</v-alert>
@endif

@include('categories.form.index')

@endsection