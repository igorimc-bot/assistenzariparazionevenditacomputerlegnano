-- Services
INSERT INTO services (name, slug, description) VALUES 
('Riparazione Guasti Elettrici', 'riparazione-guasti', 'Intervento rapido per cortocircuiti, blackout e guasti elettrici domestici.'),
('Installazione Impianti', 'installazione-impianti', 'Progettazione e installazione di impianti elettrici civili e industriali.'),
('Illuminazione LED e Design', 'illuminazione-led', 'Soluzioni di illuminazione moderne e a risparmio energetico.'),
('Certificazione Impianti', 'certificazione-impianti', 'Rilascio certificazioni di conformità per impianti elettrici esistenti.'),
('Impianti di Allarme', 'impianti-allarme', 'Installazione sistemi di videosorveglianza e antifurto.'),
('Automazione Cancelli', 'automazione-cancelli', 'Installazione e riparazione motori per cancelli automatici.');

-- Zones - Comuni
INSERT INTO zones (name, slug, type, parent_city) VALUES 
('Legnano', 'legnano', 'Comune', NULL),
('Busto Arsizio', 'busto-arsizio', 'Comune', NULL),
('Castellanza', 'castellanza', 'Comune', NULL),
('Canegrate', 'canegrate', 'Comune', NULL),
('San Giorgio su Legnano', 'san-giorgio-su-legnano', 'Comune', NULL),
('Cerro Maggiore', 'cerro-maggiore', 'Comune', NULL),
('San Vittore Olona', 'san-vittore-olona', 'Comune', NULL),
('Villa Cortese', 'villa-cortese', 'Comune', NULL),
('Rescaldina', 'rescaldina', 'Comune', NULL),
('Dairago', 'dairago', 'Comune', NULL),
('Parabiago', 'parabiago', 'Comune', NULL),
('Nerviano', 'nerviano', 'Comune', NULL),
('Rho', 'rho', 'Comune', NULL),
('Lainate', 'lainate', 'Comune', NULL),
('Saronno', 'saronno', 'Comune', NULL),
('Milano', 'milano', 'Comune', NULL);

-- Zones - Milano Quartieri
INSERT INTO zones (name, slug, type, parent_city) VALUES 
('Milano Centro', 'milano-centro', 'Quartiere', 'Milano'),
('Milano Stazione Centrale', 'milano-stazione-centrale', 'Quartiere', 'Milano'),
('Milano Porta Nuova', 'milano-porta-nuova', 'Quartiere', 'Milano'),
('Milano Navigli', 'milano-navigli', 'Quartiere', 'Milano'),
('Milano Città Studi', 'milano-citta-studi', 'Quartiere', 'Milano'),
('Milano Isola', 'milano-isola', 'Quartiere', 'Milano'),
('Milano Bicocca', 'milano-bicocca', 'Quartiere', 'Milano');
