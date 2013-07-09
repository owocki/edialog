
# PHP Wrapper for eDialog API.

This class acts as an object-oriented wrapper for the eDialog API.

## Installing & Using

1. Update [these 4 variables](https://github.com/owocki/edialog/blob/master/lib/eDialog.php#L11-L14).
2. Run [this script](https://github.com/owocki/edialog/blob/master/run.php).
3. Profit.


## What e-Dialog Web Services Lets Your Applications Do
You can use e-Dialog Web Services to create applications that do the following:

### Audiences
 * Upload customer data to e-Dialog
 * Create and update audience lists
 * Create and update suppression (exclusion) lists
 * Associate audiences with categories
 * Export the audience list to a data file
 * Find audiences by criteria

### Campaigns, mailings, and cells
 * Create, update, and delete campaigns, mailings, and cells
 * Clone mailings and cells
 * Associate campaigns, mailings, and cells with categories (UDFs)
 * Specify the audience for a cell
 * Specify the content to appear in a cell
 * Send proofs
 * Send final emails immediately
 * Schedule sending final email
 * Schedule the merger and sending the final email separately
 * Create and send real time messages
 * Search by and for categories (UDFs)

### Content
 * Upload text and HTML content to the Content Library
 * Associate content with categories
 * Map symbols to content, data columns, text, or custom functions
Symbols act like variables in the content of email. When each individual email is sent, the appropriate content replaces each symbol.
 * Use grids for complex dynamic publishing
 * Find and change redirect links

### Reporting
 * Refresh and retrieve eReports data
 * Retrieve Pulse Reports data



## Reference Links

* A list of available methods is [here](http://sdk.e-dialog.com/edialog-webservices/SdkService.wsdl).
* Also [here](http://www.pdf-archive.com/2013/02/19/ewsreference/ewsreference.pdf).
* [Developer Guide](http://www.pdf-archive.com/2013/02/19/e-dialog-web-services-developer-guide-v1-4/e-dialog-web-services-developer-guide-v1-4.pdf).

## Sample request within our app

```php

$eDialog = new eDialog();
$response = $eDialog->request('listAudiences',array(
	'filterType' => 'Membership',
	'filterNameExpression' => null,
	'filterStartCreateDate' => date(DateTime::ATOM,strtotime('-3years')),
	'filterEndCreateDate' => date(DateTime::ATOM,strtotime('+1days')),
	'sortBy' => null,
	'pageSize' => 10,
	'pageNumber' => 1,
	));
var_dump($response);


```




