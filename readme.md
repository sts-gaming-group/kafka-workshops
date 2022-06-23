# Kafka
### Broker: 34.116.153.222:9092

# Zadanie: 
Stworzyć aplikację opartą o Apache Kafka, która będzie składała się z producera wiadomości oraz konsumera.

## Producer: 

publikuje do Kafki wiadomości co 100ms z następującym pyloadem w formie JSON:

```json
{
  "event":"registration",
  "data":{
    "id":"<kolejny integer inkrementowany co 1>",
    "username":"<losowe imię z biblioteki Faker>",
    "registered_at":"<bieżaca DateTime>",
    "age":"<losowy integer z zakresu 10-30>"
  }
}
```

Producer wrzuca eventy do 4 partycji (partycję wyznaczamy jako data.id modulo 4, czyli rejestracja klienta o id 1 leci 
do partycji nr 1, klienta id 4 do partycji 0, klienta 6 do partycji 2 i tak dalej.

Uwaga używamy topiku o nazwie phpers_imie_nazwisko

## Konsumer:

konsumuje wiadomości z powyższego topiku w sposób następujacy:
- Zaloguj informacje o osobie niepełnoletniej,
- Wyślij wszystkie dane użytkownika pełnoletniego (age > 18) do endpointu https://sznapka.pl/api.php?mode=random_failures.
Uwaga, Powyższyszy endpoint będzie co jakiś czas zwracał HTTP 500, w takim wypadku wykonaj akcję ponownie 
(używając opcji retry policy z kafka-bundle).