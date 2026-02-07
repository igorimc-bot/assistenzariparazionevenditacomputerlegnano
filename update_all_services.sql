-- Comprehensive Update for all 18 Services
-- Add missing column
ALTER TABLE services ADD COLUMN short_description TEXT AFTER name;

-- 1. Assemblaggio PC
UPDATE services SET 
short_description = 'Progettiamo e assembliamo il tuo computer ideale. Dalle potenti workstation per professionisti ai PC gaming più estremi, curiamo ogni dettaglio hardware.',
description = 'Il nostro servizio di assemblaggio PC offre una consulenza tecnica completa per creare una macchina su misura per le tue reali necessità. Non ci limitiamo a montare i componenti: studiamo il bilanciamento hardware, ottimizziamo il flusso d\'aria per il raffreddamento e gestiamo il cablaggio in modo professionale. Che tu abbia bisogno di una workstation per il montaggio video 8K, per il calcolo scientifico o di un PC gaming pronto per il 4K, garantiamo test di stabilità rigorosi e profili BIOS personalizzati for prestazioni massime in totale sicurezza.'
WHERE slug = 'assemblaggio-pc';

-- 2. Riparazione Console
UPDATE services SET 
short_description = 'Assistenza rapida per PS5, Xbox e Nintendo. Ripariamo porte HDMI, lettori, joy-con e problemi di surriscaldamento per farti tornare a giocare subito.',
description = 'Siamo esperti nella riparazione delle console da gioco di ultima e penultima generazione. Interveniamo su guasti hardware complessi come la sostituzione di chip video o porte HDMI danneggiate. Offriamo inoltre servizi di manutenzione preventiva come la pulizia interna profonda e la sostituzione della pasta termica (o metallo liquido) per prevenire spegnimenti improvvisi e rumore eccessivo delle ventole. Ripariamo anche i tuoi controller affetti da analog drift o tasti non funzionanti.'
WHERE slug = 'riparazione-console';

-- 3. Servizi Digitali
UPDATE services SET 
short_description = 'Supporto completo per la tua vita digitale: attivazione SPID, configurazione PEC, firma digitale e assistenza per la burocrazia online.',
description = 'Navigare tra le piattaforme della Pubblica Amministrazione può essere frustrante. Noi ti offriamo un supporto passo-passo per attivare e imparare a usare gli strumenti digitali indispensabili oggi: dallo SPID alla Posta Elettronica Certificata (PEC), fino alla Firma Digitale. Ti assistiamo nell\'accesso ai portali INPS, Agenzia delle Entrate e per la consultazione del fascicolo sanitario. Un aiuto concreto per chi non ha tempo o confidenza con la tecnologia.'
WHERE slug = 'servizi-digitali';

-- 4. Consulenza Acquisto
UPDATE services SET 
short_description = 'Non sprecare soldi in acquisti sbagliati. Ti aiutiamo a scegliere il miglior PC, notebook o tablet in base al tuo budget e utilizzo reale.',
description = 'Il mercato informatico è invaso da modelli simili ma con prestazioni molto diverse. Con il nostro servizio di consulenza all\'acquisto, analizziamo le tue abitudini di studio, lavoro o svago per consigliarti il dispositivo con il miglior rapporto qualità-prezzo. Ti indichiamo quali caratteristiche tecniche osservare (processore, RAM, display) e dove acquistare in totale sicurezza, evitandoti inutili spese eccessive o, al contrario, acquisti sottodimensionati che diventerebbero obsoleti in pochi mesi.'
WHERE slug = 'consulenza-acquisto';

-- 5. Contenuti AI
UPDATE services SET 
short_description = 'Sfrutta la potenza dell\'Intelligenza Artificiale per la tua attività. Generiamo testi creativi, immagini e soluzioni di automazione intelligenti.',
description = 'L\'Intelligenza Artificiale è la nuova frontiera della produttività. Ti aiutiamo a integrare strumenti di AI nel tuo flusso di lavoro per generare contenuti di qualità in tempi record. Offriamo copywriting assistito per blog e social, generazione di immagini realistiche o artistiche per il tuo marketing e consulenza su come utilizzare ChatGPT e altri modelli linguistici per automatizzare compiti ripetitivi. Trasformiamo la tecnologia più avanzata in un vantaggio competitivo per il tuo business.'
WHERE slug = 'contenuti-ai';

-- 6. Creazioni Grafiche
UPDATE services SET 
short_description = 'Diamo un volto professionale al tuo brand. Realizziamo loghi, biglietti da visita, brochure e grafiche coordinate per social e web.',
description = 'L\'immagine coordinata è il primo biglietto da visita per un professionista o una piccola impresa. Il nostro servizio grafico si occupa di tradurre la tua visione in elementi visivi concreti: dalla creazione di loghi vettoriali unici alla progettazione di materiale cartaceo come biglietti da visita, volantini e menu. Gestiamo anche la grafica digitale per i tuoi profili social, assicurando coerenza cromatica e stilistica su ogni piattaforma.'
WHERE slug = 'creazioni-grafiche';

