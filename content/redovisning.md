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


**Några reflektioner kring koden i övningen för PHP PDO och MySQL?**

Jag tyckte koden var ganska utförligt beskriven och förklarad i övningen.

**Hur gick det att överföra koden in i ramverket, stötte du på några utmaningar?**

Det var enkelt att se var filerna skulle läggas och med videons hjälp kom jag igång någorlunda snabbt.
Jag tycker i allmänhet det är klurigt att få ihop flödet när samma kod exekveras i olika lägen (såsom route-filer och vyer).
Det som var klurigt med sortering och pagination var att få ordning på sökvägarna när man tryckte på pilarna/antal, där tog jag hjälp av funktionen currentRoute. För reset var det klurigt att hitta till mysql och setup filen (det blev olika sökvägar utanför och inifrån ramverket på min Windows och ännu en annan från studentservern).


**Berätta om din slutprodukt för filmdatabasen, gjorde du endast basfunktionaliteten eller lade du till extra features och hur tänkte du till kring användarvänligheten och din kodstruktur?**

Utöver basfunktionaliteten så har jag gjort reset av databasen (först lokalt och sedan på studentservern) samt sortering och pagination.

Jag har valt att ha en startsida med länkar till alla movie-delar. Från respektive view-sida finns en footer med länkar till alla movie sidor. Inget som överväldigar men jag tycker det är okej.
Något som jag hade velat ha är Edit/Delete länkar i show-all vyernan på respektive rad, men lyckades inte så bra med implementation av det i route-filen. Liksom i exemplet så lägger jag till en default film vid add som sedan editeras, där saknar jag ev. en cancel-knapp.

När det gäller kodstruktur så har jag försökt lägga saker på rätt plats i ramverket och har till viss del försökt att återanvända vyer från olika route-delar.

**Vilken är din TIL för detta kmom?**

Jag tycker inte det är något som känns jättenytt men en massa småsaker som jag upptäckt runt hur ramverket samverkar med mina vyer och routes. Har även fått träna på att använda och anpassa kod som jag inte helt förstår.

Kmom06
-------------------------

**Hur gick det att jobba med klassen för filtrering och formatting av texten?**

Det gick rätt så bra, vi fick ju de mesta kodsnuttarna.
Sedan såg jag att jag hade försökt att uppfinna hjulet, för det fanns ju en grund att jobba från efter övningen... Jag använde inte de privata variablerna, ville egentligen göra metoden statisk. Hade problem med namespace och dyl, så min TextFilter-klass i redovisa heter TextFilter2.
Testfilerna för Textfiltret ligger under samma landningssida som Texterna, men har egen route-klass, egen vy.

**Berätta om din klasstruktur och kodstruktur för din lösning av webbsidor med innehåll i databasen.**

Mycket ligger tyvärr fortfarande i route-klassen, skapade klasser för Content och Page respektive Post, men såg inte vad jag skulle lägga där vid tillfället.
Sedan rann tiden ut. Hade velat flytta alla definitioner av sql-satser från route någon-annanstans, men det hade kunnat vara en egen klass bara med sådana definitioner.
Jag tycker jag har ganska olika lösningar för movies respektive texts, men kanske finns det något som kunde återanvänts såsom reset.

**Hur känner du rent allmänt för den koden du skrivit i din me/redovisa, vad är bra och mindre bra? Ser du potential till refactoring av din kod och/eller behov av stöd från ramverket?**

Det finns mycket förbättringspotential i min kod när det gäller objektorientering och att flytta mer av logiken från route-klasserna. Det är ju objektorientering jag borde träna på i den här kursen, men känner att det är en massa annat som tagit tid.
Jag blev nöjd när jag efter mycket om och men i detta kmom lyckades använda checkboxes och dropdown i edit delen för texterna.
Hade gärna lagt till lite mer hjälp- och informationstext till användarna, tex vid hoovring över ett inputfält, kanske hinner till projektet.
Reset möjligheten för texttabellen lyckas av någon anledning (lokalt) förstöra å, ä, ö, men har inte lagt tid att felsöka på det eftersom det blir rätt när jag kör scriptet via vanlig kommandorad och även ser bättre ut på studentservern.

**Vilken är din TIL för detta kmom?**

Jag tränade på checkboxar och dropdowns, hade problem att få respektive värde "valt" vid uppläsning från databasen.
Sedan har jag fått kämpa med namespace för mitt textfilter. Hittade url-metoden som hjälper med sökvägar (istället för currentRoute).
Tror rent allmänt jag lärt mig mycket inför projektet, ska bli spännande!

