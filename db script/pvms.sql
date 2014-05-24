CREATE Database pvms;
USE pvms;

#Tables:
#1.	Skill - each row represents a list of skills, with 1 indicating an attribute is on the list and 0 or null indicating it is not
#2.	Cause - each row represents a list of causes supported, with 1 indicating an attribute is on the list and 0 or null indicating it is not
#3.	Organization - each row represents details concerning an individual organiation
#4.	Person - each row represents details concerning an individual person (administrator, organizer, volunteer)
#5.	WorksFor - this table pairs the email address of a person with the organization_id of an organization the person works for
#6.	FreeTime - each row represents a time when a person is available to volunteer
#7.	Project - each row represents details of an individual project
#8.	PComments - each row represents details of a comment associated with an individual project
#9.	Role - each row represents an individual role within a project
#10.	Task - each row represents an individual task within a role.
#11.	TComments - each row represents details of a comment associated with an individual task.
#12.	OrgContact - each row represents a person who can be contacted by an individual assigned to a specific role
#13.	Message - each row represents the details of a message
#14.	File - each row represents details concerning a file.
#15.	PersonAssingedToRole - each row represents a person and a role assigned to that person.
#16.	volunteerNote - each row represents a comment made by an organizer about a volunteer in their organization
#17.    ob - Used to support on-boarding features. Each row represents the content of an onboarding message for either roles or for all users.
#18.	obOrg - Used to support on-boarding features at the organization level. Each row represents an organization-wide onboarding message.
#19.    dataFile - Used to store data concerning user-uploaded datasets imported into the db.
#20.	userImage - Used to store data concerning user-uploaded images for profile pictures.

#For all tables except Person:
#id is an auto-generated unique number. use 'null' or 0 for this attribute when inserting a new row.
#Use this query:
#SELECT LAST_INSERT_ID(id) FROM [TABLE_NAME] ORDER BY id DESC LIMIT 1); 
#immediately afterwards to return the id if needed.

#Legal values for all TINYINT(1) attributes are either 1 or 0.
#mysql does not support the SQL CHECK statement, so this constraint is NOT enforced at the DB level

CREATE TABLE Skill
	(id INT not null AUTO_INCREMENT,
	accounting TINYINT(1),
	advertising TINYINT(1),
	branding TINYINT(1),
	businessStrategy TINYINT(1),
	communications TINYINT(1),
	copywriting TINYINT(1),
	design TINYINT(1),
	education TINYINT(1),
	entrepreneurship TINYINT(1),
	eventPlanning TINYINT(1),
	finance TINYINT(1),
	fundraising TINYINT(1),
	humanResources TINYINT(1),
	legal TINYINT(1),
	marketing TINYINT(1),
	multimedia TINYINT(1),
	onlineMarketing TINYINT(1),
	photography TINYINT(1),
	projectManagement TINYINT(1),
	publicRelations TINYINT(1),
	sales TINYINT(1),
	socialMedia TINYINT(1),
	technology TINYINT(1),
	webDevelopment TINYINT(1),
	other VARCHAR(255),
	primary key (id));

#Legal values for all TINYINT(1) attributes are either 1 or 0.
#mysql does not support the SQL CHECK statement, so this constraint is NOT enforced at the DB level

CREATE TABLE Cause
	(id INT NOT NULL AUTO_INCREMENT,
	animalWelfare TINYINT(1),
	artsAndCulture TINYINT(1),
	children TINYINT(1), 
	communityAndService TINYINT(1),
	democracyAndPolitics TINYINT(1), 
	education TINYINT(1),
	environment TINYINT(1),
	food TINYINT(1),
	health TINYINT(1),
	housingAndHomelessness TINYINT(1),
	humanRights TINYINT(1),
	humanitarianRelief TINYINT(1),
	internationalAffairs TINYINT(1),
	media TINYINT(1),
	povertyAlleviation TINYINT(1),
	religion TINYINT(1),
	scienceAndTechnology TINYINT(1),
	seniorCitizens TINYINT(1),
	womensIssues TINYINT(1), 
	other VARCHAR(255), 
	PRIMARY KEY (id));

