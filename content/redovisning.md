---
...
Redovisning
=========================



Kmom01
-------------------------


**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**

Objekt och klasser är inget konstigt, jag har arbetat med det i andra språk såsom Java och C++.
Att hoppa rakt tillbaka i PHP gick sådär, behövde en del repetition.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**

GET och POST tyckte jag inte var så svårt, medans SESSION var lite svårare att förstå.

Jag lyckades också försvåra för mig själv genom att skriva lite stavfel på något ställe (- istället för _ ). Innan jag hittade stavfelet så trodde jag att jag hade missat något viktigt, så det kändes bra när jag kom på vad som var fel.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**

Vissa saker var inte helt självklara att hitta men inget jättekonstigt så jag kommer att vänja mig med vid strukturen.

Påminde en hel del om design-kursens struktur, fast med nya inslag som jag inte minns såsom page, debug, route.

**Vilken är din TIL för detta kmom?**

Jag är mest lite frustrerad över att jag lyckats glömma en del viktiga detaljer från tidigare (tex git saker och md-syntax).

Det känns så långt som att kursen kommer att vara en repetition av allt vi tidigare gjort, det är bra och ska bli roligt.


Kmom02
-------------------------


**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**

Det gick bra med hjälp av videoserien. Annars hade det varit mer utmanande.
När det väl är på plats känns det ganska naturligt.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**

Jag återanvände kod som redan fanns, Dice, DiceHand, skapade nya klasser Player (som har en DiceHand) och Game100 som har en array av Players.
Eftersom det var mycket ny kod så skapade jag en index sida utanför ramverket för att testa. Mycket av det jobbet kändes sedan bortkastat då det mesta fick göras om till ramverket, men lite fick jag väl testat.
Min lösning känns inte optimal men fungerar, hade gärna haft mindre kod i route-filen, men jag redde inte ut det. Det blev krångligt att hålla reda på var programmet var hela tiden dels i vyfilen och dels i routen, kanske kunde ha delats upp på något annat sätt.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**

Jag tycker make doc och doc-block är ett bra sätt att dokumentera kod, dock lätt hänt att det blir copy/paste fel någonstans. Jag brukar inte läsa sådan här dokumentation så jättemycket, kollar hellre i koden, där finns ju även mer kommentarer.
UML är väldigt bra sätt att beskriva klasser, det ger snabbt förståelse hur klasserna hänger ihop. Det underlättar att ha en UML utskriven när man jobbar med klasserna för att lätt hitta metodnamn och parametrar.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**

Det känns helt ok att skriva i ramverket när man väl vant sig med hur det ska delas upp och var saker ska ligga. Jag arbetade utanför ramverket med game100, men det var mycket som fick göras om sedan för att anpassas till vy-router.

**Vilken är din TIL för detta kmom?**

Jag har lärt mig mycket mer om objektorientering i PHP, om make doc och om lite mer om hur route och vyer samverkar.



Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**

Jag har arbetat med många olika sorts tester! T.ex. enhetstester (till egen och till andras kod), komponenttester (av klasser som hör ihop), integrationstester (integration av enstaka klasser såväl som integration inom större system och mellan olika system).

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**

Enhetstestning är viktigt och görs ofta av samma person som skrivit koden för att verifiera att den fungerar som tänkt.
Enhetstestning görs ofta i samband med att koden skrivs, dvs tidigt i processen, vilket är bra eftersom det är kostsamt att hitta felen sent (såsom hos en kund).
Det är bra att testa gränsvärden och villkor i sin enhetstestning såväl som att kontrollera sina publika metoder.
Att skapa enhetstester är en bra grund, men behöver oftast kompletteras med andra typer av tester för att verifiera att olika delar av systemet fungerar tillsammans.

Att skriva testbar kod är lite luddigt, men jag håller med om att olika kod är olika svårt att testa.
En lite mer sammansatt klass som har beteenden som beror på saker utanför den egna klassen är tex svårare att testa än våra exempel med Guess och Dice.
Om man tillämpar objektorientering och tydliga API-er mellan klasser kommer man långt för att ha sin kod testbar.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**

White box testning har insyn i och tar ev hänsyn till implementationen av koden. Eftersom designern själv ofta gör enhetstester så är de ofta av typen White box.

Black box testning försöker tänka testkoden som en hemlig låda där ingångar och utgångar undersöks, dvs kollar inte på arkitektur eller implementation. Kan vara bra för att verifiera ett API.

Grey box testning tänker jag är Black box testning med inslag av att tjuvkika i lådan/koden och anpassa tester utefter vad som upptäcks. Jag tror att fel upptäcks fortare med Grey box än med Black box testning.

Positiva tester syftar till att bekräfta att ett system fungerar som tänkt, medans negativa tester syftar till att undersöka hur felsäkert systemet är. Det är viktigt att ha båda sortens tester.

**Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?**

Uppgiften gick bra, provade dataproviders och flera olika sorters asserts. Testade med min egen Dice klass utöver den givna Guess.

**Vilken är din TIL för detta kmom?**

Kmom03 var väldigt enkelt, känns som det saknas något -kanske något från kmom02 kunde flyttas hit eller tvärtom.
Jag hade främst problem med installationen av phpunit och XDebug. Jag har tränat på att läsa manualer (phpunit) och lärt mig lite om enhetstestning i PHP.


Kmom04
-------------------------


**Vilka är dina tankar och funderingar kring trait och interface?**

Interface har jag stött på tidigare, men känner inte igen traits (från tex Java).
En variant på multipelt arv som funkar ganska bra.

**Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du?**

Jag var någorlunda nöjd med logiken som den redan var; spela säkert och spara för det mesta.
Datorn väljer fortsätt om motspelaren har mer än 75% samt det egna totala resultat är mindre än 100. (vilket dock kan vara lite dumt om datorn själv har ett lågt värde).

**Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur?**

Det gick smidigt att byta ut till ramverkets eget lager för GET, POST och SESSION.

**Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick.**

Jag lyckades få 100% codecoverage på allt utom Traitet. Men codecoverage säger inte allt.
Tror jag har testat och verkligen verifierat de flesta villkoren i alla if-satser med såväl ogiltiga inparametrar som giltiga (och inte bara använt koden för coverage' skull).

**Vilken är din TIL för detta kmom?**

Det som är nytt för mig i det här kmom-et är framförallt traits. Histogram i sig är också nytt för mig.


Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