Kmom07-10
-------------------------

**Krav1 Webbplats som demo**

Fokus för min webbplats är att försöka ha en hållbar livsstil, vilket jag även till viss del anpassat kraven till.
Jag har gjort en webbplats med startsida och sidor för att se bloggar respektive produkter (som är böcker i mitt fall). För alla sidor finns gemensam header med logo, footer med copyright samt en navbar-meny.
Eftersom ett av syftena med en sådan här sida är att minska konsumptionen, så har jag inga "produkter" till salu, istället så har jag valt att presentera några böcker i ämnet.
Vid klickning på en bokbild på bok-sidan alternativt på förstoringsglaset så länkas till en sida med ytterligare information om boken.

Blogg-sidan visar inledningen till blogginläggen med den senaste överst, för att se mer klickar man antingen på respektive rubrik eller läs mer-länkar.

**Krav2 Ordning och reda**

Databasen finns på studentservern och sql-filer för setup/ddl/insert är också skapade liksom ett ER-diagram.
Unit-tester med 100% coverage på mina egna klasser (utöver views och routes) är gjorda och sparade.
Generering av kod-dokumentation är möjliggjord och fungerar.
Route-filerna har jag gjort lite renare genom att flytta definitionerna av SQL-satserna till functions.php.


**Krav3 Administrativt gränssnitt**

Det administrativa gränssnittet nås från navbaren och möjliggör editering, borttagning och tillägg av nya blogg-inlägg respektive böcker för en inloggad användare med rätt behörighet.
Inloggning görs från Admin-sidan och om man är inloggad visas det även till höger i navbaren.
Användaren doe med lösenordet doe har bara behörighet som user och kan därför inte administrera något, medans användaren admin med lösenordet admin har utökad behörighet och därmed presenteras administrativa länkar. Länkarna visas dels på adminsidan, dels i footers för books/blogs samt i form av fontAwesame ikoner bredvid objekten på bok och bloggsidor.

Vid addering/editering av bloggar kan man välja textfilter mellan bbcode, markdown, link och nl2br liksom vi gjort i kmom06. Kravet att kunna använda markdown till produktinformation har jag implementerat för introduktionstexten till respektive bok.

**Projektets genomförande**

Ett av mina "problem" är att jag blev väldigt uppslukad av själva ämnet jag valde att ha i fokus... Funderingar på innehållet i bloggar och val av produkter tog en hel del tid på det här sättet... i onödan för projektets del, men viktigt i övrigt så klart!

Rent generellt så är sådana här programmeringsprojekt alltid en hel rad större och mindre problem att lösa, och jag upplevde nivån som lagom svår.
En sak som jag särskilt fastnade på var att pagineringslänkarna slutade fungera. Det visade sig att jag behövde byta ut padding-top till margin-top på elementet nedanför så funkade länkarna - men jag hade såklart felsökt på en massa annat i koden...
Något som var lite struligt var att byta faviconen på alla ställen: content-sidorna, vyer (och vyer med olika längd på sökvägarna).
En sak som jag inte fick ordning på var att undvika att spara lösenordet i klartext, provade med password_hash och password_verify, men fick aldrig ordning på vad jag skulle skriva in i insert.sql.

**Tankar om kursen**

Jag tycker kursen har varit givande generellt men tycker att objektorientering inte lyckats bli så centralt. Jag har löst de senaste kmoms samt projekt utan någon större användning av objektorientering (om jag tänker på arv och kompositions hierkier för egna klasser), men visst finns det inbyggt i ramverket att olika klasser har ansvar för olika delar av koden.

Materialet var bra, skulle kanske vilja se lite fördjupning eller exempel på hur man flyttar logiken från routes till klasser. Jag hade behövt lite mer hjälp på vägen med Tärningsspelet i kmom02, men vet inte exakt vad - början på en lösning kanske. Något annat jag hade haft nytta av till projektet är genomgång av password_verify respektive password_hash, fick inte ordning på vad jag skulle lagra för lösenord i databasen eftersom det gjordes från sql-scripten. Jag hade behövt träna mer på att arbeta med arv, kompositioner, traits och interface.

Mångden uppgifter och övningar har varit något ojämnt fördelat mellan kmoms.

Jag är nöjd med kurs och kurspaket, rekommenderar till andra med stark logik alternativt programmeringsbakgrund, och ger betyget 7/10.