CREATE TABLE Organization
	(id INT not null AUTO_INCREMENT,
	causeId INT NOT NULL,
	organizationName VARCHAR(255) UNIQUE not null,
    status VARCHAR (30) NOT NULL,
	website VARCHAR (255),
	organizationDescription VARCHAR(255),
	organizationPhone VARCHAR(255),
	contactDetails VARCHAR(255),
	FOREIGN KEY (causeId)
		REFERENCES Cause(id)
		ON DELETE NO ACTION,
	primary key (id));

#user_type can be one of: administrator, organizer, volunteer. mysql does NOT support CHECK statements, so this constraint is NOT implemented
#at the DB level.

CREATE TABLE Person 
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) UNIQUE NOT NULL,
	causeId INT NOT NULL,
	skillId INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	phone VARCHAR(30),
	workPhone VARCHAR(30),
	password VARCHAR(30) NOT NULL,
	passErr SMALLINT,
	permissionLevel TINYINT(1),
	userType VARCHAR(13)NOT NULL,
	birthdate DATE,
	locationCity VARCHAR(255),
	locationProvince VARCHAR(255),
	locationCountry VARCHAR(255),
	language VARCHAR(255),
	description VARCHAR(255),
	registered CHAR(1) NOT NULL,
	lastActive TIMESTAMP NOT NULL,
	active CHAR(1) NOT NULL,
	status VARCHAR(12) NOT NULL,
	FOREIGN KEY (causeId)
		REFERENCES Cause(id)
		ON DELETE NO ACTION,
	PRIMARY KEY (id));

CREATE TABLE WorksFor
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	organizationId INT NOT NULL,
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	FOREIGN KEY (organizationId)
		REFERENCES Organization(id)
		ON DELETE NO ACTION,
	PRIMARY KEY (id));

#recurring has the following legal values: 'weekly', 'monthly', 'yearly', 'once'
#MySQL does not support the CHECK statement, so this constraint is NOT implemented at the DB level

