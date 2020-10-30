<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="BuildReportTests.php">
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
use PHPUnit\Framework\Assert;

/*
 * Example of how to perform mail merge.
 */
class BuildReportTests extends BaseTestContext
{
    /*
     * Test for build report online.
     */
    public function testBuildReportOnline()
    {
        $reportingFolder = "DocumentActions/Reporting";
        $localDocumentFile = "ReportTemplate.docx";
        $localDataFile = file_get_contents(realpath(__DIR__ . '/../../../../..') . "/TestData/" . $reportingFolder . "/ReportData.json");

        $requestReportEngineSettings = new \Aspose\Words\Model\ReportEngineSettings(array(
            "data_source_type" => "Json",
            "data_source_name" => "persons",
        ));
        $request = new Requests\BuildReportOnlineRequest(
            realpath(__DIR__ . '/../../../../..') . "/TestData/" . $reportingFolder . "/" . $localDocumentFile,
            $localDataFile,
            $requestReportEngineSettings,
            NULL
        );

        $result = $this->words->buildReportOnline($request);
        Assert::assertNotNull($result, "Error occurred");
    }

    /*
     * Test for build report.
     */
    public function testBuildReport()
    {
        $remoteDataFolder = self::$baseRemoteFolderPath . "/DocumentActions/Reporting";
        $reportingFolder = "DocumentActions/Reporting";
        $localDocumentFile = "ReportTemplate.docx";
        $remoteFileName = "TestBuildReport.docx";
        $localDataFile = file_get_contents(realpath(__DIR__ . '/../../../../..') . "/TestData/" . $reportingFolder . "/ReportData.json");

        $this->uploadFile(
            realpath(__DIR__ . '/../../../../..') . "/TestData/" . $reportingFolder . "/" . $localDocumentFile,
            $remoteDataFolder . "/" . $remoteFileName
        );

        $requestReportEngineSettingsReportBuildOptions = [
            "AllowMissingMembers",
            "RemoveEmptyParagraphs",
        ];
        $requestReportEngineSettings = new \Aspose\Words\Model\ReportEngineSettings(array(
            "data_source_type" => "Json",
            "report_build_options" => $requestReportEngineSettingsReportBuildOptions,
        ));
        $request = new Requests\BuildReportRequest(
            $remoteFileName,
            $localDataFile,
            $requestReportEngineSettings,
            $remoteDataFolder,
            NULL,
            NULL,
            NULL,
            NULL
        );

        $result = $this->words->buildReport($request);
        Assert::isTrue(json_decode($result, true) !== NULL);
        Assert::assertNotNull($result->getDocument());
        Assert::assertEquals("TestBuildReport.docx", substr($result->getDocument()->getFileName(), 0, strlen("TestBuildReport.docx")));
    }
}