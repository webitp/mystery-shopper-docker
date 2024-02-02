<form id="form" action="{{ route('client', ['id' => $client->id]) }}" method="post">
    @csrf
    <v-container mt-2>
        <v-card>
            <v-container>
            <v-row>
                <v-col>
                    <h3>Telegram</h3>
                    <p class="mt-2" style="margin-bottom: 0px"><b>ID:</b> {{ $client->tid }}</p>
                    <p style="margin-bottom: 0;"><b>Ссылка:</b> <a target="_blank" href="https://t.me/{{ $client->username }}">t.me/{{ $client->username }}</a></p>
                </v-col>
            </v-row>
            @if($client->activeOffer)
                <v-row>
                    <v-col>
                        <h3>Текущий оффер</h3>
                        <p class="mt-2" style="margin-bottom: 0px"><b>Категория:</b> {{ $client->activeOffer->offer->category->name }}</p>
                        <p style="margin-bottom: 0;"><b>Название:</b> {{ $client->activeOffer->offer->name }}</p>
                    </v-col>
                    <v-col>
                        <h3>Статус</h3>
                        <select style="color: {{ $client->activeOffer->status()['color'] }}" name="state">
                            @foreach($statuses as $key => $status)
                                <option @if($key == $client->activeOffer->state) selected @endif value="{{ $key }}">{{ $status['text'] }}</option>
                            @endforeach
                        </select>
                    </v-col>
                </v-row>
            @endif
            @if($client->activeOffer && $client->activeOffer->photo)
                <v-row >
                    <v-col cols="6">
                        <h3>Предоставленное фото</h3>
                        <v-img
                            class="mt-3"
                            lazy-src="https://picsum.photos/id/11/10/6"
                            max-height="100%"
                            max-width="50%"
                            src="{{ $client->activeOffer->photo }}"
                        ></v-img>
                    </v-col>
                    @if($client->activeOffer->report)
                        <v-col cols="6">
                            <h3>Отчет</h3>
                            <p>{{ $client->activeOffer->report }}</p>
                        </v-col>
                    @endif
                </v-row>
            @endif
            <v-row>
                <v-col>
                    <h3>История офферов</h3>
                    <v-simple-table class="mt-3">
                        <template v-slot:default>
                        <thead>
                            <tr>
                                <th style="width: 20px" class="text-left">
                                    #
                                </th>
                                <th class="text-left">
                                    Категория
                                </th>
                                <th class="text-left">
                                    Название
                                </th>
                                <th class="text-left">
                                    Статус
                                </th>
                                <th class="text-left">
                                    Дата начала
                                </th>
                                <th class="text-left">
                                    Последнее обновление
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($client->offers as $offer)
                            <tr>
                                <td>{{ $offer->id }}</td>
                                <td>{{ $offer->offer->category->name }}</td>
                                <td>{{ $offer->offer->name }}</td>
                                <td style="color: {{ $offer->status()['color'] }}">{{ $offer->status()['text'] }}</td>
                                <td>{{ $offer->created_at }}</td>
                                <td>{{ $offer->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </template>
                    </v-simple-table>
                </v-col>
            </v-row>
            </v-container>
        </v-card>
    </v-container>
    <v-container>
        <div class="d-flex" style="justify-content: end;">
            <v-btn form="form" type="submit" color="primary" large>
                Сохранить
            </v-btn>
        </div>
    </v-container>
</form>