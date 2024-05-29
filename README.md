# Laravel Backend voor het project TechIsland - Eind Examen Software Developer MBO NIV 4

**De live website van de backend:** 

https://techyourtalentamsterdam.nl/

**De api staat op**: 

https://api.techyourtalentamsterdam.nl/api/overview

**In samenwerking met de front end:**

https://github.com/Kipmevrouw/Proeve-Front-end

Op TechIsland kunnen leerlingen van VO (en PO) de wereld van techniek verkennen. Dit door mee te doen aan verschillende
korte workshops. Zo ontdekken ze in één ochtend hoe leuk en spannend de werelden van techniek zijn. Leerlingen maken
kennis met een technisch vak en/of ervaren hoe het is om te werken voor een technisch bedrijf. Alle activiteiten worden
begeleid door mbo-studenten, docenten en vakmensen uit het bedrijfsleven. Zoals het nu gaat kunnen leerlingen 3 of 4
workshops van 20 minuten volgen waarbij ze willekeurig bij een workshop ingedeeld worden. Het zou leuk zijn als de
leerlingen zich van tevoren kunnen voorbereiden en zich kunnen inschrijven op 3 workshops van hun keuze. Twee van deze
workshop kunnen gehonoreerd worden en om ook kennis te maken met een onderdeel van techniek waar een leerling niet
meteen voor kiest worden ze ook ingedeeld bij een van de andere workshops. Wat hiervoor nodig is, is een website,
waarbij de aanbieders van de workshops kort hun workshop kunnen omschrijven en kunnen aangeven op welke dagen de
workshop gegeven kan worden. De organisatoren kunnen dit definitief bevestigen en de leerlingen kunnen dan zien welke
workshops er zijn op de dag dat zij komen. Op de dag dat de leerlingen naar TechIsland komen krijgen ze een badge met de
workshops waarop ze ingedeeld zijn. 

## Wat is het idee van de backend?
In de Backend werken wij aan het combineren van de Front end & Back end.

In de back end kunnen de Decanen, Admins en leraren inloggen om hun gegevens te behrenen inclusief het maken, bewerken 
en verwijderen van gelinkte scholen, workshops en gegevens.

### Functionaliteiten:
De backend is gemaakt zodat Leraren, decanen en admins makkelijk het team  of studenten kan bewerken met een gedetalieerde 
toevoeging en bewerking van de volgende items:

**Admin**: 
- decanen / deans
- Workshops
- leraren / teachers
- users / admins
- rollen / roles
- toestemmingen / permissions  
- leerlingen
- scholen

**Decanen**

- Decaan zelf
- Leeraren / Teachers

Decanen hebben alleen toestemmingen om hun eigen gegevens te wijzigen en de leeraren die horen bij de docent zelf,
Dit zal algemeen alle leeraren zijn die bij de school zelf horen.

**Leeraren**

- Leraar zelf
- studenten

Leeraren hebben alleen toestemmingen om hun eigen gegevens te wijzigen en de studenten die horen bij de docent zelf. 

### Veiligheid:
Er wordt gebruik gemaakt van zelf gemaakte guards in samenwerking met `Spatie/Roles and permissions`.

#### Hoe log je in?

Admin:  /admin/login 'gebruikt auth **web**'

auth gaat via `AdminAuthMiddleware`

Leeraar: /teacher/login 'gebruikt auth **teacher**'

auth gaat via `TeacherAuthMiddleware`


Decaan: /dean/login 'gebruikt auth **dean**' 
auth gaat via  ` DeanAuthMiddleware`



### Plugins en packages:

- filamentphp.com
- Spaties Roles and permissions - Filament plugin
- Backgrounds plugin by SWIS - Filament plugin

## Examen informatie

**De opdrachtgever:**
TechIsLand (Evelien van Polanen Petel)

**Beoordelaars:**

Erik Willems (Intern)

Robin Timman (Extern)


**Coach:**
Bart Ros

**Het team:**

De [Frontend] - (https://github.com/Kipmevrouw/Proeve-Front-end):  
- Becky van der Meulen.

De [Backend] - (https://github.com/Streats22/TechIsland-Backend): 
- Robin Schoenmkaer
