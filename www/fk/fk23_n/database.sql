drop database if exists db_luftqualitaet;
create database db_luftqualitaet;
use db_luftqualitaet;

create table stationen (
	s_id INT PRIMARY KEY AUTO_INCREMENT,
    s_bezeichnung VARCHAR(50) NOT NULL
);  

create table messungen (
	m_id INT PRIMARY KEY AUTO_INCREMENT,
    m_zeitpunkt TIMESTAMP NOT NULL,
    m_messwert INT NOT NULL,
    s_id INT NOT NULL,
    CONSTRAINT fk_station FOREIGN KEY (s_id) REFERENCES stationen(s_id)
);

insert into stationen (s_bezeichnung) values ('Brenner');
insert into stationen (s_bezeichnung) values ('Igls');

insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW(), 24, 1);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW()- INTERVAL 1 DAY, 223, 1);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW()- INTERVAL 2 DAY, 223, 1);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW() , 26, 2);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW()- INTERVAL 1 DAY, 22, 2);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW()- INTERVAL 2 DAY, 23, 2);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW() - INTERVAL 3 DAY, 21, 1);
insert into messungen (m_zeitpunkt, m_messwert, s_id) values (NOW() - INTERVAL 4 DAY, 36, 1);