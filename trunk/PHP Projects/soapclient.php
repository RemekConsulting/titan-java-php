<?php
/*
-------------------------------------------------------------------------------------------------
---   O B J E C T   D E S C R I P T I O N
-------------------------------------------------------------------------------------------------
--- This script is used to connect to the Titan webservice and extract the schedule for the
--- selected cinema and return a formatted table containing the necessary links.
---
--- AUTHOR: Greg Bridle
--- DATE:	2011.01.25.
---
--- PATCH HISTORY
---
--- DATE          BY                DESCRIPTION
-------------------------------------------------------------------------------------------------
*/

ini_set('soap.wsdl_cache_enabled', '0'); 
ini_set('soap.wsdl_cache_ttl', '0'); 

// Determine the location for the WSDL file to be used
$strWsdlFile = 'http://ttg.cinemacity.cz/soaptixs/soaptixs.wsdl';

		
try
	{
    $client = new SoapClient($strWsdlFile, array('cache_wsdl' => 0, 'features' => SOAP_SINGLE_ELEMENT_ARRAYS, 'trace' => 1));
	}
catch (Exception $objException)
	{
	echo $objException->faultstring, "<br>";
	}

// Make a call to GetEventMasters to return a list of scheduled events for the site for the current date
try
	{
	$response = $client->__soapCall('GetEventMasters', array('siteGroupId' => 1001, 'siteId' => 1031, 'ticketingServiceCode' => 'web', 'topXCount' => 0, 'startingDate' => '2011-03-27T00:00', 'sortOrder' => 0));

	echo "<strong>Request:</strong><br />", htmlentities($client->__getLastRequest()), "<br />";
	echo "<strong>Response:</strong><br />", htmlentities($client->__getLastResponse()), "<br />";

	}
catch (Exception $objException)
	{
	echo "<strong>Request:</strong><br />", htmlentities($client->__getLastRequest()), "<br />";
	echo "<strong>Response:</strong><br />", htmlentities($client->__getLastResponse()), "<br />";

	echo 'SOAP Exeception: ' . $objException->faultstring, "<br>";
	}
?>
