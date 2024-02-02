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

<form id="form" action="{{ isset($category) ? route('categories-edit', ['id' => $category->id]) : route('categories-create') }}" method="post">
  @csrf
  <v-container mt-2>
    <v-card>
      <v-container>
        <v-row>
          <v-col>
            <v-text-field
              name="name"
              value="@if(isset($category)) {{ $category->name }} @endif"
              :counter="255"
              label="Название"
              outlined
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-textarea
              name="report"
              value="@if(isset($category)) {{ $category->report }} @endif"
              required
              outlined
            >
              <template v-slot:label>
                <div>
                  Пример отчета:
                </div>
              </template>
            </v-textarea>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
  </v-container>
  <v-container>
    <div class="d-flex" style="justify-content: end;">
      <v-btn form="form" type="submit" color="primary" large>
        {{ isset($category) ? 'Сохранить' : 'Создать' }}
      </v-btn>
    </div>
  </v-container>
</form>