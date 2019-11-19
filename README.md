# enterprise-plugins-wwDemoSmartConnectionStartupScripts
This plug-in pushes InDesign scripts or InCopy scripts to the clients at login. Do not forget to enable this feature in the Access Profiles.

See also https://helpcenter.woodwing.com/hc/en-us/articles/204807589-Automatically-deploying-event-scripts-for-Smart-Connection-in-InDesign-or-InCopy

Installing the plugin:

- Install the wwDemoSmartConnectionStartupScripts in the Enterprise/config/plugins folder and activate the script in the Admin Server Plugins page
- Enable the scripts feature in Access Profiles
- Put scripts either in Scripts/InCopy or in Scripts/InDesign (subfolders, such as 'Startup Scripts' allowed)
- Create a Scripts.zip in both the InCopy folder and the InDesign folder, containing the scripts to deploy


Checking script deployment:

- Login in InDesign or InCopy
- Open the Scripts Panel
- Right click on the User folder in the Scripts Panel and select 'Reveal in Finder'
- The Finder/Explorer opens the User Scripts Panel folder
- Next to the User Scripts Panel folder a new folder has been created: EnterpriseScripts
- The EnterpriseScripts folder shows the scripts from the Scripts.zip
- The EnterpriseScripts/subAppsData.xml shows all script packages and their version ids
