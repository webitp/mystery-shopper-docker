<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mystery Shopper</title>
</head>
<body>
    <div id="app">
        <v-app>
            <v-navigation-drawer app dark permanent>
                <v-toolbar flat class="transparent">
                    <h1>Mystery Shopper</h1>
                </v-toolbar>
        
                <v-list class="pt-0" dense>
                    <v-divider></v-divider>

                    <v-list-item
                        href="/categories"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>folder_open</v-icon>
                        </v-list-item-icon>
        
                        <v-list-item-content>
                            <v-list-item-title>Категории</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
        
                    <v-list-item
                        href="/offers"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>dashboard</v-icon>
                        </v-list-item-icon>
        
                        <v-list-item-content>
                            <v-list-item-title>Офферы</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item
                        href="/links"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>link</v-icon>
                        </v-list-item-icon>
        
                        <v-list-item-content>
                            <v-list-item-title>Ссылки</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    
                    <v-list-item
                        href="/clients"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>list</v-icon>
                        </v-list-item-icon>
        
                        <v-list-item-content>
                            <v-list-item-title>Клиенты</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    @if(Auth::user()->isAdmin())
                    <v-list-item
                        href="/users"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>list</v-icon>
                        </v-list-item-icon>
        
                        <v-list-item-content>
                            <v-list-item-title>Пользователи</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    @endif
                </v-list>
            </v-navigation-drawer>

            <!-- Sizes your content based upon application components -->
            <v-main>
                <v-container fluid>
                    @yield('content')
                </v-container>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="/js/functions.js"></script>
</body>
</html>