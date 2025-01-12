<!DOCTYPE html>
<html lang="pl">
<head>
      <!-- Styles -->
      <link id="theme-style" href="{{ asset('css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('js/themeSwitcher.js') }}"></script>
    <!-- Styles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <style>
        /* Dostosowanie do ASCII Art */
        pre {
            font-family: 'Courier New', monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-x: auto; /* Dodaje pasek przewijania, jeśli obrazek jest za szeroki */
            width: 100%;
            margin: 20px 0;
        }
        /* Kontener dla tekstu */
        .description {
            font-size: 1.2em;
            margin: 20px 0;
            line-height: 1.6;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #4a90e2;
        }
    </style>
</head>
<body>
    <h1>Witaj na stronie głównej!</h1>
    <!-- Styles -->
    <button onclick="speakText()">Mów</button>
    <button onclick="stopSpeaking()">Zatrzymaj</button>
    <select id="style-selector">
        <option value="main">Standardowy</option>
        <option value="daltonism">Dla daltonistów</option>
        <option value="mono">Wysoki kontrast</option>
    </select>
    <!-- Przyciski do zmiany wielkości czcionki -->
    <button onclick="changeFontSize('increase')">Zwiększ czcionkę</button>
    <button onclick="changeFontSize('decrease')">Zmniejsz czcionkę</button>
    <!-- Styles -->
    <!-- Opis -->
    <div class="description">
        <p>W mrocznych zakamarkach księgarni, gdzie każda książka czeka na swojego czytelnika, odkrywasz miejsce, w którym to Ty panujesz nad czasem. Rezerwuj swoje ulubione tytuły z łatwością i przygotuj się na spotkanie z bohaterami, którzy tylko czekają, by opowiedzieć Ci swoją historię. Zarezerwuj książki w naszej księgarni, a my dostarczymy Ci je w sam raz na czas, byś mógł zanurzyć się w świecie pełnym przygód i tajemnic. Twoja podróż literacka zaczyna się tutaj, w jednym kliknięciu!</p>
    </div>

    <!-- ASCII Art: Głowa smoka -->
    <pre>
        _--^^^#####//      \\#####^^^--_
     _-^##########// (    ) \\##########^-_
    -############//  |\^^/|  \\############-
  _/############//   (@::@)   \\############\_
 /#############((     \\//     ))#############\
-###############\\    (oo)    //###############-
-#################\\  / UUU \  //#################-
-###################\\/  (   )  \//###################-
_#/|##########/\######(   /   \   )######/\##########|\#_
|/ |#/\#/\#/\/  \#/\##\  |(     )|  /##/\#/  \/\#/\#/\| \
 `  |/  V  \|   `  |/  | |     | |  \|  V  /  |/  V  \|  `
    </pre>

    <!-- Linki do logowania i rejestracji -->
    <a href="{{ route('login') }}">Logowanie</a>
    <a href="{{ route('register') }}">Rejestracja</a>
</body>
</html>
