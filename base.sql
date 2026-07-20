PRAGMA foreign_keys = ON;

CREATE TABLE Prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE Client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    telephone TEXT NOT NULL UNIQUE,
    date_creation DATE NOT NULL DEFAULT CURRENT_DATE,
    actif INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE TypeOperation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE Statut (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL UNIQUE
);

CREATE TABLE BaremeFrais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_type_operation INTEGER NOT NULL,
    montant_min DECIMAL(15,2) NOT NULL,
    montant_max DECIMAL(15,2) NOT NULL,
    valeur DECIMAL(15,2) NOT NULL,

    FOREIGN KEY (id_type_operation)
        REFERENCES TypeOperation(id)
);

CREATE TABLE "Transaction" (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_type_operation INTEGER NOT NULL,
    id_client_source INTEGER,
    id_client_destination INTEGER,
    montant DECIMAL(15,2) NOT NULL,
    frais DECIMAL(15,2) NOT NULL,
    date_transaction DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_statut INTEGER NOT NULL,

    FOREIGN KEY (id_type_operation)
        REFERENCES TypeOperation(id),

    FOREIGN KEY (id_client_source)
        REFERENCES Client(id),

    FOREIGN KEY (id_client_destination)
        REFERENCES Client(id),

    FOREIGN KEY (id_statut)
        REFERENCES Statut(id)
);

CREATE TABLE MouvementCompte (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    transaction_id INTEGER NOT NULL,
    client_id INTEGER NOT NULL,
    montant DECIMAL(15,2) NOT NULL,
    sens TEXT NOT NULL CHECK (sens IN ('DEBIT', 'CREDIT')),

    FOREIGN KEY (transaction_id)
        REFERENCES "Transaction"(id),

    FOREIGN KEY (client_id)
        REFERENCES Client(id)
);

-- ===================
-- V2
-- ===================

CREATE TABLE Operateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

ALTER TABLE Prefixe
ADD COLUMN id_operateur INTEGER REFERENCES Operateur(id);

ALTER TABLE "Transaction"
ADD COLUMN inclure_frais_retrait INTEGER NOT NULL DEFAULT 0;

CREATE TABLE TransactionDestination (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_transaction INTEGER NOT NULL,
    id_client INTEGER NOT NULL,
    montant DECIMAL(15,2) NOT NULL,

    FOREIGN KEY (id_transaction)
        REFERENCES "Transaction"(id),

    FOREIGN KEY (id_client)
        REFERENCES Client(id)
);

CREATE TABLE CommissionOperateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_operateur_source INTEGER NOT NULL,
    id_operateur_destination INTEGER NOT NULL,
    pourcentage DECIMAL(5,2) NOT NULL,

    FOREIGN KEY (id_operateur_source)
        REFERENCES Operateur(id),

    FOREIGN KEY (id_operateur_destination)
        REFERENCES Operateur(id)
);

