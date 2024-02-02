@extends('layouts.default')

@section('content')
<v-container>
    <v-row
        align="center"
        justify="space-between"
    >
        <h1>Клиент #{{ $client->id }}</h1>
        <v-btn
          class="ma-2"
          color="darken-2"
          href="/clients"
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
    Вы успешно изменили клиента!
</v-alert>
@endif

@include('clients.form.index')

@endsection