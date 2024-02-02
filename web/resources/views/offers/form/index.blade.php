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

<form id="form" action="{{ isset($offer) ? route('offers-edit', ['id' => $offer->id]) : route('offers-create') }}" method="post">
  @csrf
  <v-container mt-2>
    <v-card>
      <v-container>
        <v-row align="center">
          <v-col>
            <label for="category_id">Категория: </label>
            <select name="category_id">
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </v-col>
          <v-col>
            <label for="link_id">Ссылка: </label>
            <select name="link_id">
              @foreach($links as $link)
                <option value="{{ $link->id }}">{{ $link->name }}</option>
              @endforeach
            </select>
          </v-col>
          <v-col>
            <input type="checkbox" name="is_test" @if(isset($offer) && $offer->is_test) checked @endif>
            <label for="is_test">Тестовое задание</label>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              name="name"
              value="@if(isset($offer)) {{ $offer->name }} @endif"
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
              name="reward"
              value="@if(isset($offer)) {{ $offer->reward }} @endif"
              min="0"
              label="Награда"
              outlined
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-textarea
              name="text_actions"
              value="@if(isset($offer)) {{ $offer->text_actions }} @endif"
              required
              outlined
            >
              <template v-slot:label>
                <div>
                  Текст действия
                </div>
              </template>
            </v-textarea>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-textarea
              name="text_step_1"
              value="@if(isset($offer)) {{ $offer->text_step_1 }} @endif"
              required
              outlined
            >
              <template v-slot:label>
                <div>
                  Текст (Шаг: 1)
                </div>
              </template>
            </v-textarea>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-textarea
              name="text_step_2"
              value="@if(isset($offer)) {{ $offer->text_step_2 }} @endif"
              required
              outlined
            >
              <template v-slot:label>
                <div>
                  Текст (Шаг: 2)
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
        {{ isset($link) ? 'Сохранить' : 'Создать' }}
      </v-btn>
    </div>
  </v-container>
</form>