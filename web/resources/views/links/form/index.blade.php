@if ($errors->any())
  <v-alert
    type="error"
    class="mt-4"
  >
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </v-alert>
@endif

<form id="form" action="{{ isset($link) ? route('links-edit', ['id' => $link->id]) : route('links-create') }}" method="post">
  @csrf
  <v-container mt-2>
    <v-card>
      <v-container>
        <v-row>
          <v-col>
            <v-text-field
              name="name"
              value="@if(isset($link)) {{ $link->name }} @endif"
              :counter="255"
              label="Название"
              outlined
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              name="initial_link"
              value="@if(isset($link)) {{ $link->initial_link }} @endif"
              :counter="255"
              label="Ссылка"
              outlined
              required
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
  </v-container>
  <v-container>
    <div class="d-flex" style="justify-content: end;">
      <v-btn form="form" type="submit" color="primary" large>
        {{ isset($link) ? 'Сохранить' : 'Создать' }}
      </v-btn>
    </div>
  </v-container>
</form>