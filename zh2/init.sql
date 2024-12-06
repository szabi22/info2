
USE hirportal;

CREATE TABLE hirek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cim VARCHAR(255) NOT NULL,
    datum VARCHAR(255) NOT NULL,
    szoveg VARCHAR(255) NOT NULL
);

CREATE TABLE hozzaszolasok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hirek_id INT NOT NULL,
    felhasznalo VARCHAR(255) NOT NULL,
    hozzaszolas VARCHAR(255) NOT NULL,
    FOREIGN KEY (hirek_id) REFERENCES hirek(id)
);

INSERT INTO hirek (cim, datum, szoveg) VALUES
    ('Shasdasdrek', '2001.2.21', 'asdetgasdgharhahjRhZgg'),
    ('Thozgrwsga', '2011.11.2','asdfghsghdgfqa'),
    ('Dushhtjsne', '2021.12.31', 'safghrsdghsdgbjtgjdftus');

INSERT INTO hozzaszolasok (hirek_id, felhasznalo, hozzaszolas) VALUES
    (1, 'Péter', 'asfdag'),
    (1, 'Anna', 'asdasfasfg'),
    (2, 'Anna',  'asdfgsa'),
    (2, 'Zoltán', 'asfgagadsg'),
    (3,'Anyad', 'asdfasdgafas');
