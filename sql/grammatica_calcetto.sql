create database grammatica_calcetto_php;

use grammatica_calcetto_php;

create table utenti
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(50)  NOT NULL,
    password varchar(255) NOT NULL,
    nome     varchar(50),
    cognome  varchar(50)
);

insert into utenti
values (null, "DJFede", "$2y$12$Ujg0apbAs0pDfd1z6Blq6OVzooHkkfFYMtqTN3.DUrQc0XnGOuYvG", "Federico", "Maniglio");
insert into utenti
values (null, "acosta", "$2y$12$Ujg0apbAs0pDfd1z6Blq6OVzooHkkfFYMtqTN3.DUrQc0XnGOuYvG", "Alberto", "Costa");

create table campi(
                      nome_campo varchar(100) not null unique primary key,
                      capienza INT not null,
                      foto_url text
);

insert into campi values("Allianz Arena", 75.024, "https://img.fcbayern.com/image/upload/f_auto/q_auto/t_cms-16x9-seo/v1601458426/cms/public/images/allianz-arena/stadion-innenraum/aa_haupttribuene.jpg");
insert into campi values("Bernabeu", 84.000 , "https://www.barcelo.com/guia-turismo/wp-content/uploads/2019/03/santiago-bernabeu-1.jpg");
insert into campi values("San Siro" , 75.817, "https://www.webuildgroup.com/_next/image/?url=https%3A%2F%2Fadmin.webuildgroup.com%2Fsites%2Fdefault%2Ffiles%2F2024-03%2FStadio_Meazza_Italia_Webuild_02_edited.jpg&w=3840&q=75");
insert into campi values("Menti" , 12.000, "https://lrvicenza.net/wp-content/uploads/2022/06/Stadio-Romeo-Menti-1024x356.jpg");

create table prenotazioni(
                             id_utente INT,
                             id_campo varchar(100),
                             data_prenotazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             PRIMARY KEY(id_campo, data_prenotazione),
                             foreign key (id_utente) references utenti(id)
                                 ON delete cascade,
                             foreign key (id_campo) references campi(nome_campo)
                                 On delete cascade
);