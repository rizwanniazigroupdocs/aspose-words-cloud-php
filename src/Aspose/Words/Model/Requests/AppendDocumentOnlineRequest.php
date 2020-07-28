<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="AppendDocumentOnlineRequest.php">
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

namespace Aspose\Words\Model\Requests;

/*
 * Request model for appendDocumentOnline operation.
 */
class AppendDocumentOnlineRequest
{
    /*
     * The document.
     */
    public $document;

    /*
     * <see cref="DocumentEntryList"/> with a list of documents to append.
     */
    public $document_list;

    /*
     * Initializes a new instance of the AppendDocumentOnlineRequest class.
     *
     * @param \SplFileObject $document The document.
     * @param \Aspose\Words\Model\DocumentEntryList $document_list <see cref="DocumentEntryList"/> with a list of documents to append.
     */
    public function __construct($document, $document_list)
    {
        $this->document = $document;
        $this->document_list = $document_list;
    }

    /*
     * The document.
     */
    public function get_document()
    {
        return $this->document;
    }

    /*
     * The document.
     */
    public function set_document($value)
    {
        $this->document = $value;
        return $this;
    }

    /*
     * <see cref="DocumentEntryList"/> with a list of documents to append.
     */
    public function get_document_list()
    {
        return $this->document_list;
    }

    /*
     * <see cref="DocumentEntryList"/> with a list of documents to append.
     */
    public function set_document_list($value)
    {
        $this->document_list = $value;
        return $this;
    }
}
