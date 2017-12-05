CREATE TABLE Users (
	ID INT UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	Surname VARCHAR(50) NOT NULL,
	Nickname VARCHAR(50),
	Birth_Date	DATE,
	Email VARCHAR(50) NOT NULL,
	Password_Hash VARCHAR(50) NOT NULL,
	Avatar VARCHAR(100),
	Description VARCHAR(100),
	CONSTRAINT PK_Users PRIMARY KEY (ID),
	CONSTRAINT U_Users_Email_Pasword UNIQUE (Email, Password_Hash)
);

CREATE TABLE Teams (
	ID INT UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	ID_Captain INT UNSIGNED NOT NULL,
	ID_Manager INT,
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