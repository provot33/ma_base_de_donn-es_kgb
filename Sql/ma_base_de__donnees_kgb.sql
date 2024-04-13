create schema if not exists ma_base_de_donnees_kgb;

use ma_base_de_donnees_kgb;
create table if not exists administrator(
id_administrator 	INT 			primary key not null auto_increment,
name          		VARCHAR (50) 	not null,
firstname       	VARCHAR (50) 	not null,
email         		VARCHAR (50) 	not null unique,
password      		VARCHAR (50) 	not null,
creationDate  		DATE  			not null
);

insert into administrator
(name, firstname, email, creationDate, password)
values 
("Garcia", "josé", "jose.garcia@free.fr", "2007-08-01", PASSWORD("motDePasseAChanger1")), 
("Petit", "Josépha", "josepha.petit@free.fr", "2010-07-16", PASSWORD("motDePasseAChanger2")), 
("Legros", "Philippe", "philippe.legros@free.fr", "2012-06-30", PASSWORD("motDePasseAChanger3")),
("Legrand", "Marie", "marie.legrand@free.fr","2014-05-21", PASSWORD("motDePasseAChanger4"));


create table if not exists nationality (
id_nationality	INT 		primary key not null auto_increment,
country			VARCHAR(50)	not null
);

insert into nationality
(country)
values
("Russie"),("Etats-Unis"),("France"),("Allemagne"),("Espagne"),
("Angleterre"),("Ukraine"),("Roumanie"),("Canada"),("Bresil"),
("Chine"),("Japon"),("Pologne"),("Italie"),("Norvège"),
("Finlande"),("Portugal"),("Pérou"),("Belgique"),("Suisse");

create table if not exists kgbAgent (
id_kgb_agent		INT primary key not null auto_increment,
name         		VARCHAR (50) not null,
firstname      		VARCHAR (50) not null,
dateOfBirth  		DATE         not null,
identificationCode 	VARCHAR (50) not null,
id_nationality  	INT			 	not null,
foreign key (id_nationality)
references nationality(id_nationality)
on delete cascade
);

insert into kgbAgent
(name, firstname, dateOfBirth, identificationCode, id_nationality)
values 
("Dupont", "Claude", "1951-09-26", "Python", 6), 
("Durant", "Claudine", "1973-08-15", "Cobra", 3),
("Dugre", "Robert", "1989-07-07", "Vipere", 4),
("Do", "John", "2000-06-19", "Baracuda", 5),
("Drago", "Ivan", "1990-05-06", "Ours", 1);


create table if not exists contact (
id_contact 		INT 			primary key not null auto_increment,
name        	VARCHAR (50) 	not null,
firstname   	VARCHAR (50) 	not null,
dateOfBirth 	DATE  			not null,
codeName    	VARCHAR (50) 	not null,
id_nationality  INT			 	not null,
foreign key (id_nationality)
references nationality(id_nationality)
on delete cascade
);

insert into contact
(name, firstname, dateOfBirth, codeName, id_nationality)
values
("Leboeuf", "Louis", "1970-04-28", "Dublin", 14), 
("Lemoine", "Louise", "1980-05-15", "Paris", 15), 
("Lepetit", "Frederic", "1990-06-03", "Londres", 16),
("Leleu", "Maxime", "2010-07-07", "Madrid", 17),
("Dupont", "Roger", "1983-05-22", "Copenhague", 3),
("Ciane", "Angela", "1992-01-03", "Washington", 3);

create table if not exists speciality(
id_speciality 		int primary key not null auto_increment,
labelOfSpeciality  	VARCHAR (150) not null
);

insert into speciality
(labelOfSpeciality)
values
("Infiltration"),("Interrogatoire"),("Armes Lourdes"),("Explosifs"),("Armes Blanches"),
("Corps à Corps"),("Polyglote"),("Hacker"),("Acteur"),("Sniper");

create table if not exists missionType(
id_type 		int primary key not null auto_increment,
typeName       	VARCHAR (150) not null
);

insert into missionType
(typeName)
values
("Infiltration"),("Exécution"),("Exfiltration"),("Filature"),("Empoisonnement"),
("Veille"),("Espionnage Technologique"),("Enlèvement");

create table if not exists missionStatus(
id_status 		int primary key not null auto_increment,
statusName     	VARCHAR (150) not null
);

insert into missionStatus
(statusName)
values
("En préparation"),("Dormant"),("En cours"),("Réussi"),("Abandonné");

create table if not exists mission (
id_mission 		int 			primary key not null auto_increment,
title         	VARCHAR (150)	not null,
description  	VARCHAR (200) 	not null,
codeName      	VARCHAR (50) 	not null,
startDate     	DATE         	not null,
finishDate    	DATE         	not null,
id_speciality	INT				not null,
id_nationality  INT			 	not null,
id_type  		INT			 	not null,
id_status  		INT			 	not null,
foreign key (id_speciality)
references speciality(id_speciality)
on delete cascade,
foreign key (id_nationality)
references nationality(id_nationality)
on delete cascade,
foreign key (id_type)
references missionType(id_type)
on delete cascade,
foreign key (id_status)
references missionStatus(id_status)
on delete cascade
);

