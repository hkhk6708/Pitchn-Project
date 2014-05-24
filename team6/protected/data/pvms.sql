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
	locationProvince CHAR(2),
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
	status varchar(10), 
	startDate DATE,
	endDate DATE,
	actualEndDate DATE,
	projectDescription VARCHAR(255),
	city VARCHAR(255),
	province VARCHAR(255),
	recurring VARCHAR(20),
	projectWebsite VARCHAR(255),
	projectName VARCHAR(255),
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
	content VARCHAR(255),  
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
	FOREIGN KEY (projectId)
		REFERENCES Project(id)
		ON DELETE CASCADE,
	FOREIGN KEY (roleId)
		REFERENCES Role(id)
		ON DELETE CASCADE,
	PRIMARY KEY (id));

CREATE TABLE PersonAssignedToRole
	(id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	roleId INT NOT NULL,
	FOREIGN KEY (email)
		REFERENCES WorksFor(email)
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
	type VARCHAR(9) NOT NULL,
	stage SMALLINT,
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

/*
#Create Pitch'n as an Organization
*/

INSERT INTO Cause
SET id = 0;

INSERT INTO Organization
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM Cause ORDER BY id DESC LIMIT 1),'Pitch n', 'active', 'www.pitchn.ca', null, null, null);























#******************** THIS SECTION IS FOR TESTING PURPOSES ONLY *********************************
#********************DELETE BEFORE GIVING TO CLIENT *********************************************


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
	'Jack P. Lord',
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

#next, a relationship between the person and an organization must be established by inserting a row into the works_for table.
#only the email and organization_id are required

INSERT INTO WorksFor
VALUES(0, 'admin@pitchn.ca', (SELECT id FROM organization WHERE organizationName = 'Pitch n') );




#Create 3 organizations and primary organizers for each organization:

#1 ------------------
 
INSERT INTO Cause
SET id = 0;

INSERT INTO Organization 
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM Cause ORDER BY id DESC LIMIT 1), 'Toms Charity', 'active', 'www.tomscharity.com', 'A charity for people Tom likes', '604-555-5555', 'Dial extension 555 for Tom');

INSERT INTO Skill 
SET id = 0;
 
INSERT INTO Cause
SET id = 0;


INSERT INTO Person
VALUES (0, 'organizer@tomscharity.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Dave Peters', 
	null, 
	'604-555-5555', 
	'organizer123',
	0, 
	8, 
	'organizer', 
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


INSERT INTO worksFor
VALUES(0, 'organizer@tomscharity.com', (SELECT id FROM organization WHERE organizationName = 'Toms Charity') );



#2 -------------------
 
INSERT INTO Cause
SET id = 0;

INSERT INTO Organization 
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM Cause ORDER BY id DESC LIMIT 1), 'Stray Cats R Us', 'active', 'www.straycatsrus.org', 'We find stray cats', '604-777-5555', 'Press 0 to talk to a non-cat employee');

INSERT INTO Skill 
SET id = 0;
 
INSERT INTO Cause
SET id = 0;


INSERT INTO Person
VALUES (0,'organizer@straycatsrus.org', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Amanda Glerp', 
	null, 
	'604-777-5555', 
	'organizer123',
	0, 
	8, 
	'organizer', 
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
VALUES(0, 'organizer@straycatsrus.org', (SELECT id FROM organization WHERE organizationName = 'Stray Cats R Us') );

#3 -------------------
 
INSERT INTO Cause
SET id = 0;

INSERT INTO Organization 
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM Cause ORDER BY id DESC LIMIT 1),'Book Friends', 'active', 'www.bookfriends.ca', 'We find old books and give them to people', '604-444-5555', 'Leave a message if nobody answers');


INSERT INTO Skill 
SET id = 0;
 
INSERT INTO Cause
SET id = 0;


