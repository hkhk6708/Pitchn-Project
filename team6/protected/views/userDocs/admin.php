<?php
/* @var $this UserDocsController */

$this->breadcrumbs=array(
	'User Docs'=>array('/userDocs'),
	'Admin',
);
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/userdocs.css" />
</html>

<h2>Table of Contents</h2>
<p class="indent1">Administrator Documentation</a></p>
<p class="indent2"><a href="#a_faq">Admin FAQ</a></p>
<p class="indent2"><a href="#a_1">1. Getting Started</a></p>
<p class="indent3">Login</p>
<p class="indent3">Navigation Bar</p>
<p class="indent3">Messaging</p>
<p class="indent4">Inbox</p>
<p class="indent4">Sent Messages</p>
<p class="indent3">User Profile</p>
<p class="indent3">Secondary Features<p>
<p class="indent4">Logout<p>

<p class="indent2"><a href="#a_2">2. Admin Dashboard</a></p>
<p class="indent2"><a href="#a_3">3. Users</a></p>
<p class="indent3">User Profiles</p>

<p class="indent2"><a href="#a_4">4. Organizations</a></p>
<p class="indent2"><a href="#a_5">5. Reports</a></p>
	
<p class="indent1">Organizer Documentation</p>
<p class="indent2"><a href="#o_faq">Organizer FAQ</a></p>

<p class="indent2"><a href="#o_1">1. Getting Started</a></p>
<p class="indent3">Login</p>
<p class="indent3">Navigation Bar</p>
<p class="indent3">Messaging</p>
<p class="indent4">Inbox</p>
<p class="indent4">Sent Messages</p>
<p class="indent3">User Profile</p>
<p class="indent3">Secondary Features</p>
<p class="indent4">Create New Organizer Account</p>
<p class="indent4">Import Data</p>
<p class="indent4">Logout</p>
	
<p class="indent2"><a href="#o_2">2. Organizer Dashboard</a></p>

<p class="indent2"><a href="#o_3">3. Volunteers (Search)</a></p>
<p class="indent3">Role Assignment</p>
<p class="indent3">User Profiles</p>
		
<p class="indent2"><a href="#o_4">4. Projects</a></p>
<p class="indent3">Projects, Roles, Tasks – Overview</p>
<p class="indent3">Project Main</p>
<p class="indent3">Project Documents</p>
<p class="indent3">Project Roles</p>
<p class="indent4">Role Documents</p>
<p class="indent4">Modify Role Info</p>
<p class="indent4">Role Contacts</p>
<p class="indent4">Role Tasks</p>
<p class="indent5">Task Main</p>
				
<p class="indent2"><a href="#o_5">5. Reports</a></p>
		
<p class="indent1">Volunteer Documentation</p>
<p class="indent2"><a href="#v_faq">Volunteer FAQ</a></p>

<p class="indent2"><a href="#v_1">1. Getting Started</a></p>
<p class="indent3">Login</p>
<p class="indent3">Navigation Bar</p>
<p class="indent3">Messaging</p>
<p class="indent4">Inbox</p>
<p class="indent4">Sent Messages</p>
<p class="indent3">User Profile</p>
<p class="indent3">Secondary Features</p>
<p class="indent4">Change Current Organization</p>
<p class="indent4">Logout</p>
	
<p class="indent2"><a href="#v_2">2. Volunteer Dashboard</a></p>
<p class="indent3">The Mini-Calendar</p>
<p class="indent3">My Projects Table</p>
<p class="indent3">My Tasks Table</p>
<p class="indent3">Contact Info</p>

<p class="indent2"><a href="#v_3">3. Projects</a></p>
<p class="indent3">Projects, Roles, and Tasks – Overview	</p>
<p class="indent3">Project Main</p>
<p class="indent3">Project Team</p>
<p class="indent3">Project Documents</p>
<p class="indent3">Project Tasks</p>
<p class="indent3">Project Roles</p>
<p class="indent4">Role Tasks</p>
<p class="indent5">Task Main</p>
<p class="indent5">Updating the Task’s Status</p>
<p class="indent4">Role Documents</p>
<p class="indent4">Role Info</p>
			
<p class="indent2"><a href="#v_4">4. Calendar</a></p>
		
	
<h2>Administrator Documentation</h2>
<a name="a_faq"></a>
<h3>Admin FAQ:</h3>
<p class="faq1">1. How do I create a new organization?</p>
<p class="faq2">Follow the instructions in <a href="#a_4">section 4</a>.</p>

<p class="faq1">2. I’ve created an organization, now what?</p>
<p class="faq2">Once you’ve created an organization, you need to create an organizer account and associate that account with the organization. This organizer will then be able to create as many new organizer accounts as his or her organization needs.
    Add the organizer to the system by following the instructions in <a href="#a_3">section 3</a>.
</p>

<p class="faq1">3. What does it mean for an organization to be disabled?</p>
<p class="faq2">If an organization is disabled, then all functionality related to that organization is blocked. Specifically, this means that any organizers associated with that organization will be unable to log in. Also, any volunteers associated with that organization will be unable to view information concerning the organization. If the volunteer is associated with at least one other organization, they will be able to log in, but will not be able to switch perspective to the disabled organization.</p>

<p class="faq1">4. How do I disable an organization?</p>
<p class="faq2">Edit the organization’s information, as described in <a href="#a_3">section 4</a>. Change the organization’s status in the drop-down menu from ‘Enabled’ to ‘Disabled’.</p>

<p class="faq1">5. What does it mean for a user to be disabled?</p>
<p class="faq2">If a user is disabled, they cannot log in or access the system in any way.</p>

<p class="faq1">6. How do I disable a user?</p>
<p class="faq2">Use the instructions in <a href="a_3">section 3</a> to reach the user’s “advanced settings” screen. Change the user’s status in the drop-down menu from ‘Enabled’ to ‘Disabled’.</p>

