@extends('layouts.default')

@section('content')
<v-container>
    <v-row
        align="center"
        justify="space-between"
    >
        <h1>Добавить ссылку</h1>
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

@include('links.form.index')

@endsection