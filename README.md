# Something went wrong (Für Oxid 6)

Die wenigsten Betreiber einer Webseite oder eines Onlineshops nutzen Monitoring. Dabei ist es essentiell wichtig zu wissen, ob der Shop jederzeit erreichbar ist und wann ein Kunde ein Fehler erhält.

SomethingWentWrong öffnet Besuchern ein Formular, wenn diese in einem Fehlerfall auf die Startseite weitergeleitet werden und sendet dem Betreiber des Shops eine Mail mit Daten zum Kunden (falls angemeldet) und Hinweise zum aktuellen Request.

Das Formular kann der Kunde benutzen, um dem Betreiber mitzuteilen, was passiert ist. Dadurch kann der Kontakt zum Kunden hergestellt werden und mögliche Fehlerquellen können schnell erkannt und geschlossen werden.

## Support/Fragen/Hilfe

Es gibt zwei Kategorien an Fragen:

- [Das Modul hier funktioniert nicht oder dir ist nicht klar was das soll](https://github.com/Sioweb/OxidSomethingWentWrong/issues)
- [Du hast Fragen zur Entwicklung mit Oxid](https://forum.oxid-esales.com/)
- [Keine Frage, aber du findest das Modul voll gut](https://github.com/Sioweb/OxidSomethingWentWrong#dir-gef%C3%A4llt-das-bundle)

## Installation

`composer require sioweb/oxid-somethingwentwrong`

## CSS

Das CSS muss extra eingebunden werden, da das Formular auf der Startseite sonst nicht gut aussieht. Das CSS kann entweder per Smarty-Tag eingebunden werden, oder der Code aus der CSS-Datei wird einfach im Theme in eine vorhandene CSS-Datei kopiert:

```
[{oxstyle include=$oViewConf->getModuleUrl('SiowebSomethingWentWrong',"out/css/style.css")}]
```

## Formbuilder

Das Modul installiert automatisch den [Formbuilder](https://github.com/Sioweb/OxidFormBuilder). Mit diesem Modul können Sie das Formular nach belieben individualisieren.

## Dir gefällt das Bundle?

Gerne freue ich mich über ein kleines Danke via [Amazon Wunschliste](https://www.amazon.de/hz/wishlist/ls/3IW6TE09RDGV2/ref=nav_wishlist_lists_1?_encoding=UTF8&type=wishlist).

Du kannst Amazon nicht leiden? Kein Problem, ich freue mich auch über [Likes](https://www.facebook.com/sioweb) und [positive Bewertungen](https://www.google.de/search?q=Sioweb).
