# Mitschrift Formulare

## 1

Validierung sehr wichtig, benutzt für responsive bootstrap
1. Formular erstellen
2. Eingabefelder definieren
3. Clientside validation
4. Serverside validation
5. Datenverarbeitung
6. Ausgabe

Formular mittles Bootstrap erstellt, siehe Bootstrap dokumentation. \
Eigenschaften des Forms (clientside validation) mit verschidenen html tags in dem Form

Javascript validierung des Datums mittels der ``validateExamDate`` methode mittels der Bootstrap klassen : is-valid und is-invalid

Methoden: GET ist wenn man die Seite lädt, POST is wenn man an den Server schickt (form).

Value benutzen, mit php: damit der User immer noch die Daten nach dem Abschicken sehen kann

Serverseitige validierung mittels php func.inc.php (bool methode validate) kontrolliert sinnvolle Werte in diesem POST

Errors werden in ein assoziativen Array gespeichert, diese werden dann auch ausgegeben im Fall eines Umgehen der clientside validierung (mit den einzelnen Methoden für die Felder werden die Fehler in das $errors array geladen und dann ausgegeben).

Testen der Anwendung:
mittels Netzwerkanalyse und manipulieren (im browser) der clientside validierung



## 2

## 3