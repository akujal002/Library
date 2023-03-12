#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Livres
#------------------------------------------------------------

CREATE TABLE Livres(
        Id         Int  Auto_increment  NOT NULL ,
        Titre      Varchar (200) NOT NULL ,
        Date_publi Date NOT NULL ,
        Stock      Int NOT NULL ,
        Resume     Mediumtext NOT NULL
	,CONSTRAINT Livres_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateurs
#------------------------------------------------------------

CREATE TABLE Utilisateurs(
        Id           Int  Auto_increment  NOT NULL ,
        Nom          Varchar (50) NOT NULL ,
        Prenom       Varchar (50) NOT NULL ,
        Email        Varchar (50) NOT NULL ,
        Telephone    Varchar (20) NOT NULL ,
        Login        Varchar (50) NOT NULL ,
        Password     Varchar (30) NOT NULL ,
        Gestionnaire Bool
	,CONSTRAINT Utilisateurs_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Auteurs
#------------------------------------------------------------

CREATE TABLE Auteurs(
        Id        Int  Auto_increment  NOT NULL ,
        Nom       Varchar (50) NOT NULL ,
        Prenom    Varchar (50) NOT NULL ,
        Dates_vie Varchar (30) NOT NULL
	,CONSTRAINT Auteurs_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Genres
#------------------------------------------------------------

CREATE TABLE Genres(
        Id     Int  Auto_increment  NOT NULL ,
        Nom    Varchar (50) NOT NULL ,
        Resume Mediumtext NOT NULL
	,CONSTRAINT Genres_PK PRIMARY KEY (Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Emprunts
#------------------------------------------------------------

CREATE TABLE Emprunts(
        Id_Livres       Int NOT NULL ,
        Id_Utilisateurs Int NOT NULL ,
        Date_resa       Date NOT NULL ,
        Date_retour     Date NOT NULL
	,CONSTRAINT Emprunts_PK PRIMARY KEY (Id_Livres,Id_Utilisateurs)

	,CONSTRAINT Emprunts_Livres_FK FOREIGN KEY (Id_Livres) REFERENCES Livres(Id)
	,CONSTRAINT Emprunts_Utilisateurs0_FK FOREIGN KEY (Id_Utilisateurs) REFERENCES Utilisateurs(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reservations
#------------------------------------------------------------

CREATE TABLE Reservations(
        Id_Livres       Int NOT NULL ,
        Id_Utilisateurs Int NOT NULL ,
        Date_mise_cote  Date NOT NULL
	,CONSTRAINT Reservations_PK PRIMARY KEY (Id_Livres,Id_Utilisateurs)

	,CONSTRAINT Reservations_Livres_FK FOREIGN KEY (Id_Livres) REFERENCES Livres(Id)
	,CONSTRAINT Reservations_Utilisateurs0_FK FOREIGN KEY (Id_Utilisateurs) REFERENCES Utilisateurs(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RelationLivresAuteurs
#------------------------------------------------------------

CREATE TABLE RelationLivresAuteurs(
        Id_Auteurs Int NOT NULL ,
        Id_Livres Int NOT NULL
	,CONSTRAINT RelationLivresAuteurs_PK PRIMARY KEY (Id_Auteurs,Id_Livres)

	,CONSTRAINT RelationLivresAuteurs_Auteurs_FK FOREIGN KEY (Id_Auteurs) REFERENCES Auteurs(Id)
	,CONSTRAINT RelationLivresAuteurs_Livres0_FK FOREIGN KEY (Id_Livres) REFERENCES Livres(Id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RelationLivresGenres
#------------------------------------------------------------

CREATE TABLE RelationLivresGenres(
        Id_Genres Int NOT NULL ,
        Id_Livres Int NOT NULL
	,CONSTRAINT RelationLivresGenres_PK PRIMARY KEY (Id_Genres,Id_Livres)

	,CONSTRAINT RelationLivresGenres_Genres_FK FOREIGN KEY (Id_Genres) REFERENCES Genres(Id)
	,CONSTRAINT RelationLivresGenres_Livres0_FK FOREIGN KEY (Id_Livres) REFERENCES Livres(Id)
)ENGINE=InnoDB;

