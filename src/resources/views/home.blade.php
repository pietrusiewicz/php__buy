@extends('layout')

@section('content')
<h1>Piłka nożna</h1>
<p>Piłka nożna to wyjątkowy sport, cieszący się popularnością na całym świecie, uprawiany w każdym kraju i na różnych poziomach. Zasady gry są jednolite od finału mistrzostw świata po mecze dzieci w odległych miejscowościach. To właśnie ta spójność stanowi największą wartość futbolu – coś, co należy pielęgnować, aby rozwijać piłkę nożną na całym globie.</p>
<hr/>
<p>Przepisy piłkarskie muszą opierać się na uczciwości, będącej podstawą piękna tej dyscypliny, co tworzy „ducha” gry. Najbardziej ekscytujące mecze to te, w których sędzia jest prawie nieobecny, a zawodnicy grają z szacunkiem dla siebie nawzajem, dla sędziego i dla samych Przepisów Gry. W porównaniu z innymi sportami zespołowymi zasady piłki nożnej są stosunkowo proste, jednak wiele sytuacji wymaga subiektywnej oceny sędziego, co niekiedy prowadzi do błędów lub kontrowersji. Niektórzy uznają te dyskusje za integralną część futbolu, podnoszącą jego atrakcyjność. Mimo to, niezależnie od słuszności decyzji, „duch gry” wymaga zawsze poszanowania decyzji sędziów.</p>
<hr/>
<p>Trenerzy i kapitanowie, jako osoby posiadające autorytet, mają obowiązek wspierać poszanowanie sędziów oraz ich decyzji. Przepisy nie obejmują wszystkich sytuacji, dlatego gdy pojawia się coś nietypowego, IFAB oczekuje, że sędzia postąpi zgodnie z duchem gry, zadając sobie pytanie: „czego oczekiwałaby społeczność piłkarska?”.</p>
<hr/>
<p>Przepisy służą także zapewnieniu bezpieczeństwa i ochronie zdrowia graczy. IFAB reaguje na bieżąco, wspierając zawodników poprzez odpowiednie zmiany w Przepisach Gry. Przykładem jest modyfikacja Artykułu 3 w związku z pandemią COVID-19, która pozwoliła zwiększyć liczbę zmian z trzech do pięciu w najwyższych ligach. Wprowadzono też testy dodatkowej zmiany w przypadku podejrzenia wstrząśnienia mózgu, aby zdrowie zawodników było priorytetem i aby zespoły nie traciły przewagi liczebnej.</p>
<hr/>
<p>Wypadki są nieuniknione, jednak celem Przepisów jest maksymalizacja bezpieczeństwa przy zachowaniu ducha fair play. Wymaga to od sędziów stosowania przepisów, by reagować na agresywne lub niebezpieczne zachowania zawodników. Zasady jasno określają brak tolerancji dla gry zagrażającej zdrowiu przez pojęcia takie jak „nierozważny atak”, „zagrożenie bezpieczeństwa przeciwnika” czy „użycie nieproporcjonalnej siły”.</p>
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif
@endsection