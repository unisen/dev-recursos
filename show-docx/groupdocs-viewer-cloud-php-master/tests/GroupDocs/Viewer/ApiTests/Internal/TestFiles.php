<?php

/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="TestFiles.php">
 *   Copyright (c) 2003-2023 Aspose Pty Ltd
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
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

namespace GroupDocs\Viewer\ApiTests\Internal;

require_once "TestFile.php";

 /*
 * Describes file for tests.
 */
class TestFiles
{
    public static function getFileOnePageDocx()
    {
        $file = new TestFile();
        $file->fileName = "one-page.docx";
        $file->folder = "words\\docx\\";
        return $file;
    }

    public static function getFileNotExist()
    {
        $file = new TestFile();
        $file->fileName = "NotExist.docx";
        $file->folder = "some-folder/";
        return $file;
    }

    public static function getFilePasswordProtectedDocx()
    {
        $file = new TestFile();
        $file->fileName = "password-protected.docx";
        $file->folder = "words\\docx\\";
        $file->password = "password";
        return $file;
    }

    public static function getFileTwoHiddenPagesVsd()
    {
        $file = new TestFile();
        $file->fileName = "two-hidden-pages.vsd";
        $file->folder = "diagram\\vsd\\";
        return $file;
    }
    public static function getFileWithHiddenRowsAndColumns()
    {
        $file = new TestFile();
        $file->fileName = "with-hidden-rows-and-columns.xlsx";
        $file->folder = "cells\\xlsx\\";
        return $file;
    }
    public static function getFileThreeLayoutsDwf()
    {
        $file = new TestFile();
        $file->fileName = "three-layouts.dwf";
        $file->folder = "cad\\dwf\\";
        return $file;
    }
    public static function getFileProjectMpp()
    {
        $file = new TestFile();
        $file->fileName = "sample.mpp";
        $file->folder = "project\\mpp\\";
        return $file;
    }

    public static function getFileUsesCustomFontPptx()
    {
        $file = new TestFile();
        $file->fileName = "uses-custom-font.pptx";
        $file->folder = "slides\\pptx\\";
        return $file;
    }

    public static function getFileFontTtf()
    {
        $file = new TestFile();
        $file->fileName = "foo.ttf";
        $file->folder = "font\\ttf\\";
        return $file;
    }

    public static function getFileFourPagesDocx()
    {
        $file = new TestFile();
        $file->fileName = "four-pages.docx";
        $file->folder = "words\\docx\\";
        return $file;
    }

    public static function getTestFilesList()
    {        
        return array(
            self::getFileOnePageDocx(),
            self::getFilePasswordProtectedDocx(),
            self::getFileTwoHiddenPagesVsd(),
            self::getFileWithHiddenRowsAndColumns(),
            self::getFileThreeLayoutsDwf(),
            self::getFileProjectMpp(),
            self::getFileUsesCustomFontPptx(),
            self::getFileFontTtf(),
            self::getFileFourPagesDocx()
        );
    }      
}
