CREATE TABLE Users (
	ID INT UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	Surname VARCHAR(50) NOT NULL,
	Nickname VARCHAR(50),
	Birth_Date	DATE,
	Email VARCHAR(50) NOT NULL,
	Password_Hash VARCHAR(255) NOT NULL,
	Avatar VARCHAR(100),
	Description VARCHAR(100),
	Active TINYINT DEFAULT 1,
	CONSTRAINT PK_Users PRIMARY KEY (ID),
	CONSTRAINT U_Users_Email_Pasword UNIQUE (Email, Password_Hash)
);

CREATE TABLE Teams (
	ID INT UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	ID_Captain INT UNSIGNED NOT NULL,
	ID_Manager INT,
	Active TINYINT DEFAULT 1,
	CONSTRAINT PK_Teams PRIMARY KEY (ID),
	CONSTRAINT FK_Teams_Captain FOREIGN KEY (ID_Captain) REFERENCES Users(ID) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT U_Teams_Name UNIQUE (Name),
	CONSTRAINT U_Teams_ID_Captain UNIQUE (ID_Captain)
);

CREATE TABLE Teams_Users (
	ID INT UNSIGNED AUTO_INCREMENT,
	ID_Teams INT UNSIGNED,
	ID_Users INT UNSIGNED,
	CONSTRAINT PK_T_U PRIMARY KEY (ID),
	CONSTRAINT FK_T_U_Teams FOREIGN KEY (ID_Teams) REFERENCES Teams(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_T_U_Users FOREIGN KEY (ID_Users) REFERENCES Users(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT U_T_U_Teams_Users UNIQUE (ID_Teams, ID_Users)
);

CREATE TABLE LEAGUES (
	ID INT UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(100) NOT NULL,
	ID_Organizer INT UNSIGNED,
	Points INTEGER;
	CONSTRAINT PK_Leagues PRIMARY KEY (ID),
	CONSTRAINT FK_Leagues_Organizer FOREIGN KEY (ID_Organizer) REFERENCES Users(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT U_Leagues_Name UNIQUE (Name)
);

CREATE TABLE Teams_Leagues (
	ID INT UNSIGNED AUTO_INCREMENT,
	ID_Team INT UNSIGNED,
	ID_League INT UNSIGNED,
	CONSTRAINT PK_T_L PRIMARY KEY (ID),
	CONSTRAINT FK_T_L_Team FOREIGN KEY (ID_Team) REFERENCES Teams(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_T_L_League FOREIGN KEY (ID_League) REFERENCES Leagues(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT U_T_L_Team_League UNIQUE (ID_Team, ID_League)
);

CREATE TABLE Scheduled (
	ID INT UNSIGNED AUTO_INCREMENT,
	ID_First_Team_League INT UNSIGNED NOT NULL,
	ID_Second_Team_League INT UNSIGNED NOT NULL,
	Match_Date DATE NOT NULL,
	First_Team_Points INT UNSIGNED,
	Second_Team_Points INT UNSIGNED,
	CONSTRAINT PK_Leagues PRIMARY KEY (ID),
	CONSTRAINT FK_Scheduled_FTL FOREIGN KEY (ID_First_Team_League) REFERENCES Teams(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_Scheduled_STL FOREIGN KEY (ID_Second_Team_League) REFERENCES Teams (ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Participants (
	ID INT UNSIGNED AUTO_INCREMENT,
	ID_Scheduled INT UNSIGNED,
	ID_User INT UNSIGNED,
	Points INT,
	CONSTRAINT PK_Participants PRIMARY KEY (ID),
	CONSTRAINT FK_Participants_Scheduled FOREIGN KEY (ID_Scheduled) REFERENCES Scheduled(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_Participants_Users FOREIGN KEY (ID_User) REFERENCES Users(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