<p class="faq1">7. Can users message me?</p>
<p class="faq2">No. Only other Pitch’n administrators are able to message you within the system.</p>

<a name="a_1"></a>
<h3>1. Getting Started</h3>
<h4>Login</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/login.jpg") ?></div>
<p class="content">
    As a user of the Pitch’n Volunteer Management System, this is the first screen you will encounter. </p>
<p class="content">
<red>To log in to the system</red>, enter your email/password combination and click “login”.</p>
<p class="content">
<red>If you have forgotten your password</red>, click “Forgot Password?”, and you will be asked to enter email address. Click “Reset Password”, and a new, temporary password will be emailed to you. Remember to check your junk mail folder if you can’t find the email in your inbox.
</p>
<h4>Navigation Bar</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/navbar.jpg") ?></div>
<p class="content">
    The navigation bar provides access to the system’s messaging, user profile, and secondary features.
</p>
<h4>Messaging</h4>
<p class="content">The messaging system allows you to send/receive messages from other users.</p>
<h5>Inbox</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox.jpg") ?></div>
<p class="content">The inbox displays all of the messages you have received from other users. You can also create new messages from this screen. </p>
<p class="content"><red>Access the inbox</red> by clicking on the letter icon on the navigation bar, and selecting “inbox”.</p>
<p class="content"><red>To create a new message</red>, click “Create”.  The message form will appear. Click anywhere in the “To:” field to select a recipient. A list of recipients will be automatically generated for you. You may select multiple recipients if you wish.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox2.jpg") ?></div>
<p class="content">Once you have selected your recipient(s), enter the content for the message in the text area, and click “Send” to send the message.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox3.jpg") ?></div>
<h5>Sent Messages</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/outbox.jpg") ?></div>
<p class="content">The Sent Messages screen displays all of the messages you have sent. </p>
<p class="content"><red>Access the sent messages screen</red> by clicking on the letter icon on the navigation bar, and selecting “Sent Messages.” </p>
<p class="content">Note: Once the recipient of your message has read and deleted your message, it will no longer be listed.</p>
<h4>User Profile</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/profile.jpg") ?></div>
<p class="content">Your user profile contains all the details about you visible only to other Administrators within the Pitch’n Volunteer Management System. </p>
<p class="content"><red>To access your profile</red>, click the profile icon on the navigation bar.</p>
<p class="content">Note: for privacy reasons, Volunteers are unable to view the profile of other users, and Organizers may view only the profiles of volunteers assigned to their organization, as well as the profiles of other Organizers assigned to that same organization.</p>
<p class="content"><red>To edit your profile</red>, click “Edit Profile”. You may change any of the values displayed. Click “Save” to save the results, or click “Dashboard” on the menu to discard the changes.</p>
<p class="content"><red>To change your profile picture</red>, click “Change Picture”. You will be presented with the “Change Picture” screen which displays all of your currently-saved profile pictures:</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/pic1.jpg") ?></div>
<p class="content">The highlighted row represents the currently displayed image. Click on any of the other images to display it as your profile picture.</p>
<p class="content"><red>To upload a new profile picture</red>, click “Upload New Picture” from the “Change Picture” screen. Select a file from your computer to upload, and click “Upload File”.</p>
<p class="content">Note: profile pictures must be 300 x 300 pixels in dimension. </p>
<h4>Secondary Features</h4>
<p class="content">These features are accessed through the Secondary Features drop-down menu (<?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/secondary.jpg") ?>), located on the navigation bar.</p>
<h5>Logout</h5>
<p class="content"><red>To log out of the system</red>, click on the secondary features drop-down menu in the navigation bar, and select “Logout”.</p>

<a name="a_2"></a>
<h3>2. Admin Dashboard</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/dash.jpg") ?></div>
<p class="content">The Admin Dashboard is the first screen you will encounter after you log in. The features on the dashboard will give you a high-level overview of the current usage of the system. These features include:</p>
<p class="content">- The System Report bar graph. This report provides you with up-to-date data about the system, such as the number of volunteers and the number of organizations currently registered in the system.</p>
<p class="content">- The Organizations Table. This table provides a list of all the organizations currently registered in the system.</p>

<a name="a_3"></a>
<h3>3. Users</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/search.jpg") ?></div>
<p class="content">The Users screen allows you to search for and view information about any user registered in the system. You may also use this screen to message individual users or groups of users, and to add additional users of any user-type.</p>
<p class="content">Note: By default, only active users are displayed. Inactive users are those users which have been imported by an organization, but that have never logged in to the system. Once an inactive user logs in to the system, his or her status is automatically changed to active. To include inactive users in search results, uncheck the “only active users” checkbox on the search options menu, as described below.</p>
<p class="content"><red>To search for users</red>, begin by clicking the magnifying glass icon at the top of the screen to expand the Search Options menu.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/search2.jpg") ?></div>
<p class="content">The Search Options menu will allow you to specify criteria by which to search for. </p>
<p class="content"><red>To search for users</red>, enter the desired search criteria in the appropriate fields, and click “search”.  The system will then display users with matching criteria in the area below. Click the magnifying glass icon to collapse the Search Options menu to increase the viewing area of the search results.></p>
<p class="content"><red>To add a new user account to the system</red>, click the “+” button located in the lower-left corner of the Users screen. You will be required to enter information about the user. When you’re finished, click “Create”, and the user will be added to the system. A message containing, “Account Created” will be displayed, and the user will be sent an email containing his/her login information.</p>
<p class="content"><red>To view a user’s profile</red>, click the profile button (<?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/user_icon.jpg") ?>), located in the same row as the user’s name.</p>
<h4>User Profiles</h4>
<p class="content">User profiles contain all the information a user wishes to share with organizers and administrators, as well as notes organizers have created concerning the user. The profile also provides access to the user’s schedule via the calendar, and the ability to message the user directly.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/user.jpg") ?></div>
<p class="content"><red>To view this user’s calendar</red>, click the calendar button.</p>
<p class="content"><red>To send this user a message</red>, click the “Send Message” button. This will load the message pop-up with the user’s name already filled out in the “To:” field.</p>
<p class="content"><red>To edit this user’s profile</red>, click “Edit Profile”.</p>
<p class="content"><red>To edit the advanced settings for this user</red>, click “Advanced Settings”. The advanced settings will allow you to assign the user to one or more new organizations, remove the user from one or more organizations, disable the user’s account, or change the user’s user-type.</p>
<p class="content"><red>To change the user’s password</red>, click “Change Password”.</p>
<p class="content"><red>To add a note on the user’s account</red> (viewable only by administrators and organizers), click “Create Note.” The note, along with any other notes </p>

<a name="a_4"></a>
<h3>4. Organizations</h3>
<p class="content">The Manage Organizations screen gives you access to information about every organization registered in the system.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/orgs.jpg") ?></div>
<p class="content"><red>To search for an organization</red>, enter the search criteria in the corresponding field above each column, and press enter. Leave blank any fields which you do not wish to affect the search results. For example, to search for all active organizations, enter “active” in the field for the Status column, and press enter. Only those organizations which are active will be listed.</p>
<p class="content"><red>To reset the search results</red>, clear all of the fields and press enter. All organizations registered within the system will now be displayed.</p>
<p class="content"><red>To view information about a specific organization</red>, click the magnifying glass icon located on the right side of the row corresponding to the organization. </p>
<p class="content"><red>To edit information about a specific organization</red>, click the pencil icon located on the right side of the row corresponding to the organization.</p>
<p class="content">Editing an organization’s information will allow you to change all of the details concerning an organization, as well as to change the status of an organization from ‘enabled’ to ‘disabled’, and vice-versa.</p>
<p class="content"><red>To create a new organization</red>, click “Create New Organization.” You will be asked to provide information about the organization. When finished, click “create” and the organization will be registered in the system.</p>

<a name="a_5"></a>
<h3>Reports</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/admin/reports.jpg") ?></div>
<p class="content">The Admin Reports screen provides you will graphical representation of some statistics about the system.</p>
<p class="content"><red>To print a report</red>, click the printer icon located in the bottom-left corner of the screen.</p>

<h2>Organizer Documentation</h2>
<a name="o_faq"></a>
<h3>Organizer FAQ:</h3>
<p class="faq1">1. What are projects, roles, and tasks?</p>
<p class="faq2">See <a href="#o_4">section 4</a>: Projects, Roles, and Tasks - Overview</p>
<p class="faq1">2. How do I create a project?</p>
<p class="faq2">See <a href="#o_4">section 4</a>: Create a New Project.</p>
<p class="faq1">3. How do I assign a volunteer to a role?</p>
<p class="faq2">There are a couple of ways to do this. You can assign them from the Volunteers screen, as described in <a href="#o_3">section 3</a>. Or you can assign them from the Project – Roles screen, as described in <a href="#o_4">section 4</a>.</p>
<p class="faq1">4. How do I know when a task has been completed?</p>
<p class="faq2">When a volunteer completes a task, he or she will mark the task as “Pending Verification.” The system will send you a message, indicating this change. You need to then examine the task for completeness. If you are satisfied, you will mark the task as “Complete.”</p>
<p class="faq1">5. Can other organizers see the projects I’ve created?</p>
<p class="faq2">Yes. All organizers within your organization have access to the same information that you do.</p>
<p class="faq1">6. How do I add volunteers?</p>
<p class="faq2">There are two ways:</p>
<p class="faq2">1. Volunteers will be added by Pitch’n as they are paired with your organization.</p>
<p class="faq2">2. You may import user data concerning your existing volunteers using the Import Data function, as described in <a href="#o_1">section 1</a>: Import Data.</p>


<a name="o_1"></a>
<h3>1. Getting Started</h3>
<h4>Login</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/login.jpg") ?></div>
<p class="content">
    As a user of the Pitch’n Volunteer Management System, this is the first screen you will encounter. </p>
<p class="content">
<red>To log in to the system</red>, enter your email/password combination and click “login”.</p>
<p class="content">
<red>If you have forgotten your password</red>, click “Forgot Password?”, and you will be asked to enter email address. Click “Reset Password”, and a new, temporary password will be emailed to you. Remember to check your junk mail folder if you can’t find the email in your inbox. If you are still experiencing issues logging in, please contact Pitch’n through www.pitchn.ca
</p>
<h4>Navigation Bar</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/navbar.jpg") ?></div>
<p class="content">
    The navigation bar provides access to the system’s messaging, user profile, and secondary features.
</p>
<h4>Messaging</h4>
<p class="content">The messaging system allows you to send/receive messages from other users.</p>
<h5>Inbox</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox.jpg") ?></div>
<p class="content">The inbox displays all of the messages you have received from other users. You can also create new messages from this screen. </p>
<p class="content"><red>Access the inbox</red> by clicking on the letter icon on the navigation bar, and selecting “inbox”.</p>
<p class="content"><red>To create a new message</red>, click “Create”.  The message form will appear. Click anywhere in the “To:” field to select a recipient. A list of recipients will be automatically generated for you. You may select multiple recipients if you wish.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox2.jpg") ?></div>
<p class="content">Once you have selected your recipient(s), enter the content for the message in the text area, and click “Send” to send the message.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox3.jpg") ?></div>
<h5>Sent Messages</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/outbox.jpg") ?></div>
<p class="content">The Sent Messages screen displays all of the messages you have sent. </p>
<p class="content"><red>Access the sent messages screen</red> by clicking on the letter icon on the navigation bar, and selecting “Sent Messages.” </p>
<p class="content">Note: Once the recipient of your message has read and deleted your message, it will no longer be listed.</p>
<h4>User Profile</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/profile.jpg") ?></div>
<p class="content">Your user profile contains all the details about you visible to other Organizers within your organization, as well as Administrators within the Pitch’n Volunteer Management System. </p>
<p class="content"><red>To access your profile</red>, click the profile icon on the navigation bar.</p>
<p class="content">Note: for privacy reasons, Volunteers are unable to view the profile of other users.</p>
<p class="content"><red>To edit your profile</red>, click “Edit Profile”. You may change any of the values displayed. Click “Save” to save the results, or click “Dashboard” on the menu to discard the changes.</p>
<p class="content"><red>To change your profile picture</red>, click “Change Picture”. You will be presented with the “Change Picture” screen which displays all of your currently-saved profile pictures:</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/pic1.jpg") ?></div>
<p class="content">The highlighted row represents the currently displayed image. Click on any of the other images to display it as your profile picture.</p>
<p class="content"><red>To upload a new profile picture</red>, click “Upload New Picture” from the “Change Picture” screen. Select a file from your computer to upload, and click “Upload File”.</p>
<p class="content">Note: profile pictures must be 300 x 300 pixels in dimension. </p>
<h4>Secondary Features</h4>
<p class="content">These features are accessed through the Secondary Features drop-down menu (<?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/secondary.jpg") ?>), located on the navigation bar.</p>
<h5>Create New Organizer Account</h5>
<p class="content">This feature allows you to create new organizer accounts for individuals within your organization. These organizers, like yourself, will be able to create and manage projects and volunteers within your organization. </p>
<p class="content"><red>To create a new organizer account</red>, select “Create New Organizer Account” from the Secondary Features drop-down menu.</p>
<p class="content">You will be asked to enter information about the organizer. When you are finished, click “Create.” The system will display an “Account Created” message, and the new organizer will receive an email with his or her log in information.</p>
<p class="content">If the person you are attempting to register as an administrator is already registered with the system as a volunteer, please contact Pitch’n to have that user upgraded to organizer status.</p>
<h5>Import Data</h5>
<p class="content">The Import Data feature allows you to import user data from excel spreadsheets into the system. </p>
<p class="content"><red>To import users into the system</red>, select “import data” from the Secondary Features drop-down menu.</p>
<p class="content">You will be asked to upload a .csv (comma-separated values) file from your computer. </p>
<p class="content">If your spreadsheet is not currently in the .csv format, you must convert it before continuing. Using Microsoft Excel, this is an easy process. Open your spreadsheet and slelect “File->Save As” and chose the .csv (it may say “Comma Separated”, or “Comma Delimited”) format. Once your file is saved in this format, it is ready to be uploaded to the Pitch’n Volunteer Management System.</p>
<p class="content">Note: your .csv file’s first row must contain the column names for your dataset, such as “Email”, “Name”, “Address”, etc.</p>
<h5>Steps:</h5>
<p class="content">- Click the “chose file” button, and select the .csv file on your computer.</p>
<p class="content">- Click “Upload File”</p>
<p class="content">Next, the system will display the “Map Column Names” screen. The purpose of this screen is to allow you to match your column names with the corresponding parts of the system’s database, so that your data is stored correctly within the system.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/map.jpg") ?></div>
<p class="content">- Use the dropdown menus to make the matches. The labels for the drop-down menus are the system’s column names, and the values in the drop-down menus are the column names from your .csv file. The system will try to automatically match the names. It is important, though, that you check to make sure everything is correct. If there is a value in our system for which there is no corresponding match within your column names, leave that drop-down menu blank. The only required pairings are for name and email.</p>
<p class="content">- Once you have made all the pairings, click “Submit”</p>
<p class="content">The system will add the users from your file and send them an email with their login information.</p>
<p class="content">Note: The users added in this method are automatically categorized by the system as inactive. This allows you, as an organizer, to distinguish between volunteers who are actively using the Pitch’n Volunteer Management System, and those who were added through importing of existing records.  If an inactive user logs in to the system, they are re-classified as an active user.</p>
<p class="content">When the system is finished importing users and send emails, it will present you with a message indicating the number of accounts which were successfully created. If there are errors in your .csv file, the system will provide the names associated with the rows where the errors are located. </p>
<h5>Logout</h5>
<p class="content"><red>To log out of the system</red>, click on the secondary features drop-down menu in the navigation bar, and select “Logout”.</p>

<a name="o_2"></a>
<h3>2. Organizer Dashboard</h3>
<p class="content">The Organizer Dashboard is the first screen you will be presented with after you log in. The features of the dashboard provide you with an at-a-glace overview of your organization. These include:</p>
<h5>The Organization Report</h5>
<p class="content">This bar-graph presents you with data about the total number of volunteers assigned to your organization, the number of volunteers currently assigned to at least one project, the number of volunteers not currently assigned to any project, and the number of active volunteers. Remember, active volunteers are those volunteers who have logged in to the system at least once.</p>
<h5>The Current Projects Table:</h5>
<p class="content">This table displays the name, start date, target end date, and a progress bar for all in-progress projects within your organization. </p>
<p class="content"><red>To view details about a project from the Organizer Dashboard</red>, click anywhere on the row corresponding to the project you wish to view.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/dash.jpg") ?></div>

<a name="o_3"></a>
<h3>3. Volunteers (Search)</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/search.jpg") ?></div>
<p class="content">The Volunteers screen allows you to search for and view information about any user assigned to your organization. You may also use this screen to message individual users or groups of users.</p>
<p class="content">Note: By default, only active users are displayed. Inactive users are those users which have been imported by an organization, but that have never logged in to the system. Once an inactive user logs in to the system, his or her status is automatically changed to active. To include inactive users in search results, uncheck the “only active users” checkbox on the search options menu, as described below.</p>
<p class="content"><red>To search for users</red>, begin by clicking the magnifying glass icon at the top of the screen to expand the Search Options menu.</p>
<p class="content">The Search Options menu will allow you to specify criteria by which to search for. </p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/search2.jpg") ?></div>
<p class="content">Next, enter the desired search criteria in the appropriate fields, and click “search”.  The system will then display users with matching criteria in the area below. Click the magnifying glass icon to collapse the Search Options menu to increase the viewing area of the search results.</p>
<h5>Role Assignment</h5>
<p class="content">The Volunteers screen provides one means of assigning roles to Volunteers.</p>
<p class="content"><red>To assign a role to a Volunteer from the Volunteers Screen</red>, first select the project name from the “Assigned Roles” drop-down menu. Next, in the column below the drop-down menu, click anywhere within the cell corresponding the user that you would like to assign. Finally, select the Role from the automatically-generated list of available roles. Once you have selected the Role, the user is assigned and will be sent a message explaining the assignment.</p>
<p class="content">If you would like to view additional information about a Volunteer, you may also view his or her profile from the Volunteer’s screen.</p>
<p class="content"><red>To view a user’s profile</red>, click the profile button (<?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/user_icon.jpg") ?>), located in the same row as the user’s name.</p>
<h4>User Profiles</h4>
<p class="content">User profiles contain all the information a user wishes to share with organizers and administrators, as well as notes organizers have created concerning the user. The profile also provides access to the user’s schedule via the calendar, and the ability to message the user directly.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/user.jpg") ?></div>
<p class="content"><Red>To view this user’s calendar</red>, click the calendar button.</p>
<p class="content"><red>To send this user a message</red>, click the “Send Message” button. This will load the message pop-up with the user’s name already filled out in the “To:” field.</p>
<p class="content"><red>To add a note on the user’s account</red> (viewable only by administrators and organizers), click “Create Note.” The note, along with any other notes pertaining to this user, will appear in the “Organizer Notes” table at the bottom of the user’s profile.</p>

<a name="o_4"></a>
<h3>4. Projects</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/projects.jpg") ?></div>
<p class="content">The Projects screen provides you with a more detailed table of your organization’s projects than does the Dashboard. This table includes all projects, both in-progress and completed, associated with your organization. </p>
<h4>Projects, Roles, and Tasks – Overview</h4>
<p class="content">Within the system, Projects, Roles, and Tasks have the following structure:</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/relationship.png") ?></div>
<p class="content">A Project is divided into 1 or more Roles. These Roles are divided into 1 or more Tasks. </p>
<p class="content">A Volunteer is assigned to a Role. The Volunteer is then responsible for completing the Tasks associated with that Role.</p>
<p class="content">An individual Role can only be assigned to one Volunteer at a time. However, a Role can be copied 0 or more times. When a Role is copied, the Tasks, documents, and contact information are copied as well. Copies of Roles can be assigned to different Volunteers.</p>
<p class="content">The completion progress of a Project is based upon the completion percentage of all of the Tasks in the project. Volunteers will update this data as Tasks are completed.</p>
<p class="content"><red>To create a new project</red>, click the “Create Project” button located in the bottom-left corner of the Projects screen.</p>
<p class="content">You will be required to enter information about the new project. When you are finished, click the “Create” button. The project has now been created and will appear in the table.</p>
<p class="content"><red>To view information about a project</red>, add roles, comments, or project documents, click on the row associated with the project in the table. This will lead to the Project Main screen.</p>
<h5>Project Main</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/project.jpg") ?></div>
<p class="content">The Project Main screen contains information about the project, including any comments made by Organizers or Volunteers.</p>
<p class="content"><red>To edit the project information</red>, click the “Edit Project” button, located in the top-right corner of the Project Main screen.</p>
<p class="content"><red>To change the status of a project from “in-progress” to “completed”</red>, edit the project information and change the status in the status drop-down menu. Click “save” when you are done.</p>
<h5>Project Documents</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/projectdocs.jpg") ?></div>
<p class="content">The Project Documents screen allows you to upload documents that will be downloadable by all volunteers associated with a project.</p>
<p class="content"><red>To upload a document</red>, click the “Choose File” button. Select a file from your computer and click “Submit.” The file will be uploaded and will be visible in the table.</p>
<p class="content"><red>To download a document</red>, click the “download” link in the row associated with the file. The download will begin automatically.</p>
<h5>Project Roles</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/project_roles.jpg") ?></div>
<p class="content">The Project Roles screen provides information about the project’s roles, including the role’s name, description, and the volunteer that it is assigned to. If the “assigned to” cell is empty, the role has not yet been assigned.</p>
<p class="content">The following role-related functions can be performed from the Project Roles screen:</p>
<p class="content"><red>To create a new role</red>, click the “Add Role” button, located in the lower-left corner of the Project Roles screen. You will be asked to give the role a title, and a brief description. Click “Create” when you are done, and the new role will be listed in the table.</p>
<p class="content"><Red>To edit a role</red>, click “edit” in the row associated with the role. You may change the role’s title and/or description. Click “Save” when you are finished, and the role’s information will be updated.</p>
<p class="content"><red>To assign a role to a volunteer</red>, click “assign” in the row corresponding to the role. You will be directed to the Volunteers screen, where you may search for a volunteer to assign the role to. The “Assigned Roles” drop-down menu will be pre-set to the project to which the role belongs. Once you have selected a volunteer, click in the field located in the “Assigned Roles” column, in the row associated with that volunteer. A list of unassigned roles will appear. Select the role by title. Once you have done this, the volunteer will be assigned to the role, and notified of this via message.</p>
<p class="content"><red>To remove a role assignment from a volunteer</red>, click “remove” in the row corresponding to the role. Note: the “remove” link will only appear after a role has been assigned. The volunteer will be unassigned to the role, and the role may now be re-assigned to another volunteer.</p>
<p class="content"><red>To copy a role</red>, click the “copy” link in the row associated with the role. Note: This action also copies all tasks, documents, and contact information associated with a role. In order to make this functionality as useful as possible, it is recommended that you create all tasks, upload all documents, and define all contacts for a role prior to copying it. Instructions for completing these steps can be found in the following sections of this document.</p>
<p class="content"><Red>To delete a role</red>, click the “garbage can” icon in the row associated with the role. The system will ask you to confirm this action. If you select “OK”, the action cannot be undone. This action will also delete all tasks associated with the role.</p>
<p class="content"><red>To view details about a specific role</red>, in the table, click anywhere on the row associated with the role.</p>
<h5>Role Documents</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/roledocs.jpg") ?></div>
<p class="content">The Role Documents screen allows you to upload any number of documents associated with a role. These documents will be visible to, and available for download by, the volunteer assigned to the role.</p>
<p class="content"><red>To upload a document</red>, click the “Choose File” button. Select a file from your computer, and click “Submit”. The file will now upload and be visible in the table.</p>
<p class="content"><red>To download a document</red>, click the “download” link located in the row associated with the document.</p>
<h5>Modify Role Info</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/roleinfo.jpg") ?></div>
<p class="content">The Modify Role Info screen allows you to add and edit information about the role which the volunteer will see. These include any details or instructions you wish the volunteer to have access to.</p>
<p class="content"><red>To add/edit role information</red>, add or change the content of the text area, and click “create”. The information will be updated and you will be re-directed to the Role Tasks screen.</p>
<h5>Role Contacts</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/rolecontacts.jpg") ?></div>
<p class="content">The Role contacts screen allows you to view and define designated contact persons within your organization that the volunteer assigned to the role is to interact with as they perform the duties of the role. </p>
<p class="content">Note: These contact persons must be organizers registered within the system and associated with your organization.</p>
<p class="content"><red>To add a role contact</red>, click the “Add new contact” button. Choose an organizer by name from the drop-down menu, and enter a title for the contact person, such as “project coordinator.” Click “Create” when you are done, and the new contact will be listed in the table.</p>
<p class="content">Note: Volunteers are unable to see email addresses. For role contacts, only the organizer’s name will be displayed.</p>
<h5>Role Tasks</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/roletasks.jpg") ?></div>
<p class="content">The Role Tasks screen displays a list of all of the tasks associated with the role.</p>
<p class="content"><red>To add a new task</red>, click “Add Task”. You will be asked to enter information about the task. Click “Create” when you are done, and the task will be listed in the table.</p>
<p class="content"><red>To delete a task</red>, click the garbage can icon in the row associated with the task. The system will ask you to confirm this action. If you click “OK”, the task will be deleted. This action cannot be undone.</p>
<p class="content"><red>To view detailed information about a task</red>, click anywhere in the row associated with the task. You will be redirected to the Task Main screen.</p>
<h5>Task Main</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/taskmain.jpg") ?></div>
<p class="content">The Task Main screen provides you with detailed information about the task, including the status and the number of hours the volunteer has spent working on the task. Volunteers can also view this screen, and will update the information as they progress through completion of a task.</p>
<p class="content"><red>To edit a task</red>, click the “Edit Task” button, located in the top-right corner of the screen. When you have finished amending the task information, click “Save” and the task information will be updated.</p>
<p class="content"><red>To delete a task</red>, click “Delete Task.” The system will ask for confirmation of this action. If you click “OK”, the task will be deleted. This action cannot be undone.</p>
<p class="content"><red>To add a comment about a task</red>, enter your comment in the text area and click “submit your comment”. Your comment will now be visible in the comments table.</p>
<p class="content">Note: Both Organizers and Volunteers can create/view comments on tasks.</p>


<a name="o_5"></a>
<h3>5. Reports</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/org/taskmain.jpg") ?></div>
<p class="content">The Organization Reports screen provides you with an organization report similar to the one found on the dashboard.</p>
<p class="content"><red>To print the report</red>, click the printer icon, located in the bottom-left corner of the Organization Reports screen. The system will generate a pop-up window with print options. By default, the printer is set to a .pdf document, but those settings may be changed to print on any printer connected to your computer.</p>




<h2>Volunteer Documentation</h2>
<a name="v_faq"></a>
<h3>Volunteer FAQ:</h3>
<p class='faq1'>1. What are Projects, Roles, and Tasks?</p>
<p class='faq2'>See <a href="#v_3">section 3</a>: Projects, Roles, and Tasks – Overview</p>
<p class='faq1'>2. How do I know when I’ve been added to a project?</p>
<p class='faq2'>When an organizer adds you to a project, you will receive a message indicating that you have been added to a project. When you are added to a project, you are assigned at least 1 role within that project. You will receive a message detailing this as well.</p>
<p class='faq1'>3. I volunteer for more than 1 organization; can I see all of my projects/roles/tasks on 1 dashboard?</p>
<p class='faq2'>No. The information displayed by the system on all of your screens is specific to your current organization.  The name of your current organization is displayed on the navigation bar. If you wish to view information about another organization that you volunteer for, you need to change your current organization. See <a href="#vol_1">section 1</a>: Change Current Organization.</p>
<p class='faq1'>4.  When I’ve finished a task, what do I do?</p>
<p class='faq2'>When you have completed a task, you need to let the organizer know. You do this by changing the status of the task. See <a href="#vol_3">section 3</a>: Updating the Task’s Status.</p>
<p class='faq1'>5. Can other volunteers view my profile and personal information?</p>
<p class='faq2'>No. Other volunteers working on the same project as you will see you name and role title listed on the Project – Team screen. That is all the information they can view about you. Only organizers within an organization you volunteer for may view your profile, as can system administrators.</p>

<a name="v_1"></a>
<h3>1. Getting Started</h3>
<h4>Login</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/login.jpg") ?></div>
<p class="content">
    As a user of the Pitch’n Volunteer Management System, this is the first screen you will encounter. </p>
<p class="content">
<red>To log in to the system</red>, enter your email/password combination and click “login”.</p>
<p class="content">
<red>If you have forgotten your password</red>, click “Forgot Password?”, and you will be asked to enter email address. Click “Reset Password”, and a new, temporary password will be emailed to you. Remember to check your junk mail folder if you can’t find the email in your inbox. If you are still experiencing issues logging in, please contact Pitch’n through www.pitchn.ca
</p>
<h4>Navigation Bar</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/navbar.jpg") ?></div>
<p class="content">
    The navigation bar provides access to the system’s messaging, user profile, and secondary features.
</p>
<h4>Messaging</h4>
<p class="content">The messaging system allows you to send/receive messages from other users.</p>
<p class="content">When you have unread messages in your inbox, the messaging icon on the navigation bar will have a red plus (+) symbol displayed on top of it.</p>
<h5>Inbox</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox.jpg") ?></div>
<p class="content">The inbox displays all of the messages you have received from other users. You can also create new messages from this screen. </p>
<p class="content"><red>Access the inbox</red> by clicking on the letter icon on the navigation bar, and selecting “inbox”.</p>
<p class="content"><red>To create a new message</red>, click “Create”.  The message form will appear. Click anywhere in the “To:” field to select a recipient. A list of recipients will be automatically generated for you. You may select multiple recipients if you wish.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox2.jpg") ?></div>
<p class="content">Once you have selected your recipient(s), enter the content for the message in the text area, and click “Send” to send the message.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/inbox3.jpg") ?></div>
<h5>Sent Messages</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/outbox.jpg") ?></div>
<p class="content">The Sent Messages screen displays all of the messages you have sent. </p>
<p class="content"><red>Access the sent messages screen</red> by clicking on the letter icon on the navigation bar, and selecting “Sent Messages.” </p>
<p class="content">Note: Once the recipient of your message has read and deleted your message, it will no longer be listed.</p>
<h4>User Profile</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/profile.jpg") ?></div>
<p class="content">Your user profile contains all the details about you visible only to other Administrators within the Pitch’n Volunteer Management System. </p>
<p class="content"><red>To access your profile</red>, click the profile icon on the navigation bar.</p>
<p class="content">Note: for privacy reasons, Volunteers are unable to view the profile of other users, and Organizers may view only the profiles of volunteers assigned to their organization, as well as the profiles of other Organizers assigned to that same organization.</p>
<p class="content"><red>To edit your profile</red>, click “Edit Profile”. You may change any of the values displayed. Click “Save” to save the results, or click “Dashboard” on the menu to discard the changes.</p>
<p class="content"><red>To change your profile picture</red>, click “Change Picture”. You will be presented with the “Change Picture” screen which displays all of your currently-saved profile pictures:</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/pic1.jpg") ?></div>
<p class="content">The highlighted row represents the currently displayed image. Click on any of the other images to display it as your profile picture.</p>
<p class="content"><red>To upload a new profile picture</red>, click “Upload New Picture” from the “Change Picture” screen. Select a file from your computer to upload, and click “Upload File”.</p>
<p class="content">Note: profile pictures must be 300 x 300 pixels in dimension. </p>
<h4>Secondary Features</h4>
<p class="content">These features are accessed through the Secondary Features drop-down menu (<?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/secondary.jpg") ?>), located on the navigation bar.</p>
<h5>Change Current Organization</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/change.jpg") ?></div>
<p class="content">If you volunteer for more than one organization that uses the Pitch’n Volunteer Management System, you can use the Change Current Organization function to switch between them.</p>
<p class="content"><red>To change your current organization</red>, click on the organization’s name in the table. Your current organization is now changed. When you return to your dashboard (or any other screen), the information presented will be specific to your current organization.</p>
<h5>Logout</h5>
<p class="content"><red>To log out of the system</red>, click on the secondary features drop-down menu in the navigation bar, and select “Logout”.</p>

<a name="v_2"></a>
<h3>2. Volunteer Dashboard</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/dash.jpg") ?></div>
<p class="content">The Volunteer Dashboard is the first screen you are presented with after logging in. The elements of the Volunteer Dashboard will provide you with an overview of your current responsibilities. These elements include:</p>
<h5>The Mini-Calendar</h5>
<p class="content">The Mini-Calendar provides you with an at-a-glance overview of your week/day. Here, your available volunteer times will be displayed in red, and your upcoming task deadlines in purple.</p>
<h5>My Projects Table</h5>
<p class="content">This table lists all of the projects to which you are currently assigned (for your current organization). </p>
<p class="content"><red>To view detailed project information</red>, click anywhere on the row associated with the project.</p>
<h5>My Tasks Table</h5>
<p class="content">This table lists all of the tasks to which you are currently assigned as part of your roles. </p>
<p class="content"><red>To view detailed task information</red>, click anywhere on the row associated with the project.</p>
<h5>Contact Info</h5>
<p class="content">Each role to which you are assigned has specific contact people associated with it. These are individuals the organizers would like you to contact if you have questions about your project/role/tasks. The names of these individuals are listed here, along with their title and work phone number.</p>
<p class="content"><red>To send a message to one of your assigned contacts</red>, click anywhere on the row associated with the person in the table. A message window will be generated. Enter your message and click “send”.</p>

<a name="v_3"></a>
<h3>3. Projects</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/projects.jpg") ?></div>
<p class="content">The Projects screen provides you with a list of all of your assigned projects.</p>
<p class="content"><red>To view detailed information about a project</red>, click anywhere on the row associated with the project in the projects table. You will be redirected to the Project Main screen for the specified project.</p>
<h4>Projects, Roles, and Tasks - Overview</h4>
<p class="content">Within the system, Projects, Roles, and Tasks have the following structure.</p>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/common/relationship.png") ?></div>
<p class="content">A Project is divided into 1 or more Roles. These Roles are divided into 1 or more Tasks. </p>
<p class="content">A volunteer is assigned to a Role. The volunteer is then responsible for completing the Tasks associated with that Role.</p>
<p class="content">An individual Role can only be assigned to one volunteer at a time. However, a Role can be copied 0 or more times. When a Role is copied, the Tasks, documents, and contact information are copied as well. Copies of Roles can be assigned to different volunteers.</p>
<p class="content">The completion progress of a Project is based upon the completion percentage of all of the Tasks in the project. Volunteers are required to update this data as Tasks are completed.</p>
<h5>Project Main</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/project_main.jpg") ?></div>
<p class="content">The Project Main screen provides you with information about the project. It also contains comments made by both organizers and other volunteers.</p>
<p class="content"><red>To add a comment about the project</red>, type your comment in the text area, and click “Submit your comment.” The comment will now appear in the table below.</p>
<h5>Project Team</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/team.jpg") ?></div>
<p class="content">The Project Team screen lists all of the other volunteers assigned to the project.</p>
<p class="content"><red>To send a message to a team member</red>, click the link on the person’s name. A message dialog box will appear. Enter your message and click “Send.”</p>
<h5>Project Documents</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/proj_docs.jpg") ?></div>
<p class="content">The Project Documents screen allows you to both download and upload project-related documents.  These documents are downloadable by all volunteers working on the project, as well as by the organizers.</p>
<p class="content"><red>To download a project-related file</red>, click the “download” link in the row associated with the file.</p>
<p class="content"><red>To upload a project-related file</red>, click the “choose file” button. Select a file from your computer and click “Submit.” The file will then be uploaded and its name will appear in the table.</p>
<h5>Project Tasks</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/proj_tasks.jpg") ?></div>
<p class="content">The Project Tasks screen allows you to view a table which lists all of the tasks currently assigned to you.</p>
<p class="content"><red>To view detailed information about a task</red>, click anywhere on the row associated with the task.</p>
<h5>Project Roles</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/proj_roles.jpg") ?></div>
<p class="content">The Project Roles screen allows you to view a table that lists all of the roles to which you are currently assigned.</p>
<p class="content"><red>To view detailed information about a role</red>, click anywhere on the row associated with the role. You will be redirected to the Role Tasks screen.</p>
<h5>Role Tasks</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/role_tasks.jpg") ?></div>
<h5>Task Main</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/task_main.jpg") ?></div>
<p class="content">The Task Main Screen provides you with detailed information about the task. You may also add comments, and update the task status.</p>
<p class="content"><Red>To add a comment about the task</red>, enter your comment in the text area and click “Submit your comment.” The comment will now appear in the table below.</p>
<h4>Updating a Task's Status</h4>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/task_update.jpg") ?></div>
<p class="content">As a volunteer, you are responsible for updating the status of a task, so that the organizer in charge of the project can monitor the project’s progress.</p>
<p class="content"><red>To update the status of a task</red>, click the “Edit Task” button, located in the top-right corner of the Task Main screen. You will be redirected to the Task – Update screen. You may update the number of hours you have spent working on the task, the completion percentage (estimate), and the task status. </p>
<p class="content"><red>To indicate that you have completed a task</red>, change the status to “Pending Verification.” This will indicate to the organizer that the task is ready to be reviewed. The organizer will review your progress on the task, and either change the status to “completed”, or contact you with follow-up instructions.</p>
<h5>Role Documents</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/role_docs.jpg") ?></div>
<p class="content">The Role Documents screen allows you to download and upload role-related documents. These documents are accessible only by you and by organizers working for the organization.</p>
<p class="content"><red>To download a role-related file</red>, click the “download” link in the row associated with the file.</p>
<p class="content"><red>To upload a role-related file</red>, click the “choose file” button. Select a file from your computer and click “Submit.” The file will then be uploaded and its name will appear in the table.</p>
<h5>Role Info</h5>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/role_info.jpg") ?></div>
<p class="content">The Role Info screen provides you with detailed organization about both the role to which you are assigned, as well as the project to which it belongs. </p>


<a name="v_4"></a>
<h3>4. Calendar</h3>
<div id="image"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/userdocs/vol/calendar.jpg") ?></div>
<p class="content">The Calendar screen allows you to set your available volunteer times, and to view upcoming deadlines. Available volunteer times are represented by red rectangles, and task deadlines are represented by purple rectangles.</p>
<p class="content"><red>To set an available volunteer time</red>, click on the specific day on the calendar. You will be asked to provide start and end dates and times. If you do not enter these values, by default the availability will be set to all day for the specified day. Use the Recurring option to quickly set multiple scheduled available times.</p>
<p class="content"><red>To change or delete an existing available volunteer time</red>, click on the red rectangle for the specified time. The system will allow you to alter the information or delete the available time altogether. You can quickly change the date of an available volunteer time by dragging and dropping the red rectangle from a specified date to another date.</p>