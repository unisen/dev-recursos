<?php
/**
* --------------------------------------------------------------------------------------------------------------------
* <copyright company="Aspose Pty Ltd" file="ViewerDeleteViewApiTest.php">
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
use \GroupDocs\Viewer\Model\DeleteViewOptions;

require_once "BaseApiTestCase.php";

class ViewerDeleteViewApiTest extends BaseApiTestCase
{
    public function testDeleteViewWithDefaultViewFormat()
    {
        // Create view
        $testFile = Internal\TestFiles::getFileOnePageDocx();
        $viewOptions = new ViewOptions();
        $viewOptions->setFileInfo($testFile->ToFileInfo());
        $request = new Requests\createViewRequest($viewOptions);
       
        $response = self::$viewApi->createView($request);

        $this->assertEquals(1, count($response->getPages()));
        $this->assertEquals(0, count($response->getAttachments()));
        $this->assertEquals(1, $response->getPages()[0]->getNumber());

        // Delete view
        $deleteOptions = new DeleteViewOptions();
        $deleteOptions->setFileInfo($testFile->ToFileInfo());
        $deleteRequest = new Requests\deleteViewRequest($deleteOptions);
       
        self::$viewApi->deleteView($deleteRequest);        
    }    
}