INSERT INTO Person
VALUES (0, 'organizer@bookfriends.ca', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Rachel McThomas', 
	null, 
	'604-444-5555', 
	'organizer123',
	0, 
	8, 
	'organizer', 
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
VALUES(0, 'organizer@bookfriends.ca', (SELECT id FROM organization WHERE organizationName = 'Book Friends') );


# --------------------



#Add some Volunteers and assign them to organizations 

#Pitchn admins will do this in practice, and they will know the causes and skills of the volunteers,
#so when we create the required new skill and cause entries, we can specify which skills and causes the
#volunteers have, instead of leaving them null like for administrators and organizers
#The first attribute (cause_id) must always be 0 or null.

# 1 *********************************


INSERT INTO Skill
	VALUES (0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 1, 1);

INSERT INTO Cause
	VALUES (0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0);


INSERT INTO Person
VALUES (0, 'reebus_m@hotmail.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Reebus McJesus', 
	604-123-5555, 
	'604-123-5555', 
	'volunteer123',
	0, 
	1, 
	'volunteer', 
	'1981-10-14', 
	'Richmond', 
	'BC', 
	'Canada', 
	'English', 
	'Enthusiastic about books!', 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');


INSERT INTO WorksFor
VALUES(0, 'reebus_m@hotmail.com', (SELECT id FROM organization WHERE organizationName = 'Book Friends') );



# 2 *************************************

INSERT INTO Skill
	VALUES (0, 0, 1, 0, 0, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 1, 1);

INSERT INTO Cause
	VALUES (0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1);


INSERT INTO Person
VALUES (0, 'sally_p@hotmail.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Sally Peterson', 
	'604-123-5555', 
	'604-123-5555', 
	'volunteer123',
	0, 
	1, 
	'volunteer',
	'1985-5-19', 
	'Vancouver', 
	'BC', 
	'Canada', 
	'English', 
	'I want to help dogs, and I also like libraries and other book-related things', 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');


INSERT INTO WorksFor
VALUES(0,'sally_p@hotmail.com', (SELECT id FROM organization WHERE organizationName = 'Stray Cats R Us') );

INSERT INTO WorksFor
VALUES(0, 'sally_p@hotmail.com', (SELECT id FROM organization WHERE organizationName = 'Book Friends') );

# 3 ***************************************

INSERT INTO Skill
	VALUES (0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

INSERT INTO Cause
	VALUES (0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0);


INSERT INTO Person
VALUES (0, 'franky_boy33@gmail.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Frank Wilcox', 
	'604-123-5555', 
	'604-123-5555', 
	'volunteer123',
	0, 
	1, 
	'volunteer', 
	'1966-1-22', 
	'Salmon Arm', 
	'BC', 
	'Canada', 
	'English', 
	'My girlfriend is making me do this so I do not care what I do as long as it gets me out of the house', 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');

INSERT INTO WorksFor
VALUES(0, 'franky_boy33@gmail.com', (SELECT id FROM organization WHERE organizationName = 'Toms Charity') );

INSERT INTO WorksFor
VALUES(0, 'franky_boy33@gmail.com', (SELECT id FROM organization WHERE organizationName = 'Stray Cats R Us') );

INSERT INTO WorksFor
VALUES(0, 'franky_boy33@gmail.com', (SELECT id FROM organization WHERE organizationName = 'Book Friends') );

# 4 ***************************************

INSERT INTO Skill
	VALUES (0, 0, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1);

INSERT INTO Cause
	VALUES (0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0);


INSERT INTO Person
VALUES (0, 'weipeng@yahoo.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Wei Peng', 
	'604-123-5555', 
	'604-123-5555', 
	'volunteer123',
	0, 
	1, 
	'volunteer', 
	'1976-12-2', 
	'West Vancouver', 
	'BC', 
	'Canada', 
	'Cantonese', 
	'I want to help Tom and be his friend', 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');

INSERT INTO WorksFor
VALUES(0, 'weipeng@yahoo.com', (SELECT id FROM organization WHERE organizationName = 'Toms Charity') );

# 5 **************************************

INSERT INTO Skill
	VALUES (0, 1, 1, 0, 0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1, 0, 1, 0, 0);

INSERT INTO Cause
	VALUES (0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1);


INSERT INTO Person
VALUES (9, 'sandeep890@outlook.com', 
	(SELECT LAST_INSERT_ID(id) FROM skill ORDER BY id DESC LIMIT 1), 
	(SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 
	'Sandeep Dhaliwal', 
	'604-123-5555', 
	'604-123-5555', 
	'volunteer123',
	0, 
	1, 
	'volunteer', 
	'1987-4-12', 
	'West Vancouver', 
	'BC', 
	'Canada', 
	'English', 
	'Books are important and I want to help save them', 
	'Y',
	'2014-03-21 12:00:00',
	'Y',
	'active');

INSERT INTO WorksFor
VALUES(0, 'sandeep890@outlook.com', (SELECT id FROM organization WHERE organizationName = 'Book Friends') );

#**************************************



#Set some free time for a couple volunteers:
#The first attribute must always be 0 or null

INSERT INTO FreeTime
VALUES (0, 'franky_boy33@gmail.com', '2014-03-12', '2014-03-12', '10:00:00', '14:00:00', 'weekly');

INSERT INTO FreeTime
VALUES (0, 'franky_boy33@gmail.com', '2014-03-14', '2014-03-14', '8:00:00', '13:00:00', 'once');

INSERT INTO FreeTime
VALUES (0, 'weipeng@yahoo.com', '2014-03-20', '2014-03-20', '9:00:00', '15:00:00', 'once');

INSERT INTO FreeTime
VALUES (0, 'sandeep890@outlook.com', '2014-03-18', '2014-03-18', '11:00:00', '13:00:00', 'once');

INSERT INTO FreeTime
VALUES (0, 'sally_p@hotmail.com', '2014-03-17', '2014-03-17', '10:00:00', '16:00:00', 'monthly');

INSERT INTO FreeTime
VALUES (0, 'reebus_m@hotmail.com', '2014-12-25', '2014-12-25', '10:00:00', '16:00:00', 'yearly');

INSERT INTO FreeTime
VALUES (0, 'reebus_m@hotmail.com', '2014-03-16', '2014-03-16', '90:00:00', '15:00:00', 'weekly');

# ***************************************


# Create Some Projects, with Roles and Tasks

# 1 ***********************

INSERT INTO Cause
	VALUES (0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0);

INSERT INTO Project
VALUES (0, 4, (SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 'incomplete', '2014-02-20', null, null,'Build a website for our new London branch', 'Vancouver', 'BC', 'Once', 'www.bookfriends.uk', 'Website Build');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'general', 'general role for entire project');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'Lead Developer', 'Lead a team of developers to make the website');

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Hosting Setup', 'incomplete', 0, 1, 'Setup the web hosting account', null, null);

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Basic Setup', 'incomplete', 0, 5, 'create basic site framework', null, null);

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'Developer', 'Work on a team of developers to make the website');

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Create Static Pages', 'incomplete', 0, 25, 'create all static pages required for site', null, null);


# 2 ************************

INSERT INTO Cause
	VALUES (0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0);

INSERT INTO Project
VALUES (0, 3, (SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 'incomplete', '2014-02-20', null, null,'Raise money for cat shelters', 'Vancouver', 'BC', 'Once', 'www.cakebake.ca', 'Giant Cat Bake Sale');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'general', 'general role for entire project');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'Bake Leader', 'Lead a team of bakers making the goods for the sale');

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Buy ingredients', 'incomplete', 0, 4, 'Buy all the stuff we need to make the goods', null, null);

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Bake the Goods', 'incomplete', 0, 12, 'With a team, bake all the goods needed for the sale', null, null);

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'Promoter', 'Promote the upcoming sale online and in the neighbourhood');

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Make Posters', 'incomplete', 0, 3, 'Make some posters advertising the sale', null, null);

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Put up Posters', 'incomplete', 0, 10, 'Put posters up around the neihbourhood', null, null);


# 3 ************************

INSERT INTO Cause
	VALUES (0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0);

INSERT INTO Project
VALUES (0, 2, (SELECT LAST_INSERT_ID(id) FROM cause ORDER BY id DESC LIMIT 1), 'incomplete', '2014-02-20', null, null,'Have some fun and raise money for Cancer research', 'Vancouver', 'BC', 'Yearly', 'www.tomcancerwalk.com', 'The Annual Tom Cancer Walk');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'general', 'general role for entire project');

INSERT INTO Role
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM project ORDER BY id DESC LIMIT 1), 'Fundraiser', 'Raise Funds for the event');