CREATE TABLE FreeTime 
	(id INTEGER NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	startDate DATE,
	endDate DATE,
	startTime TIME,
	endTime TIME,
	recurring VARCHAR(255),
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

# cause_supported must match one of the attributes of the Cause table
# status can be either 'incomplete' or 'complete'
# recurring can be either 'daily', 'weekly', 'monthly', 'yearly', or 'once'
# MySQL does not support the CHECK statement, so these constraints are NOT implemented at the DB level.

CREATE TABLE Project
	(id INT NOT NULL AUTO_INCREMENT,
	organizationId INT NOT NULL,
	causeId INT NOT NULL,
	status varchar(25), 
	startDate DATE,
	endDate DATE,
	actualEndDate DATE,
	projectDescription VARCHAR(255),
	city VARCHAR(255),
	province VARCHAR(255),
	recurring VARCHAR(20),
	projectWebsite VARCHAR(255),
	projectName VARCHAR(255) NOT NULL,
	FOREIGN KEY (organizationId)
		REFERENCES Organization(id)
		ON DELETE CASCADE,
	FOREIGN KEY (causeId)
		REFERENCES Cause(id)
		ON DELETE NO ACTION,
	PRIMARY KEY(id));

CREATE TABLE PComments 
	(id INT NOT NULL AUTO_INCREMENT,
	projectId INT NOT NULL,
	cdate DATE,
	email VARCHAR(255) NOT NULL,
	content VARCHAR(255),
	FOREIGN KEY (projectId)
		REFERENCES Project(id)
		ON DELETE CASCADE,
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE NO ACTION,
	PRIMARY KEY (id));
/*
# Each project must define a "general" role. This is required to allow organizers to share files to all roles within a project.
# The first role defined for a project should be this general role, like this:
#INSERT INTO Role
#VALUES (0, (SELECT LAST_INSERT_ID(project_id) FROM project ORDER BY project_id DESC LIMIT 1), 'general', 'general role for entire project')
#Any files which an organizer wishes to share with all roles within a project should use the general role's role_id as its foreign key.
*/

CREATE TABLE Role
	(id INT NOT NULL AUTO_INCREMENT,
	projectId INT NOT NULL,
	title VARCHAR(255),
	roleDescription VARCHAR(255),
	FOREIGN KEY (projectId)
		REFERENCES Project(id)
		ON DELETE CASCADE,
	PRIMARY KEY(id));

# status can be either 'complete' or 'incomplete'
# timeSpent is the number of hours required to complete the task. should be 0 at the beginning and updated by the volunteer as he or she progresses.
# estCompTime is the number of hours estimated to be required to complete the task.

CREATE TABLE Task 
	(id INT NOT NULL AUTO_INCREMENT,
	roleId INT,
	taskName VARCHAR(255),
	status VARCHAR(255),
	timeSpent INT,
	estCompTime INT,
	completion INT,
	taskDescription VARCHAR(255),
	startDate DATE,
	endDate DATE,
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	PRIMARY KEY(id));

CREATE TABLE TComments
	(id INT NOT NULL AUTO_INCREMENT,
	taskId INT NOT NULL,
	cdate DATE,
	email VARCHAR(255),
	content VARCHAR(255),
	FOREIGN KEY (taskId)
		REFERENCES Task(id)
		ON DELETE CASCADE,
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE NO ACTION,
	PRIMARY KEY (id));

CREATE TABLE OrgContact
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	roleId INT NOT NULL,
	title VARCHAR(255),
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE Message
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL, 
	recipientEmail VARCHAR(255), 
	senderName VARCHAR(255), 
	userType VARCHAR(20), 
	date DATE, 
	content VARCHAR(511),  
	readmsg CHAR(1),
	FOREIGN KEY (email)
		REFERENCES Person (email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE File
	(id INT NOT NULL AUTO_INCREMENT,
	projectId INT NOT NULL,
	roleId INT NOT NULL,
	path VARCHAR(255),
	filename VARCHAR(255),
	addedBy VARCHAR(255),
	FOREIGN KEY (projectId)
		REFERENCES Project(id)
		ON DELETE CASCADE,
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	FOREIGN KEY (addedBy)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE PersonAssignedToRole
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	roleId INT UNIQUE NOT NULL,
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE VolunteerNote
	(id INT NOT NULL AUTO_INCREMENT,
	volunteerEmail VARCHAR(255) NOT NULL,
	organizerEmail VARCHAR(255) NOT NULL,
	organizationId INT NOT NULL,
	dateTime TIMESTAMP NOT NULL,
	content VARCHAR(255),
	FOREIGN KEY (volunteerEmail)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	FOREIGN KEY (organizerEmail)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE Table ob
	(id INT NOT NULL AUTO_INCREMENT,
	roleId INT NOT NULL,
	content VARCHAR(255),
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE Table obOrg
	(id INT NOT NULL AUTO_INCREMENT,
	organizationId INT NOT NULL,
	stage SMALLINT,
	content VARCHAR(255),
	FOREIGN KEY (organizationId)
		REFERENCES Organization(id)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE dataFile
	(id INT NOT NULL AUTO_INCREMENT,
	orgId INT NOT NULL,
	path VARCHAR(255),
	filename VARCHAR(255),
	addedBy VARCHAR(255),
	date TIMESTAMP,
	FOREIGN KEY (orgId)
		REFERENCES Organization(id)
		ON DELETE CASCADE,
	FOREIGN KEY (addedBy)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE userImage
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	path VARCHAR(255),
	filename VARCHAR(255),
	date DATE,
	current TINYINT(1),
	FOREIGN KEY (email)
		REFERENCES Person(email)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

/*
#Create Pitch'n as an Organization
*/

INSERT INTO Cause
SET id = 0;

INSERT INTO Organization
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM Cause ORDER BY id DESC LIMIT 1),'Pitch\'n', 'active', 'www.pitchn.ca', null, null, null);

#Create 1 Administrator

#To create ANY person, first a new skill entry and a new cause entry must be created. Only the primary keys must be created, the other values can be 
#left null and updated using UPDATE later.
 
INSERT INTO Cause
SET id = 0;

INSERT INTO Skill 
SET id = 0;

#Create a new person with user-type Administrator

INSERT INTO Person
VALUES (0,
	'admin@pitchn.ca', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Sean Kennedy',
	null, 
	'604-555-5555', 
	'admin123',
	0, 
	10, 
	'administrator', 
	null, 
	null, 
	null, 
	null, 
	null, 
	null, 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');


INSERT INTO WorksFor
VALUES(0, 'admin@pitchn.ca', (SELECT id FROM organization WHERE organizationName = 'Pitch\'n') );



