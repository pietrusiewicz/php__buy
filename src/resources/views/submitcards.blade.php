@extends('layout')

@section('content')
    <p>Otrzymane czerwone kartki: {{$red}}</p>
    @if ($red == 0)
        <p>Brak kartek.</p>
    
    @elseif ($red == 1)
        <p>Ostrzeżenie dla zespołu.</p>
    @elseif ($red == 2)
        <p>Gracz zostaje wykluczony z meczu.</p>
    @elseif ($red == 3)
        <p>Zespół kończy grę z trzema zawodnikami mniej.</p>
    @elseif ($red == 4)
        <p>Możliwe rozważenie przerwania meczu ze względu na liczebność zawodników.</p>
    @elseif ($red == 5)
        <p>Zespół przegrywa przez wykluczenie z powodu braku zawodników.</p>
    @endif

    @if ($red > 0)
    <ul style="background:red">
        <li>Bardzo brutalny faul – np. atak w nogi przeciwnika z dużą siłą, który może grozić kontuzją.</li>
        <li>Użycie przemocy – np. uderzenie przeciwnika, celowe popchnięcie z dużą siłą, kopnięcie lub podobne działania.</li>
        <li>Zatrzymanie piłki ręką w sytuacji bramkowej – celowe zagranie ręką, które uniemożliwia zdobycie bramki przeciwnikowi.</li>
        <li>Obrażanie lub groźby wobec sędziego – kierowanie słów lub gestów, które są obraźliwe lub zastraszające w stosunku do sędziego.</li>
        <li>Celowe kopnięcie przeciwnika bez piłki – np. w ramach zemsty lub próby wywołania bójki.</li>
    </ul>
    @endif

    <p>Otrzymane żółte kartki: {{$yellow}}</p>
    @if ($yellow == 0)
        <p>Gra fair play.</p>
    
    @elseif ($yellow == 1)
        <p>Ostrzeżenie dla zawodnika.</p>
    @elseif ($yellow == 2)
        <p>Gracz otrzymuje czerwoną kartkę i zostaje usunięty z boiska.</p>
    @elseif ($yellow == 3)
        <p>Dwa ostrzeżenia dla różnych zawodników.</p>
    @elseif ($yellow == 4)
        <p>Czterech różnych zawodników otrzymało ostrzeżenia.</p>
    @elseif ($yellow == 5)
        <p>Więcej niż połowa zespołu została ostrzeżona; grozi przejście na czerwoną kartkę przy kolejnym przewinieniu.</p>
    @endif

    @if ($yellow > 0)
    <ul style="background:yellow">
        <li>Opóźnianie wznowienia gry – celowe opóźnianie czasu przez zawodnika, np. poprzez powolne wykonywanie rzutów wolnych lub autów.</li>
        <li>Symulowanie faulu – udawanie kontuzji lub przewinienia przeciwnika, aby wymusić na sędzim decyzję o faulu.</li>
        <li>Wejście na murawę bez zgody sędziego – gdy zawodnik wchodzi na boisko po opuszczeniu go, np. z powodu urazu, bez wcześniejszej zgody sędziego.</li>
        <li>Niesportowe zachowanie – np. wulgarne gesty, przesadne celebrowanie bramki lub prowokowanie przeciwnika.</li>
        <li>Nierozważne zachowanie – np. podniesienie nogi za wysoko przy próbie odebrania piłki, co mogłoby zagrozić przeciwnikowi.</li>
    </ul>
    @endif
@endsection