INSERT INTO Task
VALUES (0, (SELECT LAST_INSERT_ID(id) FROM role ORDER BY id DESC LIMIT 1), 'Call Potential Donors', 'incomplete', 0, 30, 'Call potential donors and ask for donations', null, null);

# ***************************

# Create Some Messages from Volunteers to Organizers

#1 *************************

INSERT INTO Message
VALUES (0, 'reebus_m@hotmail.com', 'organizer@bookfriends.ca', 'Reebus McJesus', 'organizer', '2014-03-12', 'Hey, I am Reebus and I just wanted to say I love books!', 'N');

# **************************

# Create Some Comments

# 1 *************************

# Comments on a project:

INSERT INTO PComments
VALUES (0, (SELECT id FROM Project WHERE projectName = 'Giant Cat Bake Sale'), '2014-03-10', 'franky_boy33@gmail.com', 'It is not a cat that is being baked, is it?');

# Comments on a task:

INSERT INTO TComments
VALUES (0, (SELECT id FROM task WHERE taskName = 'Buy ingredients'), '2014-03-08', 'franky_boy33@gmail.com', 'Do I have to spend my own money, or will you provide it?');

# ***************************

# Define contact restrictions for a role. I.e. the people that a role is allowed to contact

INSERT INTO orgContact
VALUES (0, 'organizer@tomscharity.com', (SELECT id FROM role WHERE title = 'Developer'), 'Media Volunteer Organizer');

#****************************

# Test Adding File information:


# General File for the entire project:

INSERT INTO File
VALUES (0, (SELECT id FROM Project WHERE ProjectName = 'Giant Cat Bake Sale'),(SELECT id FROM ROle WHERE title = 'General' AND projectId = (SELECT id FROM Project WHERE ProjectName = 'Giant Cat Bake Sale')), '/userDocs/projects/welcome.pdf');

# A file specific to a role:

INSERT INTO File
VALUES (0, (SELECT id FROM Project WHERE ProjectName = 'Website Build'),(SELECT id FROM ROle WHERE title = 'Lead Developer' AND projectId = (SELECT id FROM Project WHERE ProjectName = 'Website Build')), '/userDocs/projects/roles/staff_guidelines.pdf');

#*******************************

# Assign People to Roles:


INSERT INTO PersonAssignedToRole
VALUES (0, 'franky_boy33@gmail.com', (SELECT id FROM role WHERE title = 'Developer'));
