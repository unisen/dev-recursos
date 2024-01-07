<?php
/**
* --------------------------------------------------------------------------------------------------------------------
* <copyright company="Aspose Pty Ltd" file="ViewerGetInfoApiTest.php">
*   Copyright (c) 2003-2023 Aspose Pty Ltd
* </copyright>
* <summary>
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"), to deal
*  in the Software without restriction, including without limitation the rights
*  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*  copies of the Software, and to permit persons to whom the Software is
*  furnished to do so, subject to the following conditions:
*
*  The above copyright notice and this permission notice shall be included in all
*  copies or substantial portions of the Software.
*
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
*  SOFTWARE.
* </summary>
* --------------------------------------------------------------------------------------------------------------------
*/
namespace GroupDocs\Viewer\ApiTests;

use GroupDocs\Viewer\Model\Requests;
use \GroupDocs\Viewer\Model\ViewOptions;
use \GroupDocs\Viewer\Model\RenderOptions;
use \GroupDocs\Viewer\Model\ImageOptions;

require_once "BaseApiTestCase.php";

class ViewerGetInfoApiTest extends BaseApiTestCase
{
    public function testGetInfoReturnsMissingFileInfo()
    {
        $this->expectException(\GroupDocs\Viewer\ApiException::class);
        $this->expectExceptionMessageMatches("/Parameter 'FileInfo' is not specified./");        

        $viewOptions = new ViewOptions();
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);
    }

    public function testGetInfoReturnsFileNotFound()
    {
        $this->expectException(\GroupDocs\Viewer\ApiException::class);
        $this->expectExceptionMessageMatches("/Can't find file located at 'some-folder\/NotExist.docx'./");        

        $testFile = Internal\TestFiles::getFileNotExist();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);
    }

    public function testTestGetInfoPasswordProtected()
    {
        $this->expectException(\GroupDocs\Viewer\ApiException::class);
        $this->expectExceptionMessageMatches("/Please specify password to load the document./");        

        $testFile = Internal\TestFiles::getFilePasswordProtectedDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->getFileInfo()->setPassword(null);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);
    }
    public function testGetInfoWithMinimalViewOptions()
    {
        $testFile = Internal\TestFiles::getFilePasswordProtectedDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);
        $this->assertFalse(empty($response));
        $this->assertEquals(4, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
    }

    public function testGetInfoWithDefaultViewFormat()
    {
        $testFile = Internal\TestFiles::getFileOnePageDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(1, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
        $this->assertEquals(1, $response->getPages()[0]->getNumber());
    }    

    public function testGetInfoWithHtmlViewFormat()
    {
        $testFile = Internal\TestFiles::getFileOnePageDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setViewFormat(ViewOptions::VIEW_FORMAT_HTML);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(1, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
        $page = $response->getPages()[0];
        $this->assertEquals(1, $page->getNumber());
    }     

    public function testGetInfoWithImageViewFormat()
    {
        $testFile = Internal\TestFiles::getFileOnePageDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setViewFormat(ViewOptions::VIEW_FORMAT_PNG);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(1, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
        $page = $response->getPages()[0];
        $this->assertEquals(1, $page->getNumber());
        $this->assertGreaterThan(0, $page->getWidth());
    }

    public function testGetInfoWithRenderHiddenPages()
    {
        $testFile = Internal\TestFiles::getFileTwoHiddenPagesVsd();
        $renderOptions = new RenderOptions();
        $renderOptions->setRenderHiddenPages(true);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(3, count($response->getPages()));
    }

    public function testGetInfoWithSpreadsheetPaginateSheetsOption()
    {
        $testFile = Internal\TestFiles::getFileWithHiddenRowsAndColumns();
        $ssOptions = new \GroupDocs\Viewer\Model\SpreadsheetOptions();
        $ssOptions->setPaginateSheets(true);
        $ssOptions->setCountRowsPerPage(5);
        $renderOptions = new RenderOptions();
        $renderOptions->setSpreadsheetOptions($ssOptions);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(3, count($response->getPages()));
    }    

    public function testGetInfoWithSpreadsheetRenderHiddenRowsOption()
    {
        $testFile = Internal\TestFiles::getFileWithHiddenRowsAndColumns();
        $ssOptions = new \GroupDocs\Viewer\Model\SpreadsheetOptions();
        $ssOptions->setPaginateSheets(true);
        $ssOptions->setCountRowsPerPage(5);
        $ssOptions->setRenderHiddenRows(true);
        $renderOptions = new RenderOptions();
        $renderOptions->setSpreadsheetOptions($ssOptions);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(3, count($response->getPages()));
    }  

    public function testGetInfoWithCadOptions()
    {
        $testFile = Internal\TestFiles::getFileThreeLayoutsDwf();
        $cadOptions = new \GroupDocs\Viewer\Model\CadOptions();
        $cadOptions->setScaleFactor(5.0);
        $renderOptions = new RenderOptions();
        $renderOptions->setCadOptions($cadOptions);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(3, count($response->getPages()));
    }  

    public function testGetInfoWithProjectOptions()
    {
        $testFile = Internal\TestFiles::getFileProjectMpp();
        $projectOptions = new \GroupDocs\Viewer\Model\ProjectManagementOptions();
        $projectOptions->setPageSize(\GroupDocs\Viewer\Model\ProjectManagementOptions::PAGE_SIZE_UNSPECIFIED);
        $projectOptions->setTimeUnit(\GroupDocs\Viewer\Model\ProjectManagementOptions::TIME_UNIT_MONTHS);
        $projectOptions->setStartDate("2008/07/01");
        $projectOptions->setEndDate("2008/07/31");
        $renderOptions = new RenderOptions();
        $renderOptions->setProjectManagementOptions($projectOptions);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertGreaterThan(0, count($response->getPages()));
    }

    public function testGetInfoWithImageOptions()
    {
        $testFile = Internal\TestFiles::getFileOnePageDocx();
        $renderOptions = new ImageOptions();
        $renderOptions->setExtractText(true);
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $viewOptions->setViewFormat(ViewOptions::VIEW_FORMAT_PNG);
        $viewOptions->setRenderOptions($renderOptions);
        $request = new Requests\getInfoRequest($viewOptions);
       
        $response = self::$infoApi->getInfo($request);

        $this->assertEquals(1, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
        $page = $response->getPages()[0];
        $this->assertEquals(1, $page->getNumber());
        $this->assertGreaterThan(0, count($page->getLines())); 
    }      
}
