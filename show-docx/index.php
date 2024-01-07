<?php

require_once(__DIR__ . '/vendor/autoload.php');

//TODO: Get your AppSID and AppKey at https://dashboard.groupdocs.cloud (free registration is required).
$configuration = new GroupDocs\Viewer\Configuration();
$configuration->setAppSid("4b40cd05-9003-4dda-be59-72440b8a7d77");
$configuration->setAppKey("b5e81cf3ca1806d983bbbf8040e30baf");

$infoApi = new GroupDocs\Viewer\InfoApi($configuration); 

try {
    $response = $infoApi->getSupportedFileFormats();

    foreach ($response->getFormats() as $key => $format) {
        echo $format->getFileFormat() . " - " .  $format->getExtension(), "\n";
    }
} catch (Exception $e) {
    echo  "Something went wrong: ",  $e->getMessage(), "\n";
    PHP_EOL;
}


// This code example demonstrates how to render DOCX to HTML.
// Initialize the api
$apiInstance = new GroupDocs\Viewer\ViewApi($configuration);
$fileApi = new GroupDocs\Viewer\FileApi($configuration);

// Define ViewOptions
$viewOptions = new Model\ViewOptions();

// Input file path
$fileInfo = new Model\FileInfo();
$fileInfo->setFilePath("input.docx");	
$viewOptions->setFileInfo($fileInfo);

// Set ViewFormat
$viewOptions->setViewFormat(Model\ViewOptions::VIEW_FORMAT_HTML);

// Define HTML options
$renderOptions = new Model\HtmlOptions();

// Set it to be responsive
$renderOptions->setIsResponsive(true);

// Set for printing
$renderOptions->setForPrinting(true);

// Assign render options
$viewOptions->setRenderOptions($renderOptions);

// Create view request
$request = new Requests\CreateViewRequest($viewOptions);

// Create view
$response = $apiInstance->createView($request);

// Load an existing HTML file
$domDoc = new DOMDocument();
$domDoc->loadHTMLFile("C:\Files\Viewer\Sample.html");
$body = $domDoc->GetElementsByTagName('body')->item(0);

// Get pages
$pages = $response->getPages();

// Embed all rendered HTML pages into body tag of existing HTML
foreach ($pages as $page)
{
    // Create download file request
    $downloadFileRequest = new GroupDocs\Viewer\Model\Requests\DownloadFileRequest($page->getPath(), "");

    // Download converted page
    $file = $fileApi->DownloadFile($downloadFileRequest);

    // Read HTML from download file
    $html = file_get_contents($file->getRealPath());

    //Add content to fragment
    $fragment = $domDoc->createDocumentFragment();
    $fragment->appendXML("<div>$html</div>");

    // Append the element to body
    $body->appendChild($fragment);
}

// Save updated HTML
$output = $domDoc->saveHTML();

// Save the file
file_put_contents("C:\Files\Viewer\Sample.html", $output);

?>