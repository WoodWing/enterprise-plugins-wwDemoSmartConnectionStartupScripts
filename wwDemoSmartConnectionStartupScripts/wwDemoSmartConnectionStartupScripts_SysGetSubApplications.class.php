<?php
/****************************************************************************
   Copyright 2019 WoodWing Software BV

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
****************************************************************************/

require_once BASEDIR . '/server/interfaces/services/sys/SysGetSubApplications_EnterpriseConnector.class.php';

class wwDemoSmartConnectionStartupScripts_SysGetSubApplications extends SysGetSubApplications_EnterpriseConnector
{
	final public function getPrio()     { return self::PRIO_DEFAULT; }
	final public function getRunMode()  { return self::RUNMODE_BEFOREAFTER; }

	final public function runBefore( SysGetSubApplicationsRequest &$req )
	{	
	} 

	final public function runAfter( SysGetSubApplicationsRequest $req, SysGetSubApplicationsResponse &$resp )
	{
		if( is_null($req->ClientAppName) ||
			$req->ClientAppName == 'InDesign' ||
			$req->ClientAppName == 'InCopy' ||
			$req->ClientAppName == 'InDesign Server' ) {
			
			require_once BASEDIR . '/server/interfaces/services/sys/DataClasses.php';

			$subApp = new SysSubApplication();
			$subApp->ID = 'SmartConnectionScripts_StartupScripts';
			
			$zipfile = '/Scripts/'.$req->ClientAppName.'/Scripts.zip';
			$stat = stat(dirname(__FILE__).$zipfile);
			$subApp->Version = strval($stat['mtime']);

			$subApp->PackageUrl = SERVERURL_ROOT.INETROOT.'/config/plugins/'.basename(dirname(__FILE__)).$zipfile;
			
			$subApp->DisplayName = 'StartupScripts';
			if( !is_null($req->ClientAppName) ) { 
				$subApp->ClientAppName = $req->ClientAppName;
			}
			else {
				$subApp->ClientAppName = 'InDesign';
			}
			$resp->SubApplications[] = $subApp;		
		}
		LogHandler::Log( 'wwDemoSmartConnectionStartupScripts', 'DEBUG', 'Returns: wwDemoSmartConnectionStartupScripts_SysGetSubApplications->runAfter()' );
	} 
	
	final public function onError( SysGetSubApplicationsRequest $req, BizException $e )
	{
		LogHandler::Log( 'wwDemoSmartConnectionStartupScripts', 'DEBUG', 'Called: wwDemoSmartConnectionStartupScripts_SysGetSubApplications->onError()' );
		require_once dirname(__FILE__) . '/config.php';

		LogHandler::Log( 'wwDemoSmartConnectionStartupScripts', 'DEBUG', 'Returns: wwDemoSmartConnectionStartupScripts_SysGetSubApplications->onError()' );
	} 
	
	// Not called.
	final public function runOverruled( SysGetSubApplicationsRequest $req )
	{
	}
}
