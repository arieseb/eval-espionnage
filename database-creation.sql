CREATE DATABASE spy_site;

USE spy_site;

CREATE TABLE admin
(
    id CHAR(36) NOT NULL PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    creation_date DATE NOT NULL,
    role CHAR(5) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE country
(
    id INT(10) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    nationality VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE target
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codename VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    country_id INT(10) NOT NULL,
    FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE contact
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codename VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    country_id INT(10) NOT NULL,
    FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE specialty
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE agent
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codename VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    country_id INT(10) NOT NULL,
    FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE agent_specialty
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    agent_id INT(10) NOT NULL,
    FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE,
    specialty_id INT(10) NOT NULL,
    FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE hideout
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    country_id INT(10) NOT NULL,
    FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mission_status
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mission
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    codename VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    country_id INT(10) NOT NULL,
    FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE,
    hideout_id INT(10) NULL,
    FOREIGN KEY (hideout_id) REFERENCES hideout (id),
    mission_status_id INT(10) NOT NULL,
    FOREIGN KEY (mission_status_id) REFERENCES mission_status (id),
    required_specialty  INT(10) NOT NULL,
    FOREIGN KEY (required_specialty) REFERENCES specialty (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mission_agent
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    agent_id INT(10) NOT NULL,
    FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE,
    mission_id INT(10) NOT NULL,
    FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mission_target
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    target_id INT(10) NOT NULL,
    FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE ,
    mission_id INT(10) NOT NULL,
    FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mission_contact
(
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    contact_id INT(10) NOT NULL,
    FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE ,
    mission_id INT(10) NOT NULL,
    FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET names 'utf8';

INSERT INTO mission_status (name) VALUES ('En préparation'), ('En cours'), ('Terminé'), ('Echec');

INSERT INTO admin (id, email, password, firstname, lastname, creation_date, role) VALUES
    (UUID(), 'admin@example.com', '$2y$10$n96S0ThuQTWUYjriIVTxpeLMkfqzDv.3fXoK506WdrNknJD6s5juy', 'Administrateur', 'Principal', '2023-04-29', 'ADMIN');