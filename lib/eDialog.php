<?

/**
 * This class allows a user to interact with the eDialog API.
 * @author ksowocki@gmail.com
 */

class eDialog {

	// UPDATE ME!
	const SDK_USER = "UPDATE_ME"; 
	const SDK_PASS = "UPDATE_ME"; 
	const PATH_TO_NUSOAP = "3rdparty_lib/nusoap/lib/nusoap.php";
	const IS_PRODUCTION = false;
	
	static $availableMethods = array(
		'buildAudienceFromIBQuery',
		'buildPermutationProofSample',
		'buildRandomProofSample',
		'canAccessClient',
		'cancelCell',
		'cancelExportJob',
		'clearSymbolMap',
		'cloneAudience',
		'cloneCell',
		'cloneMailing',
		'createAudience',
		'createAudienceClass',
		'createCampaign',
		'createCell',
		'createContent',
		'createDataUploadConfigForExistingAudience',
		'createDataUploadConfigForExistingSuppression',
		'createDataUploadConfigForGlobalUnsub',
		'createDataUploadConfigForNewAudience',
		'createDataUploadConfigForNewSuppression',
		'createGrid',
		'createMailing',
		'createRTMConfiguration',
		'createTabSeparatedGrid',
		'createXmlGrid',
		'deleteAllRTMVariations',
		'deleteAudience',
		'deleteCampaign',
		'deleteCell',
		'deleteContent',
		'deleteGrid',
		'deleteMailing',
		'deleteRTMConfiguration',
		'downloadAudience',
		'getCellContentId',
		'getDeliverabilityReport',
		'getEReportsRefreshStatus',
		'getExportJobStatus',
		'getGoodMailHeader',
		'getIBJobStatus',
		'getMailingVolumeReport',
		'getMemberCount',
		'getProofGroupOptions',
		'getProofSampleSetting',
		'getProofSampleStatus',
		'hideContent',
		'listAllDataColumns',
		'listAudienceClasses',
		'listAudiences',
		'listAudiencesByFilter',
		'listAudienceUdfs',
		'listAvailableMeters',
		'listCampaigns',
		'listCampaignUdfs',
		'listCells',
		'listCellsByFilter',
		'listCellUdfCategoryNames',
		'listCellUdfs',
		'listClients',
		'listContent',
		'listContentAlt',
		'listContentUdfs',
		'listDataColumnsForAudience',
		'listDataColumnsForCell',
		'listDomains',
		'listEReportTypes',
		'listExportedDataColumns',
		'listFeederQueues',
		'listForwardToFriendTemplates',
		'listGridColumns',
		'listGridKeyValues',
		'listGrids',
		'listIBQueries',
		'listLinks',
		'listMailings',
		'listMailingsByFilter',
		'listMailingsByFilterAndMailingType',
		'listMailingUdfs',
		'listMappingFunctionsForCell',
		'listMasterUniqueKeyColumns',
		'listProofAudienceEmails',
		'listProofGroupSampleCIDs',
		'listProofSampleCIDs',
		'listRealTimeMessageConfigurations',
		'listRecipientCellEvents',
		'listRecipientHistory',
		'listRTMConfigurations',
		'listRTMQueues',
		'listSymbolsInCell',
		'listSymbolsInContent',
		'listSymbolsInText',
		'listUdfCategoryNamesAndValues',
		'listUnsubTemplates',
		'listWebAnalyticsTokens',
		'lookupAudienceByAlternateKey',
		'lookupAudienceById',
		'lookupAudienceByIds',
		'lookupCampaignById',
		'lookupCellAdvancedOptionsById',
		'lookupCellByAlternateKey',
		'lookupCellById',
		'lookupCellStatus',
		'lookupContentByAlternateKey',
		'lookupContentById',
		'lookupContentDeliveryPart',
		'lookupDataUploadStatus',
		'lookupGrid',
		'lookupIBQueryById',
		'lookupLinkByEncodedURL',
		'lookupLinkById',
		'lookupMailingByAlternateKey',
		'lookupMailingById',
		'lookupRecipientAudienceProfile',
		'lookupRecipientProfile',
		'lookupRTMConfiguration',
		'lookupSymbolMap',
		'lookupTabSeparatedGrid',
		'lookupXmlGrid',
		'mapAllGridColumnsToSymbols',
		'mapAllGridColumnsToSymbolsByKeyLiteral',
		'mapGridColumnToSymbol',
		'mapGridColumnToSymbolByKeyLiteral',
		'mapSymbolToContent',
		'mapSymbolToCustomFunction',
		'mapSymbolToDataColumn',
		'mapSymbolToLiteralValue',
		'pauseCell',
		'promoteRTMTestCell',
		'refreshEReports',
		'resetSymbolMap',
		'resumeCell',
		'retrieveCellViewEReports',
		'retrieveEReports',
		'retrieveMailingViewEReports',
		'retrieveMailingViewEReportsUdfs',
		'retrievePulseReport',
		'scheduleCell',
		'scheduleMailing',
		'sendCellAsScheduled',
		'sendCellLater',
		'sendCellNow',
		'sendMailingAsScheduled',
		'sendMailingLater',
		'sendMailingNow',
		'sendMessage',
		'sendProofMessage',
		'sendProofsNow',
		'setCellAudiences',
		'setCellProofAddresses',
		'setCellUnsubRules',
		'setSymbolMap',
		'startExportJob',
		'unhideContent',
		'updateAudience',
		'updateCampaign',
		'updateCell',
		'updateCellAdvancedOptions',
		'updateCellConversionTracking',
		'updateCellDropDate',
		'updateCellFeederQueue',
		'updateCellHeaders',
		'updateCellMetering',
		'updateCellWebAnalytics',
		'updateContent',
		'updateContentDeliveryPart',
		'updateGrid',
		'updateLink',
		'updateMailing',
		'updateProofGroupOptions',
		'updateProofGroupSampleCIDs',
		'updateRecipientProfile',
		'updateRTMConfiguration',
		'updateRTMTestCell',
		'updateRTMVariations',
		'updateTabSeparatedGrid',
		'updateXmlGrid',
		'wrapUrlsInText'
		);

