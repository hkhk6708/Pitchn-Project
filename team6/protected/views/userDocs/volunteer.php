<?php
/* @var $this UserDocsController */

$this->breadcrumbs=array(
	'User Docs'=>array('/userDocs'),
	'Volunteer',
);
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/userdocs.css" />
</html>

<h2>Table of Contents</h2>
		
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