-- 7. Ripristino S.O.
UPDATE services SET 
short_description = 'Il tuo PC è bloccato o lentissimo? Reinstalliamo Windows, macOS o Linux salvando i tuoi dati e configurando tutto per un riavvio perfetto.',
description = 'A volte la pulizia software non basta e l\'unica soluzione è un ripristino profondo. Il nostro servizio di installazione sistema operativo prevede il backup completo dei tuoi dati, la formattazione sicura dell\'unità e l\'installazione dell\'ultima versione stabile del sistema (Windows, Mac o Linux). Configuriamo per te tutti i driver necessari per stampanti, audio e video, e reinstalliamo i tuoi programmi preferiti, restituendoti un PC scattante, pulito e privo di bloatware.'
WHERE slug = 'ripristino-so';

-- 8. Software e Antivirus
UPDATE services SET 
short_description = 'Installazione programmi professionali e protezione totale contro virus, malware e cyber-attacchi. Metti al sicuro i tuoi dati preziosi.',
description = 'Un PC senza un software adeguato ed una protezione solida è vulnerabile e inefficiente. Ci occupiamo dell\'installazione e configurazione di pacchetti Office, software di grafica e suite gestionali. Fondamentale è poi la nostra consulenza sulla sicurezza informatica: installiamo i migliori antivirus sul mercato, configuriamo firewall e sistemi di protezione proattiva contro i ransomware, assicurando che le tue foto e i tuoi documenti aziendali siano sempre criptati e protetti.'
WHERE slug = 'software-antivirus';

-- 9. Siti Web
UPDATE services SET 
short_description = 'La tua vetrina online professionale. Creiamo siti web moderni, veloci e ottimizzati per Google per farti trovare dai tuoi clienti.',
description = 'Non basta esserci, bisogna farsi notare. Progettiamo siti web "responsive" (perfetti su smartphone e tablet) che caricano istantaneamente. Dalla semplice landing page per promuovere un unico servizio, al sito vetrina per liberi professionisti, fino a e-commerce completi. Curiamo l\'ottimizzazione SEO di base per darti visibilità sui motori di ricerca e ti offriamo un interfaccia di gestione semplice per aggiornare i tuoi contenuti in totale autonomia.'
WHERE slug = 'siti-web';

-- 10. Recupero Dati
UPDATE services SET 
short_description = 'Recuperiamo i tuoi ricordi e documenti importanti da Hard Disk rotti, chiavette USB danneggiate e schede di memoria non funzionanti.',
description = 'Un file cancellato per errore o un Hard Disk che non viene più rilevato non significano necessariamente la perdita definitiva dei dati. Con tecniche software avanzate e procedure hardware dedicate, recuperiamo dati da supporti magnetici, stati solidi (SSD) e memorie flash. Gestiamo casi di danneggiamento logico (formattazioni accidentali) e fisico minor (connettori dissaldati o settori danneggiati). Offriamo un analisi gratuita per valutare la fattibilità del recupero.'
WHERE slug = 'recupero-dati';

-- 11. Pulizia e Sicurezza
UPDATE services SET 
short_description = 'Rimozione virus e pulizia interna del computer. Eliminiamo polvere e file inutili per evitare surriscaldamenti e rallentamenti.',
description = 'La manutenzione preventiva è il segreto per longevi dispositivi. Offriamo una doppia pulizia: digitale e fisica. Digitalmente, rimuoviamo file temporanei, programmi spia e ottimizziamo l\'avvio del sistema. Fisicamente, apriamo il dispositivo per rimuovere polvere e ostruzioni dalle ventole, prevenendo i picchi di calore che danneggiano processore e scheda video. Questo servizio migliora drasticamente le prestazioni e protegge i componenti critici dall\'usura precoce.'
WHERE slug = 'pulizia-sicurezza';

-- 12. Riparazione PC (Generale)
UPDATE services SET 
short_description = 'Diagnosi e riparazione hardware/software per ogni tipo di computer. Risolviamo guasti alla scheda madre, alimentatori e periferiche.',
description = 'Il nostro core business è la risoluzione di qualsiasi anomalia informatica. Gestiamo riparazioni hardware come la sostituzione di componenti bruciati (alimentatori, schede video) o schede madri difettose. In ambito software, risolviamo conflitti tra programmi, errori di registro e problemi di connettività di rete. Ogni intervento inizia con una diagnosi accurata per identificare la causa radice del malfunzionamento, garantendo una riparazione duratura e professionale.'
WHERE slug = 'riparazione-pc';

-- 13. Smaltimento
UPDATE services SET 
short_description = 'Smaltiamo correttamente il tuo vecchio materiale elettronico (RAEE) proteggendo l\'ambiente e cancellando i tuoi dati personali.',
description = 'I rifiuti elettronici non vanno gettati nella spazzatura comune. Offriamo un servizio di ritiro e smaltimento a norma di legge per computer rotti, stampanti, monitor e cavi. Particolare attenzione viene data alla privacy: prima di avviare il dispositivo allo smaltimento, eseguiamo una cancellazione sicura (wiping) di ogni Hard Disk o memoria interna, rendendo impossibile il recupero di qualsiasi dato personale residuo da parte di terzi.'
WHERE slug = 'smaltimento';

