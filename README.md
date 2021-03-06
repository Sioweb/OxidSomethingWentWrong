# Something went wrong (Für Oxid 6)

Die wenigsten Betreiber einer Webseite oder eines Onlineshops nutzen Monitoring. Dabei ist es essentiell wichtig zu wissen, ob der Shop jederzeit erreichbar ist und wann ein Kunde ein Fehler erhält.

SomethingWentWrong öffnet Besuchern ein Formular, wenn diese in einem Fehlerfall auf die Startseite weitergeleitet werden und sendet dem Betreiber des Shops eine Mail mit Daten zum Kunden (falls angemeldet) und Hinweise zum aktuellen Request.

Das Formular kann der Kunde benutzen, um dem Betreiber mitzuteilen, was passiert ist. Dadurch kann der Kontakt zum Kunden hergestellt werden und mögliche Fehlerquellen können schnell erkannt und geschlossen werden.

## Kosten

Das Modul darf is auf weiteres nicht kostenfrei verwendet werden! Open Source ist nicht Free2Use!

## Support/Fragen/Hilfe

Es gibt zwei Kategorien an Fragen:

- [Das Modul hier funktioniert nicht oder dir ist nicht klar was das soll](https://github.com/Sioweb/OxidSomethingWentWrong/issues)
- [Du hast Fragen zur Entwicklung mit Oxid](https://forum.oxid-esales.com/)

## Installation

`composer require sioweb/oxid-somethingwentwrong`

## Konfiguration

Als erstes, muss das Modul `Creative Inneneinrichter | Formulargenerator` aktiviert werden, als zweites das Modul `Sioweb | Something went wrong!`. In den Einstellungen für SWW, können optionen für die erste Log-Mail von Oxid eingestellt werden.

Unter `Shopeinstellungen / Formulare` kann das Formular `Fehler-Feedback` konfiguriert werden.

Unter `Kundeninformationen / CMS-Seiten` können die Seiten `Vielen Dank für ihr Feedback` und `Feedback Formular (Top)` bearbeitet werden. Letzteres wird überhalb des Formulars ausgegeben.

## CSS

Das CSS muss extra eingebunden werden, da das Formular auf der Startseite sonst nicht gut aussieht. Das CSS kann entweder per Smarty-Tag eingebunden werden, oder der Code aus der CSS-Datei wird einfach im Theme in eine vorhandene CSS-Datei kopiert:

```
[{oxstyle include=$oViewConf->getModuleUrl('SiowebSomethingWentWrong',"out/css/style.css")}]
```

## Formbuilder

Das Modul installiert automatisch den [Formbuilder](https://github.com/Sioweb/OxidFormBuilder). Mit diesem Modul können Sie das Formular nach belieben individualisieren.
