<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="ClassificationTests.php">
 *   Copyright (c) 2020 Aspose.Words for Cloud
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
 * --------------------------------------------------------------------------------
 */

namespace Aspose\Tests;

use Aspose\Words\Model\Requests;
use Aspose\Words\Model\BookmarkData;
use PHPUnit\Framework\Assert;

/*
 * Example of how to classify text.
 */
class ClassificationTests extends BaseTestContext
{
    private static $remoteDataFolder = baseRemoteFolder . "/Common";
    private static $localFile = "Common/test_multi_pages.docx";

    /*
     * Test for raw text classification.
     */
    public function testClassify()
    {
        $request = new Requests\ClassifyRequest(
            "Try text classification",
            "3"
        );

        $result = $this->words->classify($request);
        Assert::isTrue(json_decode($result, true) !== NULL);
    }

    /*
     * Test for document classification.
     */
    public function testClassifyDocument()
    {
        $remoteFileName = "Source.docx";

        $this->uploadFile(
            realpath(__DIR__ . '/../../../../..') . $localFile,
            $remoteDataFolder . "/" . $remoteFileName
        );

        $request = new Requests\ClassifyDocumentRequest(
            $remoteFileName,
            $remoteDataFolder,
            NULL,
            NULL,
            NULL,
            "3",
            NULL
        );

        $result = $this->words->classifyDocument($request);
        Assert::isTrue(json_decode($result, true) !== NULL);
    }

    /*
     * Test for document classification with taxonomy documents.
     */
    public function testClassifyTaxonomyDocuments()
    {
        $remoteFileName = "Source.docx";

        $this->uploadFile(
            realpath(__DIR__ . '/../../../../..') . $localFile,
            $remoteDataFolder . "/" . $remoteFileName
        );

        $request = new Requests\ClassifyDocumentRequest(
            $remoteFileName,
            $remoteDataFolder,
            NULL,
            NULL,
            NULL,
            "3",
            "documents"
        );

        $result = $this->words->classifyDocument($request);
        Assert::isTrue(json_decode($result, true) !== NULL);
    }
}