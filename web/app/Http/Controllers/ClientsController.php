<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientOffer;
use App\Services\BotService;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::paginate(15)
        ]);
    }

    public function show($id)
    {
        $client = Client::where('id', '=', $id)->first();
        if ($client) {
            return view('clients.show', [
                'client' => $client,
                'statuses' => ClientOffer::$statuses
            ]);
        }
        else
            return abort(404);
    }

    public function edit($id, Request $request)
    {
        $client = Client::where('id', '=', $id)->with(['activeOffer'])->first();
        if ($client) {
            if ($client->activeOffer) {
                $state = $request->input('state');
                if ($state != $client->activeOffer->state) {
                    $chat_id = $client->tid;

                    if ($state == 2) {
                        $message = $client->activeOffer->offer->text_step_2;
                        $reply_markup = [
                            "keyboard" => [
                                [
                                    [
                                        'text' => 'Отправить отчет'
                                    ],
                                    [
                                        'text' => 'Форма отчета'
                                    ]
                                ]
                            ]
                        ];
                        $bot = new BotService();
                        $bot->sendMessage($chat_id, $message, $reply_markup);
                    }

                    if ($state == 3) {
                        $message = 'Поздравляю, вы успешно выполнили задание! Выполняя задания, вы повышаете свою квалификацию, это позволит вам получать более сложные и высокооплачиваемые задания';
                        $reply_markup = [
                            "keyboard" => [
                                [
                                    [
                                        'text' => 'Задания'
                                    ],
                                    [
                                        'text' => 'Мои задания'
                                    ],
                                    [
                                        'text' => 'Мой уровень'
                                    ]
                                ],
                                [
                                    [
                                        'text' => 'Отзывы'
                                    ],
                                    [
                                        'text' => 'Поддержка'
                                    ]
                                ]
                            ]
                        ];
                        $bot = new BotService();
                        $bot->sendMessage($chat_id, $message, $reply_markup);
                    }

                    if ($state == 4) {
                        $message = 'К сожалению, задание было отклонено! Попробуйте еще раз или возьмите другое задание.';

                        $reply_markup = [
                            "keyboard" => [
                                [
                                    [
                                        'text' => 'Задания'
                                    ],
                                    [
                                        'text' => 'Мои задания'
                                    ],
                                    [
                                        'text' => 'Мой уровень'
                                    ]
                                ],
                                [
                                    [
                                        'text' => 'Отзывы'
                                    ],
                                    [
                                        'text' => 'Поддержка'
                                    ]
                                ]
                            ]
                        ];

                        if ($client->activeOffer->offer->is_test) {
                            $reply_markup = [
                                "keyboard" => [
                                    [
                                        [
                                            'text' => 'Тестовое задание'
                                        ],
                                        [
                                            'text' => 'Мой уровень'
                                        ]
                                    ],
                                    [
                                        [
                                            'text' => 'Отзывы'
                                        ],
                                        [
                                            'text' => 'Поддержка'
                                        ]
                                    ]
                                ]
                            ];
                        }

                        $bot = new BotService();
                        $bot->sendMessage($chat_id, $message, $reply_markup);
                    }
                }

                $client->activeOffer->state = $state;
                $client->activeOffer->save();
            }
            return view('clients.show', [
                'client' => $client,
                'statuses' => ClientOffer::$statuses,
                'edited' => true
            ]);
        }
        else
            return abort(404);
    }
}