insert into mission
(title, description, codeName, id_speciality, id_nationality, id_type, id_status, startDate, finishDate)      
values  
("Code mayo","Tuer un homme méchant", "Mayo", 5, 3, 2, 3, "2024-03-31", "2024-04-07"),
("Code ketchup","Tuer une mamie méchante", "Ketchup", 10, 3, 2, 3, "2024-03-31", "2024-04-17"),
("Mission alpha","Réaliser un ECF", "Loup", 8, 3, 7, 1, "2024-03-31", "2024-04-07"),
("Mission choucroute","Enlever un restaurateur depressif", "Saucisse", 6, 3, 8, 1, "2024-04-14", "2024-04-30");

create table if not exists target (
id_target		int 			primary key not null auto_increment,
name			VARCHAR (50) 	not null,
firstname		VARCHAR (50) 	not null,
dateOfBirth		DATE         	not null,
codeName		VARCHAR (50) 	not null,
id_nationality  INT			 	not null,
foreign key (id_nationality)
references nationality(id_nationality)
on delete cascade
);

insert into target
(name, firstname, dateOfBirth, codeName, id_nationality)
values 
("Mime", "Marceau", "1971-03-31", "Mayonnaise", 18), 
("Bond", "James", "1981-04-13", "Ketchup", 11),
("Cosby", "Marcus", "1991-05-01", "Samourai", 19),
("Brandon", "Marlow", "2001-06-17", "Curry", 20);

create table if not exists hideoutType (
id_hideoutType 	int 			primary key not null auto_increment,
hideoutType		VARCHAR (150) 	not null
);

insert into hideoutType
(hideoutType)
values
("Appartement"), ("Loft"), ("Cabane"), ("Armurerie"), ("Bunker"),
("Villa"), ("Ranch"), ("Egoût"), ("Maison"), ("Restaurant");

create table if not exists hideout (
id_hideout 		int 			primary key not null auto_increment,
adress			VARCHAR (150) 	not null,
code			INT          	not null,
city			VARCHAR (50) 	not null,
id_nationality  INT			 	not null,
id_hideoutType  INT			 	not null,
foreign key (id_nationality)
references nationality(id_nationality)
on delete cascade,
foreign key (id_hideoutType)
references hideoutType(id_hideoutType)
on delete cascade
);

insert into hideout
(adress, city, code, id_nationality, id_hideoutType)
values 
("8 rue des Lilas", "Gradignan", "33170", 3, 9),
("25 rue des pigeons","Bordeaux", "33000", 3, 10),
("70  rue des oiseaux", "Merignac", "33600", 3, 5),
("110 rue des colibris", "Lormont", "33500", 3, 1),
("163 rue des mesanges", "Pessac", "33100", 3, 3);

create table if not exists missionWithContact(
id_mission INT not null,
id_contact INT not null,
foreign key (id_mission) 
references mission(id_mission)
on delete cascade,
foreign key (id_contact)
references contact(id_contact)
on delete cascade,
primary key (id_mission, id_contact)
);

insert into missionWithContact
(id_mission, id_contact)
values
(1, 5), (1, 6), (2, 6), (3, 5), (4, 5),
(4, 6);

create table if not exists missionOnTarget(
id_mission INT not null,
id_target INT not null,
foreign key (id_mission) 
references mission(id_mission)
on delete cascade,
foreign key (id_target)
references target(id_target)
on delete cascade,
primary key (id_mission, id_target)
);

insert into missionOnTarget
(id_mission, id_target)
values
(1, 1), (2, 2), (2, 3), (3, 2), (3, 4),
(4, 4);

create table if not exists hideoutForMission(
id_mission INT not null,
id_hideout INT not null,
foreign key (id_mission) 
references mission(id_mission)
on delete cascade,
foreign key (id_hideout)
references hideout(id_hideout)
on delete cascade,
primary key (id_mission, id_hideout)
);

insert into hideoutForMission
(id_mission, id_hideout)
values
(1, 1), (2, 1), (2, 3), (4, 2), (4, 4), 
(4, 5);

create table if not exists agentOnMission(
id_kgb_agent INT not null,
id_mission INT not null,
foreign key (id_kgb_agent)
references kgbAgent(id_kgb_agent)
on delete cascade,
foreign key (id_mission) 
references mission(id_mission)
on delete cascade,
primary key (id_kgb_agent, id_mission)
);

insert into agentOnMission
(id_kgb_agent, id_mission)
values
(2, 1), (5, 1),
(5, 2), (2, 2), (4, 2),
(3, 3),
(2, 4), (1, 4);

create table if not exists agentSpeciality(
id_kgb_agent INT not null,
id_speciality INT not null,
foreign key (id_kgb_agent)
references kgbAgent(id_kgb_agent)
on delete cascade,
foreign key (id_speciality) 
references speciality(id_speciality)
on delete cascade,
primary key (id_kgb_agent, id_speciality)
);

insert into agentSpeciality
(id_kgb_agent, id_speciality)
values
(1, 1), (1, 7),
(2, 5), (2, 6),
(3, 8), (3, 9), 
(4, 10),
(5, 3), (5, 4);