-- 14. Schermi e Batterie
UPDATE services SET 
short_description = 'Sostituzione display notebook e smartphone. Cambiamo la tua batteria vecchia o gonfia per ridare autonomia ai tuoi dispositivi.',
description = 'Schermo rotto o batteria che dura pochi minuti? Siamo rapidi nella sostituzione di pannelli display per notebook di ogni marca e per i principali modelli di smartphone e tablet. Utilizziamo componenti di ricambio certificati per assicurare colori brillanti e touch-screen reattivi. Sostituiamo inoltre batterie interne integrate soggette a degrado naturale o gonfiore, ripristinando la portabilità originale del tuo dispositivo senza doverne acquistare uno nuovo.'
WHERE slug = 'schermi-batterie';

-- 15. Upgrade PC
UPDATE services SET 
short_description = 'Potenzia il tuo computer con dischi SSD e più memoria RAM. Prestazioni raddoppiate senza cambiare il tuo attuale PC.',
description = 'La maggior parte dei computer lenti può rinascere con un semplice upgrade. Passare da un vecchio Hard Disk meccanico a un moderno disco a stato solido (SSD) garantisce una velocità fino a 10 volte superiore nel caricamento di sistema e programmi. Aumentando la RAM, permettiamo al tuo PC di gestire molteplici attività aperte contemporaneamente senza blocchi. Analizziamo la tua scheda madre per identificare il massimo potenziale di espansione con una spesa contenuta.'
WHERE slug = 'upgrade-pc';

-- 16. Vendita Accessori
UPDATE services SET 
short_description = 'Ampia scelta di cavi, alimentatori, mouse, borse e periferiche esterne. Tutto ciò che serve per completare la tua postazione IT.',
description = 'Presso il nostro centro o su ordinazione rapida, trovi ogni accessorio indispensabile per il tuo ecosistema informatico. Selezioniamo solo periferiche affidabili: da tastiere ergonomiche e mouse ad alta precisione, a borse protettive per notebook e hub USB. Particolare importanza diamo all\'alimentazione: forniamo caricatori universali o specifici certificati per garantire la stabilità di corrente ai tuoi dispositivi costosi, evitando i rischi dei prodotti economici non regolamentati.'
WHERE slug = 'vendita-accessori';

-- 17. Vendita PC
UPDATE services SET 
short_description = 'Computer nuovi e ricondizionati con garanzia. Ti guidiamo nella scelta della macchina perfetta già pronta all\'uso.',
description = 'Offriamo una selezione di computer desktop e notebook accuratamente scelti. I nostri PC nuovi sono configurati e ottimizzati prima della consegna: niente software spazzatura, solo velocità. Disponiamo inoltre di macchine "Ricondizionate Professionali" (ex-leasing o fine noleggio) che offrono prestazioni di fascia alta a prezzi drasticamente ridotti, tutte verificate nei nostri laboratori e coperte da una garanzia reale di funzionamento.'
WHERE slug = 'vendita-pc';

-- 18. Assistenza Stampanti
UPDATE services SET 
short_description = 'Riparazione e configurazione di stampanti laser e inkjet. Risolviamo inceppamenti di carta, problemi di rete e qualità stampa.',
description = 'Le stampanti sono spesso il punto debole della produttività. Interveniamo su inceppamenti meccanici, errori di testine otturate o sensori sporchi. Ti supportiamo nella configurazione wireless e di rete per stampare comodamente da PC, smartphone e tablet. Offriamo inoltre consulenza sulla gestione dei materiali di consumo (toner e cartucce) per ottimizzare i costi di gestione della tua flotta stampanti aziendale o domestica.'
WHERE slug = 'assistenza-stampanti';

-- 19. Sicurezza Reti (New term or alternative for a missing one?)
-- Actually there are 20 in the seed data. Let me re-verify the names.
-- Looking at seed_data.sql lines 3-20...

-- Wait, seed_data.sql has:
-- Assemblaggio (2), Riparazione Console (4), Servizi Digitali (5), Consulenza (6), Contenuti AI (7), Creazioni Grafiche (8), 
-- Ripristino S.O. (9), Software e Antivirus (10), Siti Web (11), Recupero Dati (12), Pulizia e Sicurezza (13), 
-- Riparazione PC (14), Smaltimento (15), Schermi e Batterie (16), Upgrade PC (17), Vendita Accessori (18), Vendita PC (19), Assistenza Stampanti (20).
-- That's 18 services. Let me check if I missed any.
-- Actually the numbers I assigned above match the order. 
-- 18 services found in seed_data.sql. I will stick to these 18.

-- Let's apply the updates for these 18.