	var $client = null;

	/**
	 * @return string a URL to post a request to.
	 */
	private static function URL(){
		if(!self::IS_PRODUCTION){
			$SdkURL = 'https://sdk-staging.e-dialog.com/edialog-webservices/SdkService.wsdl'; 
		} else {
			$SdkURL = "https://sdk.e-dialog.com/edialog-webservices/SdkService.wsdl"; 
		}
		return $SdkURL;
	}

	/**
	 * constructor for the edialog 
	 */
	public function __construct(){
		require_once(self::PATH_TO_NUSOAP);
		$this->client = new soapclient(self::URL(), true);
		$this->client->setCredentials(self::SDK_USER, self::SDK_PASS);
	}	

	/**
	 * @param  string $endpoint an endpoint name (from self::$availableMethods)
	 * @param  associative array $params   an array of arguments to pass into the method
	 * @return an array, containing a an index
	 *                   'response' => a response from the endpoint.
	 *                   'error' => a list of errors 
	 *                   'error' => a list of debug information 
	 */
	public function request($endpoint,$params){

		if(!in_array($endpoint, self::$availableMethods))
			return false;
		if(!is_array($params))
			$params = array();
		
		$result = $this->client->call($endpoint,$params);

		if ($this->client->fault) {
			//error condition
			$err = $this->client->getError(); 
		} else {
			//get response
			$response = $result;
		}
		if ($debug) {
			//debug information
			$debug = array(
				'request' => $this->client->request,
				'response' => $this->client->response,
				'debug_info' => $this->client->debug_str 
			);
		}

		return array(
			'response' => $response,
			'errors' => (array)$err,
			'debug' => $debug
			);
	}



}
?>




